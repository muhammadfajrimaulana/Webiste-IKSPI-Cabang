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
    public function boot(): void
    {
        Gate::define('is-cabang', fn($user) => $user->role === 'admin_cabang');
        Gate::define('is-ranting', fn($user) => $user->role === 'admin_ranting');
        Gate::define('is-anggota', fn($user) => $user->role === 'anggota');
    }
}
