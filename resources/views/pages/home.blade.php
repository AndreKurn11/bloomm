@extends('layouts.app')
@section('title', 'Home — Bloom Coffee & Place')

@section('content')

    {{-- HERO --}}
    <section class="hero-section"
        style="
    min-height: 90vh;
    background: url('{{ asset('images/hero/hero-bg.jpg') }}') center center / cover no-repeat;
    position: relative;
    display: flex;
    align-items: center;
">
        {{-- Overlay gelap supaya teks terbaca --}}
        <div
            style="
        position:absolute;inset:0;
        background: linear-gradient(135deg, rgba(10,10,30,0.72) 0%, rgba(10,10,30,0.45) 100%);
    ">
        </div>

        <div class="container" style="position:relative;z-index:2">
            <div class="row align-items-center">
                <div class="col-md-6 mb-5 mb-md-0">
                    <div class="hero-badge"
                        style="
                    display:inline-block;
                    background:rgba(255,255,255,0.15);
                    color:#fff;
                    border:1px solid rgba(255,255,255,0.3);
                    border-radius:50px;
                    padding:6px 18px;
                    font-size:0.82rem;
                    font-weight:600;
                    letter-spacing:0.05em;
                    margin-bottom:20px;
                    backdrop-filter:blur(8px);
                ">
                        Sejak 2024</div>

                    <h1
                        style="
                    font-family:var(--font-heading);
                    font-size:clamp(2.2rem, 5vw, 3.6rem);
                    font-weight:800;
                    color:#fff;
                    line-height:1.15;
                    margin-bottom:20px;
                ">
                        Sip —<br>relax and<br>BLOOM</h1>

                    <p
                        style="color:rgba(255,255,255,0.82);font-size:1rem;max-width:400px;margin-bottom:32px;line-height:1.7">
                        Nikmati suasana hangat dengan kopi pilihan, ruang terbuka yang nyaman, dan momen kebersamaan tanpa
                        batas.
                    </p>

                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('menu.index') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">
                            Order Sekarang
                        </a>
                        <a href="{{ route('location') }}"
                            style="
                        display:inline-flex;align-items:center;
                        color:#fff;border:2px solid rgba(255,255,255,0.6);
                        border-radius:50px;padding:8px 24px;
                        font-weight:600;text-decoration:none;
                        transition:all 0.2s;"
                            onmouseover="this.style.background='rgba(255,255,255,0.15)'"
                            onmouseout="this.style.background='transparent'">
                            Kunjungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- STATS BAR --}}
    <section style="background:var(--primary,#0d6efd);padding:24px 0">
        <div class="container">
            <div class="row text-center g-3">
                @foreach ([['10+', 'Menu Pilihan'], ['1K+', 'Pelanggan Puas'], ['4.9', 'Rating Rata-rata'], ['1', 'Cabang']] as $s)
                    <div class="col-6 col-md-3">
                        <div style="color:#fff">
                            <div style="font-size:1.8rem;font-weight:800;font-family:var(--font-heading)">
                                {{ $s[0] }}</div>
                            <div style="font-size:0.82rem;opacity:0.85;margin-top:2px">{{ $s[1] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ABOUT SECTION --}}
    <section id="about" class="section-pad" style="background:var(--bg-light,#f8f9fa)">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-md-6">
                    <div class="row g-3">
                        <div class="col-6">
                            <img src="{{ asset('images/gallery/gallery1.jpg') }}" class="img-fluid rounded-3 w-100"
                                alt="Café Vibes" style="height:200px;object-fit:cover">
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('images/gallery/gallery2.jpg') }}" class="img-fluid rounded-3 w-100"
                                alt="Coffee" style="height:200px;object-fit:cover">
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('images/gallery/gallery3.jpg') }}" class="img-fluid rounded-3 w-100"
                                alt="Interior" style="height:200px;object-fit:cover">
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('images/gallery/gallery4.jpg') }}" class="img-fluid rounded-3 w-100"
                                alt="Barista" style="height:200px;object-fit:cover">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ps-md-5">
                    <p
                        style="color:var(--primary,#0d6efd);font-weight:600;font-size:0.85rem;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:12px">
                        Tentang Kami
                    </p>
                    <h2 style="font-family:var(--font-heading);font-size:2rem;font-weight:700;margin-bottom:16px">
                        Konsep Ruang Terbuka
                    </h2>
                    <p style="color:var(--text-body,#555);margin-bottom:24px;line-height:1.75">
                        Bloom Café didirikan atas dasar keyakinan bahwa kopi terbaik adalah kopi yang
                        dinikmati bersama. Kami menghadirkan konsep "Open Space" yang mendorong
                        interaksi antar individu dan komunitas.
                    </p>
                    <div class="d-flex flex-column gap-3">
                        @foreach ([['Ruang Nyaman untuk Berkumpul'], ['Open Space dengan Suasana Hangat'], ['Cocok untuk Semua Kalangan']] as $f)
                            <div class="d-flex align-items-center gap-3">
                                <span style="font-size:1.2rem">•</span>

                                <span style="color:var(--text-body,#555);font-weight:500">
                                    {{ $f[0] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MENU UNGGULAN --}}
    <section class="section-pad">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <p
                        style="color:var(--primary,#0d6efd);font-weight:600;font-size:0.85rem;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:6px">
                        Featured
                    </p>
                    <h2 style="font-family:var(--font-heading);font-size:2rem;font-weight:700;margin:0">
                        Menu Unggulan
                    </h2>
                    <p style="color:var(--text-muted,#888);margin:6px 0 0">
                        Ketahui rasa terbaik untuk memulai harimu.
                    </p>
                </div>
                <a href="{{ route('menu.index') }}"
                    style="color:var(--primary,#0d6efd);text-decoration:none;font-weight:600;font-size:0.9rem;white-space:nowrap">
                    Lihat Semua →
                </a>
            </div>

            @if (isset($featuredMenus) && $featuredMenus->count() > 0)
                <div class="row g-4">
                    @foreach ($featuredMenus as $menu)
                        <div class="col-6 col-md-3">
                            <div class="bloom-card menu-card"
                                style="cursor:pointer;border-radius:16px;overflow:hidden;transition:transform 0.2s,box-shadow 0.2s;box-shadow:0 2px 12px rgba(0,0,0,0.07)"
                                onclick="window.location='{{ route('menu.show', $menu->slug) }}'"
                                onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 28px rgba(0,0,0,0.13)'"
                                onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 12px rgba(0,0,0,0.07)'">
                                <div style="position:relative;overflow:hidden;height:180px;background:#eef2ff">
                                    <img src="{{ asset('images/menu/' . ($menu->image ?? 'placeholder.jpg')) }}"
                                        alt="{{ $menu->name }}" style="width:100%;height:100%;object-fit:cover"
                                        onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                                    @if ($menu->badge)
                                        <span
                                            style="
                            position:absolute;top:10px;left:10px;
                            background:{{ str_contains($menu->badge, 'SALE') ? '#dc3545' : (str_contains($menu->badge, 'NEW') ? '#198754' : '#0d6efd') }};
                            color:#fff;font-size:0.7rem;font-weight:700;
                            padding:3px 10px;border-radius:50px;letter-spacing:0.05em;
                        ">{{ $menu->badge }}</span>
                                    @endif
                                </div>
                                <div style="padding:14px">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <span
                                            style="font-weight:600;font-size:0.9rem;color:#1a1a2e">{{ $menu->name }}</span>
                                        <span
                                            style="font-size:0.82rem;color:var(--primary,#0d6efd);font-weight:700;white-space:nowrap;margin-left:8px">
                                            Rp {{ number_format($menu->price / 1000, 0) }}k
                                        </span>
                                    </div>
                                    <p style="font-size:0.78rem;color:#888;margin:0;line-height:1.5">
                                        {{ Str::limit($menu->description, 65) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Fallback kalau $featuredMenus kosong/tidak ada --}}
                <div class="text-center py-5" style="color:#aaa">
                    <i class="bi bi-cup-hot" style="font-size:3rem;display:block;margin-bottom:12px"></i>
                    <p class="fw-semibold">Menu belum tersedia.</p>
                    <p class="small">Jalankan <code>php artisan db:seed</code> untuk mengisi data menu.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- TESTIMONIALS --}}
    <section class="section-pad" style="background:var(--bg-light,#f8f9fa)">
        <div class="container">
            <div class="text-center mb-5">
                <p
                    style="color:var(--primary,#0d6efd);font-weight:600;font-size:0.85rem;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:6px">
                    Testimoni
                </p>
                <h2 style="font-family:var(--font-heading);font-size:2rem;font-weight:700">
                    BLOOM di Mata Mereka
                </h2>
            </div>
            <div class="row g-4">
                @foreach ([['name' => 'Andre Kurniawan', 'role' => 'Creative Director', 'stars' => 4, 'quote' => 'Tempat favorit untuk bekerja. Suasananya tenang, kopinya luar biasa, dan koneksi internetnya sangat stabil.'], ['name' => 'Intan Sri Ayu', 'role' => 'Startup Founder', 'stars' => 5, 'quote' => 'Konsep open-space-nya sangat menyenangkan. Saya sering bertemu teman baru dan berdiskusi ide menarik.'], ['name' => 'Rani Dwi Putri', 'role' => 'Coffee Enthusiast', 'stars' => 5, 'quote' => 'Kualitas biji kopi single origin-nya konsisten. Setiap seduhan V60 selalu memberikan kejutan rasa yang baru.']] as $review)
                    <div class="col-md-4">
                        <div
                            style="
                    background:#fff;border-radius:16px;padding:28px;height:100%;
                    box-shadow:0 2px 16px rgba(0,0,0,0.06);
                    border:1px solid rgba(0,0,0,0.04);
                ">
                            <div class="d-flex gap-1 mb-3">
                                @for ($i = 0; $i < 5; $i++)
                                    <span
                                        style="color:{{ $i < $review['stars'] ? '#f5a623' : '#e0e0e0' }};font-size:1.1rem">★</span>
                                @endfor
                            </div>
                            <p style="color:#444;font-style:italic;margin-bottom:20px;line-height:1.7;font-size:0.92rem">
                                "{{ $review['quote'] }}"
                            </p>
                            <div class="d-flex align-items-center gap-3">
                                <div
                                    style="
                            width:42px;height:42px;
                            background:var(--primary,#0d6efd);
                            border-radius:50%;display:flex;align-items:center;
                            justify-content:center;color:#fff;font-weight:700;font-size:1rem;
                            flex-shrink:0;
                        ">
                                    {{ substr($review['name'], 0, 1) }}</div>
                                <div>
                                    <div style="font-weight:600;font-size:0.88rem">{{ $review['name'] }}</div>
                                    <div style="font-size:0.78rem;color:#aaa">{{ $review['role'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
