<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    protected $table = 'aset';
    public $timestamps = false;
    protected $fillable = ['nama_barang', 'jumlah', 'kondisi', 'lokasi'];
}

