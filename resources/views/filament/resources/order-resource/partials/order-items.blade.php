@php
    $record = $getRecord();
@endphp

@if($record)
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr>
                    <th class="px-2 py-1 text-left">Produk/Layanan</th>
                    <th class="px-2 py-1 text-center">Jumlah</th>
                    <th class="px-2 py-1 text-right">Harga Satuan</th>
                    <th class="px-2 py-1 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($record->products as $product)
                    <tr>
                        <td class="px-2 py-1">{{ $product->name }}</td>
                        <td class="px-2 py-1 text-center">{{ $product->pivot->quantity }}</td>
                        <td class="px-2 py-1 text-right">Rp {{ number_format($product->pivot->unit_price,0,',','.') }}</td>
                        <td class="px-2 py-1 text-right">Rp {{ number_format($product->pivot->unit_price * $product->pivot->quantity,0,',','.') }}</td>
                    </tr>
                @endforeach
                @foreach($record->services as $service)
                    <tr>
                        <td class="px-2 py-1">{{ $service->name }}</td>
                        <td class="px-2 py-1 text-center">{{ $service->pivot->quantity }}</td>
                        <td class="px-2 py-1 text-right">Rp {{ number_format($service->pivot->unit_price,0,',','.') }}</td>
                        <td class="px-2 py-1 text-right">Rp {{ number_format($service->pivot->unit_price * $service->pivot->quantity,0,',','.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div>Data pesanan tidak ditemukan.</div>
@endif 