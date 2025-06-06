@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Edit Pembayaran Gaji</h4>

    <form action="{{ route('admin.pembayaran.update', $pembayaran->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="gaji_id" class="form-label">Pilih Gaji</label>
            <select name="gaji_id" id="gaji_id" class="form-select" required disabled>
                <option value="{{ $pembayaran->gaji->id }}">
                    {{ $pembayaran->gaji->karyawan->nama_lengkap }} - {{ $pembayaran->gaji->bulan_format }}
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
            <input type="text" name="metode_pembayaran" id="metode_pembayaran" class="form-control"
                value="{{ $pembayaran->metode_pembayaran }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
            <input type="date" name="tanggal_pembayaran" id="tanggal_pembayaran" class="form-control"
                value="{{ $pembayaran->tanggal_pembayaran->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran (jika ingin mengganti)</label>
            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control" accept="image/*">
            @if($pembayaran->bukti_pembayaran)
                <p class="mt-2">Bukti saat ini: <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank">Lihat</a></p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection