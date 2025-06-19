@extends('layouts.app')

@section('content')
<div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Karyawan</h1>
        </div>

    <form action="{{ route('admin.karyawan.update', $karyawan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Form fields -->
        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap', $karyawan->nama_lengkap) }}" required>
        </div>

        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" name="nip" value="{{ old('nip', $karyawan->nip) }}" required>
        </div>

        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" class="form-control" name="jabatan" value="{{ old('jabatan', $karyawan->jabatan) }}" required>
        </div>

        <div class="mb-3">
            <label for="divisi" class="form-label">Divisi</label>
            <input type="text" class="form-control" name="divisi" value="{{ old('divisi', $karyawan->divisi) }}" required>
        </div>

        <div class="mb-3">
            <label for="nomor_telepon" class="form-label">No. Telepon</label>
            <input type="text" class="form-control" name="nomor_telepon" value="{{ old('nomor_telepon', $karyawan->nomor_telepon) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $karyawan->user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" rows="2" required>{{ old('alamat', $karyawan->alamat) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
            <input type="date" class="form-control" name="tanggal_masuk" value="{{ old('tanggal_masuk', $karyawan->tanggal_masuk) }}" required>
        </div>

        <hr>
        <h5>Akun Login</h5>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="{{ old('username', $karyawan->user->username) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.karyawan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
