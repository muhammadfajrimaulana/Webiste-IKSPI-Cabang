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
    Schema::create('members', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->text('alamat');
        $table->string('foto')->nullable();
        $table->string('koordinat_gps')->nullable(); // Untuk integrasi Google Maps
        $table->enum('tingkatan', ['Polos', 'Sabuk Kuning', 'Sabuk Biru', 'Sabuk Merah', 'Warga']); 
        $table->enum('status_verifikasi', ['pending', 'approved'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
