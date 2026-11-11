<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiTransfer extends Model
{
    protected $table = 'transaksi_transfer';
    public $timestamps = false;
    protected $fillable = ['warga_id', 'jenis', 'jumlah', 'keterangan', 'metode', 'bukti_bayar', 'rekening_info', 'status', 'created_at'];

    public function warga()
    {
        return $this->belongsTo(DataWarga::class, 'warga_id', 'idWarga');
    }
}

