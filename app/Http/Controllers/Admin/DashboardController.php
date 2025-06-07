<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Cuti;
use App\Models\Gaji;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
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

        return view('admin.dashboard', [
            'total_karyawan' => Karyawan::count(),
            'cuti_disetujui' => Cuti::where('status', 'disetujui')->count(),
            'gaji_dibayar' => Gaji::where('status_kelola', 'sudah_dibayar')->sum(DB::raw('gaji_pokok + tunjangan - potongan_cuti'))
        ]);
    }
}
