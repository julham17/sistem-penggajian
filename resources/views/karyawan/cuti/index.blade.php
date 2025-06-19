@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Riwayat Cuti</h1>
    </div>

    @if ($riwayatCuti->isEmpty())
        <div class="alert alert-info">Belum ada pengajuan cuti.</div>
    @else

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th>Diajukan Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayatCuti as $cuti)
                        <tr>
                            <td>{{ $cuti->karyawan?->nama_lengkap ?? '-' }}</td>
                            <td>{{ $cuti->tanggal_mulai->translatedFormat('d F Y') }}</td>
                            <td>{{ $cuti->tanggal_selesai->translatedFormat('d F Y') }}</td>
                            <td>{{ $cuti->alasan }}</td>
                            <td>
                                @if($cuti->status === 'disetujui')
                                    <span class="btn btn-sm btn-success">Disetujui</span>
                                @elseif($cuti->status === 'ditolak')
                                    <span class="btn btn-sm btn-danger">Ditolak</span>
                                @else($cuti->status === 'pending')
                                    <span class="btn btn-sm btn-primary">Pending</span>
                                @endif
                            </td>
                            <td>{{ $cuti->created_at->translatedFormat('d F Y') }}</td>
                            <td>
                                @if ($cuti->status === 'pending')
                                    <a href="{{ route('karyawan.cuti.edit', $cuti->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('karyawan.cuti.destroy', $cuti->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus pengajuan cuti ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
