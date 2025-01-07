<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    // Pastikan Gate `update-agenda` sudah didefinisikan
    Gate::define('update-agenda', function ($user) {
        return $user->has_access; // Ubah sesuai kolom database yang relevan
    });

    // Pastikan Gate `delete-agenda` sudah didefinisikan
    Gate::define('delete-agenda', function ($user) {
        return $user->has_access; // Ubah sesuai kolom database yang relevan
    });
}
}
