<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Kalau user tidak login atau role-nya tidak ada di daftar yang diizinkan
        if (!$request->user() || !in_array($request->user()->role, $roles)) {

            // Menghentikan request dan menampilkan halaman 403 bawaan Laravel
            abort(403, 'Anda tidak memiliki hak akses untuk halaman ini.');
        }

        return $next($request);
    }
}
