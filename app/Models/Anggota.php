<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = ['nomor_anggota', 'pendaftaran_id', 'ranting_id', 'tingkatan', 'tanggal_pengesahan', 'status_aktif'];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function ranting()
    {
        return $this->belongsTo(Ranting::class);
    }
}
