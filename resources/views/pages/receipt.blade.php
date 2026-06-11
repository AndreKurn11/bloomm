@extends('layouts.app')
@section('title', 'Receipt — Bloom')

@section('content')
    <div class="section-pad">
        <div class="container">
            {{-- Success Header --}}
            <div class="text-center mb-5">
                <div class="success-icon mb-4">
                    <span style="font-size:1.8rem;color:var(--primary)">✓</span>
                </div>
                <h1 style="font-family:var(--font-heading);font-size:2.5rem;color:var(--primary)">Terima Kasih!</h1>
                <p style="color:var(--text-muted)">Pesanan Anda telah kami terima dan sedang diproses.</p>
            </div>

            <div class="receipt-card">
                {{-- Receipt Meta --}}
                <div class="receipt-header">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="receipt-meta-label">ORDER ID</div>
                            <div class="order-id-display">#{{ $order->order_id }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="receipt-meta-label">TANGGAL & WAKTU</div>
                            <div class="receipt-meta-value">{{ $order->created_at->format('d M Y, H:i') }} WIB</div>
                        </div>
                        <div class="col-md-4">
                            <div class="receipt-meta-label">NAMA PELANGGAN</div>
                            <div class="receipt-meta-value">{{ $order->customer_name }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="receipt-meta-label">STATUS</div>
                            <span class="status-badge">{{ ucfirst($order->status) }}</span>
                        </div>
                        <div class="col-md-4">
                            <div class="receipt-meta-label">PEMBAYARAN</div>
                            <div class="receipt-meta-value">🏦 {{ $order->payment_method }}</div>
                        </div>
                    </div>
                </div>

                {{-- Detail Pesanan --}}
                <div class="mt-4">
                    <h4 style="font-family:var(--font-heading);font-size:1.3rem;font-weight:700;margin-bottom:20px">Detail
                        Pesanan</h4>
                    @foreach ($order->items as $item)
                        <div class="order-item-row">
                            <img src="{{ $item['image'] ?? asset('images/placeholder.jpg') }}" alt="{{ $item['name'] }}">
                            <div class="flex-grow-1">
                                <div style="font-weight:600">{{ $item['name'] }}</div>
                                @if (!empty($item['notes']))
                                    <div style="font-size:0.82rem;color:var(--text-muted)">{{ $item['notes'] }}</div>
                                @endif
                            </div>
                            <div class="text-end">
                                <div>Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                                <div style="font-size:0.82rem;color:var(--text-muted)">x{{ $item['quantity'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Total Summary --}}
                <div class="total-summary-box">
                    <div class="summary-row"><span>Subtotal</span><span>Rp
                            {{ number_format($order->subtotal, 0, ',', '.') }}</span></div>
                    <div class="summary-row"><span>Pajak (11%)</span><span>Rp
                            {{ number_format($order->tax, 0, ',', '.') }}</span></div>
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3"
                        style="border-top:1px solid var(--border)">
                        <h4 style="font-family:var(--font-heading);font-weight:700;margin:0">Total Pembayaran</h4>
                        <span
                            style="font-family:var(--font-heading);font-size:1.5rem;color:var(--primary);font-weight:700">Rp
                            {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- QR Proof --}}
                <div class="text-center my-4">
                    <img src="{{ asset('images/qris-receipt.png') }}" alt="QRIS Receipt" style="width:80px;opacity:0.6">
                    <p style="font-size:0.8rem;color:var(--text-muted);margin-top:10px">
                        Bukti pembayaran ini sah secara digital dan tidak memerlukan tanda tangan basah.
                    </p>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
                <button onclick="window.print()" class="btn-bloom btn-bloom-outline btn-bloom-lg">⬇ Download PDF</button>
                <a href="{{ route('home') }}" class="btn-bloom btn-bloom-primary btn-bloom-lg">🏠 Kembali ke Home</a>
            </div>
        </div>
    </div>
@endsection
