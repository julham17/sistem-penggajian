<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Gaji;
use App\Models\Karyawan;

class GajiController extends Controller
{
    public function index(Request $request)
    {
        $query = Gaji::with('karyawan')->latest();

        if ($request->has('status_kelola') && $request->status_kelola != '') {
            $query->where('status_kelola', $request->status_kelola);
        }

        $gaji = $query->paginate(10);

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
            'bulan' => 'required|date_format:Y-m',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
        ]);

        $karyawan = Karyawan::findOrFail($request->karyawan_id);
        $bulan = $request->bulan;

        // Default potongan
        $potongan_cuti = 0;

        try {
            $bulanCarbon = Carbon::createFromFormat('Y-m', $bulan);

            // Ambil cuti yang disetujui dalam bulan & tahun yang sama
            $cutiDisetujui = $karyawan->cuti()
                ->where('status', 'disetujui')
                ->whereMonth('tanggal_mulai', $bulanCarbon->month)
                ->whereYear('tanggal_mulai', $bulanCarbon->year)
                ->get();

            $jumlahHariCuti = $cutiDisetujui->sum(function ($cuti) {
                return $cuti->tanggal_mulai->diffInDays($cuti->tanggal_selesai) + 1;
            });

            $potongan_cuti = $jumlahHariCuti * 100000;
            
            // Log::info('Jumlah hari cuti disetujui:', ['jumlah_hari_cuti' => $jumlahHariCuti]);
            // Log::info('Potongan cuti:', ['potongan' => $potongan_cuti]);
            
            
        } catch (\Exception $e) {
            Log::error('Gagal parsing bulan: ' . $e->getMessage());
        }

        $cekDuplikat = Gaji::where('karyawan_id', $karyawan->id)
            ->where('bulan', $bulan)
            ->exists();

        if ($cekDuplikat) {
            return back()->withErrors(['bulan' => 'Gaji untuk bulan ini sudah ada.'])->withInput();
        }

        Gaji::create([
            'karyawan_id' => $karyawan->id,
            'bulan' => $bulan,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan ?? 0,
            'potongan_cuti' => $potongan_cuti,
        ]);

        return redirect()->route('admin.gaji.index')->with('success', 'Data gaji berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $gaji = Gaji::findOrFail($id);
        $karyawan = Karyawan::all();

        return view('admin.gaji.edit', compact('gaji', 'karyawan'));
    }

    public function update(Request $request, $id)
    {
        $gaji = Gaji::findOrFail($id);

        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'bulan' => 'required|date_format:Y-m',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
        ]);

        $karyawan = Karyawan::findOrFail($request->karyawan_id);
        $bulan = $request->bulan;

        $potongan_cuti = 0;

        try {
            $bulanCarbon = Carbon::createFromFormat('Y-m', $bulan);

            $cutiDisetujui = $karyawan->cuti()
                ->where('status', 'disetujui')
                ->whereMonth('tanggal_mulai', $bulanCarbon->month)
                ->whereYear('tanggal_mulai', $bulanCarbon->year)
                ->get();

            $jumlahHariCuti = $cutiDisetujui->sum(function ($cuti) {
                return $cuti->tanggal_mulai->diffInDays($cuti->tanggal_selesai) + 1;
            });

            $potongan_cuti = $jumlahHariCuti * 100000;
        } catch (\Exception $e) {
            Log::error('Gagal parsing bulan: ' . $e->getMessage());
        }

        $gaji->update([
            'karyawan_id' => $request->karyawan_id,
            'bulan' => $request->bulan,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan ?? 0,
            'potongan_cuti' => $potongan_cuti,
        ]);

        return redirect()->route('admin.gaji.index')->with('success', 'Data gaji berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $gaji = Gaji::findOrFail($id);
        $gaji->delete();

        return redirect()->route('admin.gaji.index')->with('success', 'Data gaji berhasil dihapus.');
    }
}
