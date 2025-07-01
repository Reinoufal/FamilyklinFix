@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Layanan FamilyKlin</h1>
        <p class="text-gray-600">Pilih layanan hydrocleaning terbaik untuk kebutuhan Anda</p>
    </div>
    
    <!-- Search and Filter Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="mb-4">
            <h2 class="text-lg font-semibold text-gray-800 mb-1">Filter & Pencarian</h2>
            <p class="text-sm text-gray-600">Temukan layanan yang sesuai dengan kebutuhan Anda</p>
        </div>
        
        <form method="GET" action="{{ route('services.index') }}" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Search Bar -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Layanan</label>
                    <input type="text" 
                           id="search" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari berdasarkan nama atau deskripsi..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm">
                </div>
                
                <!-- Service Type Filter -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Jenis Layanan</label>
                    <select id="type" 
                            name="type" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm bg-white">
                        <option value="">Semua Layanan</option>
                        <option value="hydrocleaning" {{ request('type') == 'hydrocleaning' ? 'selected' : '' }}>Hydrocleaning</option>
                        <option value="regular" {{ request('type') == 'regular' ? 'selected' : '' }}>Cuci Biasa</option>
                    </select>
                </div>
                
                <!-- Sort Options -->
                <div>
                    <label for="sort" class="block text-sm font-medium text-gray-700 mb-2">Urutkan Berdasarkan</label>
                    <div class="flex space-x-2">
                        <select id="sort" 
                                name="sort" 
                                class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm bg-white">
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Harga</option>
                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
                        </select>
                        <select name="order" 
                                class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm bg-white">
                            <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>A-Z / Rendah-Tinggi</option>
                            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Z-A / Tinggi-Rendah</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-200 pt-6">
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" 
                            class="flex items-center justify-center bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition duration-200 font-medium text-sm shadow-sm min-w-[140px]">
                        <i class="fas fa-search mr-2"></i>
                        <span>Cari & Filter</span>
                    </button>
                    <a href="{{ route('services.index') }}" 
                       class="flex items-center justify-center bg-gray-500 text-white px-8 py-3 rounded-lg hover:bg-gray-600 focus:ring-4 focus:ring-gray-200 transition duration-200 font-medium text-sm shadow-sm min-w-[140px]">
                        <i class="fas fa-refresh mr-2"></i>
                        <span>Reset</span>
                    </a>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Results Info -->
    <div class="mb-6">
        <p class="text-gray-600">
            Menampilkan {{ $services->count() }} layanan
            @if(request('search'))
                untuk pencarian "<strong>{{ request('search') }}</strong>"
            @endif
            @if(request('type'))
                dengan jenis "<strong>{{ request('type') == 'hydrocleaning' ? 'Hydrocleaning' : 'Cuci Biasa' }}</strong>"
            @endif
        </p>
    </div>
    
    <!-- Services Grid -->
    @if($services->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $service)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-200 overflow-hidden">
                <div class="p-6">
                    <!-- Service Type Badge -->
                    <div class="mb-3">
                        @if(stripos($service->name, 'hydrocleaning') !== false)
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                Hydrocleaning
                            </span>
                        @else
                            <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                Cuci Biasa
                            </span>
                        @endif
                    </div>
                    
                    <h2 class="text-xl font-semibold mb-3 text-gray-800">{{ $service->name }}</h2>
                    <p class="text-gray-600 mb-4 text-sm leading-relaxed">{{ Str::limit($service->description, 120) }}</p>
                    
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                        </div>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 text-sm">
                            <i class="fas fa-plus mr-1"></i>Pilih Layanan
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <!-- No Results -->
        <div class="text-center py-12">
            <div class="mb-4">
                <i class="fas fa-search text-gray-400 text-6xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada layanan ditemukan</h3>
            <p class="text-gray-500 mb-4">Coba ubah kata kunci pencarian atau filter yang Anda gunakan</p>
            <a href="{{ route('services.index') }}" 
               class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                Lihat Semua Layanan
            </a>
        </div>
    @endif
</div>

<!-- Add Font Awesome for icons -->
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit form when filter changes
    const typeSelect = document.getElementById('type');
    const sortSelect = document.getElementById('sort');
    const orderSelect = document.querySelector('select[name="order"]');
    const form = document.querySelector('form');
    
    [typeSelect, sortSelect, orderSelect].forEach(select => {
        select.addEventListener('change', function() {
            form.submit();
        });
    });
    
    // Add loading state to buttons
    const submitBtn = document.querySelector('button[type="submit"]');
    form.addEventListener('submit', function() {
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i><span>Mencari...</span>';
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
    });
});
</script>
@endpush
@endsection