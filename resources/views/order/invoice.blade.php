@extends('layouts.app')

@section('content')
<style>
@media print {
    body { background: #fff !important; }
    .no-print, .navbar, nav, header, footer, .footer, .main-footer, .site-footer, .bg-white.shadow-md, .bg-white.shadow, .bg-white.sticky, .bg-white, .sticky, .shadow-md, .shadow, .footer, .main-footer, .site-footer, .max-w-7xl.mx-auto.px-6.py-4.flex.justify-between.items-center { display: none !important; }
    .invoice-box { box-shadow: none !important; border: none !important; margin-top: 0 !important; }
    main { padding: 0 !important; }
}
.invoice-box {
    max-width: 800px;
    margin: 40px auto;
    padding: 30px;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: #555;
    background: #fff;
    border-radius: 10px;
}
.invoice-box table {
    width: 100%;
    line-height: inherit;
    text-align: left;
    border-collapse: collapse;
}
.invoice-box table td {
    padding: 5px;
    vertical-align: top;
}
.invoice-box table tr.heading td {
    background: #f5f5f5;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
}
.invoice-box table tr.item td{
    border-bottom: 1px solid #eee;
}
.invoice-box .total {
    font-size: 18px;
    font-weight: bold;
    color: #2d6cdf;
}
.invoice-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}
.invoice-logo {
    font-size: 2rem;
    font-weight: bold;
    color: #2d6cdf;
}
</style>
<div class="invoice-box">
    <div class="invoice-header">
        <div class="invoice-logo">FamilyKlin</div>
        <div>
            <h2 style="margin:0;">INVOICE</h2>
            <div style="font-size:14px; color:#888;">{{ $order->order_code }}</div>
        </div>
    </div>
    <table>
        <tr>
            <td>
                <strong>Tanggal:</strong> {{ $order->placed_at ? $order->placed_at->format('d-m-Y H:i') : '-' }}<br>
                <strong>Status:</strong> {{ ucfirst($order->status) }}<br>
                <strong>Nama Pemesan:</strong> {{ $order->user->name ?? '-' }}<br>
                <strong>Alamat:</strong> {{ $order->shipping_address }}<br>
                <strong>Metode Pembayaran:</strong> {{ $order->payment_method === 'cash' ? 'Bayar di Tempat (COD)' : 'QRIS' }}<br>
            </td>
            <td style="text-align:right;">
                <strong>Total:</strong> <span class="total">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </td>
        </tr>
    </table>
    <hr style="margin:20px 0;">
    <h3 style="margin-bottom:10px;">Detail Produk</h3>
    <table>
        <tr class="heading">
            <td>Nama</td>
            <td>Jumlah</td>
            <td>Harga Satuan</td>
            <td>Subtotal</td>
        </tr>
        @foreach($order->products as $product)
        <tr class="item">
            <td>
                {{ $product->name }}
                @php $options = $product->pivot->options ? json_decode($product->pivot->options, true) : []; @endphp
                @if(!empty($options))
                    <ul style="margin:0; padding-left:18px; font-size:13px; color:#666;">
                        @foreach($options as $opt)
                            <li>{{ $opt['option'] ?? '' }}: {{ $opt['value'] ?? '' }}@if(isset($opt['price']) && $opt['price'] > 0) <span style="color:green;">(+Rp {{ number_format($opt['price'], 0, ',', '.') }})</span>@endif</li>
                        @endforeach
                    </ul>
                @endif
            </td>
            <td>{{ $product->pivot->quantity }}</td>
            <td>Rp {{ number_format($product->pivot->unit_price,0,',','.') }}</td>
            <td>Rp {{ number_format($product->pivot->unit_price * $product->pivot->quantity,0,',','.') }}</td>
        </tr>
        @endforeach
    </table>
    @if($order->services->count())
    <h3 style="margin:20px 0 10px;">Layanan</h3>
    <table>
        <tr class="heading">
            <td>Nama</td>
            <td>Jumlah</td>
            <td>Harga Satuan</td>
            <td>Subtotal</td>
        </tr>
        @foreach($order->services as $service)
        <tr class="item">
            <td>{{ $service->name }}</td>
            <td>{{ $service->pivot->quantity }}</td>
            <td>Rp {{ number_format($service->pivot->unit_price,0,',','.') }}</td>
            <td>Rp {{ number_format($service->pivot->unit_price * $service->pivot->quantity,0,',','.') }}</td>
        </tr>
        @endforeach
    </table>
    @endif
    <hr style="margin:30px 0 10px;">
    <div style="font-size:13px; color:#888;">
        Terima kasih telah memesan di FamilyKlin.<br>
        Jika ada pertanyaan, hubungi kami di WhatsApp: 0838 9310 6918<br>
        Atau hubungi via email: <a href="mailto:familyklin88@gmail.com">familyklin88@gmail.com</a>
    </div>
    <div class="no-print" style="text-align:right; margin-top:20px;">
        <a href="#" onclick="window.print()" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Cetak / Simpan PDF</a>
    </div>
</div>
@endsection 