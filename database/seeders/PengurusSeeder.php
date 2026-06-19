<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengurusSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan data lama sebelum seeding agar ID teratur
        DB::table('pengurus')->truncate();

        // 1. Insert Ketua Cabang (Parent utama, parent_id = null)
        $ketuaCabangId = DB::table('pengurus')->insertGetId([
            'nama' => 'Budi Santoso',
            'jabatan' => 'Ketua Cabang',
            'foto' => null,
            'urutan' => 1,
            'parent_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Insert Pengurus di bawah Ketua Cabang
        DB::table('pengurus')->insert([
            [
                'nama' => 'Siti Aminah',
                'jabatan' => 'Sekretaris Cabang',
                'foto' => null,
                'urutan' => 2,
                'parent_id' => $ketuaCabangId, // Menunjuk ke Ketua Cabang
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Andi Wijaya',
                'jabatan' => 'Ketua Ranting',
                'foto' => null,
                'urutan' => 3,
                'parent_id' => $ketuaCabangId, // Menunjuk ke Ketua Cabang
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
