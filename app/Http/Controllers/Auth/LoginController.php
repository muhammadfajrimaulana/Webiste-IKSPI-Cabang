<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login', ['title' => 'Login Pengurus - IKSPI Jakpus']);
    }

    public function login(Request $request)
    {
        // Sementara bypass langsung ke dashboard untuk cek tampilan
        return redirect()->route('dashboard');
    }
}
