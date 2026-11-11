<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankSampah extends Model
{
    protected $table = 'bank_sampah';
    public $timestamps = false;
    protected $fillable = ['warga_id', 'jenis_sampah', 'berat', 'poin', 'tanggal'];

    public function warga()
    {
        return $this->belongsTo(DataWarga::class, 'warga_id', 'idWarga');
    }
}

