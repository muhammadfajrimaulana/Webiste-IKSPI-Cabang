<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ranting_id');
            $table->string('nama_lengkap');
            $table->string('nik', 16);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('status_verifikasi')->default('pending');
            $table->string('foto')->nullable();
            $table->string('berkas_pdf')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();;
            $table->decimal('longitude', 11, 8)->nullable();;
            $table->timestamps();

            $table->foreign('ranting_id')->references('id')->on('rantings')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
