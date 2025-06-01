<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cek role dan redirect ke view sesuai role
        if ($user->role === 'admin') {
            return view('dashboard.admin', compact('user'));
        } elseif ($user->role === 'karyawan') {
            return view('dashboard.karyawan', compact('user'));
        } else {
            abort(403, 'Unauthorized');
        }
    }
}
