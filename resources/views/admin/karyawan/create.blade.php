@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Data Karyawan</h2>

    <form action="{{ route('karyawan.store') }}" method="POST">
        @csrf

        <!-- Form fields -->
        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama_lengkap" required>
        </div>

        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" name="nip" required>
        </div>

        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" class="form-control" name="jabatan" required>
        </div>

        <div class="mb-3">
            <label for="divisi" class="form-label">Divisi</label>
            <input type="text" class="form-control" name="divisi" required>
        </div>

        <div class="mb-3">
            <label for="nomor_telepon" class="form-label">No. Telepon</label>
            <input type="text" class="form-control" name="nomor_telepon" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" rows="2" required></textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
            <input type="date" class="form-control" name="tanggal_masuk" required>
        </div>

        <hr>
        <h5>Akun Login</h5>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
