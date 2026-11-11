<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'aspirasi';
    public $timestamps = false;
    protected $fillable = ['nama_pengirim', 'kategori', 'isi', 'tanggal_kirim'];
}

