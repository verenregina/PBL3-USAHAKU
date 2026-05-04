<nav class="navbar">
    <div class="container nav-wrapper">

        <!-- LOGO -->
        <div class="logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
            {{-- <span>USAHAKU</span> --}}
        </div>

        <!-- MENU -->
        <ul class="nav-menu">
            <li><a href="{{ url('/') }}" class="active">Beranda</a></li>
            <li><a href="#cara-kerja">Cara Kerja</a></li>
            <li><a href="#rekomendasi">Rekomendasi</a></li>
            <li><a href="#tentang">Tentang</a></li>
        </ul>

        <!-- BUTTON -->
        <div>
            <a href="#" class="btn-login" id="openModal">
                <i class="fa-solid fa-user"></i>Masuk/Daftar</a>
        </div>

    </div>
</nav>