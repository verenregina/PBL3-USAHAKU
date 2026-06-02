<nav class="navbar">
    <div class="container nav-wrapper">

        <!-- LOGO -->
        <div class="logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
            {{-- <span>USAHAKU</span> --}}
        </div>

        <!-- MENU -->
        <ul class="nav-menu">
            <li>
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    Beranda
                </a>
            </li>

            <li>
                <a href="{{ route('home') }}#manfaat">
                    Manfaat
                </a>
            </li>

            <li>
                <a href="{{ route('home') }}#cara-kerja">
                    Cara Kerja
                </a>
            </li>

            <li>
                @auth

                    <a href="{{ route('rekomendasi-form') }}"
                        class="{{ request()->routeIs('rekomendasi-form') ? 'active' : '' }}">
                        Rekomendasi
                    </a>
                @else
                    <a href="{{ route('home') }}#rekomendasi">
                        Rekomendasi
                    </a>

                @endauth
            </li>

            <li>
                <a href="{{ route('home') }}#tentang">
                    Tentang
                </a>
            </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

        <!-- BUTTON -->
        <div>
            @auth

                <div class="profile-menu">

                    <span class="user-name">
                        Hi, {{ Auth::user()->name }}
                    </span>

                    <button type="button" class="profile-icon">
                        <i class="fa-solid fa-circle-user"></i>
                    </button>

                    <div class="profile-dropdown">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Logout
                            </button>
                        </form>
                    </div>

                </div>
            @else
                <a href="#" class="btn-login openModal">
                    <i class="fa-solid fa-user"></i>
                    Masuk/Daftar
                </a>

            @endauth
        </div>

    </div>
</nav>
