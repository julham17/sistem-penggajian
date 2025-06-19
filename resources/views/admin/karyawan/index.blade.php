@extends('layouts.app')

@section('content')
<div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Karyawan</h1>
        </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead >
                    <tr >
                        <th >No</th>
                        <th >NIP</th>
                        <th >Nama Lengkap</th>
                        <th >Jabatan</th>
                        <th >Divisi</th>
                        <th >Nomor Telepon</th>
                        <th >Tanggal Masuk</th>
                        <th >Aksi</th>
                    </tr>
                </thead>
                <tbody >
                    @forelse($karyawan as $index => $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nip }}</td>
                            <td>{{ $item->nama_lengkap }}</td>
                            <td>{{ $item->jabatan }}</td>
                            <td>{{ $item->divisi }}</td>
                            <td>{{ $item->nomor_telepon }}</td>
                            <td data-order="{{ $item->tanggal_masuk }}">
                                {{ \Carbon\Carbon::parse($item->tanggal_masuk)->translatedFormat('d F Y') }}
                            </td>
                            <td>
                                <a href="{{ route('admin.karyawan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.karyawan.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
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
    </div>
</div>
@endsection
