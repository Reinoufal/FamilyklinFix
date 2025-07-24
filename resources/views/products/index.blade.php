@extends('layouts.app')

@section('content')
<section id="products" class="bg-blue-50 py-20" data-aos="fade-up">
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-4xl font-bold text-blue-800 text-center mb-12">Produk yang Bisa Dibersihkan</h2>
    
    <!-- Filter Produk -->
    <div class="mb-8">
      <div class="flex justify-center space-x-4">
        <a href="{{ route('products.index', ['sort' => 'termurah']) }}"
           class="px-4 py-2 rounded-full {{ request('sort') == 'termurah' ? 'bg-blue-700 text-white' : 'bg-white text-blue-700 border border-blue-700' }} hover:bg-blue-800 hover:text-white transition">
          Harga Termurah
        </a>
        <a href="{{ route('products.index', ['sort' => 'tertinggi']) }}"
           class="px-4 py-2 rounded-full {{ request('sort') == 'tertinggi' ? 'bg-blue-700 text-white' : 'bg-white text-blue-700 border border-blue-700' }} hover:bg-blue-800 hover:text-white transition">
          Harga Tertinggi
        </a>
        <a href="{{ route('products.index', ['sort' => 'terlaris']) }}"
           class="px-4 py-2 rounded-full {{ request('sort') == 'terlaris' ? 'bg-blue-700 text-white' : 'bg-white text-blue-700 border border-blue-700' }} hover:bg-blue-800 hover:text-white transition">
          Terlaris
        </a>
      </div>
    </div>

    <!-- Products Grid -->
    <div class="grid md:grid-cols-3 gap-8">
      @forelse($products as $product)
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden hover:scale-105 transition transform duration-300" data-aos="zoom-in">
          <div class="h-48 overflow-hidden">
            @if($product->image)
              <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            @else
              <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                <span class="text-gray-400">Tidak ada gambar</span>
              </div>
            @endif
          </div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-blue-900 mb-2">{{ $product->name }}</h3>
            <p class="text-gray-600 mb-4 line-clamp-3">{{ $product->description }}</p>
            <form action="{{ route('cart.add') }}" method="POST" class="space-y-4 mb-4">
              @csrf
              <input type="hidden" name="id" value="{{ $product->id }}">
              <input type="hidden" name="type" value="product">
              @php
                $isSimpleType = $product->type === 'perlengkapan_bayi' || $product->type === 'add_on';
              @endphp
              @foreach($product->options as $option)
                @if($isSimpleType && $option->name === 'Dummy')
                  <input type="hidden" name="options[{{ $option->id }}]" value="{{ $option->values->first()->id }}">
                @endif
              @endforeach
              <div class="text-center">
              </div>
            </form>
            <div class="flex justify-between items-center">
              @php
                  $min = number_format($product->price, 0, ',', '.');
                  $max = $product->price_max ? number_format($product->price_max, 0, ',', '.') : null;
                  $isRange = $product->price_max && floatval($product->price_max) > floatval($product->price);
              @endphp

              @if($isRange)
                  <div class="text-green-600 font-bold">
                      Rp {{ $min }} – Rp {{ $max }}
                  </div>
              @else
                  <div class="text-green-600 font-bold">
                      Rp {{ $min }}
                  </div>
              @endif
              <a href="{{ route('products.show', $product->id) }}" class="px-4 py-2 bg-blue-700 text-white rounded-full hover:bg-blue-800 transition">Detail</a>
            </div>
          </div>
        </div>
      @empty
        <div class="col-span-3 text-center py-10">
          <p class="text-gray-500 text-lg">Belum ada produk yang tersedia.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>
@endsection