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
            $table->string('nomor_anggota')->unique();
            $table->string('pas_foto')->nullable()->default('profile/default.png');
            $table->foreignId('pendaftaran_id')->constrained('pendaftarans')->onDelete('cascade');
            $table->foreignId('ranting_id')->constrained('rantings')->onDelete('cascade');
            $table->enum('tingkatan', ['Siswa', 'Warga TK 1', 'Warga TK 2', 'Warga TK 3',])->default('Siswa');
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