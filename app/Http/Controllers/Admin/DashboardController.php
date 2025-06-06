<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Cuti;
use App\Models\Gaji;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Validasi role admin
        if ($user->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // Total karyawan
        $totalKaryawan = Karyawan::count();

        // Data status cuti
        $cuti = [
            'pending' => Cuti::where('status', 'pending')->count(),
            'disetujui' => Cuti::where('status', 'disetujui')->count(),
            'ditolak' => Cuti::where('status', 'ditolak')->count(),
        ];

        // Total gaji bulan ini
        $totalGajiDibayar = Gaji::where('status_kelola', 'sudah_dibayar')
            ->whereMonth('bulan', Carbon::now()->month)
            ->sum(DB::raw('gaji_pokok + tunjangan - potongan_cuti'));

        // Ambil data cuti 6 bulan terakhir dan format bulan
        $cutiChart = Cuti::select(
                DB::raw('DATE_FORMAT(tanggal_mulai, "%Y-%m") as bulan'),
                DB::raw('COUNT(*) as jumlah')
            )
            ->whereNotNull('tanggal_mulai')
            ->where('tanggal_mulai', '>=', Carbon::now()->subMonths(6))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Siapkan data chart
        $chartLabels = $cutiChart->pluck('bulan');
        $chartData = $cutiChart->pluck('jumlah');

        // Kirim ke view
        return view('admin.dashboard', compact(
            'totalKaryawan',
            'cuti',
            'totalGajiDibayar',
            'chartLabels',
            'chartData'
        ));
    }
}
