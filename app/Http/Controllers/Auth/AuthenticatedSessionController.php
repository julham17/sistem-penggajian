<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();

            $role = Auth::user()->role;
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'karyawan') {
                return redirect()->route('karyawan.dashboard');
            }

            // Jika role tidak dikenali
            Auth::logout();
            return redirect()->route('login')->withErrors(['username' => 'Role tidak dikenali']);
        }

        return back()->withErrors([
            'username' => 'Login gagal, cek kembali username dan password',
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
