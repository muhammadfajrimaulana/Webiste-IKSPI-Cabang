<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        // 1. Cek dulu, dia udah lewat Gerbang belum?
        // Kalo belom, lempar paksa ke halaman Gerbang
        if (!session()->has('gerbang_terlewati')) {
            return redirect()->route('gerbang.form')
                ->with('error', 'Akses ditolak! Lewati gerbang utama terlebih dahulu.');
        }

        // 2. Kalo udah lewat Gerbang, baru cek apakah dia udah login sebagai admin?
        // Kalo udah login, langsung bawa ke dashboard
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        // 3. Kalo belom login tapi udah lewat gerbang, baru tampilin form login
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->with('error', 'Username atau password salah, harap periksa kembali.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
