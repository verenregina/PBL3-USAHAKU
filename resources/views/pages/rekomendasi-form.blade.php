@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/rekomendasi.css') }}">

    <div class="rekomendasi-page">

        <!-- HERO -->
        <section class="hero-section">

            <div class="hero-left">

                <h1>Rekomendasi Usaha</h1>

                <p>
                    Sistem membantu pelaku UMKM menganalisis
                    potensi usaha berdasarkan kondisi
                    keuangan dan operasional usaha menggunakan
                    metode SAW dan sistem berbasis pengetahuan.
                </p>

                <a href="#form-rekomendasi" class="btn-orange">
                    Cek Potensi Usaha Anda
                </a>

            </div>

            <div class="hero-right">
                <img src="{{ asset('assets/images/tentang.png') }}" alt="">
            </div>

        </section>

        <!-- FORM -->
        <section class="form-section" id="form-rekomendasi">

            <div class="form-card">

                <h2>Input Data UMKM</h2>

                <p class="subtitle">
                    Lengkapi data usaha, keuangan, dan operasional untuk mendapatkan
                    hasil analisis potensi usaha.
                </p>

                <div class="info-box">
                    <i class="fas fa-circle-info"></i>
                    Silakan masukkan data usaha Anda. Data digunakan untuk menghitung
                    potensi usaha berdasarkan profitabilitas dan produktivitas.
                </div>

                <form action="{{ url('/rekomendasi/proses') }}" method="POST">
                    @csrf

                    <!-- DATA UMKM -->
                    <div class="form-section-box">

                        <div class="section-title">
                            Data UMKM
                        </div>

                        <div class="form-grid">

                            <input type="text" name="nama_usaha" placeholder="Nama Usaha" required>

                            <select name="jenis_usaha" required>
                                <option disabled selected>
                                    Pilih Jenis Usaha
                                </option>

                                @foreach ($jenisUsaha as $item)
                                    <option value="{{ $item->nama_jenis_usaha }}">
                                        {{ $item->nama_jenis_usaha }}
                                    </option>
                                @endforeach
                            </select>

                            <select name="kabupaten" id="kabupaten" required>
                                <option value="">
                                    Memuat Kabupaten...
                                </option>
                            </select>

                            <input type="number" name="lama_usaha" placeholder="Lama Usaha (Tahun)" min="0"
                                required>

                        </div>

                    </div>

                    <!-- DATA KEUANGAN -->
                    <div class="form-section-box">

                        <div class="section-title">
                            Data Keuangan
                        </div>

                        <div class="form-grid">

                            <input type="number" name="aset" placeholder="Total Aset (Rp)" required>

                            <input type="number" name="omset" placeholder="Omset / Pendapatan per Bulan (Rp)" required>

                            <input type="number" name="laba" placeholder="Laba Bersih per Bulan (Rp)" required>

                        </div>

                    </div>

                    <!-- DATA OPERASIONAL -->
                    <div class="form-section-box">

                        <div class="section-title">
                            Data Operasional
                        </div>

                        <div class="form-grid">

                            <input type="number" name="jumlah_karyawan" placeholder="Jumlah Karyawan (Orang)" required>

                            <input type="number" name="kapasitas_produksi" placeholder="Kapasitas Produksi per Bulan"
                                required>

                            <input type="number" name="produksi_aktual" placeholder="Produksi Aktual per Bulan" required>

                        </div>

                    </div>

                    <button type="submit" class="btn-submit">
                            <i class="fas fa-chart-line"></i>
                        Analisis UMKM
                    </button>

                </form>

            </div>

        </section>

    </div>
    <!-- AJAX untuk interaksi dinamis -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{-- AJAX Kabupaten/Kota --}}
    <script>
        $(document).ready(function() {

            $.get('/wilayah/kabupaten', function(data) {

                $('#kabupaten').html(
                    '<option value="">Pilih Kabupaten/Kota</option>'
                );

                data.forEach(function(item) {

                    $('#kabupaten').append(
                        `<option
            value="${item.name}"
            data-id="${item.id}">
            ${item.name}
        </option>`
                    );

                });

            });

        });
    </script>
@endsection
