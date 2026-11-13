<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PosyanduSesi;

class PosyanduSesiSeeder extends Seeder
{
    public function run(): void
    {
        PosyanduSesi::firstOrCreate(
            ['status' => 'Aktif'],
            [
                'nama_sesi'     => 'Posyandu Balita Terpadu RT',
                'tanggal'       => date('Y-m-d'),
                'waktu_mulai'   => '08:00',
                'waktu_selesai' => '12:00',
                'lokasi'        => 'Balai Warga RT',
                'petugas'       => 'Bidan Posyandu RT',
                'status'        => 'Aktif'
            ]
        );
    }
}
