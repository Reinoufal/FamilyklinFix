<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductOptionValueCombination;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->query('sort');
        $query = Product::query();

        if ($sort === 'termurah') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'tertinggi') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'terlaris') {
            $query->orderBy('sold', 'desc'); // pastikan ada kolom 'sold' di tabel produk
        }

        $products = $query->get();
        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('options.values');
        // Ambil semua kombinasi harga untuk produk ini
        $hargaKombinasi = ProductOptionValueCombination::where('product_id', $product->id)
            ->get()
            ->map(function($row) {
                return [
                    'layanan_id' => $row->layanan_value_id,
                    'ukuran_id' => $row->ukuran_value_id,
                    'price' => (int)$row->price,
                ];
            });
        return view('products.show', compact('product', 'hargaKombinasi'));
    }
}