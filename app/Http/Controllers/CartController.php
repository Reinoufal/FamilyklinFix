<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    private function getHargaProduk($productType, $layanan, $ukuran)
    {
        $harga = [
            'kasur' => [
                'Hydrovacuum' => [
                    'Kasur Super King' => 170000,
                    'Kasur King' => 160000,
                    'Kasur Queen' => 150000,
                    'Kasur Singel' => 120000,
                    'Kasur Kecil' => 85000,
                ],
                'Cuci Kasur' => [
                    'Kasur Super King' => 350000,
                    'Kasur King' => 300000,
                    'Kasur Queen' => 260000,
                    'Kasur Singel' => 200000,
                    'Kasur Kecil' => 150000,
                ],
            ],
            'sofa' => [
                'Hydrovacuum' => [
                    'Sofa Standart' => 50000,
                    'Sofa Jumbo' => 55000,
                    'Sofa Bed' => 125000,
                    'Sofa L' => 175000,
                    'Sofa Reclainer' => 75000,
                ],
                'Cuci Sofa' => [
                    'Sofa Standart' => 65000,
                    'Sofa Jumbo' => 75000,
                    'Sofa Bed' => 200000,
                    'Sofa L' => 300000,
                    'Sofa Reclainer' => 95000,
                ],
            ],
            // Tambahkan tipe produk lain jika perlu
        ];
        return $harga[$productType][$layanan][$ukuran] ?? 0;
    }

    public function add(Request $request)
    {
        file_put_contents(base_path('cart-debug.txt'), json_encode($request->all()));
        $id = $request->input('id');
        $type = $request->input('type');
        $quantity = (int) $request->input('quantity', 1);
        if ($quantity < 1) $quantity = 1;

        Log::info('Cart Add', [
            'id' => $id,
            'type' => $type,
            'quantity' => $quantity,
            'cart_before' => session('cart', [])
        ]);

        if ($type === 'product') {
            $item = Product::with('options.values')->findOrFail($id);
        } else {
            $item = Service::findOrFail($id);
        }

        $cart = session()->get('cart', []);
        $key = $type . '_' . $id . '_' . md5(json_encode($request->input('options', [])));

        $basePrice = $item->price;
        $options = $request->input('options', []);
        $optionDetails = [];
        $additionalPrice = 0;

        if ($type === 'product') {
            $layanan = null;
            $ukuran = null;
            $isSimpleType = in_array($item->type, ['perlengkapan_bayi', 'add_on']);
            if ($isSimpleType) {
                // Ambil id layanan dan dummy dari options
                $layananOption = $item->options->where('name', 'Layanan')->first();
                $dummyOption = $item->options->where('name', 'Dummy')->first();
                $layananId = $layananOption ? ($options[$layananOption->id] ?? null) : null;
                $dummyId = $dummyOption ? ($options[$dummyOption->id] ?? null) : null;
                $layanan = $layananOption && $layananId ? $layananOption->values->where('id', $layananId)->first()?->name : null;
                // Ambil harga dari tabel kombinasi
                $hargaKombinasi = \App\Models\ProductOptionValueCombination::where('product_id', $item->id)
                    ->where('layanan_value_id', $layananId)
                    ->where('ukuran_value_id', $dummyId)
                    ->first();
                $basePrice = $hargaKombinasi ? $hargaKombinasi->price : 0;
                $optionDetails[] = [
                    'option' => $layananOption ? $layananOption->name : 'Layanan',
                    'value' => $layanan,
                    'price' => $basePrice
                ];
            } else {
                foreach ($item->options as $option) {
                    if (stripos($option->name, 'Layanan') !== false && isset($options[$option->id])) {
                        $val = $option->values->where('id', $options[$option->id])->first();
                        $layanan = $val ? $val->name : null;
                        $optionDetails[] = [
                            'option' => $option->name,
                            'value' => $layanan,
                            'price' => 0
                        ];
                    }
                    if ((stripos($option->name, 'Ukuran') !== false || stripos($option->name, 'Jenis') !== false) && isset($options[$option->id])) {
                        $val = $option->values->where('id', $options[$option->id])->first();
                        $ukuran = $val ? $val->name : null;
                        $optionDetails[] = [
                            'option' => $option->name,
                            'value' => $ukuran,
                            'price' => 0
                        ];
                    }
                }
                $basePrice = $this->getHargaProduk($item->type, $layanan, $ukuran);
                if ($basePrice == 0) {
                    $basePrice = $item->price;
                }
            }
            foreach ($item->options as $option) {
                $optId = $option->id;
                $optName = $option->name;
                $selected = $options[$optId] ?? null;
                if ($option->type === 'checkbox' && is_array($selected)) {
                    foreach ($selected as $valId) {
                        $val = $option->values->where('id', $valId)->first();
                        if ($val) {
                            $optionDetails[] = [
                                'option' => $optName,
                                'value' => $val->name,
                                'price' => $val->price_modifier
                            ];
                            $additionalPrice += $val->price_modifier;
                        }
                    }
                } elseif ($selected && ($option->name !== 'Layanan' && $option->name !== 'Ukuran Kasur' && $option->name !== 'Jenis Sofa')) {
                    $val = $option->values->where('id', $selected)->first();
                    if ($val) {
                        $optionDetails[] = [
                            'option' => $optName,
                            'value' => $val->name,
                            'price' => $val->price_modifier
                        ];
                        $additionalPrice += $val->price_modifier;
                    }
                }
            }
        }

        $totalPrice = $basePrice + $additionalPrice;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $quantity;
        } else {
            $cart[$key] = [
                'id' => $id,
                'type' => $type,
                'name' => $item->name,
                'price' => $totalPrice,
                'quantity' => $quantity,
                'options' => $optionDetails,
            ];
        }

        session(['cart' => $cart]);
        Log::info('Cart After', [ 'cart_after' => $cart ]);
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Item ditambahkan ke keranjang!']);
        }
        return redirect()->route('cart.index')->with('success', 'Item ditambahkan ke keranjang! Silakan lanjut ke checkout.');
    }

    public function remove(Request $request)
    {
        $key = $request->input('key');
        $cart = session()->get('cart', []);
        unset($cart[$key]);
        session(['cart' => $cart]);
        return redirect()->route('cart.index')->with('success', 'Item dihapus dari keranjang!');
    }

    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('warning', 'Silakan login untuk melanjutkan checkout.');
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('warning', 'Keranjang belanja kosong.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:30',
            'address' => 'required|string',
            'payment_method' => 'required|in:cod,qris',
        ]);

        $user = Auth::user();
        // Simpan data user jika belum ada (opsional, bisa diupdate juga)
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;
        $user->address = $validated['address'] ?? null;
        $user->save();

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = \App\Models\Order::create([
            'user_id' => $user->id,
            'total_price' => $total,
            'status' => 'pending',
            'payment_method' => $validated['payment_method'] === 'cod' ? 'cash' : 'transfer',
            'shipping_address' => $validated['address'],
            'placed_at' => now(),
            'email' => $user->email,
        ]);

        // Simpan item produk dan layanan ke tabel relasi
        $products = [];
        foreach ($cart as $item) {
            if ($item['type'] === 'product') {
                if (!isset($products[$item['id']])) {
                    $products[$item['id']] = [
                        'quantity' => 0,
                        'unit_price' => $item['price'],
                    ];
                }
                $products[$item['id']]['quantity'] += $item['quantity'];
            }
        }
        if (!empty($products)) {
            $order->products()->attach($products);
        }

        // Kosongkan keranjang
        session()->forget('cart');

        return redirect()->route('order.verify', ['order' => $order->id]);
    }

    public function showCheckoutForm(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('warning', 'Silakan login untuk melanjutkan checkout.');
        }
        $cart = session()->get('cart', []);
        $user = Auth::user();
        return view('cart.checkout', compact('cart', 'user'));
    }

    public function count(Request $request)
    {
        $cart = session()->get('cart', []);
        $count = array_sum(array_column($cart, 'quantity'));
        return response()->json(['count' => $count]);
    }

    public function mini()
    {
        $cart = session('cart', []);
        return view('partials.cart-mini', compact('cart'))->render();
    }
}
