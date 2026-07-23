<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ranting;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $ranting1 = \App\Models\Ranting::where('nama_ranting', 'Ranting Kemayoran')->first();
        $ranting2 = \App\Models\Ranting::where('nama_ranting', 'Ranting Tanah Abang')->first();
        $ranting3 = \App\Models\Ranting::where('nama_ranting', 'Ranting Gambir')->first();
        $ranting4 = \App\Models\Ranting::where('nama_ranting', 'Ranting Sawah Besar')->first();
        $ranting5 = \App\Models\Ranting::where('nama_ranting', 'Ranting Menteng')->first();
        $ranting6 = \App\Models\Ranting::where('nama_ranting', 'Ranting Johar Baru')->first();
        $ranting7 = \App\Models\Ranting::where('nama_ranting', 'Ranting Senen')->first();
        $ranting8 = \App\Models\Ranting::where('nama_ranting', 'Ranting Cempaka Putih')->first();

        // 1. Buat Testing Admin Cabang
        $namaAdminCabang = 'Admin Cabang';
        User::create([
            'avatar'        => 'https://ui-avatars.com/api/?name=' . urlencode($namaAdminCabang) . '&background=0f172a&color=fff',
            'nama_pengurus' => 'Admin Cabang',
            'username'      => 'admin_cabang',
            'password'      => Hash::make('cabang1ksp1'),
            'role'          => 'admin_cabang',
            'ranting_id'    => null,
        ]);

        // 2. Buat Testing Admin Ranting
        $adminRantingList = [
            ['nama' => 'Admin Kemayoran', 'user' => 'admin_kemayoran', 'ranting' => $ranting1],
            ['nama' => 'Admin Tanah Abang', 'user' => 'admin_tanahabang', 'ranting' => $ranting2],
            ['nama' => 'Admin Gambir', 'user' => 'admin_gambir', 'ranting' => $ranting3],
            ['nama' => 'Admin Sawah Besar', 'user' => 'admin_sawahbesar', 'ranting' => $ranting4],
            ['nama' => 'Admin Menteng', 'user' => 'admin_menteng', 'ranting' => $ranting5],
            ['nama' => 'Admin Johar Baru', 'user' => 'admin_joharbaru', 'ranting' => $ranting6],
            ['nama' => 'Admin Senen', 'user' => 'admin_senen', 'ranting' => $ranting7],
            ['nama' => 'Admin Cempaka Putih', 'user' => 'admin_cempakaputih', 'ranting' => $ranting8],
        ];

        foreach ($adminRantingList as $admin) {
            if ($admin['ranting']) {
                User::updateOrCreate(['username' => $admin['user']], [
                    'avatar'        => 'https://ui-avatars.com/api/?name=' . urlencode($admin['nama']) . '&background=dc2626&color=fff',
                    'nama_pengurus' => $admin['nama'],
                    'password'      => Hash::make('ranting1ksp1'),
                    'role'          => 'admin_ranting',
                    'ranting_id'    => $admin['ranting']->id,
                ]);
            }
        }

        // 3. Buat Testing Anggota
        $anggotas = [
            ['nama' => 'Budi', 'ranting_id' => $ranting1->id],
            ['nama' => 'Siti', 'ranting_id' => $ranting2->id],
            ['nama' => 'Andi', 'ranting_id' => $ranting3->id],
        ];

        foreach ($anggotas as $anggota) {
            User::create([
                'avatar'        => 'https://ui-avatars.com/api/?name=' . urlencode($anggota['nama']) . '&background=475569&color=fff',
                'nama_pengurus' => $anggota['nama'],
                'username'      => strtolower(str_replace(' ', '_', $anggota['nama'])),
                'password'      => Hash::make('anggota1ksp1'),
                'role'          => 'anggota',
                'ranting_id'    => $anggota['ranting_id'],
            ]);
        }
    }
}
