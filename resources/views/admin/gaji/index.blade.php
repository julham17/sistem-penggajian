@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Data Gaji Karyawan</h4>

    <a href="{{ route('gaji.create') }}" class="btn btn-success mb-3">+ Tambah Gaji</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gaji as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->karyawan->nama_lengkap }}</td>
                    <td>{{ $row->bulan }}</td>
                    <td>Rp{{ number_format($row->gaji_pokok) }}</td>
                    <td>Rp{{ number_format($row->tunjangan) }}</td>
                    <td>Rp{{ number_format($row->potongan_cuti) }}</td>
                    <td><strong>Rp{{ number_format($row->total_bersih) }}</strong></td>
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
