<!DOCTYPE html>
<html>

<head>
    <title>Sistem Rekomendasi Potensi Usaha Di Jawa Timur</title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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

    @include('layouts.footer')

    <!-- LOGIN MODAL -->
    <div id="loginModal" class="modal {{ isset($active) && $active === 'login' ? 'show' : '' }}">
        <div class="modal-overlay"></div>

        <div class="modal-box">
            <button class="modal-close" id="closeModal">&times;</button>

            <div class="auth-logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
            </div>

            <h3 class="auth-title">Masuk ke Akun</h3>

            @if (session('success') && isset($active) && $active === 'login')
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (isset($active) && $active === 'login' && $errors->any())
                <div class="alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}"
                        required>
                </div>

                <div class="form-group">
                    <label>Kata Sandi</label>
                    <div class="password-wrapper">
                        <input type="password" class="password-input" name="password" placeholder="Masukkan Kata Sandi"
                            required>
                        <i class="fa-solid fa-eye-slash toggle-password"></i>
                    </div>
                </div>

                <div class="forgot">
                    <a href="#">Lupa kata sandi?</a>
                </div>

                <button type="submit" class="btn-primary">Masuk</button>

                <p class="text-center">Belum punya akun?</p>
                <a href="#" class="btn-secondary openRegister">Daftar</a>
            </form>
        </div>
    </div>

    <!-- REGISTER MODAL -->
    <div id="registerModal" class="modal {{ isset($active) && $active === 'register' ? 'show' : '' }}">
        <div class="modal-overlay register-overlay"></div>

        <div class="modal-box register-modal">
            <button class="modal-close" id="closeRegister">&times;</button>

            <div class="auth-logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
            </div>

            <h3 class="auth-title">Daftar Akun</h3>

            @if (isset($active) && $active === 'register' && $errors->any())
                <div class="alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" placeholder="Masukkan Nama Lengkap"
                        value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}"
                        required>
                </div>

                <div class="form-group">
                    <label>Kata Sandi</label>

                    <div class="password-wrapper">
                        <input type="password" class="password-input" name="password" placeholder="Masukkan Kata Sandi"
                            required>

                        <i class="fa-solid fa-eye-slash toggle-password"></i>
                    </div>

                    <small class="password-rule">
                        Minimal 8 karakter, kombinasi huruf dan angka.
                    </small>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Kata Sandi</label>

                    <div class="password-wrapper">
                        <input type="password" class="password-input" name="password_confirmation"
                            placeholder="Konfirmasi Kata Sandi" required>

                        <i class="fa-solid fa-eye-slash toggle-password"></i>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Daftar</button>

                <p class="text-center">Sudah punya akun?</p>
                <a href="#" class="btn-secondary openLogin">Masuk</a>
            </form>
        </div>
    </div>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const modal = document.getElementById("loginModal");
        const openBtns = document.querySelectorAll(".openModal");
        const closeBtn = document.getElementById("closeModal");
        const overlays = document.querySelectorAll(".modal-overlay");

        // OPEN MODAL
        openBtns.forEach(btn => {
            btn.addEventListener("click", function(e) {
                if (!modal) return;
                e.preventDefault();
                modal.classList.add("show");
            });
        });

        // CLOSE MODAL
        if (modal && closeBtn) {
            closeBtn.onclick = () => modal.classList.remove("show");
        }

        overlays.forEach(overlay => {
            overlay.addEventListener('click', function() {
                if (modal) modal.classList.remove('show');
                const registerModal = document.getElementById('registerModal');
                if (registerModal) registerModal.classList.remove('show');
            });
        });

        // TOGGLE PASSWORD (support multiple instances)
        document.querySelectorAll('.toggle-password').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const wrapper = this.closest('.password-wrapper');
                const input = wrapper ? wrapper.querySelector('.password-input') : document.querySelector(
                    'input[name="password"]');
                if (!input) return;

                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.replace('fa-eye-slash', 'fa-eye');
                } else {
                    input.type = 'password';
                    this.classList.replace('fa-eye', 'fa-eye-slash');
                }
            });
        });
    </script>
    <script>
        const registerModal = document.getElementById("registerModal");

        // buka register
        document.querySelectorAll(".openRegister").forEach(btn => {
            btn.addEventListener("click", function(e) {
                if (!registerModal || !modal) return;
                e.preventDefault();

                modal.classList.remove("show");
                registerModal.classList.add("show");
            });
        });

        // kembali ke login
        document.querySelectorAll(".openLogin").forEach(btn => {
            btn.addEventListener("click", function(e) {
                if (!registerModal || !modal) return;
                e.preventDefault();

                registerModal.classList.remove("show");
                modal.classList.add("show");
            });
        });

        const closeRegister = document.getElementById("closeRegister");
        if (registerModal && closeRegister) {
            closeRegister.onclick = () => registerModal.classList.remove("show");
        }
    </script>
    <script>
        const navLinks = document.querySelectorAll('.nav-menu a');

        navLinks.forEach(link => {
            link.addEventListener('click', function() {

                navLinks.forEach(item => {
                    item.classList.remove('active');
                });

                this.classList.add('active');
            });
        });
    </script>
    <script>
        const profileIcon = document.querySelector('.profile-icon');
        const profileDropdown = document.querySelector('.profile-dropdown');

        if (profileIcon) {

            profileIcon.addEventListener('click', function(e) {
                e.stopPropagation();

                profileDropdown.classList.toggle('show');
            });

            document.addEventListener('click', function() {
                profileDropdown.classList.remove('show');
            });

        }
    </script>
    <script>
        let lastScroll = 0;
        const navbar = document.querySelector('.navbar');

        window.addEventListener('scroll', () => {

            let currentScroll = window.pageYOffset;

            // scroll ke bawah
            if (currentScroll > lastScroll) {
                navbar.classList.add('hide');
            }

            // scroll ke atas
            else {
                navbar.classList.remove('hide');
            }

            lastScroll = currentScroll;
        });
    </script>

</body>

</html>
