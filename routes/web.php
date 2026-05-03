<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\RantingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. Halaman Publik (Tanpa Login)
Route::get('/', function () {
    return view('welcome');
});

// 2. Rute yang Membutuhkan Login (Auth)
Route::middleware('auth')->group(function () {
    
    // Dashboard Utama (Akan diarahkan oleh MemberController@index)
    Route::get('/dashboard', [MemberController::class, 'index'])->name('dashboard');

    // Manajemen Profil (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- FITUR IKSPI (Berdasarkan Diagram) ---

    // Alur A: Input Data & Dashboard Anggota (Akses Level 2)
    Route::prefix('anggota')->group(function () {
        Route::get('/', [MemberController::class, 'index'])->name('member.index');
        Route::get('/tambah', [MemberController::class, 'create'])->name('member.create');
        Route::post('/simpan', [MemberController::class, 'store'])->name('member.store');
    });

    // Alur B: Verifikasi & Ranting (Akses Level 1 - Admin)
    Route::get('/ranting', [RantingController::class, 'index'])->name('ranting.index');
    // Nanti kamu bisa tambah Route::post('/verifikasi/{id}', ...) di sini
});

Route::patch('/anggota/{id}/verifikasi', [MemberController::class, 'verify'])->name('member.verify');

require __DIR__.'/auth.php';