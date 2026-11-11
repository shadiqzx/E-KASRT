<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosyanduBalita extends Model
{
    protected $table = 'posyandu_balita';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_anak',
        'tanggal_lahir',
        'jenis_kelamin',
        'warga_id',
        'rfid_uid',
        'created_at',
    ];

    public function ortu()
    {
        return $this->belongsTo(DataWarga::class, 'warga_id', 'idWarga');
    }

    public function kehadiran()
    {
        return $this->hasMany(PosyanduKehadiran::class, 'balita_id', 'id');
    }
}

