@extends('layouts.app')

@section('content')
<div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Riwayat Pengajuan Cuti</h1>
        </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if ($riwayatCuti->isEmpty())
        <div class="alert alert-info">Belum ada riwayat cuti.</div>
    @else

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Alasan</th>
                        <th>Diajukan Pada</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayatCuti as $cuti)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cuti->karyawan?->nama_lengkap ?? '-' }}</td>
                            <td>{{ $cuti->tanggal_mulai->translatedFormat('d F Y') }}</td>
                            <td>{{ $cuti->tanggal_selesai->translatedFormat('d F Y') }}</td>
                            <td>{{ $cuti->alasan }}</td>
                            <td>{{ $cuti->created_at->translatedFormat('d F Y') }}</td>
                            <td>
                                @if ($cuti->status === 'pending')
                                    <span class="btn btn-sm btn-primary">Pending</span>
                                @elseif ($cuti->status === 'disetujui')
                                    <span class="btn btn-sm btn-success">Disetujui</span>
                                @else
                                    <span class="btn btn-sm btn-danger">Ditolak</span>
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
