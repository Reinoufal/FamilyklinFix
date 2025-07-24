@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>
    <form action="{{ route('cart.checkout') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block mb-2 font-semibold">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            </div>
            <div>
                <label class="block mb-2 font-semibold">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            </div>
            <div>
                <label class="block mb-2 font-semibold">No. Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            </div>
            <div class="md:col-span-2">
                <label class="block mb-2 font-semibold">Alamat Lengkap</label>
                <textarea name="address" class="w-full border border-gray-300 rounded-lg px-4 py-2" rows="3" required>{{ old('address', $user->address ?? '') }}</textarea>
            </div>
        </div>
        <h2 class="text-xl font-semibold mb-4">Rincian Pesanan</h2>
        <div class="mb-6 bg-gray-50 p-4 rounded-lg">
            @if(count($cart) > 0)
                <ul>
                    @php $total = 0; @endphp
                    @foreach($cart as $item)
                        <li class="flex justify-between items-center py-2 border-b last:border-b-0">
                            <div>
                                <span class="font-semibold">{{ $item['name'] }}</span>
                                @if(!empty($item['options']))
                                    <ul class="text-sm text-gray-500 ml-4">
                                        @foreach($item['options'] as $opt)
                                            <li>{{ $opt['option'] }}: {{ $opt['value'] }} @if($opt['price'] > 0) (+Rp{{ number_format($opt['price'],0,',','.') }})@endif</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <span class="text-sm">x{{ $item['quantity'] }}</span>
                            </div>
                            <div class="font-semibold">Rp{{ number_format($item['price'] * $item['quantity'],0,',','.') }}</div>
                        </li>
                        @php $total += $item['price'] * $item['quantity']; @endphp
                    @endforeach
                </ul>
                <div class="flex justify-between items-center mt-4 text-lg font-bold">
                    <span>Total</span>
                    <span>Rp{{ number_format($total,0,',','.') }}</span>
                </div>
            @else
                <div class="text-gray-500">Keranjang belanja kosong.</div>
            @endif
        </div>
        <h2 class="text-xl font-semibold mb-4">Metode Pembayaran</h2>
        <div class="mb-6">
            <select name="payment_method" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                <option value="">-- Pilih Metode Pembayaran --</option>
                <option value="cod">Bayar di Tempat (COD)</option>
                <option value="qris">QRIS</option>
            </select>
        </div>
        <div class="mb-6" id="qris-section" style="display:none;">
    <label class="block font-medium mb-2">Scan QRIS untuk pembayaran:</label>
    <div class="flex items-center gap-4 mb-4">
        <img src="/images/QRIS.jpg" alt="QRIS" class="w-64 border rounded shadow">
        <a href="/images/QRIS.jpg" download class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition">Unduh Gambar</a>
    </div>
    <label class="block font-medium mb-2">Upload Bukti Pembayaran:</label>
    <input type="file" name="qris_proof" accept="image/*,application/pdf" class="block w-full border rounded px-3 py-2">
</div>
        <div class="text-right">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Buat Pesanan</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var paymentSelect = document.querySelector('select[name="payment_method"]');
    var qrisSection = document.getElementById('qris-section');
    function toggleQris() {
        if(paymentSelect.value === 'qris') {
            qrisSection.style.display = '';
        } else {
            qrisSection.style.display = 'none';
        }
    }
    paymentSelect.addEventListener('change', toggleQris);
    toggleQris();
});
</script>
@endpush 