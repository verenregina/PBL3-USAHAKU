@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-2">Hasil Rekomendasi Usaha</h1>
            <p class="text-muted">Berikut adalah hasil analisis potensi usaha berdasarkan modal dan jenis usaha yang Anda pilih dengan data historis di wilayah Jawa Timur.</p>
        </div>
        <a href="{{ route('recommendation.form') }}" class="btn btn-outline-orange">
            <i class="fas fa-arrow-left"></i> Kembali ke Input
        </a>
    </div>

    <div class="row">
        <!-- Usaha Direkomendasikan -->
        <div class="col-md-8 mb-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Usaha Direkomendasikan</h5>
                    
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="business-icon">
                            <i class="fas fa-store fa-3x text-orange"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">{{ $input['nama_usaha'] }}</h6>
                            <span class="badge bg-danger">{{ $potensi }}</span>
                            <div class="text-muted small mt-2">
                                <i class="fas fa-map-marker-alt"></i> Lokasi utama: {{ $input['daerah'] }}
                            </div>
                            <div class="text-muted small">
                                Daerah Potensial: {{ $input['daerah'] }}, Madiun, Batu
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analisis Kinerja -->
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title mb-3">Analisis Kinerja Usaha (Data Historis)</h6>
                            <div class="mb-2">
                                <small class="text-muted">Rata-rata Omset</small>
                                <div class="fw-bold">Rp 31.02 Juta</div>
                            </div>
                            <div class="mb-2">
                                <small class="text-muted">Rata-rata Laba</small>
                                <div class="fw-bold">Rp 16.01 Juta</div>
                            </div>
                            <div class="mb-2">
                                <small class="text-muted">Presentase Keuntungan</small>
                                <div class="fw-bold">16%</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title mb-3">Analisis Risiko & Tren Pasar</h6>
                            <div class="mb-2">
                                <small class="text-muted">Tingkat Risiko</small>
                                <div class="text-danger fw-bold">Tinggi</div>
                                <small class="text-danger">Risiko tinggi karena rata-rata laba terendah</small>
                            </div>
                            <div class="mt-3">
                                <small class="text-muted">Tren Pasar</small>
                                <div class="fw-bold">Sedang</div>
                                <small>Permintaan stabil namun pertumbuhan terbatas</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Distribusi Potensi -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="card-title mb-3">Distribusi Potensi (Berdasarkan Data Wilayah)</h6>
                    <div class="d-flex align-items-center">
                        <div style="width: 40%;">
                            <canvas id="distributionChart"></canvas>
                        </div>
                        <div style="width: 60%; padding-left: 20px;">
                            <div class="mb-2">
                                <span class="badge bg-success me-2">●</span> Tinggi: 15%
                            </div>
                            <div class="mb-2">
                                <span class="badge bg-warning me-2">●</span> Sedang: 35%
                            </div>
                            <div class="mb-2">
                                <span class="badge bg-danger me-2">●</span> Rendah: 50%
                            </div>
                            <small class="text-muted">Data berdasarkan distribusi usaha sejenis di Jawa Timur</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Kanan -->
        <div class="col-md-4">
            <!-- Tingkat Potensi Keberlanjutan -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="card-title mb-3">Tingkat Potensi Keberlanjutan</h6>
                    <div class="text-center">
                        <canvas id="riskChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Detail Kategori -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="card-title mb-3">Kategori Modal</h6>
                    <div class="mb-2">
                        <span class="badge bg-secondary me-2">●</span>
                        <small>Kategori Modal</small>
                        <div class="fw-bold">Kecil</div>
                    </div>
                    <div class="mb-2">
                        <span class="badge bg-secondary me-2">●</span>
                        <small>Range Modal</small>
                        <div class="fw-bold">Rp 328.337 - 3.708.847</div>
                    </div>
                    <div class="mb-2">
                        <span class="badge bg-secondary me-2">●</span>
                        <small>Skala Usaha</small>
                        <div class="fw-bold text-danger">Berdasarkan Tinggi</div>
                    </div>
                </div>
            </div>

            <!-- Rekomendasi Sistem -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="card-title mb-3">
                        <i class="fas fa-lightbulb text-warning me-2"></i>Rekomendasi Sistem
                    </h6>
                    <p class="small">
                        {{ $recommendation }}
                    </p>
                </div>
            </div>

            <!-- Penjelasan -->
            <div class="alert alert-info" role="alert">
                <h6 class="alert-heading">
                    <i class="fas fa-info-circle me-2"></i>Penjelasan
                </h6>
                <small>
                    Usaha jasa dengan modal kategori kecil memiliki tingkat keberlanjutan yang rendah. Data menunjukkan usaha di wilayah Kediri memiliki tingkat keberlanjutan yang rendah. Data menunjukkan usaha tanpa target jangka panjang memiliki kerugian sehingga perlu penyesuaian strategi.
                </small>
            </div>
        </div>
    </div>
</div>

<style>
    .text-orange {
        color: #FF7A00;
    }

    .bg-orange {
        background-color: #FF7A00;
    }

    .btn-outline-orange {
        color: #FF7A00;
        border-color: #FF7A00;
    }

    .btn-outline-orange:hover {
        background-color: #FF7A00;
        color: white;
    }

    .business-icon {
        background-color: #fff3e0;
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }

    .card {
        border: none;
        border-radius: 10px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Distribution Chart
    const distCtx = document.getElementById('distributionChart').getContext('2d');
    new Chart(distCtx, {
        type: 'doughnut',
        data: {
            labels: ['Tinggi', 'Sedang', 'Rendah'],
            datasets: [{
                data: [15, 35, 50],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Risk Chart (Gauge)
    const riskCtx = document.getElementById('riskChart').getContext('2d');
    new Chart(riskCtx, {
        type: 'doughnut',
        data: {
            labels: ['Risk', 'Safe'],
            datasets: [{
                data: [{{ $riskPercentage }}, {{ 100 - $riskPercentage }}],
                backgroundColor: ['#dc3545', '#e9ecef'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: false
                }
            }
        }
    });
</script>
@endsection
