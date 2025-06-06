<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'karyawan') {
            return view('dashboard.karyawan', compact('user'));
        }

        abort(403, 'Unauthorized');
    }
}