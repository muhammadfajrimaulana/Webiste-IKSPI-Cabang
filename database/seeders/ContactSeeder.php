<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contacts')->insert([
            // Kontak Cabang
            [
                'nama' => 'Ketua Cabang',
                'jabatan' => 'Pimpinan Pusat',
                'nomor_wa' => '628123456789',
                'level' => 'cabang',
                'ranting_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Contoh Kontak Ranting (Asumsi ada ranting_id 1)
            [
                'nama' => 'Ketua Ranting A',
                'jabatan' => 'Ketua Ranting',
                'nomor_wa' => '628987654321',
                'level' => 'ranting',
                'ranting_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
