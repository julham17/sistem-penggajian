@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Daftar Pembayaran Gaji</h4>

    <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-primary mb-3">Tambah Pembayaran</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Bulan</th>
                <th>Metode</th>
                <th>Tanggal</th>
                <th>Bukti</th>
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
                            <a href="{{ asset('storage/'.$item->bukti_pembayaran) }}" target="_blank">Lihat</a>
                        @else
                            -
                        @endif
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

    {{ $pembayaran->links() }}
</div>
@endsection
