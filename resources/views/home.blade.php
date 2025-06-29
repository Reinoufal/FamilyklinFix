@extends('layouts.app')

@section('content')
  <!-- Hero Section dengan Carousel -->
  @include('components.hero')

  <!-- Layanan Section -->
  <section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-6">
      <h2 class="text-3xl font-bold text-center text-blue-800 mb-12">Layanan Kami</h2>
      <div class="text-center">
        <a href="{{ route('services.index') }}" class="px-6 py-3 bg-blue-700 text-white rounded-full hover:bg-blue-800 transition font-semibold inline-block">Lihat Semua Layanan</a>
      </div>
    </div>
  </section>

  <!-- Booking Section -->
  @include('components.booking')
@endsection