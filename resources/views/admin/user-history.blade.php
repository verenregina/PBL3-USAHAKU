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

    {{-- ===== Stat Strip ===== --}}
    <div class="stat-strip">

        <div class="strip-card">
            <div class="strip-icon orange">
                <svg viewBox="0 0 20 20"><path class="icon-orange" d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/></svg>
            </div>
            <div class="strip-info">
                <p class="strip-value">{{ $users->total() }}</p>
                <p class="strip-label">Total Pengguna</p>
            </div>
        </div>

        <div class="strip-card">
            <div class="strip-icon blue">
                <svg viewBox="0 0 20 20"><path class="icon-blue" fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/></svg>
            </div>
            <div class="strip-info">
                <p class="strip-value">{{ $users->where('role','user')->count() }}</p>
                <p class="strip-label">Role User</p>
            </div>
        </div>

        <div class="strip-card">
            <div class="strip-icon green">
                <svg viewBox="0 0 20 20"><path class="icon-green" fill-rule="evenodd" d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zm6-4a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zm6-3a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" clip-rule="evenodd"/></svg>
            </div>
            <div class="strip-info">
                <p class="strip-value">{{ $users->sum('analisis_usaha_count') }}</p>
                <p class="strip-label">Total Analisis</p>
            </div>
        </div>

    </div>

    {{-- ===== Table Card ===== --}}
    <div class="table-card">

        {{-- Toolbar --}}
        <div class="table-toolbar">
            <div class="toolbar-left">
                <div class="toolbar-icon">
                    <svg width="16" height="16" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <span class="toolbar-title">
                    Daftar Pengguna
                    <span class="badge-count">{{ $users->total() }}</span>
                </span>
            </div>

            {{-- Search --}}
            <div class="toolbar-search">
                <svg width="14" height="14" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                </svg>
                <input type="text"
                       id="searchInput"
                       placeholder="Cari nama atau email..."
                       autocomplete="off">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table" id="penggunaTable">
                <thead>
                    <tr>
                        <th class="td-no">No</th>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Analisis</th>
                        <th>Terdaftar</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $maxAnalisis = $users->max('analisis_usaha_count') ?: 1;
                        $avatarColors = ['','b','c','d','e','f','g','h'];
                    @endphp

                    @forelse($users as $index => $user)
                    @php
                        $initials  = strtoupper(substr($user->name, 0, 2));
                        $colorIdx  = (ord(strtolower($user->name[0])) - ord('a')) % count($avatarColors);
                        $colorCls  = $avatarColors[$colorIdx];
                        $barWidth  = round(($user->analisis_usaha_count / $maxAnalisis) * 100);
                    @endphp
                    <tr>
                        {{-- No --}}
                        <td class="td-no">{{ $users->firstItem() + $index }}</td>

                        {{-- Pengguna --}}
                        <td>
                            <div class="user-chip">
                                <div class="user-avatar {{ $colorCls }}">{{ $initials }}</div>
                                <div class="user-info">
                                    <span class="user-name">{{ $user->name }}</span>
                                </div>
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

                        {{-- Analisis --}}
                        <td>
                            <div class="analisis-wrap">
                                <div class="analisis-bar-bg">
                                    <div class="analisis-bar-fill" style="width: {{ $barWidth }}%;"></div>
                                </div>
                                <span class="analisis-number">{{ $user->analisis_usaha_count }}</span>
                                <span class="analisis-label">analisis</span>
                            </div>
                        </td>

                        {{-- Terdaftar --}}
                        <td class="td-date">
                            {{ $user->created_at->format('d M Y') }}
                            <span class="date-relative">{{ $user->created_at->diffForHumans() }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <svg width="28" height="28" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <p class="empty-state-text">Belum ada pengguna terdaftar.</p>
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

@push('scripts')
<script>
    // Live search filter
    document.getElementById('searchInput').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('#penggunaTable tbody tr').forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(q) ? '' : 'none';
        });
    });
</script>
@endpush