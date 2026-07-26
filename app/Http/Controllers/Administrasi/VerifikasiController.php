<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class VerifikasiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = Pendaftaran::with('ranting');

        if ($user->role === 'admin_ranting') {
            $query->where('ranting_id', $user->ranting_id);
        } else {
            $query->where('status_verifikasi', 'pending');
        }

        $antrean = $query->latest()->get();
        return view('administrasi.verifikasi', compact('antrean'));
    }

    public function proses(Request $request, $id)
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::findOrFail($id);

        if ($user->role === 'admin_ranting' && $pendaftaran->ranting_id !== $user->ranting_id) {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $request->validate(['action' => 'required|in:setujui,tolak']);

        DB::transaction(function () use ($request, $pendaftaran) {
            if ($request->action === 'setujui') {

                $pendaftaran->update(['status_verifikasi' => 'verified']);

                $firstName = explode(' ', $pendaftaran->nama_lengkap)[0];
                $username = strtolower($firstName) . rand(100, 999);

                // Auto membuat akun dengan role anggota (Saat ini di-off kan jadi jangan dihapus!)
                // $newUser = User::create([
                //     'name'          => $pendaftaran->nama_lengkap,
                //     'email'         => $pendaftaran->email,
                //     'username'      => $username,
                //     'nama_pengurus' => $pendaftaran->nama_lengkap,
                //     'password'      => Hash::make('ikspi123'),
                //     'role'          => 'anggota',
                // ]);

                Anggota::create([
                    'user_id'            => null,
                    'pendaftaran_id'     => $pendaftaran->id,
                    'ranting_id'         => $pendaftaran->ranting_id,
                    'nomor_anggota'      => 'IKS-' . date('Y') . '-' . str_pad($pendaftaran->id, 4, '0', STR_PAD_LEFT),
                    'tingkatan'          => $pendaftaran->tingkatan,
                    'status_aktif'       => 'aktif',
                    'tanggal_pengesahan' => date('Y-m-d'),
                ]);

                $this->msg = 'Data ' . $pendaftaran->nama_lengkap . ' berhasil diverifikasi, akun dibuat (Pass: password123).';
            } else {
                $pendaftaran->update(['status_verifikasi' => 'rejected', 'catatan' => $request->catatan]);
                $this->msg = 'Data ' . $pendaftaran->nama_lengkap . ' ditolak.';
            }
        });

        return redirect()->back()->with('success', $this->msg);
    }
    protected $msg;

    public function lihatBerkas($filename)
    {
        $path = $filename;

        $fullPath = storage_path('app/public/' . $path);

        if (!file_exists($fullPath)) {
            abort(404, "File tidak ditemukan di: " . $fullPath);
        }

        return response()->file($fullPath);
    }
}
