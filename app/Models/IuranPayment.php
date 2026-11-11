<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IuranPayment extends Model
{
    protected $table = 'iuran_payment';
    public $timestamps = false;
    protected $fillable = ['warga_id', 'bulan', 'tahun', 'jumlah', 'metode', 'bukti_bayar', 'status', 'tanggal_bayar'];

    public function warga()
    {
        return $this->belongsTo(DataWarga::class, 'warga_id', 'idWarga');
    }
}

