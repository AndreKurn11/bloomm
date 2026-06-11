@extends('layouts.app')

@section('title', 'Karier — Bloom Coffee & Place')

@section('content')

    {{-- HERO --}}
    <section class="career-hero">
        <div class="career-overlay"></div>

        <div class="container career-content text-center">
            <p class="career-tag">
                Bergabung Bersama Kami
            </p>

            <h1>
                Karier di Bloom Coffee & Place
            </h1>

            <p>
                Tumbuh bersama tim yang hangat, kreatif,
                dan penuh semangat dalam menciptakan
                pengalaman terbaik bagi setiap pelanggan.
            </p>

            <a href="#jobs" class="btn btn-primary rounded-pill px-4 py-2">
                Lihat Lowongan
            </a>
        </div>
    </section>

    {{-- WHY JOIN US --}}
    <section id="jobs" class="py-5" bg-ligth>
        <div class="container">

            <div class="text-center mb-5">
                <h2 class="fw-bold">Mengapa Bergabung dengan Bloom?</h2>
                <p class="text-muted">
                    Lebih dari sekadar tempat bekerja.
                </p>
            </div>

            <div class="row g-4">

                <div class="col-md-3">
                    <div class="card bloom-benefit-card border-0 h-100 text-center p-4">
                        <h5>Lingkungan Nyaman</h5>
                        <p class="text-muted mb-0">
                            Bekerja dalam suasana café yang hangat dan menyenangkan.
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card bloom-benefit-card border-0 h-100 text-center p-4">
                        <h5>Tim Suportif</h5>
                        <p class="text-muted mb-0">
                            Bertumbuh bersama rekan kerja yang saling mendukung.
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card bloom-benefit-card border-0 h-100 text-center p-4">
                        <h5>Kesempatan Berkembang</h5>
                        <p class="text-muted mb-0">
                            Belajar dan meningkatkan keterampilan setiap hari.
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card bloom-benefit-card border-0 h-100 text-center p-4">
                        <h5>Budaya Positif</h5>
                        <p class="text-muted mb-0">
                            Mengutamakan kerja sama, kreativitas, dan rasa hormat.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- JOB OPENINGS --}}
    <section class="py-5">
        <div class="container">

            <div class="text-center mb-5">
                <h2 class="fw-bold">Lowongan Tersedia</h2>
                <p class="text-muted">
                    Posisi yang sedang kami buka saat ini.
                </p>
            </div>

            @php
                $jobs = [
                    [
                        'title' => 'Barista',
                        'type' => 'Full Time',
                        'location' => 'Jambi',
                        'image' => 'barista.jpg',
                    ],
                    [
                        'title' => 'Kasir',
                        'type' => 'Full Time',
                        'location' => 'Jambi',
                        'image' => 'kasir.jpg',
                    ],
                    [
                        'title' => 'Kitchen Crew',
                        'type' => 'Part Time',
                        'location' => 'Jambi',
                        'image' => 'kitchen-crew.jpg',
                    ],
                ];
            @endphp

            <div class="row g-4">

                @foreach ($jobs as $job)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden">

                            <img src="{{ asset('images/career/' . $job['image']) }}" alt="{{ $job['title'] }}"
                                class="career-job-image">

                            <div class="p-4">

                                <h4 class="fw-bold mb-3">
                                    {{ $job['title'] }}
                                </h4>

                                <p class="text-muted mb-2">
                                    <strong>Tipe:</strong> {{ $job['type'] }}
                                </p>

                                <p class="text-muted mb-4">
                                    <strong>Lokasi:</strong> {{ $job['location'] }}
                                </p>

                                <a href="https://instagram.com/bloomcoffeeplace" target="_blank"
                                    class="btn btn-primary rounded-pill">
                                    Lamar Sekarang
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section>

    {{-- CONTACT --}}
    <section class="py-5 bg-light">
        <div class="container text-center">

            <h2 class="fw-bold mb-3">
                Hubungi Tim Rekrutmen
            </h2>

            <p class="text-muted mb-4">
                Tertarik bergabung dengan Bloom? Kirim CV dan portofolio terbaikmu melalui Instagram kami.
            </p>

            <a href="https://instagram.com/bloomcoffeeplace" target="_blank"
                class="btn btn-outline-primary rounded-pill px-4">
                @bloomcoffeeplace
            </a>

        </div>
    </section>

@endsection
