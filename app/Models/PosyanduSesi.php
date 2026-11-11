<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosyanduSesi extends Model
{
    protected $table = 'posyandu_sesi';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_sesi',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
        'petugas',
        'catatan',
        'status',
        'created_at',
    ];

    public function kehadiran()
    {
        return $this->hasMany(PosyanduKehadiran::class, 'sesi_id', 'id');
    }
}

