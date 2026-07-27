<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ranting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login', ['title' => 'Login - IKSPI Jakpus']);
    }

    public function login(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // 2. Cek apakah user ada dan password benar
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // 3. Arahkan berdasarkan role
            $user = Auth::user();

            return match ($user->role) {
                'admin_cabang' => redirect()->intended('/dashboard/admin-cabang'),
                'admin_ranting' => redirect()->intended('/dashboard/admin-ranting'),
                default => redirect()->intended('/dashboard/member'),
            };
        }

        // 4. Jika login gagal
        throw ValidationException::withMessages([
            'username' => 'Username atau Password salah. Silakan coba kembali.',
        ]);
    }

    public function resetPassword(Request $request, $id)
    {
        // Cari data ranting berdasarkan ID yang dikirim dari tombol
        $ranting = Ranting::findOrFail($id);

        // Cari akun user yang memiliki ranting_id yang sama dengan ranting tersebut
        $user = User::where('ranting_id', $ranting->id)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Akun user untuk ranting ' . $ranting->nama_ranting . ' tidak ditemukan.');
        }

        // Reset password user
        $user->password = Hash::make('ikspi123');
        $user->save();

        return redirect()->back()->with('success', 'Password untuk akun Ranting ' . $ranting->nama_ranting . ' (Username: ' . $user->username . ') berhasil direset menjadi: ikspi123');
    }

    public function logout(Request $request)
    {
        // 1. Proses logout
        Auth::logout();

        // 2. Invalidate session supaya aman
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 3. Balikin ke halaman login
        return redirect('/login');
    }
}
