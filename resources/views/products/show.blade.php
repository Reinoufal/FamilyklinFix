@extends('layouts.app')

@section('content')
<div class="pt-20 pb-10 bg-blue-50">
  <div class="max-w-7xl mx-auto px-6">
    <a href="{{ route('products.index') }}" class="inline-flex items-center text-blue-700 hover:text-blue-800 mb-6">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
      </svg>
      Kembali ke Daftar Produk
    </a>
    
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
      <div class="md:flex">
        <div class="md:w-1/2">
          @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto max-h-[300px] object-contain mx-auto p-4">
          @else
            <div class="w-full h-full min-h-[250px] bg-gray-200 flex items-center justify-center">
              <span class="text-gray-400">Tidak ada gambar</span>
            </div>
          @endif
        </div>
        <div class="md:w-1/2 p-8">
          <h1 class="text-3xl font-bold text-blue-900 mb-4">{{ $product->name }}</h1>
          @php
              $min = number_format($product->price, 0, ',', '.');
              $max = $product->price_max ? number_format($product->price_max, 0, ',', '.') : null;
              $isRange = $product->price_max && floatval($product->price_max) > floatval($product->price);
          @endphp
          <div class="mb-6">
            @if($isRange)
                <span class="text-green-600 font-bold text-2xl">Rp {{ $min }} – Rp {{ $max }}</span>
            @else
                <span class="text-green-600 font-bold text-2xl">Rp {{ $min }}</span>
            @endif
          </div>
          <div class="prose max-w-none mb-8">
            <p class="text-gray-700">{{ $product->description }}</p>
          </div>
          <div class="border-t border-gray-200 pt-6 mb-6">
            {{-- Hapus judul dan paragraf layanan pembersihan --}}
          </div>
          @php
            $isSimpleType = $product->type === 'perlengkapan_bayi' || $product->type === 'add_on';
          @endphp
          {{-- Hapus debug harga kombinasi --}}
          {{-- Form Booking dipindahkan ke dalam card utama --}}
          <form id="booking-form" action="{{ route('cart.add') }}" method="POST" class="space-y-8">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <input type="hidden" name="type" value="product">
            @foreach($product->options as $option)
              @if($isSimpleType && $option->name === 'Dummy')
                <input type="hidden" name="options[{{ $option->id }}]" id="option-{{ $option->id }}" value="{{ $option->values->first()->id }}">
              @else
                <div class="bg-white rounded-lg p-6 shadow-sm">
                  <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    {{ $option->name }}
                    @if($option->required)
                      <span class="text-red-500">*</span>
                    @endif
                  </h3>
                  @if($option->type === 'select')
                    <select name="options[{{ $option->id }}]" id="option-{{ $option->id }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" {{ $option->required ? 'required' : '' }}>
                      <option value="">Pilih {{ $option->name }}</option>
                      @foreach($option->values as $value)
                        <option value="{{ (int) $value->id }}">{{ $value->name }}</option>
                      @endforeach
                    </select>
                  @endif
                </div>
              @endif
            @endforeach
            <div class="bg-blue-50 rounded-lg p-6">
              <div class="flex justify-between items-center mb-4">
                <span class="text-lg font-medium text-gray-900">Harga Dasar:</span>
                <span id="harga-dasar" class="text-lg font-semibold text-gray-900">Rp 0</span>
              </div>
              <div class="border-t border-blue-200 pt-4">
                <div class="flex justify-between items-center">
                  <span class="text-xl font-bold text-gray-900">Total Harga:</span>
                  <span id="total-price" class="text-2xl font-bold text-blue-600">Rp 0</span>
                </div>
              </div>
            </div>
            <div class="flex items-center mt-6">
              <label for="quantity" class="mr-2 font-medium">Jumlah:</label>
              <input type="number" id="quantity" name="quantity" value="1" min="1" class="border rounded px-2 py-1 w-24">
            </div>
            <div class="text-center">
              <button type="submit" 
                      class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition duration-200 text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                Tambah ke Keranjang
              </button>
              <div id="cart-success-message" class="hidden mt-4 p-3 bg-green-100 border border-green-300 text-green-800 rounded-lg text-center"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Total Harga Section --}}
{{-- FORM BOOKING DI BAWAH INI DIHAPUS --}}

@push('scripts')
<script>
const hargaKombinasi = @json($hargaKombinasi);
function updateHargaProduk() {
  const selects = document.querySelectorAll('#booking-form select[name^="options"]');
  let price = 0;
  if (selects.length === 1) {
    const layananId = selects[0].value;
    const kombinasi = hargaKombinasi.find(h => h.layanan_id == layananId);
    price = kombinasi ? kombinasi.price : 0;
  } else if (selects.length === 2) {
    const layananId = selects[0].value;
    const ukuranId = selects[1].value;
    const kombinasi = hargaKombinasi.find(h => h.layanan_id == layananId && h.ukuran_id == ukuranId);
    price = kombinasi ? kombinasi.price : 0;
  }
  document.getElementById('harga-dasar').textContent = price > 0 ? 'Rp ' + price.toLocaleString('id-ID') : 'Rp 0';
  document.getElementById('total-price').textContent = price > 0 ? 'Rp ' + price.toLocaleString('id-ID') : 'Rp 0';
}

document.querySelectorAll('#booking-form select[name^="options"]').forEach(select => {
  select.addEventListener('change', updateHargaProduk);
});
updateHargaProduk();

// AJAX submit untuk tambah ke keranjang
const bookingForm = document.getElementById('booking-form');
if (bookingForm) {
  bookingForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(bookingForm);
    fetch(bookingForm.action, {
      method: 'POST',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': formData.get('_token'),
      },
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        const msg = document.getElementById('cart-success-message');
        msg.textContent = data.message || 'Item ditambahkan ke keranjang!';
        msg.classList.remove('hidden');
        msg.classList.add('block');
        // Reset jumlah ke 1
        const qty = document.getElementById('quantity');
        if (qty) qty.value = 1;
        // Sembunyikan pesan setelah 2.5 detik
        setTimeout(() => { msg.classList.add('hidden'); msg.classList.remove('block'); }, 2500);
        // Update badge keranjang di navbar
        fetch('/cart/count')
          .then(res => res.json())
          .then(data => {
            const badge = document.querySelector('button.relative .absolute.bg-red-500');
            if (badge) {
              badge.textContent = data.count;
              badge.style.display = data.count > 0 ? '' : 'none';
            } else if (data.count > 0) {
              // Jika badge belum ada, buat baru
              const btn = document.querySelector('button.relative');
              if (btn) {
                const span = document.createElement('span');
                span.className = 'absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-2 py-0.5';
                span.textContent = data.count;
                btn.appendChild(span);
                }
            }
        });
        // Update isi dropdown keranjang di navbar
        fetch('/cart/mini')
          .then(res => res.text())
          .then(html => {
            const dropdown = document.querySelector('div[x-show] > div.p-4');
            if (dropdown) dropdown.innerHTML = html;
          });
      } else {
        alert('Gagal menambah ke keranjang!');
      }
    })
    .catch(() => alert('Gagal menambah ke keranjang!'));
  });
}
</script>
@endpush
@endsection