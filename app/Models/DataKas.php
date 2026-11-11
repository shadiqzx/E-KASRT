<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataKas extends Model
{
    protected $table = 'data_kas';
    protected $primaryKey = 'idKas';
    public $timestamps = false;

    protected $fillable = [
        'keterangan',
        'tanggal',
        'jumlah',
        'jenis',
    ];
}

