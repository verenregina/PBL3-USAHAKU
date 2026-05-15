@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/rekomendasi.css') }}">

<div class="rekomendasi-page">

    <!-- HERO -->
    <section class="hero-section">

        <div class="hero-left">

            <h1>Rekomendasi Usaha</h1>

            <p>
                Sistem ini memberikan rekomendasi usaha sekaligus
                menganalisis potensi keberhasilan berdasarkan modal,
                jenis usaha, dan data historis di wilayah Jawa Timur.
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

            <h2>Cek Potensi Usaha Anda</h2>

            <p class="subtitle">
                Masukkan data untuk mendapatkan rekomendasi berbasis analisis data
            </p>

            <form action="" method="POST">
                @csrf

                <div class="form-row">

                    <!-- MODAL -->
                    <div class="form-group">

                        <label>Modal yang Tersedia</label>

                        <select name="modal">

                            <option selected disabled>
                                Pilih rentang modal
                            </option>

                            <option>
                                Kecil (Rp500.000 - Rp3.700.000)
                            </option>

                            <option>
                                Sedang (Rp3.800.000 - Rp5.300.000)
                            </option>

                            <option>
                                Besar (Rp5.400.000 - Rp8.000.000)
                            </option>

                        </select>

                    </div>

                    <!-- JENIS USAHA -->
                    <div class="form-group">

                        <label>Jenis Usaha yang Diminati</label>

                        <select name="jenis_usaha">

                            <option selected disabled>
                                Pilih jenis usaha
                            </option>

                            <option>Jasa</option>
                            <option>Perdagangan</option>
                            <option>Perusahaan</option>
                            <option>Pendidikan</option>
                            <option>Fashion</option>
                            <option>Makanan & Minuman</option>

                        </select>

                    </div>

                </div>

                <button type="submit" class="btn-submit">
                    🚀 Mulai Analisis Usaha
                </button>

            </form>

        </div>

    </section>

</div>

@endsection