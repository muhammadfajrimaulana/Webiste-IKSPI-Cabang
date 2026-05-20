<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GerbangController extends Controller
{
    public function showGerbangForm()
    {
        return view('auth.gerbang', ['title' => 'Gerbang Utama - IKSPI Jakpus']);
    }

    public function checkGerbangPassword(Request $request)
    {
        $request->validate([
            'password_gerbang' => 'required',
        ]);

        if ($request->password_gerbang === 'IKSPI2026') {
            session(['gerbang_terlewati' => true]);

            return redirect()->route('login');
        }

        return back()->withErrors(['password_gerbang' => 'Password Gerbang Salah!']);
    }
}
