@extends('layouts.admin')

@section('title', 'Riwayat Pengguna')
@section('topbar-label', 'Pengguna')
@section('topbar-heading', 'Daftar Pengguna Terdaftar')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/datapengguna.css') }}">
@endpush

@section('content')

    {{-- ===== Section Header ===== --}}
    <div class="section-header">
        <p class="section-label">Data Pengguna</p>
        <h2 class="section-title">Semua Akun Pengguna</h2>
    </div>

    {{-- ===== Table Card ===== --}}
    <div class="table-card">

        {{-- Toolbar --}}
        <div class="table-toolbar">
            <div class="toolbar-title">
                Daftar Pengguna
                <span class="badge-count">{{ $users->total() }}</span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Analisis</th>
                        <th>Terdaftar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $index }}</td>

                            {{-- Nama --}}
                            <td>
                                <div class="user-chip">
                                    <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                                    <span class="user-name">{{ $user->name }}</span>
                                </div>
                            </td>

                            {{-- Email --}}
                            <td class="td-email">{{ $user->email }}</td>

                            {{-- Role --}}
                            <td>
                                <span class="badge-role {{ strtolower($user->role) }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            {{-- Jumlah Analisis --}}
                            <td>
                                <div class="analisis-count">
                                    <span class="analisis-number">{{ $user->analisis_usaha_count }}</span>
                                    <span class="analisis-label">analisis</span>
                                </div>
                            </td>

                            {{-- Terdaftar --}}
                            <td class="td-date">{{ $user->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-state-icon">👤</div>
                                    <div class="empty-state-text">Belum ada pengguna terdaftar.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ===== Pagination ===== --}}
    <div class="pagination-wrapper">
        {{ $users->links() }}
    </div>

@endsection