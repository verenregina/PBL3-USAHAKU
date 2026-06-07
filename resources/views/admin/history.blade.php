@extends('layouts.admin')

@section('title', 'History')
@section('topbar-label', 'Riwayat')
@section('topbar-heading', 'Daftar Riwayat Analisis')

@section('content')
    <div class="section-header">
        <p class="section-label">Riwayat Analisis</p>
        <h2 class="section-title">Semua hasil analisis pengguna</h2>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table">
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
                    </tr>
                </thead>
                <tbody>
                    @forelse($histories as $index => $history)
                        <tr>
                            <td>{{ $histories->firstItem() + $index }}</td>
                            <td>{{ $history->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ optional(optional($history->analisisUsaha)->user)->name ?? 'Anonim' }}</td>
                            <td>{{ optional($history->analisisUsaha)->nama_usaha ?? '-' }}</td>
                            <td>{{ optional($history->analisisUsaha)->jenis_usaha ?? '-' }}</td>
                            <td>{{ $history->roa }}%</td>
                            <td>{{ $history->margin_laba }}%</td>
                            <td>{{ $history->utilisasi_produksi }}%</td>
                            <td>{{ $history->nilai_saw }}</td>
                            <td>{{ $history->kategori_potensi }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Belum ada riwayat analisis.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="pagination-wrapper">
        {{ $histories->links() }}
    </div>
@endsection
