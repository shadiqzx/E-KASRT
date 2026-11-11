<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataWarga extends Model
{
    protected $table = 'data_warga';
    protected $primaryKey = 'idWarga';
    public $timestamps = false;

    protected $fillable = [
        'nik',
        'rfid_ktp',
        'no_kk',
        'nama',
        'jekel',
        'hubungan_keluarga',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_rumah',
    ];

    public function balitas()
    {
        return $this->hasMany(PosyanduBalita::class, 'warga_id', 'idWarga');
    }
}

