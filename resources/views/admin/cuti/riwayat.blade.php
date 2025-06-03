@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Riwayat Pengajuan Cuti</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if ($riwayatCuti->isEmpty())
        <div class="alert alert-info">Belum ada riwayat cuti.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
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
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif ($cuti->status === 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
