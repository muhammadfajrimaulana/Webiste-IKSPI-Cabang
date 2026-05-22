<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama_pengurus' => 'Moh Ahlusiyam Ferliansyah',
            'username' => 'adminikspi',
            'password' => \Illuminate\Support\Facades\Hash::make('ikspi2026'),
            'role' => 'admin_cabang',
        ]);
    }
}
