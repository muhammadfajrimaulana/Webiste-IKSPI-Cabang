<?php

namespace App\Http\Controllers;

use App\Models\{Anggota, Ranting, Pendaftaran, Transaksi, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'anggota') {
            return view('dashboard', [
                'title' => 'Dashboard Anggota'
            ]);
        }

        $queryAnggota = Anggota::query();
        $queryPendaftaran = Pendaftaran::where('status_verifikasi', 'pending');
        $queryTransaksi = Transaksi::query();

        if (Gate::allows('is-ranting')) {
            $queryAnggota->where('ranting_id', $user->ranting_id);
            $queryPendaftaran->where('ranting_id', $user->ranting_id);
            $queryTransaksi->where('ranting_id', $user->ranting_id);
        }

        $totalMasuk = (clone $queryTransaksi)->where('tipe', 'masuk')->sum('nominal');
        $totalKeluar = (clone $queryTransaksi)->where('tipe', 'keluar')->sum('nominal');

        return view('dashboard', [
            'title'             => 'Dashboard ' . ucfirst(str_replace('_', ' ', $user->role)),
            'totalAnggota'      => $queryAnggota->count(),
            'totalRanting'      => Gate::allows('is-cabang') ? Ranting::count() : 0,
            'totalVerifikasi'   => $queryPendaftaran->count(),
            'totalSaldo'        => $totalMasuk - $totalKeluar,
            'antreanPendaftaran' => $queryPendaftaran->latest()->take(5)->get(),
            'userRanting'       => $user->ranting
        ]);
    }

    public function profile()
    {
        $user = Auth::user();

        return view('profile/profile', [
            'title' => 'Profil ' . ucfirst(str_replace('_', ' ', $user->role)),
            'user'  => $user,
        ]);
    }

    public function editProfile()
    {
        $user = Auth::user();

        return view('profile/edit', [
            'title' => 'Edit Profil ' . ucfirst(str_replace('_', ' ', $user->role)),
            'user'  => $user,
        ]);
    }

    public function checkUsername(Request $request)
    {
        $username = $request->input('username');
        $userId = Auth::id();

        $exists = User::where('username', $username)
            ->where('id', '!=', $userId)
            ->exists();

        return response()->json([
            'available' => !$exists
        ]);
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'nama_pengurus' => ['required', 'string', 'max:255'],
            'username'      => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'avatar'        => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // Maksimal 2MB
        ]);

        $data = [
            'nama_pengurus' => $request->nama_pengurus,
            'username'      => $request->username,
        ];

        if ($request->hasFile('avatar')) {
            if ($user->avatar && !Str::startsWith($user->avatar, 'http')) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('profile', 'public');
            $data['avatar'] = $path;
        }

        $user->update($data);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'     => 'required|current_password',
            'password'             => 'required|string|min:6|confirmed|regex:/[a-z]/i|regex:/[0-9]/',
        ], [
            'current_password.current_password' => 'Password saat ini tidak sesuai.',
            'password.confirmed'                => 'Konfirmasi password baru tidak cocok.',
            'password.regex'                    => 'Password baru harus mengandung kombinasi huruf dan angka.',
        ]);

        /** @var User $user */
        $user = User::findOrFail(Auth::id());

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return back()->with('success', 'Password berhasil diubah.');
    }
}
