<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public const HOME = '/dashboard';
    
    public function boot(): void
    {
        // ...
        Route::middleware('web')
            ->group(function () {
                Route::get('/dashboard', function () {
                    if (auth()->user()->role === 'admin') {
                        return redirect('/admin');
                    } else {
                        return redirect('/karyawan');
                    }
                });
            });
    }
}
