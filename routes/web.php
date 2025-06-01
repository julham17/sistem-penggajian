<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KaryawanController;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::middleware([RoleMiddleware::class . ':admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
        Route::get('/admin/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
        Route::post('/admin/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');


        Route::resource('karyawan', KaryawanController::class);
    });

    Route::middleware([RoleMiddleware::class . ':karyawan'])->group(function () {
        Route::get('/karyawan/dashboard', function () {
            return view('karyawan.dashboard');
        })->name('karyawan.dashboard');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
