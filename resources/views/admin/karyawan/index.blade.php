@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Karyawan</h3>
        <a href="{{ route('admin.karyawan.create') }}" class="btn btn-primary">+ Tambah Karyawan</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Lengkap</th>
                    <th>Jabatan</th>
                    <th>Divisi</th>
                    <th>Nomor Telepon</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($karyawan as $index => $item)
                    <tr>
                        <td>{{ $karyawan->firstItem() + $index }}</td>
                        <td>{{ $item->nip }}</td>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>{{ $item->jabatan }}</td>
                        <td>{{ $item->divisi }}</td>
                        <td>{{ $item->nomor_telepon }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('admin.karyawan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.karyawan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data karyawan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination pagination-sm justify-content-center">
        {{ $karyawan->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
