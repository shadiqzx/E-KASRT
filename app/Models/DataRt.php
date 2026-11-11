<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataRt extends Model
{
    protected $table = 'data_rt';
    public $timestamps = false;
    protected $fillable = [
        'rt_number', 'rw_number', 'kelurahan', 'kecamatan', 'kota', 'provinsi',
        'kode_pos', 'luas_wilayah', 'jumlah_kk', 'visi', 'misi', 'sejarah',
        'qris_image', 'jam_kerja_rt', 'norek_bca', 'norek_mandiri'
    ];
}

