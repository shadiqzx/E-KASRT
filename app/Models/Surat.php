<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';
    public $timestamps = false;
    protected $fillable = ['warga_id', 'jenis_surat', 'keperluan', 'status', 'keterangan_admin', 'tanggal_pengajuan'];

    public function warga()
    {
        return $this->belongsTo(DataWarga::class, 'warga_id', 'idWarga');
    }
}

