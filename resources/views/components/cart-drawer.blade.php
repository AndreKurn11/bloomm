{{-- ===== BLOOM CAFÉ — CART DRAWER ===== --}}
{{-- IDs harus cocok persis dengan yang dipakai di bloom.js:
     #cart-drawer, #cart-overlay, #cart-body, #cart-footer --}}

{{-- Overlay (klik untuk tutup) --}}
<div id="cart-overlay"></div>

{{-- Drawer Panel --}}
<div id="cart-drawer">

    {{-- Header --}}
    <div class="cart-header">
        <div>
            <h5 class="fw-bold mb-0" style="color:var(--text-heading,#1a1a2e);font-size:1.1rem;">
                🛒 Your Cart
            </h5>
            <p class="mb-0" style="font-size:0.78rem;color:#888;margin-top:2px;">
                Items ready for checkout
            </p>
        </div>
        <button onclick="closeCart()" class="cart-close-btn" title="Close">✕</button>
    </div>

    {{-- Body — diisi oleh renderCart() di bloom.js --}}
    <div class="cart-body" id="cart-body">
        {{-- Default state sebelum JS jalan --}}
        <div class="cart-empty">
            <i class="bi bi-cup-hot"></i>
            <p class="fw-semibold mb-1">Keranjang kosong</p>
            <p class="small text-muted">Tambahkan menu favoritmu!</p>
        </div>
    </div>

    {{-- Footer — diisi oleh renderCart() di bloom.js --}}
    <div id="cart-footer"></div>

</div>
