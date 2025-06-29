@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h2 class="text-lg font-medium text-gray-900">
                    Informasi Profil
                </h2>
                
                <div class="mt-6 space-y-6">
                    <div>
                        <h4 class="text-sm font-medium text-gray-600">Nama</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ auth()->user()->name }}</p>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-gray-600">Email</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ auth()->user()->email }}</p>
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('profile.edit') }}" class="bg-gray-800 text-white px-4 py-2 rounded-md text-sm">
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection