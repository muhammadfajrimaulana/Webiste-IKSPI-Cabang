<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['nama', 'jabatan', 'nomor_wa', 'level', 'ranting_id'];
}
