<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Str;
use App\Models\User;

class KaryawanController extends Controller
{
    
    public function index()
    {
        $karyawan = Karyawan::with('user')->paginate(10);
        return view('admin.karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        return view('admin.karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'nama_lengkap' => 'required',
            'nip' => 'required|unique:karyawan,nip',
            'jabatan' => 'required',
            'divisi' => 'required',
            'nomor_telepon' => 'required',
            'alamat' => 'required',
            'tanggal_masuk' => 'required|date',
        ]);

        // Buat akun user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password), // default password
            'role' => 'karyawan',
        ]);

        // Buat data karyawan
        Karyawan::create([
            'user_id' => $user->id,
            'nama_lengkap' => $request->nama_lengkap,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'divisi' => $request->divisi,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        return redirect()->route('admin.karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::with('user')->findOrFail($id);
        return view('admin.karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $user = $karyawan->user;

        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nama_lengkap' => 'required',
            'nip' => 'required|unique:karyawan,nip,' . $id,
            'jabatan' => 'required',
            'divisi' => 'required',
            'nomor_telepon' => 'required',
            'alamat' => 'required',
            'tanggal_masuk' => 'required|date',
        ]);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);

        $karyawan->update([
            'nama_lengkap' => $request->nama_lengkap,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'divisi' => $request->divisi,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        return redirect()->route('admin.karyawan.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->user->delete(); // Hapus user terkait
        $karyawan->delete();

        return redirect()->route('admin.karyawan.index')->with('success', 'Data karyawan berhasil dihapus.');
    }
}
