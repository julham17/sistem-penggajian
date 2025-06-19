<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Gaji;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class GajiKaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Auth::user()->karyawan;
        $gaji = Gaji::where('karyawan_id', $karyawan->id)->latest()->get();

        return view('karyawan.gaji.index', compact('gaji'));
    }

    public function slipGaji($id)
    {
        $gaji = Gaji::with('karyawan.user', 'pembayaran')->findOrFail($id);

        if (auth()->user()->id !== $gaji->karyawan->user_id) {
            abort(403, 'Akses ditolak.');
        }

        $pembayaran = $gaji->pembayaran;

        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Slip gaji tidak tersedia. Pastikan gaji sudah dibayar.');
        }
        
        $pdf = PDF::loadView('karyawan.gaji.slip', compact('gaji'));
        return $pdf->stream('slip-gaji-' . $gaji->karyawan->nama_lengkap . '-' . $gaji->bulan->format('F-Y') . '.pdf');
    }
}
