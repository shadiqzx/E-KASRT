<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataWarga;
use App\Models\UserRole;

class DataWargaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles
        $roles = ['Administrator', 'Pengurus RT', 'Petugas Posyandu', 'Warga'];
        foreach ($roles as $r) {
            UserRole::firstOrCreate(['role' => $r]);
        }

        // 2. Data Warga Pokok
        $wargas = [
            [
                'nik' => '111222333444555',
                'rfid_ktp' => '04E99A11B280',
                'nama' => 'Yohan Riki',
                'jekel' => 'Laki-Laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1992-05-14',
                'alamat' => 'Jl. Mawar No. 01, RT 005/RW 012',
                'no_kk' => '3276011122330001',
                'hubungan_keluarga' => 'Kepala Keluarga',
                'no_rumah' => 'A-01',
                'no_hp' => '081234567890',
            ],
            [
                'nik' => '222333111444555',
                'rfid_ktp' => 'WWFASFEFASFD',
                'nama' => 'Ahmad Sidiq',
                'jekel' => 'Laki-Laki',
                'tempat_lahir' => 'Depok',
                'tanggal_lahir' => '1990-08-20',
                'alamat' => 'Jl. Mawar No. 02, RT 005/RW 012',
                'no_kk' => '3276012233440002',
                'hubungan_keluarga' => 'Kepala Keluarga',
                'no_rumah' => 'A-02',
                'no_hp' => '082345678901',
            ],
            [
                'nik' => '1112221113334444',
                'rfid_ktp' => '121212121212',
                'nama' => 'Echa Jesica',
                'jekel' => 'Perempuan',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1995-11-10',
                'alamat' => 'Jl. Melati No. 03, RT 005/RW 012',
                'no_kk' => '3276013344550003',
                'hubungan_keluarga' => 'Istri',
                'no_rumah' => 'B-01',
                'no_hp' => '083456789012',
            ],
            [
                'nik' => '111222111222444',
                'rfid_ktp' => '21212121212',
                'nama' => 'Rudi Hidayat',
                'jekel' => 'Laki-Laki',
                'tempat_lahir' => 'Bogor',
                'tanggal_lahir' => '1988-03-25',
                'alamat' => 'Jl. Melati No. 04, RT 005/RW 012',
                'no_kk' => '3276014455660004',
                'hubungan_keluarga' => 'Kepala Keluarga',
                'no_rumah' => 'B-02',
                'no_hp' => '084567890123',
            ],
            [
                'nik' => '333222111444555',
                'rfid_ktp' => 'OJOJOJO',
                'nama' => 'Elisabet',
                'jekel' => 'Perempuan',
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => '1994-07-18',
                'alamat' => 'Jl. Anggrek No. 05, RT 005/RW 012',
                'no_kk' => '3276015566770005',
                'hubungan_keluarga' => 'Kepala Keluarga',
                'no_rumah' => 'C-01',
                'no_hp' => '085678901234',
            ],
            [
                'nik' => '3276010101850001',
                'rfid_ktp' => null,
                'nama' => 'Budi Santoso',
                'jekel' => 'Laki-Laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1985-01-01',
                'alamat' => 'Jl. Kenanga No. 1, Blok A',
                'no_kk' => '3276010101850000',
                'hubungan_keluarga' => 'Kepala Keluarga',
                'no_rumah' => 'A-05',
                'no_hp' => '081234567890',
            ],
            [
                'nik' => '3276010202880002',
                'rfid_ktp' => null,
                'nama' => 'Siti Rahayu',
                'jekel' => 'Perempuan',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1988-02-02',
                'alamat' => 'Jl. Kenanga No. 5, Blok B',
                'no_kk' => '3276010202880000',
                'hubungan_keluarga' => 'Istri',
                'no_rumah' => 'B-05',
                'no_hp' => '082345678901',
            ],
            [
                'nik' => '3276010303900003',
                'rfid_ktp' => null,
                'nama' => 'Agus Wijaya',
                'jekel' => 'Laki-Laki',
                'tempat_lahir' => 'Depok',
                'tanggal_lahir' => '1990-03-03',
                'alamat' => 'Jl. Melati No. 8, Blok C',
                'no_kk' => '3276010303900000',
                'hubungan_keluarga' => 'Kepala Keluarga',
                'no_rumah' => 'C-05',
                'no_hp' => '083456789012',
            ],
        ];

        foreach ($wargas as $w) {
            DataWarga::updateOrCreate(['nik' => $w['nik']], $w);
        }
    }
}

