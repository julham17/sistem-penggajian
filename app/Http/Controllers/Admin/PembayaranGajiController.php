<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PembayaranGaji;
use App\Models\Gaji;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PembayaranGajiController extends Controller
{
    public function index()
    {
        $pembayaran = PembayaranGaji::with('gaji.karyawan')->latest()->paginate(10);
        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    public function create()
    {
        $gaji = Gaji::doesntHave('pembayaran')->with('karyawan')->get();
        return view('admin.pembayaran.create', compact('gaji'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gaji_id' => 'required|exists:gaji,id',
            'metode_pembayaran' => 'required|string|max:255',
            'tanggal_pembayaran' => 'required|date',
            'bukti_pembayaran' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        PembayaranGaji::create([
            'gaji_id' => $request->gaji_id,
            'metode_pembayaran' => $request->metode_pembayaran,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'bukti_pembayaran' => $path,
        ]);

        Gaji::where('id', $request->gaji_id)->update(['status_kelola' => 'sudah_dibayar']);

        return redirect()->route('admin.pembayaran.index')->with('success', 'Data pembayaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pembayaran = PembayaranGaji::with('gaji.karyawan')->findOrFail($id);

        return view('admin.pembayaran.edit', compact('pembayaran'));
    }

    public function update(Request $request, $id)
    {
        $pembayaran = PembayaranGaji::findOrFail($id);

        $request->validate([
            'metode_pembayaran' => 'required|string|max:255',
            'tanggal_pembayaran' => 'required|date',
            'bukti_pembayaran' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['metode_pembayaran', 'tanggal_pembayaran']);

        // Jika ada file baru diupload
        if ($request->hasFile('bukti_pembayaran')) {
            // Hapus file lama jika ada
            if ($pembayaran->bukti_pembayaran && Storage::exists($pembayaran->bukti_pembayaran)) {
                Storage::delete($pembayaran->bukti_pembayaran);
            }

            $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran');
        }

        $pembayaran->update($data);

        return redirect()->route('admin.pembayaran.index')->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pembayaran = PembayaranGaji::findOrFail($id);

        // Hapus bukti pembayaran jika ada
        if ($pembayaran->bukti_pembayaran && Storage::exists($pembayaran->bukti_pembayaran)) {
            Storage::delete($pembayaran->bukti_pembayaran);
        }

        $pembayaran->delete();

        return redirect()->route('admin.pembayaran.index')->with('success', 'Data pembayaran berhasil dihapus.');
    }

    public function slipGaji($id)
    {
        $pembayaran = PembayaranGaji::with('gaji.karyawan')->findOrFail($id);
        $gaji = $pembayaran->gaji;

        $pdf = PDF::loadView('admin.pembayaran.slip', compact('gaji'));
        return $pdf->stream('slip-gaji-' . $gaji->karyawan->nama_lengkap . '-' . $gaji->bulan->format('F-Y') . '.pdf');
    }

    // Menampilkan form pembayaran
    public function formPembayaran($id)
    {
        $gaji = Gaji::with('karyawan')->findOrFail($id);
        return view('admin.pembayaran.form', compact('gaji'));
    }

    // Memproses penyimpanan pembayaran
    public function prosesPembayaran(Request $request, $id)
    {
        $request->validate([
            'tanggal_pembayaran' => 'required|date',
            'metode_pembayaran' => 'required|string',
            'bukti_pembayaran' => 'nullable|image|max:2048',
        ]);

        $gaji = Gaji::findOrFail($id);

        // Upload bukti pembayaran jika ada
        $buktiPath = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        // Simpan pembayaran
        PembayaranGaji::create([
            'gaji_id' => $gaji->id,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => $buktiPath,
        ]);

        // Update status gaji
        $gaji->status_kelola = 'sudah_dibayar';
        $gaji->save();

        return redirect()->route('admin.gaji.index')->with('success', 'Pembayaran berhasil disimpan.');
    }

}
