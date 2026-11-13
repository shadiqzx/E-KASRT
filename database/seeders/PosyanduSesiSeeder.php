<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PosyanduSesi;
use App\Models\PosyanduBalita;
use App\Models\DataWarga;

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

        // Jika balita masih kosong, hubungkan ke warga pertama
        if (PosyanduBalita::count() == 0) {
            $warga = DataWarga::first();
            if ($warga) {
                // Pastikan warga pertama punya RFID KTP untuk uji coba tap
                if (empty($warga->rfid_ktp)) {
                    $warga->rfid_ktp = '04E99A11B280';
                    $warga->save();
                }

                PosyanduBalita::create([
                    'nama_anak'     => 'Ananda ' . $warga->nama,
                    'tanggal_lahir' => date('Y-m-d', strtotime('-18 months')),
                    'jenis_kelamin' => 'L',
                    'warga_id'      => $warga->idWarga,
                    'rfid_uid'      => null
                ]);
            }
        }
    }
}
