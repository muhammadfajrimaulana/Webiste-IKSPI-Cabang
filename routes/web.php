<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\GerbangController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\Navigasi\DataRantingController;
use App\Http\Controllers\Navigasi\DataPengesahanController;
use App\Http\Controllers\Navigasi\TentangController;
use App\Http\Controllers\Navigasi\LegalitasController;
use App\Http\Controllers\Navigasi\PengurusController;
use App\Http\Controllers\Navigasi\PostController;
use App\Http\Controllers\Navigasi\ContactController;

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


Route::middleware(['auth'])->group(
    function () {
        /*
|--------------------------------------------------------------------------
| 2. DASHBOARD UTAMA (Pusat Navigasi & Statistik)
|--------------------------------------------------------------------------
*/
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::get('/profile/edit', [DashboardController::class, 'editProfile'])->name('profile.edit');
    }
);

Route::middleware(['auth', 'role:admin_cabang,admin_ranting'])->group(
    function () {
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
        Route::get('/tentang', [\App\Http\Controllers\Navigasi\TentangController::class, 'index'])->name('menu.tentang');

        Route::get('/legalitas', [\App\Http\Controllers\Navigasi\LegalitasController::class, 'index'])->name('menu.legalitas');

        Route::get('/ranting', [\App\Http\Controllers\Navigasi\DataRantingController::class, 'daftarRanting'])->name('menu.ranting');
        Route::put('/ranting/update/{id}', [\App\Http\Controllers\Navigasi\DataRantingController::class, 'updateRanting'])->name('menu.ranting.update');

        Route::get('/struktur', [PengurusController::class, 'index'])->name('menu.struktur');

        Route::get('/media', [\App\Http\Controllers\Navigasi\PostController::class, 'index'])->name('menu.media');

        Route::get('/pengesahan', [\App\Http\Controllers\Navigasi\DataPengesahanController::class, 'daftarPengesahan'])->name('menu.pengesahan');
        Route::put('/pengesahan/update/{id}', [\App\Http\Controllers\Navigasi\DataPengesahanController::class, 'updatePengesahan'])->name('menu.pengesahan.update');
        Route::get('/pengesahan/cetak', [\App\Http\Controllers\Navigasi\DataPengesahanController::class, 'cetak'])->name('menu.pengesahan.cetak');

        Route::get('/kontak', [\App\Http\Controllers\Navigasi\ContactController::class, 'index'])->name('menu.kontak');
    }
);

Route::middleware(['auth', 'role:anggota'])->group(
    function () {
        /*
|--------------------------------------------------------------------------
| 6. RUTE KHUSUS ANGGOTA
|--------------------------------------------------------------------------
*/
        Route::name('anggota.')->group(function () {
            Route::get('/anggota/profil', function () {
                return view('anggota.profil');
            })->name('profil');
            Route::get('/anggota/pengesahan', function () {
                return view('anggota.pengesahan');
            })->name('pengesahan');
            Route::get('/anggota/iuran', function () {
                return view('anggota.iuran');
            })->name('iuran');
            Route::get('/anggota/password', function () {
                return view('anggota.password');
            })->name('password');
            Route::get('/anggota/jadwal', function () {
                return view('anggota.jadwal');
            })->name('jadwal');
            Route::get('/anggota/info', function () {
                return view('anggota.info');
            })->name('info');
            Route::get('/anggota/bantuan', function () {
                return view('anggota.bantuan');
            })->name('bantuan');
        });
    }
);


Route::middleware(['auth', 'role:admin_cabang'])->group(function () {
    /*
|--------------------------------------------------------------------------
| 6. RUTE KHUSUS ADMIN CABANG EDIT KONTEN
|--------------------------------------------------------------------------
*/
    Route::put('/tentang/update', [TentangController::class, 'update'])->name('menu.tentang.update');
    Route::post('/legalitas/store', [LegalitasController::class, 'store'])->name('menu.legalitas.store');
    Route::post('/struktur', [PengurusController::class, 'store'])->name('menu.struktur.store');
    Route::put('/struktur/{pengurus}', [PengurusController::class, 'update'])->name('menu.struktur.update');
    Route::delete('/struktur/{pengurus}', [PengurusController::class, 'destroy'])->name('menu.struktur.destroy');
    Route::post('/media', [PostController::class, 'store'])->name('menu.media.store');
    Route::put('/media/{post}', [PostController::class, 'update'])->name('menu.media.update');
    Route::delete('/media/{post}', [PostController::class, 'destroy'])->name('menu.media.destroy');
    Route::post('/kontak', [ContactController::class, 'store'])->name('menu.kontak.store');
});
