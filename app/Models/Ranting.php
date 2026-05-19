<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ranting extends Model
{
    protected $fillable = ['nama_ranting', 'nama_pelatih', 'lokasi_latihan', 'kontak_ranting'];

    // Satu ranting punya banyak pendaftar
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    // Satu ranting punya banyak anggota resmi
    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }
}
