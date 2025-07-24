@php $record = $getRecord(); @endphp
@if($record && $record->qris_proof)
    <div class="mt-4">
        <label class="block font-semibold mb-2">Bukti Pembayaran QRIS:</label>
        <a href="{{ asset('storage/' . $record->qris_proof) }}" target="_blank">
            <img src="{{ asset('storage/' . $record->qris_proof) }}" alt="Bukti QRIS" class="max-w-xs border rounded shadow mb-2">
        </a>
        <div>
            <a href="{{ asset('storage/' . $record->qris_proof) }}" download class="text-blue-600 hover:underline">Unduh Bukti</a>
        </div>
    </div>
@endif 