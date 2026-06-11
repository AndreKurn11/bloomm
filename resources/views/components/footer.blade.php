<footer class="bloom-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="footer-brand mb-2">Bloom Coffee & Place</div>

                <p class="footer-copy">
                    Ruang terbuka untuk menikmati kopi, berbagi cerita,
                    dan menciptakan momen terbaik bersama.
                </p>

                <p class="footer-copy">
                    © 2024 Bloom Coffee & Place. Sip — relax and BLOOM
                </p>
            </div>
            <div class="col-md-2 mb-4">
                <h6
                    style="font-size:0.8rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--text-muted);margin-bottom:14px">
                    Tautan Cepat</h6>
                <a href="{{ route('home') }}#about" class="footer-link">
                    Tentang Kami
                </a>

                <a href="{{ route('location') }}" class="footer-link">
                    Lokasi Kami
                </a>

                <a href="{{ route('menu.index') }}" class="footer-link">
                    Menu
                </a>
            </div>
            <div class="col-md-2 mb-4">
                <h6
                    style="font-size:0.8rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--text-muted);margin-bottom:14px">
                    Legal</h6>
                <h6>Info</h6>

                <a href="{{ route('location') }}" class="footer-link">
                    Jam Operasional
                </a>

                <a href="{{ route('location') }}" class="footer-link">
                    Kontak
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <h6
                    style="font-size:0.8rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--text-muted);margin-bottom:14px">
                    Ikuti Kami</h6>
                <div class="d-flex gap-3">
                    <a href="https://instagram.com/bloomcoffeeplace">
                        <i class="fa fa-instagram"></i>
                    </a>

                    <a href="mailto:hello@bloomcafe.id">
                        <i class="fa fa-envelope"></i>
                    </a>

                    <a href="{{ route('location') }}">
                        <i class="fa fa-map-marker"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
