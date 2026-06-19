<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table = 'pengurus';

    protected $fillable = ['nama', 'jabatan', 'foto', 'urutan', 'parent_id'];

    public function anakBuah()
    {
        return $this->hasMany(Pengurus::class, 'parent_id')->orderBy('urutan', 'asc');
    }

    public function bos()
    {
        return $this->belongsTo(Pengurus::class, 'parent_id');
    }
}
