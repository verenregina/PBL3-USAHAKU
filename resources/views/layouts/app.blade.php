<!DOCTYPE html>
<html>

<head>
    <title>Sistem Rekomendasi Potensi Usaha Berdasarkan Modal dan Jenis Usaha Di Jawa Timur</title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS GLOBAL -->
    <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">

    <!-- COMPONENT -->
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

    <!-- NAVBAR & FOOTER -->
    <link rel="stylesheet" href="{{ asset('assets/css/navbar_footer.css') }}">

    <!-- AUTH & MODAL -->
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/modal.css') }}">

    <!-- TAMBAHAN PER HALAMAN -->
    @stack('styles')

</head>

<body>

    @include('layouts.navbar')

    @yield('content')
    <!-- LOGIN MODAL -->
    <div id="loginModal" class="modal">
        <div class="modal-overlay"></div>

        <div class="modal-box">
            <!-- CLOSE -->
            <button class="modal-close" id="closeModal">&times;</button>

            <!-- LOGO -->
            <div class="auth-logo">
                <img src="{{ asset('assets/images/logo.png') }}">
            </div>

            <h3 class="auth-title">Masuk ke Akun</h3>

            <!-- ERROR -->
            @if ($errors->any())
                <div class="alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- FORM -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- EMAIL -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}"
                        class="@error('email') input-error @enderror">
                </div>

                <!-- PASSWORD -->
                <div class="form-group">
                    <label>Kata Sandi</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" placeholder="Masukkan Kata Sandi"
                            class="@error('password') input-error @enderror">

                        <i class="fa-solid fa-eye-slash" id="togglePassword"></i>
                    </div>
                </div>

                <!-- FORGOT -->
                <div class="forgot">
                    <a href="#">Lupa kata sandi?</a>
                </div>

                <!-- BUTTON -->
                <button type="submit" class="btn-primary">Masuk</button>

                <p class="text-center">Belum punya akun?</p>

                <a href="{{ route('register') }}" class="btn-secondary">Daftar</a>
            </form>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        const modal = document.getElementById("loginModal");
        const openBtn = document.getElementById("openModal");
        const closeBtn = document.getElementById("closeModal");
        const overlay = document.querySelector(".modal-overlay");

        // OPEN (FIX UTAMA)
        openBtn.onclick = (e) => {
            e.preventDefault();
            modal.classList.add("show");
        };

        // CLOSE
        closeBtn.onclick = () => modal.classList.remove("show");
        overlay.onclick = () => modal.classList.remove("show");

        // TOGGLE PASSWORD
        const toggle = document.getElementById("togglePassword");
        const password = document.getElementById("password");

        toggle.onclick = () => {
            if (password.type === "password") {
                password.type = "text";
                toggle.classList.replace("fa-eye-slash", "fa-eye");
            } else {
                password.type = "password";
                toggle.classList.replace("fa-eye", "fa-eye-slash");
            }
        };
    </script>

</body>

</html>
