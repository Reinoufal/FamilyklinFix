@extends('layouts.app')

@section('content')
<div class="pt-20 pb-10 bg-blue-50">
  <div class="max-w-7xl mx-auto px-6">
    <a href="{{ route('products.index') }}" class="inline-flex items-center text-blue-700 hover:text-blue-800 mb-6">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
      </svg>
      Kembali ke Daftar Produk
    </a>
    
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
      <div class="md:flex">
        <div class="md:w-1/2">
          @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto max-h-[300px] object-contain mx-auto p-4">
          @else
            <div class="w-full h-full min-h-[250px] bg-gray-200 flex items-center justify-center">
              <span class="text-gray-400">Tidak ada gambar</span>
            </div>
          @endif
        </div>
        <div class="md:w-1/2 p-8">
          <h1 class="text-3xl font-bold text-blue-900 mb-4">{{ $product->name }}</h1>
          <div class="mb-6">
            <span class="text-green-600 font-bold text-2xl">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
          </div>
          <div class="prose max-w-none mb-8">
            <p class="text-gray-700">{{ $product->description }}</p>
          </div>
          <div class="border-t border-gray-200 pt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Layanan Pembersihan</h3>
            <p class="text-gray-600 mb-4">Kami menawarkan layanan pembersihan profesional untuk produk ini dengan teknologi hydrocleaning terbaik.</p>
            <a href="#booking" class="inline-block px-6 py-3 bg-blue-700 text-white rounded-full hover:bg-blue-800 transition font-semibold">Booking Sekarang</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection