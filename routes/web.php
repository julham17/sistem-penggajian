<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Admin Route
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\GajiController;
use App\Http\Controllers\Admin\PembayaranGajiController;
use App\Http\Controllers\Admin\CutiController;
// Karyawan Route
use App\Http\Controllers\Karyawan\DashboardController as KaryawanDashboardController;
use App\Http\Controllers\Karyawan\GajiKaryawanController;
use App\Http\Controllers\Karyawan\CutiController as KaryawanCutiController;

Route::get('/', function () {
    return view('auth/login');
});

// ✅ Redirect universal ke dashboard sesuai role
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'karyawan') {
        return redirect()->route('karyawan.dashboard');
    }

    abort(403, 'Unauthorized');
})->middleware('auth')->name('dashboard');

// ✅ Group untuk user yang sudah login
Route::middleware('auth')->group(function () {

    // ADMIN
    Route::middleware([RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/chart/gaji', [AdminDashboardController::class, 'chartGaji']);

        Route::get('/cuti', [CutiController::class, 'index'])->name('cuti.index');
        Route::patch('/cuti/{id}/status', [CutiController::class, 'updateStatus'])->name('cuti.updateStatus');
        Route::get('/cuti/riwayat', [CutiController::class, 'riwayat'])->name('cuti.riwayat');

        Route::get('/gaji/{id}/bayar', [PembayaranGajiController::class, 'formPembayaran'])->name('gaji.bayar');
        Route::post('/gaji/{id}/bayar', [PembayaranGajiController::class, 'prosesPembayaran'])->name('gaji.bayar.store');

        Route::get('/pembayaran/{id}/slip', [PembayaranGajiController::class, 'slipGaji'])->name('pembayaran.slip');

        Route::resource('gaji', GajiController::class)->except(['show']);
        Route::resource('karyawan', KaryawanController::class);
        Route::resource('pembayaran', PembayaranGajiController::class);
    });

    // KARYAWAN
    Route::middleware([RoleMiddleware::class . ':karyawan'])->prefix('karyawan')->name('karyawan.')->group(function () {
        Route::get('/dashboard', [KaryawanDashboardController::class, 'index'])->name('dashboard');

        Route::get('/gaji', [GajiKaryawanController::class, 'index'])->name('gaji.index');
        Route::get('/gaji/{id}/slip', [GajiKaryawanController::class, 'slipGaji'])->name('gaji.slip');


        Route::resource('cuti', KaryawanCutiController::class);
    });

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
