@extends('layouts.app')
@section('title', $menu->name . ' — Bloom')

@section('content')
    <div class="section-pad">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-md-6">
                    <div class="hero-image-wrap">
                        <img src="{{ asset('images/' . ($menu->image ?? 'placeholder.jpg')) }}" alt="{{ $menu->name }}"
                            style="height:500px">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="section-label mb-3">{{ strtoupper($menu->category->name) }} SERIES</div>
                    <h1 style="font-family:var(--font-heading);font-size:2.5rem;font-weight:700;margin-bottom:16px">
                        {{ $menu->name }}</h1>
                    <div class="price-tag" style="font-size:1.6rem;margin-bottom:20px">Rp
                        {{ number_format($menu->price, 0, ',', '.') }}</div>
                    <p style="color:var(--text-body);line-height:1.8;margin-bottom:32px">{{ $menu->long_description }}</p>

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="d-flex align-items-center gap-2 bloom-card"
                            style="padding:8px 16px;border-radius:var(--radius-pill)">
                            <button onclick="changeQty(-1)"
                                style="background:none;border:none;cursor:pointer;font-size:1.2rem;color:var(--primary)">−</button>
                            <span id="qty-display" style="font-weight:700;min-width:24px;text-align:center">1</span>
                            <button onclick="changeQty(1)"
                                style="background:none;border:none;cursor:pointer;font-size:1.2rem;color:var(--primary)">+</button>
                        </div>
                        <button class="btn-bloom btn-bloom-primary btn-bloom-lg" style="flex:1"
                            onclick="addToCartWithQty({{ $menu->id }})">
                            🛒 Tambah ke Keranjang
                        </button>
                    </div>

                    <div class="d-flex align-items-center gap-2" style="color:var(--text-muted);font-size:0.88rem">
                        <span>🌿</span> <span>Eco-Friendly Sourcing</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let qty = 1;

            function changeQty(delta) {
                qty = Math.max(1, qty + delta);
                document.getElementById('qty-display').textContent = qty;
            }

            function addToCartWithQty(menuId) {
                fetch('{{ route('cart.add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        menu_id: menuId,
                        quantity: qty
                    })
                }).then(r => r.json()).then(data => {
                    document.getElementById('cart-count').textContent = data.count;
                    openCart();
                });
            }
        </script>
    @endpush
@endsection
