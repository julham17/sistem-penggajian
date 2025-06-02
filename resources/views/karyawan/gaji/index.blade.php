@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Daftar Gaji Saya</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan</th>
                    <th>Potongan Cuti</th>
                    <th>Total Bersih</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gaji as $index => $item)
                    <tr>
                        <td>{{ $gaji->firstItem() + $index }}</td>
                        <td>{{ $item->bulan_format }}</td>
                        <td>Rp {{ number_format($item->gaji_pokok, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->tunjangan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->potongan_cuti, 0, ',', '.') }}</td>
                        <td><strong>Rp {{ number_format($item->total_bersih, 0, ',', '.') }}</strong></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data gaji.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $gaji->links() }}
    </div>
</div>
@endsection
