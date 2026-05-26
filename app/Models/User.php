<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['nama_lengkap', 'nama_pengurus', 'username', 'password', 'role', 'ranting_id',];

    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'user_id', 'id');
    }

    public function ranting()
    {
        return $this->belongsTo(Ranting::class);
    }
}
