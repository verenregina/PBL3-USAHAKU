@extends('layouts.admin')

@section('title', 'Laporan & Statistik')

@section('topbar-label', 'Laporan')
@section('topbar-heading', 'Laporan & Statistik UMKM')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/laporan.css') }}">
@endpush

@section('content')

    {{-- SECTION HEADER --}}
    <div class="section-header">
        <p class="section-label">Analisis</p>
        <h2 class="section-title">Laporan & Statistik UMKM</h2>
    </div>

    {{-- STATS --}}
    <div class="stats-grid">

        <article class="stat-card">
            <div class="stat-card-top">
                <div class="stat-icon orange">
                    <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path class="icon-orange" d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zm6-4a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zm6-3a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                    </svg>
                </div>
                <span class="stat-badge">+{{ $trendAnalisis ?? '0' }}%</span>
            </div>
            <div class="stat-card-bottom">
                <p class="stat-value">{{ $totalAnalisis ?? 0 }}</p>
                <p class="stat-label">Total Analisis</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-card-top">
                <div class="stat-icon blue">
                    <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path class="icon-blue" fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="stat-card-bottom">
                <p class="stat-value">{{ $rataRoa ?? 0 }}<span>%</span></p>
                <p class="stat-label">Rata-rata ROA</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-card-top">
                <div class="stat-icon green">
                    <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path class="icon-green" fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="stat-card-bottom">
                <p class="stat-value">{{ $rataMargin ?? 0 }}<span>%</span></p>
                <p class="stat-label">Margin Laba</p>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-card-top">
                <div class="stat-icon purple">
                    <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path class="icon-purple" fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="stat-card-bottom">
                <p class="stat-value">{{ $rataUtilisasi ?? 0 }}<span>%</span></p>
                <p class="stat-label">Utilisasi Produksi</p>
            </div>
        </article>

    </div>

    {{-- CHARTS ROW 1: Bar + Pie --}}
    <div class="chart-grid-2">

        <div class="chart-card">
            <div class="chart-card-header">
                <div>
                    <h3>Potensi UMKM per Kabupaten</h3>
                    <p>Distribusi berdasarkan wilayah</p>
                </div>
                <span class="chart-tag blue">Bar Chart</span>
            </div>
            <div class="chart-daerah-wrap">
                <canvas id="chartDaerah"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-card-header">
                <div>
                    <h3>Potensi UMKM per Jenis Usaha</h3>
                    <p>Proporsi setiap sektor usaha</p>
                </div>
                <span class="chart-tag orange">Pie Chart</span>
            </div>
            <canvas id="chartJenis" style="max-height: 240px;"></canvas>
        </div>

    </div>

    {{-- CHARTS ROW 2: Doughnut + Placeholder --}}
    <div class="chart-grid-2" style="margin-bottom: 24px;">

        <div class="chart-card">
            <div class="chart-card-header">
                <div>
                    <h3>Kategori Potensi</h3>
                    <p>Tinggi / Sedang / Rendah</p>
                </div>
                <span class="chart-tag green">Doughnut</span>
            </div>
            <canvas id="chartKategori" style="max-height: 240px;"></canvas>
        </div>

        <div class="chart-card chart-empty">
            <svg width="40" height="40" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z" clip-rule="evenodd"/>
            </svg>
            <p>Grafik tambahan tersedia</p>
            <small>Tambahkan chart sesuai kebutuhan</small>
        </div>

    </div>

    {{-- TOP 10 TABLE --}}
    <div class="table-card">
        <div class="table-card-header">
            <h3>Top 10 UMKM &mdash; Nilai SAW Tertinggi</h3>
            <span class="badge-count">10 Entri</span>
        </div>
        <table class="laporan-table">
            <thead>
                <tr>
                    <th style="width:52px;">#</th>
                    <th>Nama Usaha</th>
                    <th>Jenis Usaha</th>
                    <th>Kabupaten</th>
                    <th>Nilai SAW</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                @foreach($top10Umkm as $item)
                <tr>
                    <td>
                        @php
                            $rank = $loop->iteration;
                            $rankClass = match($rank) {
                                1 => 'rank-gold',
                                2 => 'rank-silver',
                                3 => 'rank-bronze',
                                default => 'rank-default'
                            };
                        @endphp
                        <span class="table-rank {{ $rankClass }}">{{ $rank }}</span>
                    </td>
                    <td class="nama-usaha">{{ $item->analisisUsaha->nama_usaha }}</td>
                    <td>{{ $item->analisisUsaha->jenis_usaha }}</td>
                    <td>{{ $item->analisisUsaha->kabupaten }}</td>
                    <td>
                        <div class="saw-bar-wrap">
                            <div class="saw-bar-bg">
                                <div class="saw-bar-fill" style="width: {{ min(100, $item->nilai_saw * 100) }}%;"></div>
                            </div>
                            <span class="saw-value">{{ number_format($item->nilai_saw, 3) }}</span>
                        </div>
                    </td>
                    <td>
                        @php
                            $kategori = strtolower($item->kategori_potensi);
                            $badgeClass = match(true) {
                                str_contains($kategori, 'tinggi') => 'tinggi',
                                str_contains($kategori, 'sedang') => 'sedang',
                                str_contains($kategori, 'rendah') => 'rendah',
                                default => 'default'
                            };
                        @endphp
                        <span class="kategori-badge {{ $badgeClass }}">{{ $item->kategori_potensi }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const multiColors = [
        '#f97316', '#3b82f6', '#22c55e', '#8b5cf6',
        '#eab308', '#ef4444', '#06b6d4', '#ec4899'
    ];

    Chart.defaults.font.family = "'Plus Jakarta Sans', 'Inter', sans-serif";
    Chart.defaults.font.size   = 12;
    Chart.defaults.color       = '#6b7280';

    // ── Horizontal Bar Chart: Per Kabupaten ──────────────────
    const daerahLabels = [
        @foreach($potensiPerDaerah as $item)
            '{{ $item->kabupaten }}',
        @endforeach
    ];

    const daerahValues = [
        @foreach($potensiPerDaerah as $item)
            {{ $item->total }},
        @endforeach
    ];

    // Palet gradient per bar: dari warna solid ke transparan (kiri → kanan)
    const gradientPalette = [
        ['#f97316', '#fed7aa'],
        ['#3b82f6', '#bfdbfe'],
        ['#22c55e', '#bbf7d0'],
        ['#8b5cf6', '#ddd6fe'],
        ['#eab308', '#fef08a'],
        ['#ef4444', '#fecaca'],
        ['#06b6d4', '#a5f3fc'],
        ['#ec4899', '#fbcfe8'],
    ];

    // Plugin: buat gradient horizontal tiap bar
    const gradientBarPlugin = {
        id: 'gradientBarPlugin',
        beforeDatasetsDraw(chart) {
            const { ctx, chartArea: { left, right }, data } = chart;
            const dataset = chart.data.datasets[0];
            const gradients = data.labels.map((_, i) => {
                const g = ctx.createLinearGradient(left, 0, right, 0);
                const [start, end] = gradientPalette[i % gradientPalette.length];
                g.addColorStop(0, start);
                g.addColorStop(1, end);
                return g;
            });
            dataset.backgroundColor = gradients;
        }
    };

    new Chart(document.getElementById('chartDaerah'), {
        type: 'bar',
        plugins: [gradientBarPlugin],
        data: {
            labels: daerahLabels,
            datasets: [{
                label: 'Jumlah UMKM',
                data: daerahValues,
                backgroundColor: [], // diisi plugin
                borderColor: 'transparent',
                borderRadius: { topRight: 6, bottomRight: 6 },
                borderSkipped: false,
                barThickness: 22,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ` ${ctx.parsed.x} UMKM`
                    }
                },
                // Label nilai di ujung bar
                datalabels: false,
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: { color: '#f3f4f6' },
                    border: { display: false },
                    ticks: { precision: 0, font: { size: 11 } }
                },
                y: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: { font: { size: 12 }, color: '#374151' }
                }
            },
            animation: {
                duration: 700,
                easing: 'easeOutQuart'
            },
            // Tampilkan nilai di ujung bar via afterDraw
            afterDraw(chart) {
                const { ctx, scales: { x, y } } = chart;
                chart.data.datasets[0].data.forEach((val, i) => {
                    const xPos = x.getPixelForValue(val);
                    const yPos = y.getPixelForValue(i);
                    ctx.save();
                    ctx.font = 'bold 11px Plus Jakarta Sans, Inter, sans-serif';
                    ctx.fillStyle = '#6b7280';
                    ctx.textAlign = 'left';
                    ctx.textBaseline = 'middle';
                    ctx.fillText(val, xPos + 6, yPos);
                    ctx.restore();
                });
            }
        }
    });

    // ── Pie Chart: Per Jenis Usaha ────────────────────────────
    new Chart(document.getElementById('chartJenis'), {
        type: 'pie',
        data: {
            labels: [
                @foreach($potensiPerJenisUsaha as $item)
                    '{{ $item->jenis_usaha }}',
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach($potensiPerJenisUsaha as $item)
                        {{ $item->total }},
                    @endforeach
                ],
                backgroundColor: multiColors,
                borderColor: '#ffffff',
                borderWidth: 2,
                hoverOffset: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'right',
                    labels: { boxWidth: 10, padding: 14, font: { size: 11 } }
                }
            }
        }
    });

    // ── Doughnut Chart: Kategori Potensi ─────────────────────
    new Chart(document.getElementById('chartKategori'), {
        type: 'doughnut',
        data: {
            labels: [
                @foreach($kategoriPotensi as $item)
                    '{{ $item->kategori_potensi }}',
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach($kategoriPotensi as $item)
                        {{ $item->total }},
                    @endforeach
                ],
                backgroundColor: ['#22c55e', '#f97316', '#ef4444'],
                borderColor: '#ffffff',
                borderWidth: 3,
                hoverOffset: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { boxWidth: 10, padding: 16, font: { size: 11 } }
                }
            }
        }
    });

});
</script>
@endpush