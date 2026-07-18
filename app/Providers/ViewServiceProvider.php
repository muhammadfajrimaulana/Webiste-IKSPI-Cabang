<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $user = Auth::user();
            $badgeData = ['count' => 0, 'color' => 'bg-red-600'];

            if ($user) {
                if ($user->role === 'admin_cabang') {
                    // Cabang: Hitung data yang statusnya masih pending (perlu verifikasi)
                    $count = Pendaftaran::where('status_verifikasi', 'pending')->count();
                    $badgeData = ['count' => $count, 'color' => 'bg-red-600'];
                } elseif ($user->role === 'admin_ranting') {
                    // Ranting: Hitung data milik ranting ini yang sudah diverifikasi (disetujui)
                    $count = Pendaftaran::where('ranting_id', $user->ranting_id)
                        ->where('status_verifikasi', 'disetujui')
                        ->count();
                    $badgeData = ['count' => $count, 'color' => 'bg-green-600'];
                }
            }

            $view->with('badgeData', $badgeData);
        });
    }
}
