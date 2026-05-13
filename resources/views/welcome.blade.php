@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
@endpush

@section('content')
    <!-- HERO SECTION -->
    <section class="hero">
        <div class="container hero-wrapper">
            <div class="hero-text">
                <h1>
                    Sistem Rekomendasi Usaha Berbasis Data untuk Analisis Potensi Usaha
                </h1>
                <p>
                    Temukan apakah modal dan jenis usaha yang Anda minati memiliki potensi berdasarkan data
                    historis dari dataset usaha di <span>Jawa Timur</span>.
                </p>

                <a href="{{ auth()->check() ? route('rekomendasi.form') : route('login') }}" class="btn-primary">
                    Mulai Analisis Sekarang
                </a>
            </div>

            <div class="hero-image">
                <img src="{{ asset('assets/images/hero.png') }}" alt="hero">
            </div>
        </div>
    </section>

    <!-- TENTANG -->
    <section id="tentang" class="section">
        <div class="container">
            <h2>Tentang Sistem</h2>
            <p>
                Sistem rekomendasi ini dibuat untuk membantu masyarakat menentukan
                usaha yang sesuai berdasarkan data riil UMKM di Jawa Timur.
            </p>
        </div>
    </section>

    <!-- MANFAAT -->
    <section class="features">
        <div class="container">
            <h2>Kenapa Sistem Ini Berbeda?</h2>

            <div class="feature-list">
                <div class="feature-card">
                    <i class="fa-solid fa-bullseye"></i>
                    <h3>Berbasis Data Historis</h3>
                    <p>Menggunakan dataset usaha untuk analisis yang akurat.</p>
                </div>

                <div class="feature-card">
                    <i class="fa-solid fa-chart-column"></i>
                    <h3>Analisis Potensi</h3>
                    <p>Menilai kelayakan dan potensi usaha.</p>
                </div>

                <div class="feature-card">
                    <i class="fa-solid fa-location-dot"></i>
                    <h3>Spesifik Jawa Timur</h3>
                    <p>Disesuaikan dengan kondisi wilayah.</p>
                </div>

                <div class="feature-card">
                    <i class="fa-solid fa-bolt"></i>
                    <h3>Objektif & Terukur</h3>
                    <p>Berdasarkan data nyata, bukan asumsi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CARA KERJA -->
    <section id="cara-kerja" class="section">
        <div class="container">
            <h2>Bagaimana Cara Kerja Sistem?</h2>
            <div class="steps">

                <div class="step">
                    <span class="step-number">1</span>

                    <div class="step-icon">
                        <i class="fa-solid fa-right-to-bracket"></i>
                    </div>

                    <div class="step-text">
                        <h3>Login</h3>
                        <p>Buat akun menggunakan email dan password.</p>
                    </div>
                </div>

                <div class="step">
                    <span class="step-number">2</span>

                    <div class="step-icon">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>

                    <div class="step-text">
                        <h3>Input Data Usaha</h3>
                        <p>Masukkan modal dan jenis usaha yang ingin dianalisis.</p>
                    </div>
                </div>

                <div class="step">
                    <span class="step-number">3</span>

                    <div class="step-icon">
                        <i class="fa-solid fa-database"></i>
                    </div>

                    <div class="step-text">
                        <h3>Analisis Data</h3>
                        <p>Sistem akan mencocokkan dengan data historis.</p>
                    </div>
                </div>

                <div class="step">
                    <span class="step-number">4</span>

                    <div class="step-icon">
                        <i class="fa-solid fa-chart-column"></i>
                    </div>

                    <div class="step-text">
                        <h3>Hasil Rekomendasi</h3>
                        <p>Dapatkan analisis potensi usaha beserta insight.</p>
                    </div>
                </div>

            </div>
    </section>
    <!-- REKOMENDASI -->
    <section id="rekomendasi" class="section">
        <div class="container">
            <h2>Mulai Rekomendasi</h2>

            <div class="form-box">
                <p style="margin-bottom: 20px; text-align: center; color: #666;">
                    @if(auth()->check())
                        Silakan isi form di bawah untuk mendapatkan rekomendasi usaha
                    @else
                        Anda harus login terlebih dahulu untuk menggunakan fitur rekomendasi
                    @endif
                </p>

                @if(auth()->check())
                    <a href="{{ route('rekomendasi.form') }}" class="btn-primary" style="display: inline-block; width: 100%; text-align: center; padding: 12px; text-decoration: none; border-radius: 8px;">
                        Buka Form Rekomendasi
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary" style="display: inline-block; width: 100%; text-align: center; padding: 12px; text-decoration: none; border-radius: 8px;">
                        Login Terlebih Dahulu
                    </a>
                @endif
            </div>
        </div>
    </section>
@endsection
