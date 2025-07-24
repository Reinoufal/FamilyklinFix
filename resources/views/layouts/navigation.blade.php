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
                        Pesan
                    </a>
                    <a href="{{ route('about') }}" class="inline-flex items-center px-1 pt-1 text-gray-500 hover:text-blue-600">
                        Tentang Kami
                    </a>
                    <a href="{{ route('contact.index') }}" class="inline-flex items-center px-1 pt-1 text-gray-500 hover:text-blue-600">
                        Kontak
                    </a>
                </div>
            </div>

            <!-- Login/Register Links & Cart Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-4">
                <!-- Cart Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="relative focus:outline-none">
                        <!-- Icon keranjang -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9m-5 0a2 2 0 11-4 0" />
                        </svg>
                        @php $cart = session('cart', []); $count = array_sum(array_column($cart, 'quantity')); @endphp
                        @if($count > 0)
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-2 py-0.5">{{ $count }}</span>
                        @endif
                    </button>
                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open = false"
                         class="absolute right-0 mt-2 w-72 bg-white border border-gray-200 rounded-lg shadow-lg z-50"
                         x-cloak>
                        <div class="p-4">
                            <h3 class="font-semibold mb-2">Keranjang</h3>
                            @if($count > 0)
                                <ul class="divide-y divide-gray-200 max-h-60 overflow-y-auto">
                                    @foreach($cart as $item)
                                        <li class="py-2 flex justify-between items-center">
                                            <div>
                                                <div class="font-medium">{{ $item['name'] }}</div>
                                                <div class="text-xs text-gray-500">x{{ $item['quantity'] }}</div>
                                            </div>
                                            <div class="text-sm font-semibold">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="font-semibold">Total:</span>
                                    <span class="font-bold text-blue-600">
                                        Rp {{ number_format(collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']), 0, ',', '.') }}
                                    </span>
                                </div>
                                <a href="{{ route('cart.index') }}" class="block mt-4 w-full text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Lihat Keranjang</a>
                                <form action="{{ route('cart.checkout') }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600 transition">Checkout</button>
                                </form>
                            @else
                                <div class="text-gray-500 text-center py-8">Keranjang kosong</div>
                            @endif
                        </div>
                    </div>
                </div>
            <!-- Login/Register Links -->
                @auth
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-blue-600 px-3 py-2">Dashboard</a>
                    @else
                        <a href="{{ route('profile.show') }}" class="text-gray-500 hover:text-blue-600 px-3 py-2">Profil</a>
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

            <!-- Mobile menu button and cart -->
            <div class="-mr-2 flex items-center space-x-4 sm:hidden">
                <!-- Cart button for mobile -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="relative focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9m-5 0a2 2 0 11-4 0" />
                        </svg>
                        @php $cart = session('cart', []); $count = array_sum(array_column($cart, 'quantity')); @endphp
                        @if($count > 0)
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-2 py-0.5">{{ $count }}</span>
                        @endif
                    </button>
                    <!-- Dropdown for mobile -->
                    <div x-show="open" @click.away="open = false"
                         class="absolute right-0 mt-2 w-72 bg-white border border-gray-200 rounded-lg shadow-lg z-50"
                         x-cloak>
                        <div class="p-4">
                            <h3 class="font-semibold mb-2">Keranjang</h3>
                            @if($count > 0)
                                <ul class="divide-y divide-gray-200 max-h-60 overflow-y-auto">
                                    @foreach($cart as $item)
                                        <li class="py-2 flex justify-between items-center">
                                            <div>
                                                <div class="font-medium">{{ $item['name'] }}</div>
                                                <div class="text-xs text-gray-500">x{{ $item['quantity'] }}</div>
                                            </div>
                                            <div class="text-sm font-semibold">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="font-semibold">Total:</span>
                                    <span class="font-bold text-blue-600">
                                        Rp {{ number_format(collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']), 0, ',', '.') }}
                                    </span>
                                </div>
                                <a href="{{ route('cart.index') }}" class="block mt-4 w-full text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Lihat Keranjang</a>
                                <form action="{{ route('cart.checkout') }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600 transition">Checkout</button>
                                </form>
                            @else
                                <div class="text-gray-500 text-center py-8">Keranjang kosong</div>
                            @endif
                        </div>
                    </div>
                
                    <!-- Mobile menu button -->
                    <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state -->
    <div class="mobile-menu hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ url('/') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-blue-600 hover:bg-gray-50">Home</a>
            <a href="{{ route('services.index') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-blue-600 hover:bg-gray-50">Layanan</a>
            <a href="{{ route('products.index') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-blue-600 hover:bg-gray-50">Pesan</a>
            <a href="{{ route('about') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-blue-600 hover:bg-gray-50">Tentang Kami</a>
            <a href="{{ route('contact.index') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-blue-600 hover:bg-gray-50">Kontak</a>
            @auth
                @if(Auth::user()->is_admin)
                    <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-blue-600 hover:bg-gray-50">Dashboard</a>
                @else
                    <a href="{{ route('profile.show') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-blue-600 hover:bg-gray-50">Profil</a>
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
