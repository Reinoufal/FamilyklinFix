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
          <div class="mb-6">
            <span class="text-green-600 font-bold text-2xl">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
          </div>
          <div class="prose max-w-none mb-8">
            <p class="text-gray-700">{{ $product->description }}</p>
          </div>
          <div class="border-t border-gray-200 pt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Layanan Pembersihan</h3>
            <p class="text-gray-600 mb-4">Kami menawarkan layanan pembersihan profesional untuk produk ini dengan teknologi hydrocleaning terbaik.</p>
            <a href="#booking" class="inline-block px-6 py-3 bg-blue-700 text-white rounded-full hover:bg-blue-800 transition font-semibold">Booking Sekarang</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Booking Section -->
<div id="booking" class="py-16 bg-white">
  <div class="max-w-4xl mx-auto px-6">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-bold text-gray-900 mb-4">Booking {{ $product->name }}</h2>
      <p class="text-gray-600">Pilih opsi yang sesuai dengan kebutuhan Anda</p>
    </div>

    <div class="bg-gray-50 rounded-2xl p-8">
      <form id="booking-form" class="space-y-8">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        
        @if($product->options->count() > 0)
          @foreach($product->options as $option)
            <div class="bg-white rounded-lg p-6 shadow-sm">
              <h3 class="text-lg font-semibold text-gray-900 mb-4">
                {{ $option->name }}
                @if($option->required)
                  <span class="text-red-500">*</span>
                @endif
              </h3>
              
              @if($option->type === 'select')
                <select name="options[{{ $option->id }}]" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        {{ $option->required ? 'required' : '' }}>
                  <option value="">Pilih {{ $option->name }}</option>
                  @foreach($option->values as $value)
                    <option value="{{ $value->id }}" data-price="{{ $value->price_modifier }}">
                      {{ $value->name }}
                      @if($value->price_modifier > 0)
                        (+Rp {{ number_format($value->price_modifier, 0, ',', '.') }})
                      @endif
                    </option>
                  @endforeach
                </select>
              
              @elseif($option->type === 'checkbox')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  @foreach($option->values as $value)
                    <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition duration-200">
                      <input type="checkbox" 
                             name="options[{{ $option->id }}][]" 
                             value="{{ $value->id }}"
                             data-price="{{ $value->price_modifier }}"
                             class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                      <div class="ml-3">
                        <div class="font-medium text-gray-900">{{ $value->name }}</div>
                        @if($value->price_modifier > 0)
                          <div class="text-sm text-green-600">+Rp {{ number_format($value->price_modifier, 0, ',', '.') }}</div>
                        @endif
                      </div>
                    </label>
                  @endforeach
                </div>
              
              @elseif($option->type === 'radio')
                <div class="space-y-3">
                  @foreach($option->values as $value)
                    <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition duration-200">
                      <input type="radio" 
                             name="options[{{ $option->id }}]" 
                             value="{{ $value->id }}"
                             data-price="{{ $value->price_modifier }}"
                             class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                             {{ $option->required ? 'required' : '' }}>
                      <div class="ml-3">
                        <div class="font-medium text-gray-900">{{ $value->name }}</div>
                        @if($value->price_modifier > 0)
                          <div class="text-sm text-green-600">+Rp {{ number_format($value->price_modifier, 0, ',', '.') }}</div>
                        @endif
                      </div>
                    </label>
                  @endforeach
                </div>
              @endif
            </div>
          @endforeach
        @endif

        <!-- Price Summary -->
        <div class="bg-blue-50 rounded-lg p-6">
          <div class="flex justify-between items-center mb-4">
            <span class="text-lg font-medium text-gray-900">Harga Dasar:</span>
            <span class="text-lg font-semibold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
          </div>
          <div id="additional-costs" class="space-y-2 mb-4">
            <!-- Additional costs will be populated by JavaScript -->
          </div>
          <div class="border-t border-blue-200 pt-4">
            <div class="flex justify-between items-center">
              <span class="text-xl font-bold text-gray-900">Total Harga:</span>
              <span id="total-price" class="text-2xl font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            </div>
          </div>
        </div>

        <!-- Customer Information -->
        <div class="bg-white rounded-lg p-6 shadow-sm">
          <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pelanggan</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
              <input type="text" id="customer_name" name="customer_name" required
                     class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
            </div>
            <div>
              <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon *</label>
              <input type="tel" id="customer_phone" name="customer_phone" required
                     class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
            </div>
            <div class="md:col-span-2">
              <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
              <textarea id="customer_address" name="customer_address" rows="3" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"></textarea>
            </div>
            <div class="md:col-span-2">
              <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan</label>
              <textarea id="notes" name="notes" rows="2"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        placeholder="Instruksi khusus atau catatan tambahan..."></textarea>
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
          <button type="submit" 
                  class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition duration-200 text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            Konfirmasi Booking
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const basePrice = {{ $product->price }};
    const form = document.getElementById('booking-form');
    const totalPriceElement = document.getElementById('total-price');
    const additionalCostsElement = document.getElementById('additional-costs');

    function updatePrice() {
        let totalPrice = basePrice;
        let additionalCosts = [];

        // Get all selected options
        const selects = form.querySelectorAll('select[name^="options"]');
        const checkboxes = form.querySelectorAll('input[type="checkbox"]:checked');
        const radios = form.querySelectorAll('input[type="radio"]:checked');

        // Process selects
        selects.forEach(select => {
            if (select.value) {
                const option = select.options[select.selectedIndex];
                const price = parseFloat(option.dataset.price || 0);
                if (price > 0) {
                    totalPrice += price;
                    additionalCosts.push({
                        name: option.text,
                        price: price
                    });
                }
            }
        });

        // Process checkboxes
        checkboxes.forEach(checkbox => {
            const price = parseFloat(checkbox.dataset.price || 0);
            if (price > 0) {
                totalPrice += price;
                const label = checkbox.closest('label').querySelector('.font-medium').textContent;
                additionalCosts.push({
                    name: label,
                    price: price
                });
            }
        });

        // Process radios
        radios.forEach(radio => {
            const price = parseFloat(radio.dataset.price || 0);
            if (price > 0) {
                totalPrice += price;
                const label = radio.closest('label').querySelector('.font-medium').textContent;
                additionalCosts.push({
                    name: label,
                    price: price
                });
            }
        });

        // Update additional costs display
        additionalCostsElement.innerHTML = '';
        additionalCosts.forEach(cost => {
            const div = document.createElement('div');
            div.className = 'flex justify-between items-center text-sm';
            div.innerHTML = `
                <span class="text-gray-600">${cost.name}:</span>
                <span class="text-gray-900">+Rp ${cost.price.toLocaleString('id-ID')}</span>
            `;
            additionalCostsElement.appendChild(div);
        });

        // Update total price
        totalPriceElement.textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
    }

    // Add event listeners
    form.addEventListener('change', updatePrice);
    
    // Handle form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Here you can add AJAX submission or redirect to a booking confirmation page
        alert('Booking berhasil! Kami akan menghubungi Anda segera.');
    });
});
</script>
@endpush
@endsection