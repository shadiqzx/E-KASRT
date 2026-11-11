<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosyanduKehadiran extends Model
{
    protected $table = 'posyandu_kehadiran';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'sesi_id',
        'balita_id',
        'jam_datang',
        'metode_absen',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'lila',
        'status_gizi',
        'vitamin_a',
        'obat_cacing',
        'imunisasi',
        'catatan',
        'rfid_uid',
    ];

    public function balita()
    {
        return $this->belongsTo(PosyanduBalita::class, 'balita_id', 'id');
    }

    public function sesi()
    {
        return $this->belongsTo(PosyanduSesi::class, 'sesi_id', 'id');
    }
}

