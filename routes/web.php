<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GerbangController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\BerandaController;
use App\Http\Controllers\Administrasi\InputDataController;
use App\Http\Controllers\Administrasi\VerifikasiController;
use App\Http\Controllers\Administrasi\OutputController;

// Halaman Publik (Tanpa Login)
// Route::get('/', function () { return view('welcome'); });

// Alur Proteksi Awal (Gerbang Utama)
Route::get('/', [GerbangController::class, 'showGerbangForm'])->name('gerbang.form');
Route::post('/', [GerbangController::class, 'checkGerbangPassword'])->name('gerbang.check');

// Alur Login Admin
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// ================================================== //
// DASHBOARD ADMINISTRATOR IKSPI CABANG JAKARTA PUSAT //
// ================================================== //


// Rute Tampilan Menu 2 - 8 (Navigasi)
Route::get('/tentang', function () {
    return view('navigasi.tentang', ['title' => '2. Tentang IKSPI']);
})->name('menu.tentang');
Route::get('/legalitas', function () {
    return view('navigasi.legalitas', ['title' => '3. Tata Kelola & Legalitas']);
})->name('menu.legalitas');
Route::get('/ranting', function () {
    return view('navigasi.ranting', ['title' => '4. Data Ranting']);
})->name('menu.ranting');
Route::get('/struktur', function () {
    return view('navigasi.struktur', ['title' => '5. Struktur Organisasi']);
})->name('menu.struktur');
Route::get('/media', function () {
    return view('navigasi.media', ['title' => '6. Ruang Media']);
})->name('menu.media');
Route::get('/pengesahan', function () {
    return view('navigasi.pengesahan', ['title' => '7. Data Pengesahan']);
})->name('menu.pengesahan');
Route::get('/kontak', function () {
    return view('navigasi.kontak', ['title' => '8. Kontak Cabang']);
})->name('menu.kontak');

// Panel Alur Administrasi (Dashboard)
Route::get('/dashboard', [BerandaController::class, 'index'])->name('dashboard');

Route::get('/administrasi/pendaftaran', [InputDataController::class, 'create'])->name('pendaftaran.create');
Route::get('/administrasi/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
Route::get('/administrasi/output', [OutputController::class, 'index'])->name('output.index');

Route::get('/administrasi/pendaftaran', function () {
    return view('administrasi.pendaftaran', ['title' => 'Flow A: Pendaftaran Baru']);
})->name('pendaftaran.index');

Route::get('/administrasi/verifikasi', function () {
    return view('administrasi.verifikasi', ['title' => 'Flow B: Verifikasi Pengurus']);
})->name('verifikasi.index');

Route::get('/administrasi/output', function () {
    return view('administrasi.output', ['title' => 'Flow C: Output Data']);
})->name('output.index');

// Rute untuk Grup Manajemen Internal
Route::get('/internal/keanggotaan', function () {
    return view('internal.keanggotaan', [
        'title' => '1. Manajemen Keanggotaan',
        'icon' => 'fa-users'
    ]);
})->name('internal.keanggotaan');

Route::get('/internal/operasional', function () {
    return view('internal.operasional', [
        'title' => '2. Operasional Ranting',
        'icon' => 'fa-building-shield'
    ]);
})->name('internal.operasional');

Route::get('/internal/keuangan-logistik', function () {
    return view('internal.keuangan', [
        'title' => '3. Keuangan & Logistik',
        'icon' => 'fa-wallet'
    ]);
})->name('internal.keuangan');
