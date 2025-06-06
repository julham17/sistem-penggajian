@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Dashboard Admin</h3>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Total Karyawan</h5>
                    <h3>{{ $totalKaryawan }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Total Gaji Dibayar Bulan Ini</h5>
                    <h3>Rp {{ number_format($totalGajiDibayar) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Status Cuti</h5>
                    <ul>
                        <li>Pending: {{ $cuti['pending'] }}</li>
                        <li>Disetujui: {{ $cuti['disetujui'] }}</li>
                        <li>Ditolak: {{ $cuti['ditolak'] }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h5>Grafik Jumlah Pengajuan Cuti / Bulan</h5>
            <canvas id="cutiChart"></canvas>

            <!-- Data chart sebagai JSON -->
            <script id="chartLabels" type="application/json">{{ json_encode($chartLabels) }}</script>
            <script id="chartData" type="application/json"><pre>{{ json_encode($chartData) }}</pre></script>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const chartLabels = JSON.parse(document.getElementById('chartLabels').textContent);
    const chartData = JSON.parse(document.getElementById('chartData').textContent);

    const ctx = document.getElementById('cutiChart').getContext('2d');
    const cutiChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Jumlah Pengajuan Cuti',
                data: chartData,
                backgroundColor: '#4e73df'
            }]
        },
        options: {
            responsive: true,
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
