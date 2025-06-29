@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Layanan Kami</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($services as $service)
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-2">{{ $service->name }}</h2>
            <p class="text-gray-600 mb-4">{{ $service->description }}</p>
            <p class="text-blue-600 font-semibold">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection