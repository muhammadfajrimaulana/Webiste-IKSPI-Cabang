<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = ['id'];

    public function ranting()
    {
        return $this->belongsTo(Ranting::class, 'ranting_id');
    }
}
