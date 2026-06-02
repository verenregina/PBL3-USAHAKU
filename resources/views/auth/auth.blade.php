{{-- @extends('layouts.app')

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <p class="text-center">Jika modal tidak muncul, silakan kembali ke halaman sebelumnya.</p>
        </div>
    </div>
@endsection --}}

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

            @if(session('success') && isset($active) && $active === 'login')
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(isset($active) && $active === 'login' && $errors->any())
                <div class="alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label>Kata Sandi</label>
                    <div class="password-wrapper">
                        <input type="password" class="password-input" name="password" placeholder="Masukkan Kata Sandi" required>
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

            @if(isset($active) && $active === 'register' && $errors->any())
                <div class="alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label>Kata Sandi</label>
                    <input type="password" name="password" placeholder="Masukkan Kata Sandi" required>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required>
                </div>

                <button type="submit" class="btn-primary">Daftar</button>

                <p class="text-center">Sudah punya akun?</p>
                <a href="#" class="btn-secondary openLogin">Masuk</a>
            </form>
        </div>
    </div>
