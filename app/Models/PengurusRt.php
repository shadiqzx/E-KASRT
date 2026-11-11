<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengurusRt extends Model
{
    protected $table = 'pengurus_rt';
    public $timestamps = false;
    protected $fillable = ['nama', 'jabatan', 'no_hp', 'email', 'alamat', 'foto', 'periode_mulai', 'periode_selesai', 'status_aktif'];
}

