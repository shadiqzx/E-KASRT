<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosyanduTapLog extends Model
{
    protected $table = 'posyandu_tap_log';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'uid',
        'status',
        'keterangan',
        'warga_id',
        'created_at',
    ];

    public function warga()
    {
        return $this->belongsTo(DataWarga::class, 'warga_id', 'idWarga');
    }
}

