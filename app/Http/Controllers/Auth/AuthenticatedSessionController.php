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
    public function store(LoginRequest $request): RedirectResponse
    {
        // Otentikasi pakai username & password
        if (!Auth::attempt($request->only('username', 'password'), $request->boolean('remember'))) {
            return back()->withErrors([
                'username' => 'Username atau password salah.',
            ])->onlyInput('username');
        }

        $request->session()->regenerate();

        // Redirect ke dashboard utama (akan diarahkan lagi sesuai role)
        return redirect()->intended('/dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
