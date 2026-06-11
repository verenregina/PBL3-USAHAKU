@extends('layouts.admin')

@section('title', 'History')
@section('topbar-label', 'Riwayat')
@section('topbar-heading', 'Daftar Riwayat Analisis')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/history.css') }}">
@endpush

@section('content')

<p class="hist-section-label">Riwayat Analisis</p>
<h2 class="hist-section-title">Hasil Analisis Pengguna</h2>

<div class="hist-card">

    {{-- ===== Toolbar ===== --}}
    <div class="hist-toolbar">

        <div class="hist-toolbar-left">
            <span class="hist-toolbar-title">Daftar Riwayat</span>
            <span class="hist-badge-count">{{ $histories->total() }}</span>
        </div>

        <div style="display:flex; gap:12px; align-items:center;">

            {{-- SEARCH --}}
            <div class="hist-search">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" placeholder="Cari nama usaha...">
            </div>

        </div>
    </div>

    {{-- ===== TABLE ===== --}}
    <div class="hist-table-wrap">
        <table class="hist-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>User</th>
                    <th>Nama Usaha</th>
                    <th>Jenis Usaha</th>
                    <th>ROA</th>
                    <th>Margin</th>
                    <th>Utilisasi</th>
                    <th>Skor SAW</th>
                    <th>Kategori</th>
                    <th>Aksi</th> {{-- TAMBAH INI --}}
                </tr>
            </thead>

            <tbody>
                @forelse($histories as $index => $history)
                    @php
                        $userName = optional(optional($history->analisisUsaha)->user)->name ?? 'Anonim';
                        $userInitial = strtoupper(substr($userName, 0, 2));
                        $namaUsaha = optional($history->analisisUsaha)->nama_usaha ?? '-';
                        $jenisUsaha = optional($history->analisisUsaha)->jenis_usaha ?? '-';
                        $kategori = strtolower($history->kategori_potensi ?? '');
                    @endphp

                    <tr>
                        <td>{{ $histories->firstItem() + $index }}</td>

                        <td>
                            {{ $history->created_at->format('Y-m-d') }}<br>
                            <small>{{ $history->created_at->format('H:i') }}</small>
                        </td>

                        <td>{{ $userName }}</td>
                        <td>{{ $namaUsaha }}</td>
                        <td>{{ $jenisUsaha }}</td>

                        <td>{{ $history->roa }}%</td>
                        <td>{{ $history->margin_laba }}%</td>
                        <td>{{ $history->utilisasi_produksi }}%</td>

                        <td>{{ $history->nilai_saw }}</td>

                        <td>
                            <span class="badge-kategori {{ $kategori }}">
                                {{ $history->kategori_potensi }}
                            </span>
                        </td>

                        {{-- ✅ EXPORT PDF PER BARIS --}}
                        <td>
                            <a href="{{ route('admin.history.pdf', $history->id) }}"
                               class="export-btn">
                                PDF
                            </a>
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="11">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="hist-footer">
        <span>
            Menampilkan {{ $histories->firstItem() }}–{{ $histories->lastItem() }}
            dari {{ $histories->total() }} data
        </span>

        {{ $histories->links() }}
    </div>

</div>

@endsection