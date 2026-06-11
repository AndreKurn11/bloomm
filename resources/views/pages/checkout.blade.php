@extends('layouts.app')
@section('title', 'Checkout — Bloom')

@section('content')
    <div class="section-pad">
        <div class="container">
            <div class="mb-5">
                <h1 style="font-family:var(--font-heading);font-size:2.5rem;font-weight:700">Checkout</h1>
                <p style="color:var(--text-muted)">Selesaikan pesananmu dan nikmati kopi Bloom segera.</p>
            </div>

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="row g-4">
                    {{-- Left Column --}}
                    <div class="col-md-7">
                        {{-- Detail Pelanggan --}}
                        <div class="checkout-section-card">
                            <div class="checkout-section-title">👤 Detail Pelanggan</div>
                            <div class="mb-4">
                                <label class="input-label">Nama Lengkap</label>
                                <input type="text" name="customer_name" class="bloom-input"
                                    placeholder="Masukkan nama lengkap Anda" required>
                            </div>
                            <div class="mb-4">
                                <label class="input-label">Nomor Handphone</label>
                                <div class="phone-group">
                                    <div class="phone-prefix">+62</div>
                                    <input type="text" name="customer_phone" class="bloom-input"
                                        placeholder="812 3456 7890" required>
                                </div>
                            </div>
                            <div>
                                <label class="input-label">Catatan Pesanan (Opsional)</label>
                                <textarea name="notes" class="bloom-input" placeholder="Contoh: Kurangi gula, atau jemput di lobby."></textarea>
                            </div>
                        </div>

                        {{-- Ringkasan Pesanan --}}
                        <div class="checkout-section-card">
                            <div class="checkout-section-title">🛒 Ringkasan Pesanan</div>
                            @foreach ($cart as $item)
                                <div class="order-item-row">
                                    <img src="{{ asset('images/' . ($item['image'] ?? 'placeholder.jpg')) }}"
                                        alt="{{ $item['name'] }}">
                                    <div class="flex-grow-1">
                                        <div style="font-weight:600;font-size:0.9rem">{{ $item['name'] }}</div>
                                        <div style="font-size:0.82rem;color:var(--text-muted)">Qty: {{ $item['quantity'] }}
                                        </div>
                                    </div>
                                    <div class="price-tag" style="font-size:0.9rem">Rp
                                        {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</div>
                                </div>
                            @endforeach

                            <hr class="divider">
                            <div class="summary-row"><span>Subtotal</span><span>Rp
                                    {{ number_format($subtotal, 0, ',', '.') }}</span></div>
                            <div class="summary-row"><span>Pajak (11%)</span><span>Rp
                                    {{ number_format($tax, 0, ',', '.') }}</span></div>
                            <div class="summary-row total"
                                style="margin-top:8px;padding-top:12px;border-top:1px solid var(--border)">
                                <span>Total</span><span class="price-tag">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: QRIS --}}
                    <div class="col-md-5">
                        <div class="qris-card sticky-top" style="top:90px">
                            <div class="checkout-section-title">🏦 Bayar dengan QRIS</div>
                            <div class="qris-image-wrap">
                                <img src="{{ asset('images/qris-mock.png') }}" alt="QRIS Code">
                            </div>
                            <p
                                style="text-align:center;font-size:0.85rem;color:var(--text-muted);font-style:italic;margin-bottom:20px">
                                Scan kode QR di atas menggunakan aplikasi perbankan atau e-wallet Anda.
                            </p>
                            <button type="button" class="btn-bloom btn-bloom-outline btn-bloom-block mb-4">
                                ⬇ Unduh QRIS
                            </button>

                            <button type="submit" class="btn-bloom btn-bloom-primary btn-bloom-block btn-bloom-lg">
                                Selesaikan Pembayaran
                            </button>
                            <p style="text-align:center;font-size:0.78rem;color:var(--text-muted);margin-top:10px">
                                🔒 Pembayaran Aman & Terenkripsi
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
