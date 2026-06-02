@extends('layouts.admin')

@section('title', 'Dashboard')

@section('topbar-label', 'Dashboard')
@section('topbar-heading', 'Selamat datang, ' . auth()->user()->name)

@push('styles')
<style>
    .section-header { margin-bottom: 20px; }

    .section-label {
        font-size: 11px;
        color: #f97316;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .section-title {
        font-size: 20px;
        font-weight: 700;
        color: #1f2d3d;
        margin-top: 2px;
    }

    /* ===== STATS GRID ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        border: 1px solid #e5e7eb;
        transition: box-shadow 0.2s;
    }

    .stat-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon.orange { background: rgba(249,115,22,0.12); }
    .stat-icon.blue   { background: rgba(59,130,246,0.12); }
    .stat-icon.green  { background: rgba(34,197,94,0.12); }

    .stat-icon svg { width: 22px; height: 22px; }
    .icon-orange { fill: #f97316; }
    .icon-blue   { fill: #3b82f6; }
    .icon-green  { fill: #22c55e; }

    .stat-info { flex: 1; }

    .stat-value {
        font-size: 28px;
        font-weight: 800;
        color: #1f2d3d;
        line-height: 1;
    }

    .stat-label {
        font-size: 12px;
        color: #6b7280;
        margin-top: 4px;
    }

    .stat-badge {
        font-size: 11px;
        font-weight: 600;
        color: #16a34a;
        background: rgba(34,197,94,0.1);
        padding: 3px 8px;
        border-radius: 20px;
        align-self: flex-start;
    }

    /* ===== CHART CARD ===== */
    .chart-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid #e5e7eb;
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .chart-header h3 {
        font-size: 15px;
        font-weight: 700;
        color: #1f2d3d;
    }

    .chart-filter { display: flex; gap: 6px; }

    .filter-btn {
        font-size: 11px;
        padding: 5px 12px;
        border-radius: 20px;
        cursor: pointer;
        font-weight: 500;
        border: none;
        transition: all 0.15s;
    }

    .filter-btn.active   { background: #f97316; color: white; }
    .filter-btn.inactive { background: #f3f4f6; color: #6b7280; }
    .filter-btn.inactive:hover { background: #e5e7eb; }

    .chart-placeholder {
        width: 100%;
        height: 180px;
        background: #f9fafb;
        border-radius: 8px;
        border: 1px dashed #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
        font-size: 13px;
    }
</style>
@endpush

@section('content')

    <div class="section-header">
        <p class="section-label">Overview</p>
        <h2 class="section-title">Dashboard</h2>
    </div>

    {{-- STATS --}}
    <div class="stats-grid">

        <article class="stat-card">
            <div class="stat-icon orange">
                <svg viewBox="0 0 20 20" class="icon-orange">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="stat-info">
                <p class="stat-value">{{ $totalUsaha ?? 0 }}</p>
                <p class="stat-label">Total Usaha</p>
            </div>
            <span class="stat-badge">+12%</span>
        </article>

        <article class="stat-card">
            <div class="stat-icon blue">
                <svg viewBox="0 0 20 20" class="icon-blue">
                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                </svg>
            </div>
            <div class="stat-info">
                <p class="stat-value">{{ $totalKategori ?? 0 }}</p>
                <p class="stat-label">Total Kategori Usaha</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-icon green">
                <svg viewBox="0 0 20 20" class="icon-green">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                </svg>
            </div>
            <div class="stat-info">
                <p class="stat-value">{{ $totalUser ?? 0 }}</p>
                <p class="stat-label">Total User</p>
            </div>
            <span class="stat-badge">+8%</span>
        </article>

    </div>

    {{-- CHART --}}
    <div class="chart-card">
        <div class="chart-header">
            <h3>Grafik Penggunaan Sistem</h3>
            <div class="chart-filter">
                <button class="filter-btn active"   onclick="setFilter(this)">Mingguan</button>
                <button class="filter-btn inactive" onclick="setFilter(this)">Bulanan</button>
                <button class="filter-btn inactive" onclick="setFilter(this)">Tahunan</button>
            </div>
        </div>
        {{-- Ganti dengan <canvas id="usageChart"></canvas> jika pakai Chart.js --}}
        <div class="chart-placeholder">Placeholder grafik</div>
    </div>

@endsection

@push('scripts')
<script>
    function setFilter(btn) {
        document.querySelectorAll('.filter-btn').forEach(b => {
            b.classList.remove('active');
            b.classList.add('inactive');
        });
        btn.classList.remove('inactive');
        btn.classList.add('active');
    }
</script>
@endpush