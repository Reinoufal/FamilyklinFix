@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold text-blue-800 mb-8 text-center">Keranjang Belanja</h1>
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg text-center">
            {{ session('success') }}
        </div>
    @endif
    @if(count($cart) > 0)
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Harga</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($cart as $key => $item)
                        <tr>
                            <td class="px-4 py-4 font-medium text-gray-900">
                                {{ $item['name'] }}
                                @if(!empty($item['options']))
                                    <ul class="mt-1 text-xs text-gray-600 list-disc list-inside">
                                        @foreach($item['options'] as $opt)
                                            <li>
                                                {{ $opt['option'] }}: {{ $opt['value'] }}
                                                @if($opt['price'] > 0)
                                                    <span class="text-green-600">(+Rp {{ number_format($opt['price'], 0, ',', '.') }})</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-center">{{ $item['quantity'] }}</td>
                            <td class="px-4 py-4 text-right">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                            <td class="px-4 py-4 text-center">
                                <form action="{{ route('cart.remove') }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?')">
                                    @csrf
                                    <input type="hidden" name="key" value="{{ $key }}">
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow text-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center mt-8">
                <div class="text-lg font-semibold">Total:</div>
                <div class="text-2xl font-bold text-blue-700">
                    Rp {{ number_format(collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']), 0, ',', '.') }}
                </div>
            </div>
            <div class="mt-8 text-right">
                <a href="{{ route('checkout.form') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-lg shadow transition text-lg">Checkout</a>
            </div>
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-4 h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9m-5 0a2 2 0 11-4 0" />
            </svg>
            <p class="text-gray-500 text-lg mb-2">Keranjang kosong.</p>
            <a href="{{ route('products.index') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full font-semibold transition">Belanja Produk</a>
        </div>
    @endif
</div>
@endsection
