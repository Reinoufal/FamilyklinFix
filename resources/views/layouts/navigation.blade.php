<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">FamilyKlin</a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 text-gray-500 hover:text-blue-600">
                        Home
                    </a>
                    <a href="{{ route('services.index') }}" class="inline-flex items-center px-1 pt-1 text-gray-500 hover:text-blue-600">
                        Layanan
                    </a>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-1 pt-1 text-gray-500 hover:text-blue-600">
                        Produk
                    </a>
                    <a href="{{ route('about') }}" class="inline-flex items-center px-1 pt-1 text-gray-500 hover:text-blue-600">
                        Tentang Kami
                    </a>
                    <a href="{{ route('contact.index') }}" class="inline-flex items-center px-1 pt-1 text-gray-500 hover:text-blue-600">
                        Kontak
                    </a>
                </div>
            </div>

            <!-- Login/Register Links -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-blue-600 px-3 py-2">Dashboard</a>
                    @else
                        <a href="{{ route('profile.edit') }}" class="text-gray-500 hover:text-blue-600 px-3 py-2">Profil</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-blue-600 px-3 py-2">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-blue-600 px-3 py-2">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-500 hover:text-blue-600 px-3 py-2">Register</a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state -->
    <div class="mobile-menu hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ url('/') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-blue-600 hover:bg-gray-50">Home</a>
            <a href="{{ route('services.index') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-blue-600 hover:bg-gray-50">Layanan</a>
            <a href="{{ route('products.index') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-blue-600 hover:bg-gray-50">Produk</a>
            <a href="{{ route('about') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-blue-600 hover:bg-gray-50">Tentang Kami</a>
            <a href="{{ route('contact.index') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-blue-600 hover:bg-gray-50">Kontak</a>
            @auth
                @if(Auth::user()->is_admin)
                    <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-blue-600 hover:bg-gray-50">Dashboard</a>
                @else
                    <a href="{{ route('profile.edit') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-blue-600 hover:bg-gray-50">Profil</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-blue-600 hover:bg-gray-50">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-blue-600 hover:bg-gray-50">Login</a>
                <a href="{{ route('register') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-blue-600 hover:bg-gray-50">Register</a>
            @endauth
        </div>
    </div>
</nav>

<script>
    // Mobile menu functionality
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');

        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    });
</script>
