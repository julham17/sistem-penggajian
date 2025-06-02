<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gaji;
use App\Models\Karyawan;

class GajiController extends Controller
{
    public function index()
    {
        $gaji = Gaji::with('karyawan')->latest()->paginate(10);
        return view('admin.gaji.index', compact('gaji'));
    }

    public function create()
    {
        $karyawan = Karyawan::all();
        return view('admin.gaji.create', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'bulan' => 'required|string',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
            'potongan_cuti' => 'nullable|numeric',
        ]);

        Gaji::create([
            'karyawan_id' => $request->karyawan_id,
            'bulan' => $request->bulan,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan ?? 0,
            'potongan_cuti' => $request->potongan_cuti ?? 0,
        ]);

        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $gaji = Gaji::findOrFail($id);
        $karyawan = \App\Models\Karyawan::all();

        return view('admin.gaji.edit', compact('gaji', 'karyawan'));
    }

    public function update(Request $request, $id)
    {
        $gaji = Gaji::findOrFail($id);

        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'bulan' => 'required|string',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
            'potongan_cuti' => 'nullable|numeric',
        ]);

        $gaji->update([
            'karyawan_id' => $request->karyawan_id,
            'bulan' => $request->bulan,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan ?? 0,
            'potongan_cuti' => $request->potongan_cuti ?? 0,
        ]);

        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $gaji = Gaji::findOrFail($id);
        $gaji->delete();

        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil dihapus.');
    }

}
