@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Layanan FamilyKlin</h1>
        <p class="text-gray-600">Pilih layanan terbaik untuk kebutuhan Anda</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Card HydroVaccum -->
        <a href="{{ route('services.show', 'hydrovaccum') }}" class="block bg-white rounded-lg shadow-md overflow-hidden group transition-transform hover:scale-105">
            <div class="relative h-80">
                <img src="/storage/images/services_image/hydrovaccum.jpg" alt="HydroVaccum" class="object-cover w-full h-full">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                    <h2 class="text-xl font-bold text-white">HydroVaccum</h2>
                </div>
            </div>
        </a>
        <!-- Card Cuci Bersih -->
        <a href="{{ route('services.show', 'cuci-bersih') }}" class="block bg-white rounded-lg shadow-md overflow-hidden group transition-transform hover:scale-105">
            <div class="relative h-80">
                <img src="/storage/images/services_image/CuciBersih.jpg" alt="Cuci Bersih" class="object-cover w-full h-full">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                    <h2 class="text-xl font-bold text-white">Cuci Bersih</h2>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection