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
        ]);
    }
}
