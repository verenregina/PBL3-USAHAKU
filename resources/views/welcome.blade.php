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
                    Selamat Datang Di USAHAKU!
                </h1>
                <h2>
                    Temukan Potensi Usaha Anda dengan Analisis yang Cerdas
                </h2>
                <p>
                    Analisis kondisi usaha Anda dan temukan rekomendasi yang tepat 
                    untuk meningkatkan produktivitas, daya saing, dan peluang pertumbuhan usaha.
                </p>

                <a href="#rekomendasi" class="btn-primary">
                    Mulai Analisis Sekarang
                </a>
            </div>

            <div class="hero-image">
                <img src="{{ asset('assets/images/hero.png') }}" alt="hero">
            </div>
        </div>
    </section>

    <!-- Content section -->
    <section id="manfaat" class="features">@include('landing.manfaat')</section>    
    <section id="cara-kerja" class="section">@include('landing.cara-kerja')</section>
    <section id="rekomendasi" class="section">@include('landing.rekomendasi')</section>
    <section id="tentang" class="tentang">@include('landing.tentang')</section>

@endsection
