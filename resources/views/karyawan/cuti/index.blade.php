@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Riwayat Pengajuan Cuti</h4>

    <a href="{{ route('karyawan.cuti.create') }}" class="btn btn-success mb-3">Ajukan Cuti</a>

    @if ($riwayatCuti->isEmpty())
        <div class="alert alert-info">Belum ada pengajuan cuti.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
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
                            <td>{{ $cuti->tanggal_mulai->translatedFormat('d F Y') }}</td>
                            <td>{{ $cuti->tanggal_selesai->translatedFormat('d F Y') }}</td>
                            <td>{{ $cuti->alasan }}</td>
                            <td>
                                <span class="badge 
                                    @if ($cuti->status === 'disetujui') bg-success
                                    @elseif ($cuti->status === 'ditolak') bg-danger
                                    @else bg-secondary @endif">
                                    {{ ucfirst($cuti->status) }}
                                </span>
                            </td>
                            <td>{{ $cuti->created_at->translatedFormat('d F Y') }}</td>
                            <td>
                                @if ($cuti->status === 'pending')
                                    <a href="{{ route('karyawan.cuti.edit', $cuti->id) }}" class="btn btn-sm btn-warning">Ubah</a>

                                    <form action="{{ route('karyawan.cuti.destroy', $cuti->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengajuan cuti ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
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
    @endif
</div>
@endsection
