<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftaran extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['ranting_id', 'nama_lengkap', 'nik', 'tempat_lahir', 'tanggal_lahir', 'tingkatan', 'no_hp', 'alamat', 'status_verifikasi', 'pas_foto', 'berkas_pdf', 'latitude', 'longitude'];

    public function ranting(): BelongsTo
    {
        return $this->belongsTo(Ranting::class, 'ranting_id');
    }

    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'pendaftaran_id');
    }
}
