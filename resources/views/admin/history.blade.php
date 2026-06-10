@extends('layouts.admin')

@section('title', 'History')
@section('topbar-label', 'Riwayat')
@section('topbar-heading', 'Daftar Riwayat Analisis')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/history.css') }}">
@endpush

@section('content')

    {{-- ===== Section Header ===== --}}
    <p class="hist-section-label">Riwayat Analisis</p>
    <h2 class="hist-section-title">Hasil Analisis Pengguna</h2>

    {{-- ===== Table Card ===== --}}
    <div class="hist-card">

        {{-- Toolbar --}}
        <div class="hist-toolbar">
            <div class="hist-toolbar-left">
                <span class="hist-toolbar-title">Daftar Riwayat</span>
                <span class="hist-badge-count">{{ $histories->total() }}</span>
            </div>
            <div class="hist-search">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" placeholder="Cari nama usaha...">
            </div>
        </div>

        {{-- Table --}}
        <div class="hist-table-wrap">
            <table class="hist-table">
                <thead>
                    <tr>
                        <th style="width:44px">No</th>
                        <th style="width:130px">Tanggal</th>
                        <th style="width:150px">User</th>
                        <th style="width:160px">Nama Usaha</th>
                        <th style="width:110px">Jenis Usaha</th>
                        <th class="th-right" style="width:66px">ROA</th>
                        <th class="th-right" style="width:72px">Margin</th>
                        <th class="th-right" style="width:78px">Utilisasi</th>
                        <th style="width:110px">Skor SAW</th>
                        <th>Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($histories as $index => $history)
                        @php
                            $userName    = optional(optional($history->analisisUsaha)->user)->name ?? 'Anonim';
                            $userInitial = strtoupper(substr(implode('', array_map(fn($w) => $w[0], explode(' ', trim($userName)))), 0, 2));
                            $namaUsaha   = optional($history->analisisUsaha)->nama_usaha ?? '-';
                            $jenisUsaha  = optional($history->analisisUsaha)->jenis_usaha ?? '-';
                            $kategori    = strtolower($history->kategori_potensi ?? '');
                            $sawPct      = min(round($history->nilai_saw * 100), 100);
                        @endphp
                        <tr>
                            <td class="td-no">{{ $histories->firstItem() + $index }}</td>

                            <td class="td-date">
                                {{ $history->created_at->format('Y-m-d') }}<br>
                                <span style="color:#9ca3af;font-size:11px">{{ $history->created_at->format('H:i') }}</span>
                            </td>

                            <td>
                                <div class="user-chip">
                                    <div class="user-avatar">{{ $userInitial }}</div>
                                    <span class="user-name">{{ $userName }}</span>
                                </div>
                            </td>

                            <td class="td-usaha">{{ $namaUsaha }}</td>

                            <td>
                                @if($jenisUsaha !== '-')
                                    <span class="badge-jenis">{{ $jenisUsaha }}</span>
                                @else
                                    <span style="color:#d1d5db">—</span>
                                @endif
                            </td>

                            <td class="td-metric">{{ $history->roa }}%</td>
                            <td class="td-metric">{{ $history->margin_laba }}%</td>
                            <td class="td-metric">{{ $history->utilisasi_produksi }}%</td>

                            <td class="td-saw">
                                <span class="saw-score">{{ $history->nilai_saw }}</span>
                                <span class="saw-mini-bar">
                                    <span class="saw-mini-fill" style="width:{{ $sawPct }}%"></span>
                                </span>
                            </td>

                            <td>
                                <span class="badge-kategori {{ $kategori }}">
                                    {{ $history->kategori_potensi }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">
                                <div class="empty-state">
                                    <div class="empty-state-icon">📋</div>
                                    <div class="empty-state-text">Belum ada riwayat analisis.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer + Pagination --}}
        <div class="hist-footer">
            <span class="hist-page-info">
                Menampilkan {{ $histories->firstItem() }}–{{ $histories->lastItem() }}
                dari {{ $histories->total() }} data
            </span>
            {{ $histories->links() }}
        </div>

    </div>

@endsection