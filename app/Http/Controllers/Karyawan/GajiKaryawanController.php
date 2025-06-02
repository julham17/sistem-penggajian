<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Gaji;

class GajiKaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Auth::user()->karyawan;
        $gaji = Gaji::where('karyawan_id', $karyawan->id)->latest()->paginate(10);

        return view('karyawan.gaji.index', compact('gaji'));
    }
}
