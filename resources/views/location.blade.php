@extends('layouts.app')

@section('title', 'Location — Bloom Digital Café')

@section('content')

    {{-- ===== HERO SECTION ===== --}}
    <section class="location-hero py-5 text-center bg-white">
        <div class="container">
            <p class="text-primary fw-semibold text-uppercase letter-spacing-2 mb-2">Kunjungi Kami</p>
            <h1 class="display-5 fw-bold text-dark mb-3">Temukan Bloom Café</h1>
            <p class="text-muted fs-5 mx-auto" style="max-width:520px;">
                Kami menantikan kunjungan Anda. Nikmati secangkir kopi dan suasana hangat bersama di ruang terbuka Bloom.
            </p>
        </div>
    </section>

    {{-- ===== MAP + INFO SECTION ===== --}}
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4 align-items-start">

                {{-- Google Maps Embed --}}
                <div class="col-lg-7">
                    <div class="rounded-4 overflow-hidden shadow-sm border">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.0!2d103.6145!3d-1.6101!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMcKwMzYnMzYuNCJTIDEwM8KwMzYnNTIuMiJF!5e0!3m2!1sen!2sid!4v1234567890"
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    {{-- Ganti src iframe di atas dengan embed link Google Maps lokasi nyata café kamu --}}
                </div>

                {{-- Info Card --}}
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">

                        <div class="mb-4">
                            <h5 class="fw-bold text-primary mb-1">Alamat</h5>
                            <p class="text-muted mb-0">Jl. Jend A. Thalib No.86, Simpang IV Sipin, Telanaipura</p>
                            <p class="text-muted">Kec. Telanaipura, Kota Jambi</p>
                        </div>

                        <div class="mb-4">
                            <h5 class="fw-bold text-primary mb-2">Jam Operasional</h5>
                            <table class="table table-sm table-borderless text-muted mb-0">
                                <tbody>
                                    <tr>
                                        <td class="ps-0 fw-semibold text-dark">Setiap Hari</td>
                                        <td>09:00 – 23:00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mb-4">
                            <h5 class="fw-bold text-primary mb-2">Kontak</h5>
                            <p class="text-muted mb-1">
                                <i class="bi bi-telephone-fill me-2 text-primary"></i>
                                +62 812-3456-7890
                            </p>
                            <p class="text-muted mb-0">
                                <i class="bi bi-envelope-fill me-2 text-primary"></i>
                                hello@bloomcafe.id
                            </p>
                        </div>

                        <div>
                            <h5 class="fw-bold text-primary mb-2">Instagram</h5>
                            <a href="https://instagram.com/bloomcoffeeplace" target="_blank"
                                class="d-inline-flex align-items-center gap-2 text-decoration-none text-primary fw-semibold instagram-link">
                                <i class="bi bi-instagram fs-5"></i>
                                @bloomcoffeeplace
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ===== GALLERY SECTION ===== --}}
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <p class="text-primary fw-semibold text-uppercase letter-spacing-2 mb-2">Momen</p>
                <h2 class="fw-bold text-dark">Galeri Kami</h2>
                <p class="text-muted">Sekilas suasana dan pengalaman di Bloom</p>
            </div>

            <div class="row g-3">
                @php
                    $galleries = [
                        ['file' => 'gallery1.jpg', 'alt' => 'Bloom Café Interior'],
                        ['file' => 'gallery2.jpg', 'alt' => 'Signature Coffee'],
                        ['file' => 'gallery3.jpg', 'alt' => 'Cozy Corner'],
                        ['file' => 'gallery4.jpg', 'alt' => 'Our Menu'],
                        ['file' => 'gallery5.jpg', 'alt' => 'Team Bloom'],
                        ['file' => 'gallery6.jpg', 'alt' => 'Bloom at Night'],
                    ];
                @endphp

                @foreach ($galleries as $img)
                    <div class="col-6 col-md-4">
                        <div class="gallery-item rounded-4 overflow-hidden">
                            <img src="{{ asset('images/gallery/' . $img['file']) }}" alt="{{ $img['alt'] }}"
                                class="img-fluid w-100" style="height: 220px; object-fit: cover;">
                            <div class="gallery-overlay">
                                <span><i class="bi bi-eye fs-4 text-white"></i></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        .letter-spacing-2 {
            letter-spacing: 2px;
            font-size: 0.8rem;
        }

        .gallery-item {
            position: relative;
            cursor: pointer;
        }

        .gallery-item img {
            transition: transform 0.4s ease;
            display: block;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: rgba(13, 110, 253, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .instagram-link {
            transition: opacity 0.2s ease;
        }

        .instagram-link:hover {
            opacity: 0.75;
        }
    </style>
@endpush
