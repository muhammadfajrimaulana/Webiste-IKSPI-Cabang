<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['visi', 'misi', 'sejarah', 'legalitas_nama', 'legalitas_file'];
}
