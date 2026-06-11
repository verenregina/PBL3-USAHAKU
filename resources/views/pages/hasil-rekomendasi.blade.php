@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/rekomendasi.css') }}">

    <div class="dashboard-container">

        {{-- HEADER --}}
        <div class="dashboard-header">
            <h2>Hasil Rekomendasi</h2>
            <p>Hasil analisis dari form input menggunakan metode SAW + Forward Chaining</p>
        </div>

        {{-- DATA INPUT --}}
        <div class="card-section">

            <div class="info-card">
                <i class="fas fa-store"></i>
                <div>
                    <span>Nama Usaha</span>
                    <h4>{{ $hasil->analisisUsaha->nama_usaha ?? '-' }}</h4>
                </div>
            </div>

            <div class="info-card">
                <i class="fas fa-industry"></i>
                <div>
                    <span>Jenis Usaha</span>
                    <h4>{{ $hasil->analisisUsaha->jenis_usaha ?? '-' }}</h4>
                </div>
            </div>

            <div class="info-card">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <span>Lokasi</span>
                    <h4>{{ $hasil->analisisUsaha->kabupaten ?? '-' }}</h4>
                </div>
            </div>

        </div>

        {{-- HASIL UTAMA --}}
        <div class="result-box">

            <h3>Hasil Analisis</h3>

            <div class="hero-result">

                {{-- KATEGORI --}}
                <div>

                    <span>Kategori Potensi</span>

                    <h1
                        class="
                    @if ($hasil->kategori_potensi == 'Potensi Tinggi') potensi-tinggi
                    @elseif($hasil->kategori_potensi == 'Potensi Sedang') potensi-sedang
                    @else potensi-rendah @endif
                ">
                        {{ $hasil->kategori_potensi }}
                    </h1>

                    <p>Hasil kombinasi metode SAW dan Forward Chaining</p>

                </div>

                {{-- SKOR --}}
                <div class="score-box">
                    <small>Skor SAW</small>
                    <h2>{{ number_format($hasil->nilai_saw, 2) }}</h2>
                </div>

            </div>

        </div>

        {{-- INDIKATOR --}}
        <h3 class="section-title">Indikator Penilaian</h3>

        <div class="indicator-grid">

            <div class="indicator-card">
                <h4>ROA</h4>
                <h2>{{ number_format($hasil->roa, 2) }}%</h2>
            </div>

            <div class="indicator-card">
                <h4>Margin</h4>
                <h2>{{ number_format($hasil->margin_laba, 2) }}%</h2>
            </div>

            <div class="indicator-card">
                <h4>Utilisasi</h4>
                <h2>{{ number_format($hasil->utilisasi_produksi, 2) }}%</h2>
            </div>

            <div class="indicator-card">
                <h4>Produktivitas</h4>
                <h2>Rp {{ number_format($hasil->produktivitas, 0, ',', '.') }}</h2>
            </div>

        </div>

        {{-- INTERPRETASI SINGKAT --}}
        <div class="analysis-box">

            <h3>Interpretasi Hasil</h3>

            <p>
                Berdasarkan hasil perhitungan metode <strong>SAW (Simple Additive Weighting)</strong>,
                UMKM ini memperoleh nilai akhir sebesar
                <strong>{{ number_format($hasil->nilai_saw, 2) }}</strong>.
            </p>

            <p>
                Nilai tersebut menunjukkan bahwa kinerja usaha berdasarkan indikator
                ROA, Margin Laba, Utilisasi Produksi, dan Produktivitas Karyawan
                berada pada kategori
                <strong>{{ $hasil->kategori_potensi }}</strong>.
            </p>

            <p>
                Artinya, kondisi usaha saat ini
                @if ($hasil->kategori_potensi == 'Potensi Tinggi')
                    sudah berada pada tingkat yang baik dan berpotensi untuk dikembangkan lebih lanjut.
                @elseif($hasil->kategori_potensi == 'Potensi Sedang')
                    masih memiliki potensi berkembang, namun memerlukan beberapa peningkatan pada aspek tertentu.
                @else
                    masih perlu dilakukan perbaikan pada beberapa indikator utama agar kinerja usaha meningkat.
                @endif
            </p>

        </div>

        {{-- REKOMENDASI --}}
        <div class="recommendation-box">

            <h3>Rekomendasi Perbaikan</h3>

            @php
                $rekomendasi = json_decode($hasil->rekomendasi, true) ?? [];
            @endphp

            @if (!empty($rekomendasi))
                <ul>
                    @foreach ($rekomendasi as $item)
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Tidak ada rekomendasi.</p>
            @endif

        </div>

        {{-- DETAIL --}}
        <div class="analysis-detail">

            <h3>Detail Penilaian</h3>

            <table>
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <th>Nilai</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>ROA</td>
                        <td>{{ number_format($hasil->roa, 2) }}%</td>
                        <td>
                            <span
                                class="
                        @if ($hasil->roa_label == 'Tinggi') status-tinggi
                        @elseif($hasil->roa_label == 'Sedang') status-sedang
                        @else status-rendah @endif
                    ">
                                {{ $hasil->roa_label }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>Margin Laba</td>
                        <td>{{ number_format($hasil->margin_laba, 2) }}%</td>
                        <td>
                            <span
                                class="
                        @if ($hasil->margin_label == 'Tinggi') status-tinggi
                        @elseif($hasil->margin_label == 'Sedang') status-sedang
                        @else status-rendah @endif
                    ">
                                {{ $hasil->margin_label }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>Utilisasi Produksi</td>
                        <td>{{ number_format($hasil->utilisasi_produksi, 2) }}%</td>
                        <td>
                            <span
                                class="
                        @if ($hasil->utilisasi_label == 'Optimal' || $hasil->utilisasi_label == 'Tinggi') status-tinggi
                        @elseif($hasil->utilisasi_label == 'Cukup' || $hasil->utilisasi_label == 'Sedang') status-sedang
                        @else status-rendah @endif
                    ">
                                {{ $hasil->utilisasi_label }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>Produktivitas</td>
                        <td>Rp {{ number_format($hasil->produktivitas, 0, ',', '.') }}</td>
                        <td>
                            <span
                                class="
                        @if ($hasil->produktivitas_label == 'Tinggi') status-tinggi
                        @elseif($hasil->produktivitas_label == 'Sedang') status-sedang
                        @else status-rendah @endif
                    ">
                                {{ $hasil->produktivitas_label }}
                            </span>
                        </td>
                    </tr>

                </tbody>
            </table>

        </div>

        {{-- BUTTON --}}
        <div class="action-button">
            <a href="{{ url('/rekomendasi-form') }}" class="btn-primary">
                Analisis UMKM Baru
            </a>
        </div>

    </div>
@endsection
