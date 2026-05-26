<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rantings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ranting')->unique();
            $table->string('ketua_ranting');
            $table->text('alamat_ranting');
            $table->string('nama_pelatih');
            $table->text('lokasi_latihan');
            $table->string('kontak_ranting')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rantings');
    }
};
