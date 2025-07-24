<header class="bg-white shadow-md sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-6 py-4">
    <div class="flex justify-between items-center">
      <div class="flex items-center space-x-4">
        <a href="/" class="text-2xl font-bold text-blue-700">FamilyKlin</a>
      </div>

      <!-- Desktop Navigation -->
      <nav class="hidden md:flex items-center space-x-6">
        <a href="{{ route('home') }}" class="hover:text-blue-700 font-medium transition">Beranda</a>
        <a href="{{ route('services.index') }}" class="hover:text-blue-700 font-medium transition">Layanan</a>
        <a href="{{ route('products.index') }}" class="hover:text-blue-700 font-medium transition">Produk</a>
        <a href="{{ route('contact.index') }}" class="hover:text-blue-700 font-medium transition">Kontak</a>
      </nav>
      
      <!-- Auth Buttons -->
      <div class="hidden md:flex space-x-3">
        <a href="{{ url('/login') }}" class="px-4 py-2 text-blue-700 border border-blue-700 rounded-full hover:bg-blue-50 transition">Login</a>
        <a href="{{ url('/register') }}" class="px-4 py-2 bg-blue-700 text-white rounded-full hover:bg-blue-800 transition">Daftar</a>
      </div>

      <!-- Mobile Buttons -->
      <div class="flex md:hidden items-center space-x-4">
        <!-- Tombol Keranjang -->
        <button id="cart-button" class="relative focus:outline-none">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A2 2 0 007.5 19h9a2 2 0 001.85-2.7L17 13M7 13V6a4 4 0 018 0v7" />
          </svg>
        </button>
        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" class="text-gray-600 focus:outline-none">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>
  
  <!-- Modal Keranjang -->
  <div id="cart-modal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-80 relative">
      <button id="close-cart" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
      @include('partials.cart-mini')
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden md:hidden bg-white px-6 py-4 shadow-inner">
    <div class="flex flex-col space-y-3">
      <a href="{{ route('home') }}" class="hover:text-blue-700 font-medium transition">Beranda</a>
      <a href="{{ route('services.index') }}" class="hover:text-blue-700 font-medium transition">Layanan</a>
      <a href="{{ route('products.index') }}" class="hover:text-blue-700 font-medium transition">Produk</a>
      <a href="{{ route('contact.index') }}" class="hover:text-blue-700 font-medium transition">Kontak</a>
      <div class="relative mt-2">
        <input type="text" placeholder="Cari..." class="w-full border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
        <button class="absolute right-3 top-1/2 transform -translate-y-1/2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </button>
      </div>
      <div class="flex space-x-3 mt-2">
        <a href="{{ url('/login') }}" class="px-4 py-2 text-blue-700 border border-blue-700 rounded-full hover:bg-blue-50 transition text-center w-1/2">Login</a>
        <a href="{{ url('/register') }}" class="px-4 py-2 bg-blue-700 text-white rounded-full hover:bg-blue-800 transition text-center w-1/2">Daftar</a>
      </div>
    </div>
  </div>
</header>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const cartButton = document.getElementById('cart-button');
    const cartModal = document.getElementById('cart-modal');
    const closeCart = document.getElementById('close-cart');
    
    mobileMenuButton.addEventListener('click', function() {
      mobileMenu.classList.toggle('hidden');
    });

    cartButton.addEventListener('click', function() {
      cartModal.classList.remove('hidden');
    });

    closeCart.addEventListener('click', function() {
      cartModal.classList.add('hidden');
    });

    // Menutup modal saat mengklik di luar modal
    cartModal.addEventListener('click', function(e) {
      if (e.target === cartModal) {
        cartModal.classList.add('hidden');
      }
    });
  });
</script>
</header>
