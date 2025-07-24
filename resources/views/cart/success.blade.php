@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-16 text-center">
    <div class="mb-8">
        <svg class="mx-auto h-20 w-20 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
        </svg>
    </div>
    <h1 class="text-3xl font-bold mb-4 text-green-700">Pesanan Berhasil!</h1>
    <p class="mb-6 text-lg">Terima kasih, pesanan Anda telah diterima.<br>Nomor Order: <span class="font-semibold">#{{ $order->id }}</span></p>
    <div class="bg-white rounded-lg shadow p-6 mb-6 text-left">
        <div class="mb-2"><span class="font-semibold">Total:</span> Rp{{ number_format($order->total_price,0,',','.') }}</div>
        <div class="mb-2"><span class="font-semibold">Metode Pembayaran:</span> {{ $order->payment_method === 'cash' ? 'Bayar di Tempat (COD)' : 'QRIS' }}</div>
        <div class="mb-2"><span class="font-semibold">Alamat Pengiriman:</span> {{ $order->shipping_address }}</div>
        <div class="mb-2"><span class="font-semibold">Status:</span> {{ ucfirst($order->status) }}</div>
        <div class="mt-4 text-sm text-gray-500">Tanggal: {{ $order->placed_at->format('d M Y H:i') }}</div>
    </div>
    <a href="/" class="inline-block mt-6 px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Kembali ke Beranda</a>
</div>
@endsection 