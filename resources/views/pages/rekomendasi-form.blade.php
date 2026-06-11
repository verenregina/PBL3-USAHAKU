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

                <!-- ================= DATA UMKM ================= -->
                <div class="form-section-box">

                    <div class="section-title">
                        <i class="fa-solid fa-store"></i>
                        Data UMKM
                    </div>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Nama Usaha</label>
                            <input type="text" name="nama_usaha" placeholder="Tulis nama usaha" required>
                            <small class="input-hint">Contoh: Reycelty</small>
                        </div>

                        <div class="form-group">
                            <label>Jenis Usaha</label>
                            <select name="jenis_usaha" required>
                                <option value="" selected disabled>Pilih jenis usaha</option>
                                @foreach ($jenisUsaha as $item)
                                    <option value="{{ $item->nama_jenis_usaha }}">
                                        {{ $item->nama_jenis_usaha }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="input-hint">Pilih jenis usaha yang paling sesuai</small>
                        </div>

                        <div class="form-group">
                            <label>Kabupaten / Kota</label>
                            <select name="kabupaten" id="kabupaten" required>
                                <option value="" selected disabled>Pilih Kabupaten/Kota</option>
                            </select>
                            <small class="input-hint">Lokasi utama usaha berada</small>
                        </div>

                        <div class="form-group">
                            <label>Lama Usaha (Tahun)</label>
                            <input type="number" name="lama_usaha" min="0" placeholder="Masukkan lama usaha" required>
                            <small class="input-hint">Contoh: 3</small>
                        </div>

                    </div>
                </div>

                <!-- ================= DATA KEUANGAN ================= -->
                <div class="form-section-box">

                <div class="section-title">
                    <i class="fa-solid fa-money-bill-trend-up"></i>
                    Data Keuangan
                </div>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Total Aset (Rp)</label>
                            <input type="number" name="aset" placeholder="Masukkan total aset" required>
                            <small class="input-hint">Contoh: 50000000</small>
                        </div>

                        <div class="form-group">
                            <label>Omset / Pendapatan per Bulan (Rp)</label>
                            <input type="number" name="omset" placeholder="Masukkan omset bulanan" required>
                            <small class="input-hint">Contoh: 10000000</small>
                        </div>

                        <div class="form-group">
                            <label>Laba Bersih per Bulan (Rp)</label>
                            <input type="number" name="laba" placeholder="Masukkan laba bersih" required>
                            <small class="input-hint">Contoh: 2500000</small>
                        </div>

                    </div>
                </div>

                <!-- ================= DATA OPERASIONAL ================= -->
                <div class="form-section-box">

                <div class="section-title">
                    <i class="fa-solid fa-industry"></i>
                    Data Operasional
                </div>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Jumlah Karyawan (Orang)</label>
                            <input type="number" name="jumlah_karyawan" placeholder="Masukkan jumlah karyawan" required>
                            <small class="input-hint">Contoh: 5</small>
                        </div>

                        <div class="form-group">
                            <label>Kapasitas Produksi per Bulan</label>
                            <input type="number" name="kapasitas_produksi" placeholder="Masukkan kapasitas produksi" required>
                            <small class="input-hint">Contoh: 1000</small>
                        </div>

                        <div class="form-group">
                            <label>Produksi Aktual per Bulan</label>
                            <input type="number" name="produksi_aktual" placeholder="Masukkan produksi aktual" required>
                            <small class="input-hint">Contoh: 850</small>
                        </div>

                    </div>
                </div>

                <!-- BUTTON -->
                <button type="submit" class="btn-submit">
                    <i class="fas fa-chart-line"></i>
                    Analisis UMKM
                </button>

            </form>

        </div>

    </section>

</div>

<!-- ================= AJAX KABUPATEN ================= -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(document).ready(function () {

    $.get('/wilayah/kabupaten', function (data) {

        $('#kabupaten').html('<option value="" disabled selected>Pilih Kabupaten/Kota</option>');

        data.forEach(function (item) {
            $('#kabupaten').append(`
                <option value="${item.name}" data-id="${item.id}">
                    ${item.name}
                </option>
            `);
        });

    });

});
</script>

@endsection