@extends('layouts.app')

@section('content')
<section class="py-20 bg-white">
  <div class="max-w-5xl mx-auto px-6">
    <div class="flex flex-col md:flex-row gap-10">
      <div class="md:w-1/2">
        @if ($service->image)
          <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="w-full h-auto rounded-2xl shadow-lg">
        @else
          <div class="w-full h-80 bg-gray-200 rounded-2xl flex items-center justify-center">
            <span class="text-gray-400">No Image</span>
          </div>
        @endif
      </div>
      
      <div class="md:w-1/2">
        <h1 class="text-3xl font-bold text-blue-800 mb-4">{{ $service->name }}</h1>
        <div class="bg-blue-50 text-blue-700 font-bold text-xl px-4 py-2 rounded-lg inline-block mb-6">
          Rp {{ number_format($service->price, 0, ',', '.') }}
        </div>
        
        <div class="prose max-w-none mb-8">
          <p>{{ $service->description }}</p>
        </div>
        
        <a href="#" class="px-6 py-3 bg-blue-700 text-white rounded-full hover:bg-blue-800 transition font-semibold inline-block">Booking Sekarang</a>
        
        <a href="{{ route('services.index') }}" class="px-6 py-3 border border-blue-700 text-blue-700 rounded-full hover:bg-blue-50 transition font-semibold inline-block ml-4">Kembali</a>
      </div>
    </div>
  </div>
</section>
@endsection