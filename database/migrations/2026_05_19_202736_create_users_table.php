<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $col) {
            $col->id();
            $col->string('nama_pengurus');
            $col->string('username')->unique();
            $col->string('password');
            $col->string('role')->default('anggota');
            $col->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
