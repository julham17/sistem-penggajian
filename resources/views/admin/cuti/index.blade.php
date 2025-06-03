@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Pengajuan Cuti Pending</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($cutiPending->isEmpty())
        <div class="alert alert-info">Tidak ada pengajuan cuti yang pending.</div>
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cutiPending as $cuti)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cuti->karyawan?->nama_lengkap ?? '-' }}</td>
                            <td>{{ $cuti->tanggal_mulai->translatedFormat('d F Y') }}</td>
                            <td>{{ $cuti->tanggal_selesai->translatedFormat('d F Y') }}</td>
                            <td>{{ $cuti->alasan }}</td>
                            <td>{{ $cuti->created_at->translatedFormat('d F Y') }}</td>
                            <td>
                                <form action="{{ route('admin.cuti.updateStatus', $cuti->id) }}" method="POST" class="d-flex gap-1">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="disetujui">
                                    <button class="btn btn-sm btn-success" onclick="return confirm('Setujui cuti ini?')">Setujui</button>
                                </form>

                                <form action="{{ route('admin.cuti.updateStatus', $cuti->id) }}" method="POST" class="d-inline-block mt-1">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Tolak cuti ini?')">Tolak</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
