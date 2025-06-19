@extends('layouts.app')

@section('content')
<div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Gaji Karyawan</h1>
        </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead >
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
                    @foreach ($gaji as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->karyawan->nama_lengkap }}</td>
                            <td>{{ $item->bulan_format }}</td>
                            <td>Rp{{ number_format($item->gaji_pokok) }}</td>
                            <td>Rp{{ number_format($item->tunjangan) }}</td>
                            <td>Rp{{ number_format($item->potongan_cuti, 0, ',', '.') }}</td>
                            <td><strong>Rp{{ number_format($item->total_bersih, 0, ',', '.') }}</strong></td>
                            <td>
                                @if($item->status_kelola === 'sudah_dibayar')
                                    <span class="btn btn-sm btn-success">Sudah Dibayar</span>
                                @else
                                    <a href="{{ route('admin.gaji.bayar', $item->id) }}" class="btn btn-sm btn-primary ">
                                        Bayar Sekarang
                                    </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.gaji.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('admin.gaji.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
