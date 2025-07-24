@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-12">
    <h1 class="text-2xl font-bold mb-6">Detail Pesanan</h1>
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="mb-2"><span class="font-semibold">Kode Order:</span> {{ $order->order_code }}</div>
        <div class="mb-2"><span class="font-semibold">Tanggal:</span> {{ $order->placed_at ? $order->placed_at->format('d-m-Y H:i') : '-' }}</div>
        <div class="mb-2"><span class="font-semibold">Status:</span> <span class="inline-block px-2 py-1 rounded text-xs {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($order->status == 'verified' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">{{ ucfirst($order->status) }}</span></div>
        <div class="mb-2"><span class="font-semibold">Total:</span> Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
        <div class="mb-2"><span class="font-semibold">Metode Pembayaran:</span> {{ $order->payment_method === 'cash' ? 'Bayar di Tempat (COD)' : 'QRIS' }}</div>
        <div class="mb-2"><span class="font-semibold">Alamat Pengiriman:</span> {{ $order->shipping_address }}</div>
        <div class="mb-2"><span class="font-semibold">Nama Pemesan:</span> {{ $order->user->name ?? '-' }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-lg font-semibold mb-2">Produk</h2>
        @if($order->products->count())
            <table class="min-w-full text-sm mb-4">
                <thead>
                    <tr>
                        <th class="px-2 py-1 text-left">Nama</th>
                        <th class="px-2 py-1 text-center">Jumlah</th>
                        <th class="px-2 py-1 text-right">Harga Satuan</th>
                        <th class="px-2 py-1 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->products as $product)
                        <tr>
                            <td class="px-2 py-1">
                                {{ $product->name }}
                                @php
                                    $options = $product->pivot->options ? json_decode($product->pivot->options, true) : [];
                                @endphp
                                @if(!empty($options))
                                    <ul class="mt-1 text-xs text-gray-600 list-disc list-inside">
                                        @foreach($options as $opt)
                                            <li>
                                                {{ $opt['option'] ?? '' }}: {{ $opt['value'] ?? '' }}
                                                @if(isset($opt['price']) && $opt['price'] > 0)
                                                    <span class="text-green-600">(+Rp {{ number_format($opt['price'], 0, ',', '.') }})</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                            <td class="px-2 py-1 text-center">{{ $product->pivot->quantity }}</td>
                            <td class="px-2 py-1 text-right">Rp {{ number_format($product->pivot->unit_price,0,',','.') }}</td>
                            <td class="px-2 py-1 text-right">Rp {{ number_format($product->pivot->unit_price * $product->pivot->quantity,0,',','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-gray-500 mb-2">Tidak ada produk.</div>
        @endif
        <h2 class="text-lg font-semibold mb-2 mt-6">Layanan</h2>
        @if($order->services->count())
            <table class="min-w-full text-sm">
                <thead>
                    <tr>
                        <th class="px-2 py-1 text-left">Nama</th>
                        <th class="px-2 py-1 text-center">Jumlah</th>
                        <th class="px-2 py-1 text-right">Harga Satuan</th>
                        <th class="px-2 py-1 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->services as $service)
                        <tr>
                            <td class="px-2 py-1">{{ $service->name }}</td>
                            <td class="px-2 py-1 text-center">{{ $service->pivot->quantity }}</td>
                            <td class="px-2 py-1 text-right">Rp {{ number_format($service->pivot->unit_price,0,',','.') }}</td>
                            <td class="px-2 py-1 text-right">Rp {{ number_format($service->pivot->unit_price * $service->pivot->quantity,0,',','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-gray-500">Tidak ada layanan.</div>
        @endif
    </div>
    <div class="flex justify-end">
        @if($order->status !== 'denied')
            <a href="{{ route('order.invoice', $order->id) }}" target="_blank" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Cetak Invoice</a>
        @endif
    </div>
</div>
@endsection 