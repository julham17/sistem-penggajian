<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuti;

class CutiController extends Controller
{
    // Menampilkan semua pengajuan cuti dengan status 'pending'
    public function index()
    {
        $cutiPending = Cuti::with('karyawan.user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.cuti.index', compact('cutiPending'));
    }

    // Memperbarui status cuti (disetujui/ditolak)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $cuti = Cuti::findOrFail($id);
        $cuti->status = $request->status;
        $cuti->save();

        $status = $request->status === 'disetujui' ? 'disetujui' : 'ditolak';
        return redirect()->back()->with('success', "Cuti berhasil $status.");
    }

    public function riwayat()
    {
        $riwayatCuti = Cuti::with('karyawan.user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.cuti.riwayat', compact('riwayatCuti'));
    }
}
