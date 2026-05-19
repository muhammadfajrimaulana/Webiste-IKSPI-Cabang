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
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_anggota')->unique(); // Primary key relasi internal (Bukan NIK)
            $table->foreignId('pendaftaran_id')->constrained('pendaftarans')->onDelete('cascade');
            $table->foreignId('ranting_id')->constrained('rantings')->onDelete('cascade');
            $table->enum('tingkatan', ['Warga', 'Pendekar'])->default('Warga');
            $table->date('tanggal_pengesahan')->nullable(); // Diisi saat cetak laporan Flow C
            $table->enum('status_aktif', ['aktif', 'non-aktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
