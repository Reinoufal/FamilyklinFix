@extends('layouts.app')

@section('content')
<section id="about" class="bg-gradient-to-r from-blue-50 to-blue-100 py-20">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-blue-800 mb-6">Tentang FamilyKlin</h2>
            <p class="text-lg text-gray-700 leading-relaxed max-w-3xl mx-auto">
                FamilyKlin adalah penyedia layanan hydrocleaning terpercaya yang mengutamakan kualitas, kebersihan, dan kepuasan pelanggan. Kami melayani rumah tangga, kantor, dan tempat usaha lainnya dengan teknologi modern dan tim profesional.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Visi -->
            <div class="bg-white rounded-xl shadow-lg p-8 transform hover:scale-105 transition-transform duration-300">
                <div class="text-center mb-4">
                    <svg class="w-12 h-12 text-blue-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-blue-800 mb-4 text-center">Visi Kami</h3>
                <p class="text-gray-600 text-center">
                    Menjadi penyedia layanan kebersihan terdepan dengan inovasi teknologi dan layanan berkualitas.
                </p>
            </div>

            <!-- Misi -->
            <div class="bg-white rounded-xl shadow-lg p-8 transform hover:scale-105 transition-transform duration-300">
                <div class="text-center mb-4">
                    <svg class="w-12 h-12 text-blue-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-blue-800 mb-4 text-center">Misi Kami</h3>
                <p class="text-gray-600 text-center">
                    Memberikan solusi kebersihan terbaik dengan standar profesional dan harga terjangkau.
                </p>
            </div>

            <!-- Nilai -->
            <div class="bg-white rounded-xl shadow-lg p-8 transform hover:scale-105 transition-transform duration-300">
                <div class="text-center mb-4">
                    <svg class="w-12 h-12 text-blue-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-blue-800 mb-4 text-center">Nilai Kami</h3>
                <p class="text-gray-600 text-center">
                    Kualitas, Integritas, dan Kepuasan Pelanggan adalah prioritas utama kami.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection