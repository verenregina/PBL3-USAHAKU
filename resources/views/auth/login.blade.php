@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="auth-card">

        <!-- LOGO -->
        <div class="auth-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
        </div>

        <hr>

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- EMAIL -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan Email" required>
            </div>

            <!-- PASSWORD -->
            <div class="form-group">
                <label>Kata Sandi</label>
                <div class="password-wrapper">
                    <input type="password" name="password" placeholder="Masukkan Kata Sandi" required>
                    <i class="fa-solid fa-eye-slash"></i>
                </div>
            </div>

            <!-- LUPA PASSWORD -->
            <div class="forgot">
                <a href="#">Lupa kata sandi?</a>
            </div>

            <!-- BUTTON LOGIN -->
            <button type="submit" class="btn-primary">Masuk</button>

            <!-- REGISTER -->
            <p class="text-center">Belum punya akun?</p>

            <a href="{{ route('register') }}" class="btn-secondary">Daftar</a>

        </form>
    </div>
</div>
@endsection