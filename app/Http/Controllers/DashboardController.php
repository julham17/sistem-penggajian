<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Cuti;
use App\Models\Gaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Data dashboard admin
            $totalKaryawan = Karyawan::count();
            $cuti = [
                'pending' => Cuti::where('status', 'pending')->count(),
                'disetujui' => Cuti::where('status', 'disetujui')->count(),
                'ditolak' => Cuti::where('status', 'ditolak')->count(),
            ];

            $totalGajiDibayar = Gaji::where('status_kelola', 'sudah_dibayar')
                ->whereMonth('bulan', Carbon::now()->month)
                ->sum(DB::raw('gaji_pokok + tunjangan - potongan_cuti'));

            $cutiChart = Cuti::selectRaw('DATE_FORMAT(tanggal_mulai, "%Y-%m") as bulan, COUNT(*) as jumlah')
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get();

            $chartLabels = $cutiChart->pluck('bulan');
            $chartData = $cutiChart->pluck('jumlah');

            return view('dashboard.admin', compact(
                'user',
                'totalKaryawan',
                'cuti',
                'totalGajiDibayar',
                'chartLabels',
                'chartData'
            ));
        }

        if ($user->role === 'karyawan') {
            // Data dashboard karyawan (optional, sementara cukup info akun)
            return view('dashboard.karyawan', compact('user'));
        }

        abort(403, 'Unauthorized');
    }
}
