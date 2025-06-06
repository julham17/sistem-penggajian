@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Tambah Data Gaji Karyawan</h4>

    <a href="{{ route('admin.gaji.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.gaji.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="karyawan_id" class="form-label">Nama Karyawan</label>
            <select name="karyawan_id" id="karyawan_id" class="form-select" required>
                <option value="">-- Pilih Karyawan --</option>
                @foreach ($karyawan as $row)
                    <option value="{{ $row->id }}" {{ old('karyawan_id') == $row->id ? 'selected' : '' }}>
                        {{ $row->nama_lengkap }} ({{ $row->nip }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="bulan" class="form-label">Bulan</label>
            <input type="month" name="bulan" id="bulan" class="form-control" placeholder="Bulan Tahun" value="{{ old('bulan', isset($gaji) ? $gaji->bulan : '') }}" required>
        </div>

        <div class="mb-3">
            <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
            <input type="number" name="gaji_pokok" id="gaji_pokok" class="form-control" value="{{ old('gaji_pokok') }}" required>
        </div>

        <div class="mb-3">
            <label for="tunjangan" class="form-label">Tunjangan</label>
            <input type="number" name="tunjangan" id="tunjangan" class="form-control" value="{{ old('tunjangan', 0) }}">
        </div>

        <div class="mb-3">
            <label for="potongan_cuti" class="form-label">Potongan Cuti</label>
            <input type="number" name="potongan_cuti" id="potongan_cuti" class="form-control" value="{{ old('potongan_cuti', 0) }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
