@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/rekomendasi.css') }}">

<div class="dashboard-container">

    {{-- HEADER --}}
    <div class="dashboard-header">
        <h2>Hasil Analisis UMKM</h2>
        <p>Berikut hasil evaluasi dan rekomendasi berdasarkan sistem SAW + Forward Chaining</p>
    </div>

    {{-- DATA UMKM (DARI RELASI INPUT) --}}
    <div class="card-section">

        <div class="card">
            <h4>Nama Usaha</h4>
            <p>{{ $hasil->analisisUsaha->nama_usaha }}</p>
        </div>

        <div class="card">
            <h4>Jenis Usaha</h4>
            <p>{{ $hasil->analisisUsaha->jenis_usaha }}</p>
        </div>

        <div class="card">
            <h4>Daerah</h4>
            <p>{{ $hasil->analisisUsaha->kabupaten }}</p>
        </div>

    </div>

    {{-- INDICATOR SECTION --}}
    <h3 class="section-title">Indikator Analisis</h3>

    <div class="indicator-grid">

        <div class="indicator-card">
            <h4>ROA</h4>
            <h2>{{ number_format($hasil->roa, 2) }}</h2>
        </div>

        <div class="indicator-card">
            <h4>Margin Laba</h4>
            <h2>{{ number_format($hasil->margin_laba, 2) }}</h2>
        </div>

        <div class="indicator-card">
            <h4>Utilisasi Produksi</h4>
            <h2>{{ number_format($hasil->utilisasi_produksi, 2) }}</h2>
        </div>

    </div>

    {{-- RESULT --}}
    <div class="result-box">

        <h3>Hasil Keputusan Sistem</h3>

        <div class="result-item">
            <span>Kategori Potensi:</span>
            <h2 class="badge {{ strtolower(str_replace(' ', '-', $hasil->kategori_potensi)) }}">
                {{ $hasil->kategori_potensi }}
            </h2>
        </div>

        <div class="result-item">
            <span>Skor SAW:</span>
            <h2>{{ number_format($hasil->nilai_saw, 3) }}</h2>
        </div>

    </div>

    {{-- INTERPRETASI --}}
    <div class="analysis-box">

        <h3>Interpretasi Hasil</h3>

        <p>
            @if($hasil->kategori_potensi == 'Potensi Tinggi')
                UMKM memiliki performa sangat baik dan layak dikembangkan.
            @elseif($hasil->kategori_potensi == 'Potensi Sedang')
                UMKM cukup baik, tetapi masih perlu optimasi.
            @else
                UMKM perlu evaluasi menyeluruh.
            @endif
        </p>

    </div>

    {{-- REKOMENDASI --}}
    <div class="recommendation-box">

        <h3>Rekomendasi Sistem</h3>

        <ul>
            @if($hasil->kategori_potensi == 'Potensi Tinggi')
                <li>✔ Ekspansi usaha</li>
                <li>✔ Pertahankan efisiensi</li>
                <li>✔ Diversifikasi produk</li>

            @elseif($hasil->kategori_potensi == 'Potensi Sedang')
                <li>✔ Tingkatkan efisiensi aset</li>
                <li>✔ Optimalkan pemasaran</li>
                <li>✔ Perbaiki produksi</li>

            @else
                <li>⚠ Evaluasi model bisnis</li>
                <li>⚠ Kurangi biaya tidak efisien</li>
                <li>⚠ Cari strategi baru</li>
            @endif
        </ul>

    </div>

    {{-- BUTTON --}}
    <div class="action-button">
        <a href="{{ url('/rekomendasi-form') }}" class="btn-primary">
            Analisis UMKM Baru
        </a>
    </div>

</div>

@endsection