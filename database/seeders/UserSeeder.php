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

        // 1. Buat Testing Admin Cabang
        User::create([
            'nama_pengurus' => 'Admin Cabang Utama',
            'username'      => 'admin_cabang',
            'password'      => Hash::make('cabang1ksp1'),
            'role'          => 'admin_cabang',
            'ranting_id'    => null,
        ]);

        // 2. Buat Testing Admin Ranting
        User::create([
            'nama_pengurus' => 'Admin Ranting',
            'username'      => 'admin_ranting',
            'password'      => Hash::make('ranting1ksp1'),
            'role'          => 'admin_ranting',
            'ranting_id'    => $ranting3->id,
        ]);

        // 3. Buat Testing Anggota
        $anggotas = [
            ['nama' => 'Budi', 'ranting_id' => $ranting1->id],
            ['nama' => 'Siti', 'ranting_id' => $ranting2->id],
            ['nama' => 'Andi', 'ranting_id' => $ranting3->id],
        ];

        foreach ($anggotas as $anggota) {
            User::create([
                'nama_pengurus' => $anggota['nama'],
                'username'      => strtolower(str_replace(' ', '_', $anggota['nama'])),
                'password'      => Hash::make('anggota1ksp1'),
                'role'          => 'anggota',
                'ranting_id'    => $anggota['ranting_id'],
            ]);
        }
    }
}
