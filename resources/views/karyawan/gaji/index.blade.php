@extends('layouts.app')

@section('content')
<div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Gaji</h1>
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
                        <th>Bulan</th>
                        <th>Gaji Pokok</th>
                        <th>Tunjangan</th>
                        <th>Potongan Cuti</th>
                        <th>Total Bersih</th>
                        <th>slip</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gaji as $index => $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->bulan_format }}</td>
                            <td>Rp {{ number_format($item->gaji_pokok, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->tunjangan, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->potongan_cuti, 0, ',', '.') }}</td>
                            <td><strong>Rp {{ number_format($item->total_bersih, 0, ',', '.') }}</strong></td>
                            <td>
                                <a href="{{ route('karyawan.gaji.slip', $item->id) }}" class="btn btn-sm btn-primary" target="_blank">
                                    Lihat Slip
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data gaji.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
