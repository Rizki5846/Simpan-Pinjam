@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Selamat Datang -->
    <div class="card bg-white shadow-sm border-0 mb-4">
        <div class="card-body">
            <h4 class="card-title mb-1">Selamat Datang di Aplikasi Klasifikasi KNN</h4>
            <p class="mb-0">Aplikasi ini menggunakan metode K-Nearest Neighbor untuk klasifikasi kelayakan pinjaman.</p>
        </div>
    </div>

    <div class="row">

        <!-- Info Data -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title text-success">
                        <i class="fas fa-database me-2"></i>Info Data
                    </h5>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <i class="fas fa-chart-line text-primary me-2"></i>
                            <span>Data Latih</span>
                        </div>
                        <span class="badge bg-primary rounded-pill fs-6">{{ $jumlah_latih }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <i class="fas fa-flask text-info me-2"></i>
                            <span>Data Uji</span>
                        </div>
                        <span class="badge bg-info rounded-pill fs-6">{{ $jumlah_uji }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-history text-warning me-2"></i>
                            <span>Riwayat Perhitungan</span>
                        </div>
                        <span class="badge bg-warning rounded-pill fs-6">{{ $jumlah_riwayat }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Distribusi Hasil -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title text-success">
                        <i class="fas fa-chart-pie me-2"></i>Distribusi Hasil
                    </h5>
                    <div class="chart-container" style="height: 250px;">
                        <canvas id="distribusiChart"></canvas>
                    </div>
                    <div class="mt-3 text-center">
                        <span class="badge bg-success p-2 me-2">Layak</span>
                        <span class="badge bg-danger p-2">Tidak Layak</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tren Perhitungan -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title text-success">
                        <i class="fas fa-chart-line me-2"></i>Tren Perhitungan
                    </h5>
                    <div class="chart-container" style="height: 250px;">
                        <canvas id="trenChart"></canvas>
                    </div>
                    <div class="mt-3 text-center small text-muted">7 Hari Terakhir</div>
                </div>
            </div>
        </div>

    </div>

    <!-- Perhitungan Berdasarkan Nilai K -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title text-success">
                        <i class="fas fa-chart-bar me-2"></i>Perhitungan Berdasarkan Nilai K
                    </h5>
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="kChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Chart Distribusi
    const distribusiCtx = document.getElementById('distribusiChart').getContext('2d');
    new Chart(distribusiCtx, {
        type: 'doughnut',
        data: {
            labels: ['Layak', 'Tidak Layak'],
            datasets: [{
                data: [
                    {{ $distribusiHasil->get('Layak', 0) }},
                    {{ $distribusiHasil->get('Tidak Layak', 0) }}
                ],
                backgroundColor: ['rgba(40, 167, 69, 0.8)', 'rgba(220, 53, 69, 0.8)'],
                borderColor: ['rgba(40, 167, 69, 1)', 'rgba(220, 53, 69, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.raw || 0;
                            let total = context.dataset.data.reduce((a, b) => a + b, 0);
                            let percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Chart Nilai K
    const kCtx = document.getElementById('kChart').getContext('2d');
    const kValues = {!! json_encode($perhitunganPerK->pluck('k')) !!};
    const kCounts = {!! json_encode($perhitunganPerK->pluck('total')) !!};

    new Chart(kCtx, {
        type: 'bar',
        data: {
            labels: kValues,
            datasets: [{
                label: 'Jumlah Perhitungan',
                data: kCounts,
                backgroundColor: 'rgba(0, 123, 255, 0.7)',
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });

    // Chart Tren Perhitungan
    const trenCtx = document.getElementById('trenChart').getContext('2d');
    const dates = {!! json_encode($trenWaktu->pluck('date')) !!};
    const counts = {!! json_encode($trenWaktu->pluck('total')) !!};

    new Chart(trenCtx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label: 'Jumlah Perhitungan',
                data: counts,
                backgroundColor: 'rgba(253, 126, 20, 0.2)',
                borderColor: 'rgba(253, 126, 20, 1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true,
                pointBackgroundColor: '#fd7e14',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: '#fd7e14',
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
</script>
@endsection
