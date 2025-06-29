<section id="products" class="bg-blue-50 py-20" data-aos="fade-up">
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-4xl font-bold text-blue-800 text-center mb-12">Produk yang Bisa Dibersihkan</h2>
    <div class="grid md:grid-cols-3 gap-8">
      @forelse($products as $product)
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden hover:scale-105 transition transform duration-300" data-aos="zoom-in">
          <div class="h-48 overflow-hidden">
            @if($product->image)
              <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            @else
              <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                <span class="text-gray-400">Tidak ada gambar</span>
              </div>
            @endif
          </div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-blue-900 mb-2">{{ $product->name }}</h3>
            <p class="text-gray-600 mb-4 line-clamp-3">{{ $product->description }}</p>
            <div class="flex justify-between items-center">
              <span class="text-green-600 font-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
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