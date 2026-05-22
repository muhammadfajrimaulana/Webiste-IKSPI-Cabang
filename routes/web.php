<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\GerbangController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Administrasi\InputDataController;
use App\Http\Controllers\Administrasi\VerifikasiController;
use App\Http\Controllers\Administrasi\OutputController;
use App\Http\Controllers\Internal\KeanggotaanController;
use App\Http\Controllers\Internal\OperasionalController;
use App\Http\Controllers\Internal\KeuanganController;

/*
|--------------------------------------------------------------------------
| 1. ALUR PROTEKSI & AUTENTIKASI (Pintu Masuk Awal)
|--------------------------------------------------------------------------
*/

// Halaman utama (Landing Page)
Route::get('/', function () {
    return view('welcome');
})->name('landing');

// Gerbang (Input Password Pengaman) - Sekarang pindah ke URL /gerbang
Route::get('/gerbang', [GerbangController::class, 'showGerbangForm'])->name('gerbang.form');
Route::post('/gerbang', [GerbangController::class, 'checkGerbangPassword'])->name('gerbang.check');

// Alur Login Admin Resmi
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/admin-cabang', [DashboardController::class, 'index']);
    Route::get('/dashboard/admin-ranting', [DashboardController::class, 'index']);
    Route::get('/dashboard/member', [DashboardController::class, 'index']);
});
// Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login.post');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(
    function () {
        /*
|--------------------------------------------------------------------------
| 2. DASHBOARD UTAMA (Pusat Navigasi & Statistik)
|--------------------------------------------------------------------------
*/
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


        /*
|--------------------------------------------------------------------------
| 3. PANEL ALUR ADMINISTRASI (Flow A, B, C - Melewati Controller Resmi)
|--------------------------------------------------------------------------
*/

        // Flow A: Input Pendaftaran Anggota Baru
        Route::get('/administrasi/pendaftaran', [InputDataController::class, 'create'])->name('pendaftaran.index');
        Route::post('/administrasi/pendaftaran', [InputDataController::class, 'store'])->name('pendaftaran.store');

        // Flow B: Validasi & Verifikasi Berkas oleh Pengurus
        Route::get('/administrasi/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
        Route::post('/administrasi/verifikasi/{id}', [VerifikasiController::class, 'proses'])->name('verifikasi.proses');

        // Flow C: Cetak Output Laporan Kelulusan & Set Tgl Awasul
        Route::get('/administrasi/output', [OutputController::class, 'index'])->name('output.index');
        Route::get('/administrasi/output/cetak', [\App\Http\Controllers\Administrasi\OutputController::class, 'cetakLaporan'])->name('output.cetak');
        Route::patch('/administrasi/output/{id}', [OutputController::class, 'updatePengesahan'])->name('output.update');

        /*
|--------------------------------------------------------------------------
| 4. MANAJEMEN INTERNAL (Data Master Organisasi)
|--------------------------------------------------------------------------
*/
        Route::get('/internal/keanggotaan', [KeanggotaanController::class, 'index'])->name('internal.keanggotaan');

        Route::get('/internal/operasional', [OperasionalController::class, 'index'])->name('internal.operasional');
        Route::post('/internal/operasional', [OperasionalController::class, 'store'])->name('internal.operasional.store');
        Route::put('/internal/operasional/{id}', [OperasionalController::class, 'update'])->name('internal.operasional.update');

        Route::get('/internal/keuangan-logistik', [KeuanganController::class, 'index'])->name('internal.keuangan');
        Route::post('/internal/keuangan-logistik', [KeuanganController::class, 'store'])->name('internal.keuangan.store');
        Route::put('/internal/keuangan-logistik/{id}', [KeuanganController::class, 'update'])->name('internal.keuangan.update');
        Route::delete('/internal/keuangan-logistik/{id}', [KeuanganController::class, 'destroy'])->name('internal.keuangan.destroy');

        /*
|--------------------------------------------------------------------------
| 5. RUTE TAMPILAN INFORMASI (Menu Navigasi 2 - 8)
|--------------------------------------------------------------------------
*/
        Route::get('/tentang', function () {
            return view('navigasi.tentang', ['title' => '2. Tentang IKSPI', 'icon' => 'fa-clock-rotate-left']);
        })->name('menu.tentang');

        Route::get('/legalitas', function () {
            return view('navigasi.legalitas', ['title' => '3. Tata Kelola & Legalitas', 'icon' => 'fa-file-shield']);
        })->name('menu.legalitas');

        Route::get('/ranting', function () {
            return view('navigasi.ranting', ['title' => '4. Data Ranting', 'icon' => 'fa-map-location-dot']);
        })->name('menu.ranting');

        Route::get('/struktur', function () {
            return view('navigasi.struktur', ['title' => '5. Struktur Organisasi', 'icon' => 'fa-sitemap']);
        })->name('menu.struktur');

        Route::get('/media', function () {
            return view('navigasi.media', ['title' => '6. Ruang Media', 'icon' => 'fa-images']);
        })->name('menu.media');

        Route::get('/pengesahan', function () {
            return view('navigasi.pengesahan', ['title' => '7. Data Pengesahan', 'icon' => 'fa-id-card-clip']);
        })->name('menu.pengesahan');

        Route::get('/kontak', function () {
            return view('navigasi.kontak', ['title' => '8. Kontak Cabang', 'icon' => 'fa-headset']);
        })->name('menu.kontak');
    }
);
