<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Mengizinkan field ini diisi lewat mass assignment
    protected $fillable = ['judul', 'isi', 'thumbnail', 'kategori'];
}
