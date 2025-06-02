@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Data Gaji Karyawan</h4>

    <a href="{{ route('gaji.create') }}" class="btn btn-success mb-3">+ Tambah Gaji</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('gaji.index') }}" class="mb-3 row g-3 align-items-center">
        <div class="col-auto">
            <label for="status_kelola" class="col-form-label">Filter Status:</label>
        </div>
        <div class="col-auto">
            <select name="status_kelola" id="status_kelola" class="form-select">
                <option value="">Semua</option>
                <option value="belum_dibayar" {{ request('status_kelola') == 'belum_dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                <option value="sudah_dibayar" {{ request('status_kelola') == 'sudah_dibayar' ? 'selected' : '' }}>Sudah Dibayar</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Terapkan</button>
        </div>
    </form>


    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Bulan</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan</th>
                <th>Potongan Cuti</th>
                <th>Total Bersih</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gaji as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->karyawan->nama_lengkap }}</td>
                    <td>{{ $row->bulan_format }}</td>
                    <td>Rp{{ number_format($row->gaji_pokok) }}</td>
                    <td>Rp{{ number_format($row->tunjangan) }}</td>
                    <td>Rp{{ number_format($row->potongan_cuti, 0, ',', '.') }}</td>
                    <td><strong>Rp{{ number_format($row->total_bersih, 0, ',', '.') }}</strong></td>
                    <td>
                        @if($row->status_kelola === 'sudah_dibayar')
                            <span class="badge bg-success">Sudah Dibayar</span>
                        @else
                            <span class="badge bg-warning text-dark">Belum Dibayar</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('gaji.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('gaji.destroy', $row->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $gaji->links() }}
</div>
@endsection
