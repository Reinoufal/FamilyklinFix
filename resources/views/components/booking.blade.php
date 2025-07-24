<section id="produk-terlaris" class="py-20 bg-blue-50" data-aos="fade-up">
  <div class="max-w-6xl mx-auto px-6">
    <h2 class="text-4xl font-bold text-center text-blue-800 mb-10">Produk Terlaris</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      @foreach($bestSellingProducts as $product)
        <div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center">
          <img src="{{ asset('storage/' . $product->image) ?? asset('/images/default-product.png') }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded mb-4">
          <h3 class="text-lg font-semibold text-blue-800 mb-2">{{ $product->name }}</h3>
          <p class="text-gray-600 mb-2">{{ $product->description }}</p>
          <div class="text-blue-700 font-bold text-xl mb-4">
            @if($product->price_max && floatval($product->price_max) > floatval($product->price))
              Rp {{ number_format($product->price,0,',','.') }} – Rp {{ number_format($product->price_max,0,',','.') }}
            @else
              Rp {{ number_format($product->price,0,',','.') }}
            @endif
      </div>
          <a href="{{ route('products.show', $product->id) }}" class="px-4 py-2 bg-blue-700 text-white rounded-full hover:bg-blue-800 transition font-semibold">Lihat Detail</a>
      </div>
      @endforeach
      </div>
  </div>
</section>