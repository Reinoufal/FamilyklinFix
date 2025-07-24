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
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-8">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-3xl">
                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    Riwayat Pemesanan
                </h2>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td class="px-4 py-2">{{ $order->order_code }}</td>
                            <td class="px-4 py-2">{{ $order->placed_at->format('d-m-Y H:i') }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('order.verify', $order->id) }}"
                                   class="px-2 py-1 rounded text-xs {{
                                    $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                    ($order->status == 'verified' ? 'bg-green-100 text-green-800' :
                                    'bg-red-100 text-red-800')
                                   }}" style="text-decoration:none;">
                                    {{ ucfirst($order->status) }}
                                </a>
                                <a href="{{ route('order.detail', $order->id) }}" class="ml-2 inline-block px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">Belum ada riwayat pemesanan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection