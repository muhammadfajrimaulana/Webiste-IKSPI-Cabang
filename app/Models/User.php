<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['nama_lengkap', 'username', 'password', 'role', 'ranting_id',];

    public function ranting()
    {
        return $this->belongsTo(Ranting::class);
    }
}
