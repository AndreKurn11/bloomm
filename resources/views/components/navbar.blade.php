<nav class="bloom-navbar">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('images/logo/bloom-icon.png') }}" alt="Bloom" class="brand-logo">
            </a>

            <div class="d-none d-md-flex align-items-center gap-1">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('menu.index') }}" class="nav-link {{ request()->routeIs('menu.*') ? 'active' : '' }}">
                    Menu
                </a>
                <a href="{{ route('location') }}" class="nav-link {{ request()->routeIs('location') ? 'active' : '' }}">
                    Lokasi
                </a>

                <a href="{{ route('home') }}#about" class="nav-link">
                    Tentang Kami
                </a>

                <a href="{{ route('career') }}" class="nav-link {{ request()->routeIs('career') ? 'active' : '' }}">
                    Karier
                </a>
            </div>

            <div class="d-flex align-items-center">
                <button class="cart-btn" onclick="openCart()" title="Cart">
                    <i class="fa fa-shopping-cart" style="font-size:1.2rem;color:var(--text-body)"></i>
                    <span class="cart-badge" id="cart-count">0</span>
                </button>
            </div>
        </div>
    </div>
</nav>
