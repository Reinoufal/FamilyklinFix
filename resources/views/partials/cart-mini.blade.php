<div class="flex items-center mb-2">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-700 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A2 2 0 007.5 19h9a2 2 0 001.85-2.7L17 13M7 13V6a4 4 0 018 0v7" />
  </svg>
  <h3 class="font-semibold">Keranjang</h3>
</div>
@if(count($cart) > 0)
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
@else
    <div class="text-gray-500 text-center py-8">Keranjang kosong</div>
@endif