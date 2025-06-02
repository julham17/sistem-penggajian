@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Data Gaji</h4>

    <form action="{{ route('gaji.update', $gaji->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="karyawan_id" class="form-label">Nama Karyawan</label>
            <select name="karyawan_id" class="form-select" required>
                <option value="">-- Pilih Karyawan --</option>
                @foreach ($karyawan as $k)
                    <option value="{{ $k->id }}" {{ $gaji->karyawan_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_lengkap }} ({{ $k->nip }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="bulan" class="form-label">Bulan</label>
            <input type="text" name="bulan" class="form-control" value="{{ $gaji->bulan }}" required>
        </div>

        <div class="mb-3">
            <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
            <input type="number" name="gaji_pokok" class="form-control" value="{{ $gaji->gaji_pokok }}" required>
        </div>

        <div class="mb-3">
            <label for="tunjangan" class="form-label">Tunjangan</label>
            <input type="number" name="tunjangan" class="form-control" value="{{ $gaji->tunjangan }}">
        </div>

        <div class="mb-3">
            <label for="potongan_cuti" class="form-label">Potongan Cuti</label>
            <input type="number" name="potongan_cuti" class="form-control" value="{{ $gaji->potongan_cuti }}">
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('gaji.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
