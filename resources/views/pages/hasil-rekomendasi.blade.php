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

            <div class="info-card">
                <i class="fas fa-store"></i>
                <div>
                    <span>Nama Usaha</span>
                    <h4>{{ $hasil->analisisUsaha->nama_usaha }}</h4>
                </div>
            </div>

            <div class="info-card">
                <i class="fas fa-industry"></i>
                <div>
                    <span>Jenis Usaha</span>
                    <h4>{{ $hasil->analisisUsaha->jenis_usaha }}</h4>
                </div>
            </div>

            <div class="info-card">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <span>Daerah</span>
                    <h4>{{ $hasil->analisisUsaha->kabupaten }}</h4>
                </div>
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

            <div class="hero-result">
                <div>
                    <span>Kategori Potensi</span>
                    <h1>{{ $hasil->kategori_potensi }}</h1>
                    <p>Hasil analisis menggunakan metode SAW dan Forward Chaining</p>
                </div>

                <div class="score-box">
                    <small>Skor SAW</small>
                    <h2>{{ number_format($hasil->nilai_saw, 3) }}</h2>
                </div>
            </div>

        </div>

        {{-- INTERPRETASI --}}
        <div class="analysis-box">

            <h3>Interpretasi Hasil</h3>

            <p>
                @if ($hasil->kategori_potensi == 'Potensi Tinggi')
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
                @if ($hasil->kategori_potensi == 'Potensi Tinggi')
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Ekspansi usaha</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Pertahankan efisiensi</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Diversifikasi produk</span>
                    </li>
                @elseif($hasil->kategori_potensi == 'Potensi Sedang')
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Tingkatkan efisiensi aset</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Optimalkan pemasaran</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Perbaiki produksi</span>
                    </li>
                @else
                    <li>
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Evaluasi model bisnis</span>
                    </li>
                    <li>
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Kurangi biaya tidak efisien</span>
                    </li>
                    <li>
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Cari strategi baru</span>
                    </li>
                @endif
            </ul>

        </div>

        <div class="summary-card">
            <h3>Kesimpulan Sistem</h3>

            <p>
                Berdasarkan perhitungan metode SAW dan proses Forward Chaining,
                UMKM ini termasuk kategori
                <strong>{{ $hasil->kategori_potensi }}</strong>
                dengan nilai akhir
                <strong>{{ number_format($hasil->nilai_saw, 3) }}</strong>.
            </p>
        </div>

        {{-- BUTTON --}}
        <div class="action-button">
            <a href="{{ url('/rekomendasi-form') }}" class="btn-primary">
                Analisis UMKM Baru
            </a>
        </div>

    </div>
@endsection
