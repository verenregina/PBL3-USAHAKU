@extends('layouts.admin')

@section('title', 'Detail Data Usaha')

@section('topbar-label', 'Detail Data Usaha')
@section('topbar-heading', 'Selamat datang, ' . auth()->user()->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/detailkeloladata.css') }}">
@endpush

@section('content')
    <div class="page-header">
        <div class="page-header-left">
            <h2>Detail Data Usaha</h2>
        </div>
    </div>

    <div class="table-card">

        {{-- ── Hero ─────────────────────────────────────────── --}}
        <div class="dkd-hero">
            <div class="dkd-monogram">
                {{ strtoupper(mb_substr($umkm->nama_usaha, 0, 1)) }}{{ strtoupper(mb_substr($umkm->nama_usaha, mb_strpos($umkm->nama_usaha . ' ', ' ') + 1, 1)) }}
            </div>

            <div class="dkd-hero-info">
                <h3 class="dkd-nama-usaha">{{ $umkm->nama_usaha }}</h3>
                <div class="dkd-meta">
                    <span class="dkd-meta-id">{{ $umkm->id_umkm }}</span>
                    <span class="dkd-meta-dot"></span>
                    <span class="dkd-badge dkd-badge-jenis">{{ $umkm->jenisUsaha?->nama_jenis_usaha ?? 'Lainnya' }}</span>
                    @if($umkm->daerah?->nama_daerah)
                        <span class="dkd-badge dkd-badge-daerah">{{ $umkm->daerah->nama_daerah }}</span>
                    @endif
                </div>
            </div>

            {{-- Satu tombol kembali --}}
            <a href="{{ route('admin.kelola-data') }}" class="dkd-btn-back">
                <svg viewBox="0 0 24 24" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali
            </a>
        </div>

        {{-- ── Stats ────────────────────────────────────────── --}}
        <div class="dkd-stats">
            <div class="dkd-stat-card">
                <div class="dkd-stat-label">Aset</div>
                <div class="dkd-stat-value">Rp {{ number_format($umkm->aset, 0, ',', '.') }}</div>
            </div>
            <div class="dkd-stat-card">
                <div class="dkd-stat-label">Omset</div>
                <div class="dkd-stat-value">Rp {{ number_format($umkm->omset, 0, ',', '.') }}</div>
            </div>
            <div class="dkd-stat-card">
                <div class="dkd-stat-label">Laba</div>
                <div class="dkd-stat-value">Rp {{ number_format($umkm->laba, 0, ',', '.') }}</div>
            </div>
            <div class="dkd-stat-card">
                <div class="dkd-stat-label">Biaya Karyawan</div>
                <div class="dkd-stat-value">Rp {{ number_format($umkm->biaya_karyawan, 0, ',', '.') }}</div>
            </div>
        </div>

        {{-- ── Detail ───────────────────────────────────────── --}}
        <div class="dkd-body">
            <p class="dkd-section-label">Informasi Usaha</p>

            <div class="dkd-detail-grid">

                <div class="dkd-detail-card">
                    <div class="dkd-detail-card-header">Profil Usaha</div>
                    <div class="dkd-field">
                        <span class="dkd-field-label">Marketplace</span>
                        <span class="dkd-field-value {{ !$umkm->marketplace ? 'is-dash' : '' }}">
                            {{ $umkm->marketplace?->nama_marketplace ?? '—' }}
                        </span>
                    </div>
                    <div class="dkd-field">
                        <span class="dkd-field-label">Tahun Berdiri</span>
                        <span class="dkd-field-value {{ !$umkm->tahun_berdiri ? 'is-dash' : '' }}">
                            {{ $umkm->tahun_berdiri ?? '—' }}
                        </span>
                    </div>
                    <div class="dkd-field">
                        <span class="dkd-field-label">Kapasitas Produksi</span>
                        <span class="dkd-field-value {{ !$umkm->kapasitas_produksi ? 'is-dash' : '' }}">
                            {{ $umkm->kapasitas_produksi ?? '—' }}
                        </span>
                    </div>
                </div>

                <div class="dkd-detail-card">
                    <div class="dkd-detail-card-header">Tenaga Kerja &amp; Pelanggan</div>
                    <div class="dkd-field">
                        <span class="dkd-field-label">Tenaga Kerja Perempuan</span>
                        <span class="dkd-field-value {{ !$umkm->tenaga_kerja_perempuan ? 'is-dash' : '' }}">
                            {{ $umkm->tenaga_kerja_perempuan ?? '—' }}
                        </span>
                    </div>
                    <div class="dkd-field">
                        <span class="dkd-field-label">Tenaga Kerja Laki-laki</span>
                        <span class="dkd-field-value {{ !$umkm->tenaga_kerja_laki_laki ? 'is-dash' : '' }}">
                            {{ $umkm->tenaga_kerja_laki_laki ?? '—' }}
                        </span>
                    </div>
                    <div class="dkd-field">
                        <span class="dkd-field-label">Jumlah Pelanggan</span>
                        <span class="dkd-field-value {{ !$umkm->jumlah_pelanggan ? 'is-dash' : '' }}">
                            {{ $umkm->jumlah_pelanggan ?? '—' }}
                        </span>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection