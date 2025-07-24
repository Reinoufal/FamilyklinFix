<div x-data="{ activeSlide: 0, slides: [0, 1, 2, 3] }" x-init="setInterval(() => activeSlide = (activeSlide + 1) % slides.length, 5000)" class="relative w-full h-screen overflow-hidden">

  <!-- Slides wrapper -->
  <div class="flex transition-transform duration-700 ease-in-out h-full" :style="`transform: translateX(-${activeSlide * 100}%);`">
    <template x-for="(slide, index) in slides" :key="index">
      <div class="w-full flex-shrink-0 h-screen relative">
        <img :src="`/storage/images/hero/hero${index + 1}.jpg`" alt="" class="w-full h-full object-cover brightness-75">
        <div class="absolute inset-0 flex items-center justify-center text-white text-center px-4">
          <div>
            <h1 class="text-4xl md:text-6xl font-bold">Bersih, Segar, Profesional</h1>
            <p class="mt-4 text-lg md:text-xl">Layanan Hydrocleaning Terpercaya di Kota Anda</p>
            <a href="{{ route('products.index') }}" class="inline-block mt-6 px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition">Pesan Sekarang</a>
          </div>
        </div>
      </div>
    </template>
  </div>

  <!-- Tombol Kiri -->
  <button
    @click="activeSlide = (activeSlide - 1 + slides.length) % slides.length"
    class="absolute left-4 top-1/2 transform -translate-y-1/2 z-10 p-3 bg-white bg-opacity-70 rounded-full shadow hover:bg-opacity-90 transition"
    aria-label="Sebelumnya"
  >
    &#8592;
  </button>

  <!-- Tombol Kanan -->
  <button
    @click="activeSlide = (activeSlide + 1) % slides.length"
    class="absolute right-4 top-1/2 transform -translate-y-1/2 z-10 p-3 bg-white bg-opacity-70 rounded-full shadow hover:bg-opacity-90 transition"
    aria-label="Selanjutnya"
  >
    &#8594;
  </button>

  <!-- Indicators -->
  <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
    <template x-for="(slide, index) in slides" :key="index">
      <button
        @click="activeSlide = index"
        :class="{
          'bg-white': activeSlide === index,
          'bg-gray-400': activeSlide !== index
        }"
        class="w-3 h-3 rounded-full transition"
      ></button>
    </template>
  </div>
</div>
