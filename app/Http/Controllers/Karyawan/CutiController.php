<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuti;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    public function index()
    {
        $karyawan = Auth::user()->karyawan;

        $riwayatCuti = Cuti::where('karyawan_id', $karyawan->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('karyawan.cuti.index', compact('riwayatCuti'));
    }

    public function create()
    {
        return view('karyawan.cuti.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string|max:255',
        ]);

        Cuti::create([
            'karyawan_id' => Auth::user()->karyawan->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
            'status' => 'pending',
        ]);

        return redirect()->route('karyawan.cuti.index')->with('success', 'Pengajuan cuti berhasil dikirim.');
    }

    public function edit(Cuti $cuti)
    {
        // Cek kepemilikan dan status
        if ($cuti->karyawan_id !== Auth::user()->karyawan->id || $cuti->status !== 'pending') {
            abort(403, 'Ditolak!');
        }

        return view('karyawan.cuti.edit', compact('cuti'));
    }

    public function update(Request $request, Cuti $cuti)
    {
        if ($cuti->karyawan_id !== Auth::user()->karyawan->id || $cuti->status !== 'pending') {
            abort(403, 'Ditolak!');
        }

        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string|max:255',
        ]);

        $cuti->update($request->only(['tanggal_mulai', 'tanggal_selesai', 'alasan']));

        return redirect()->route('karyawan.cuti.index')->with('success', 'Pengajuan cuti berhasil diperbarui.');
    }

    public function destroy(Cuti $cuti)
    {
        if ($cuti->karyawan_id !== Auth::user()->karyawan->id || $cuti->status !== 'pending') {
            abort(403, 'Unauthorized');
        }

        $cuti->delete();

        return redirect()->route('karyawan.cuti.index')->with('success', 'Pengajuan cuti berhasil dihapus.');
    }

}
