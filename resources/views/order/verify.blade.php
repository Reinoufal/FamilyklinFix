@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-16 text-center">
    <h1 class="text-2xl font-bold mb-4">Verifikasi Pesanan</h1>
    <p class="mb-4">Terima kasih, pesanan Anda telah diterima.</p>
    <p>Status pesanan: <span class="font-semibold">{{ ucfirst($order->status) }}</span></p>
    @if($order->status === 'pending')
        <p class="mt-2 text-gray-500">Pesanan Anda sedang menunggu verifikasi admin.</p>
    @elseif($order->status === 'verified')
        <p class="mt-2 text-green-600">Pesanan Anda sudah diverifikasi, Kami akan segera menghubungi anda melalui Whatsapp, silakan cek WA anda.</p>
    @endif
    <a href="/" class="inline-block mt-6 px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Kembali ke Beranda</a>
</div>
@endsection 