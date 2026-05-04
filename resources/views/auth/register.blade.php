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
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- NAMA LENGKAP -->
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" placeholder="Masukkan Nama Lengkap" required>
            </div>

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

            <!-- ERROR VALIDATION -->
            @if ($errors->any())
                <div class="error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- BUTTON REGISTER -->
            <button type="submit" class="btn-primary">Daftar</button>

            <!-- LOGIN -->
            <p class="text-center">Sudah punya akun?</p>

            <a href="{{ route('login') }}" class="btn-secondary">Masuk</a>

        </form>
    </div>
</div>
@endsection