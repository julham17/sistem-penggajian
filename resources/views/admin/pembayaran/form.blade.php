@extends('layouts.app')

@section('content')
<div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Form Pembayaran Gaji</h1>
        </div>

    <p><strong>Nama Karyawan:</strong> {{ $gaji->karyawan->nama_lengkap }}</p>
    <p><strong>Bulan:</strong> {{ \Carbon\Carbon::parse($gaji->bulan)->translatedFormat('F Y') }}</p>

    <form action="{{ route('admin.gaji.bayar.store', $gaji->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mt-2">
            <label>Tanggal Pembayaran</label>
            <input type="date" name="tanggal_pembayaran" class="form-control" required>
        </div>
        <div class="form-group mt-2">
            <label>Metode Pembayaran</label>
            <input type="text" name="metode_pembayaran" class="form-control" required>
        </div>
        <div class="form-group mt-2">
            <label>Upload Bukti (optional)</label>
            <input type="file" name="bukti_pembayaran" class="form-control">
        </div>
        <button type="submit" class="btn btn-success mt-3">Simpan Pembayaran</button>
    </form>
</div>
@endsection
