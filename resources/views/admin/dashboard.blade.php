@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Admin</h1>

    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="card p-3 bg-light rounded shadow">
                <h4>Jumlah Karyawan</h4>
                <p class="fs-3">{{ $total_karyawan }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 bg-light rounded shadow">
                <h4>Cuti Disetujui</h4>
                <p class="fs-3">{{ $cuti_disetujui }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 bg-light rounded shadow">
                <h4>Total Gaji Dibayar</h4>
                <p class="fs-3">Rp {{ number_format($gaji_dibayar, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

