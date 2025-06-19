@extends('layouts.app')

@section('content')
<div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Pembayaran Gaji</h1>
        </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Bulan</th>
                        <th>Metode</th>
                        <th>Tanggal</th>
                        <th>Bukti</th>
                        <th>Slip</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembayaran as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->gaji->karyawan->nama_lengkap }}</td>
                            <td>{{ $item->gaji->bulan_format }}</td>
                            <td>{{ $item->metode_pembayaran }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->translatedFormat('d F Y') }}</td>
                            <td>
                                @if($item->bukti_pembayaran)
                                    <a href="{{ asset('storage/'.$item->bukti_pembayaran) }}" class="btn btn-sm btn-success" target="_blank">Lihat</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.pembayaran.slip', $item->id) }}" class="btn btn-sm btn-primary" target="_blank">
                                    Slip Gaji
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.pembayaran.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.pembayaran.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
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
