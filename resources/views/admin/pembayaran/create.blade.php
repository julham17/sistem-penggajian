@extends('layouts.app')

@section('content')
<div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Pembayaran</h1>
        </div>

    <form action="{{ route('admin.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="gaji_id" class="form-label">Pilih Gaji</label>
            <select name="gaji_id" id="gaji_id" class="form-select" required>
                <option value="">-- Pilih Gaji --</option>
                @foreach($gaji as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->karyawan->nama_lengkap }} - {{ $item->bulan_format }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
            <input type="text" name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
            <input type="date" name="tanggal_pembayaran" id="tanggal_pembayaran" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran (opsional)</label>
            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
