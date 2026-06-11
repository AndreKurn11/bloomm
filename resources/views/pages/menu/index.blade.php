@extends('layouts.app')
@section('title', 'Menu — Bloom Digital Café')

@section('content')
    <div class="section-pad">
        <div class="container">
            {{-- Header --}}
            <div class="mb-5">
                <span class="section-label">OUR COLLECTION</span>
                <h1 style="font-family:var(--font-heading);font-size:2.5rem;font-weight:700;margin:12px 0 10px">Menu Kami
                </h1>
                <p style="color:var(--text-body);max-width:520px">
                    Jelajahi pilihan terbaik dari biji kopi pilihan dan kudapan lezat yang diracik khusus untuk menemani
                    setiap momen pertumbuhan Anda.
                </p>
            </div>

            <div class="row g-4">
                {{-- Sidebar --}}
                <div class="col-md-3">
                    <div class="category-sidebar">
                        <div class="cat-label">Kategori</div>
                        @foreach ($categories as $cat)
                            <a href="{{ route('menu.index', ['category' => $cat->slug]) }}"
                                class="category-item {{ $categorySlug === $cat->slug ? 'active' : '' }}">
                                <span>{{ $cat->name }}</span>
                                @if ($cat->slug !== 'semua')
                                    <span style="font-size:0.9rem">{{ $cat->icon ?? '›' }}</span>
                                @else
                                    <span>›</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Menu Grid --}}
                <div class="col-md-9">
                    <div class="row g-4">
                        @foreach ($menus as $menu)
                            <div class="col-md-4 col-6">
                                <div class="bloom-card menu-card">
                                    <div class="card-img-wrap"
                                        onclick="window.location='{{ route('menu.show', $menu->slug) }}'">
                                        <img src="{{ asset('images/menu/' . ($menu->image ?? 'placeholder.jpg')) }}"
                                            alt="{{ $menu->name }}"
                                            onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                                        @if ($menu->badge)
                                            <span
                                                class="badge-tag {{ str_contains($menu->badge, 'SALE') ? 'sale' : '' }}">{{ $menu->badge }}</span>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="menu-name mb-0">{{ $menu->name }}</h6>
                                            <span class="menu-price"
                                                style="font-size:0.85rem;white-space:nowrap;margin-left:8px">Rp
                                                {{ number_format($menu->price, 0, ',', '.') }}</span>
                                        </div>
                                        <p class="menu-desc">{{ Str::limit($menu->description, 80) }}</p>

                                        {{--
                                            addToCart(id, name, price, imageUrl)
                                            — item masuk cart, TIDAK redirect ke payment
                                        --}}
                                        <button class="btn-add-cart"
                                            onclick="addToCart(
                                                '{{ $menu->id }}','{{ addslashes($menu->name) }}',{{ $menu->price }},'{{ asset('images/menu/' . ($menu->image ?? 'placeholder.jpg')) }}'
                                            )">
                                            Tambah ke Keranjang
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
