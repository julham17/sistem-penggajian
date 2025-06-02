@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Ubah Pengajuan Cuti</h4>

    <form action="{{ route('karyawan.cuti.update', $cuti->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $cuti->tanggal_mulai->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $cuti->tanggal_selesai->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label for="alasan" class="form-label">Alasan</label>
            <textarea name="alasan" class="form-control" required>{{ old('alasan', $cuti->alasan) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('karyawan.cuti.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
