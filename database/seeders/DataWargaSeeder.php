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

        // 2. Data Warga Pokok (pertahankan UID RFID yang sudah terdaftar)
        $wargas = [
            [
                'nik' => '111222333444555',
                'rfid_ktp' => '04E99A11B280',
                'nama' => 'Yohan Riki',
                'jekel' => 'Laki-Laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1992-05-14',
                'alamat' => 'Jl. Mawar No. 01, Blok A, RT 005/RW 012',
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
                'alamat' => 'Jl. Mawar No. 02, Blok A, RT 005/RW 012',
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
                'alamat' => 'Jl. Melati No. 01, Blok B, RT 005/RW 012',
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
                'alamat' => 'Jl. Melati No. 02, Blok B, RT 005/RW 012',
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
                'alamat' => 'Jl. Anggrek No. 01, Blok C, RT 005/RW 012',
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
                'alamat' => 'Jl. Mawar No. 05, Blok A, RT 005/RW 012',
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
                'alamat' => 'Jl. Melati No. 05, Blok B, RT 005/RW 012',
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
                'alamat' => 'Jl. Anggrek No. 05, Blok C, RT 005/RW 012',
                'no_kk' => '3276010303900000',
                'hubungan_keluarga' => 'Kepala Keluarga',
                'no_rumah' => 'C-05',
                'no_hp' => '083456789012',
            ],
        ];

        foreach ($wargas as $w) {
            DataWarga::updateOrCreate(['nik' => $w['nik']], $w);
        }

        // 3. Tambah 100 Data Warga Realistis Tersebar di 32 Rumah (Blok A - Blok D, termasuk Rumah Multi-KK)
        $blokStreets = [
            'A' => 'Jl. Mawar',
            'B' => 'Jl. Melati',
            'C' => 'Jl. Anggrek',
            'D' => 'Jl. Kenanga',
        ];

        $maleNames = [
            'Andi Pratama', 'Bayu Nugroho', 'Cahyo Utomo', 'Dimas Saputra', 'Eko Prasetyo',
            'Fajar Ramadhan', 'Gilang Permana', 'Hendra Kusuma', 'Irwan Setiawan', 'Joko Susilo',
            'Kurniawan Adi', 'Lukman Hakim', 'Miftahul Huda', 'Nanda Kurnia', 'Oki Wijaya',
            'Putra Mahendra', 'Qomarudin', 'Rizky Maulana', 'Slamet Riyadi', 'Taufik Hidayat',
            'Umar Bakri', 'Vino Bastian', 'Wahyu Hidayat', 'Yoga Aditya', 'Zainal Abidin',
            'Aditya Firmansyah', 'Bagus Setiadi', 'Dedi Mulyadi', 'Farhan Hakim', 'Galih Raka',
        ];

        $femaleNames = [
            'Ayu Lestari', 'Bunga Citra', 'Citra Dewi', 'Dewi Anggraini', 'Endah Puspita',
            'Fitri Handayani', 'Gita Permata', 'Hana Pertiwi', 'Indah Sari', 'intan Cahyani',
            'Kartika Sari', 'Lina Marlina', 'Maya Kusuma', 'Nadia Putri', 'Oktavia Rahma',
            'Putri Maharani', 'Qoriatul Aini', 'Ratna Sari', 'Sari Wulandari', 'Tari Novita',
            'Umi Kalsum', 'Vina Panduwinata', 'Wulan Dari', 'Yanti Susanti', 'Zahra Aulia',
            'Anisa Rahmawati', 'Bella Safira', 'Dina Mariana', 'Fika Amalia', 'Hesti Purwanti',
        ];

        $childNames = [
            'Alif Putra', 'Nayla Putri', 'Rafi Akbar', 'Keisha Azalea', 'Farel Ardiansyah',
            'Zaki Pratama', 'Aisyah Zahra', 'Daffa Alfarizi', 'Rania Khairunnisa', 'Kenzo Alvaro',
            'Cinta Kirana', 'Bima Sakti', 'Nadia Salsabila', 'Arka Wiratama', 'Salsa Nabila',
            'Rayyan Malik', 'Aqila Humaira', 'Gibran Rakabuming', 'Tiara Andini', 'Dzaky Ramadhan',
        ];

        $cities = ['Jakarta', 'Depok', 'Bogor', 'Bekasi', 'Tangerang', 'Bandung', 'Semarang', 'Surabaya', 'Yogyakarta', 'Solo'];

        // Bangun daftar 32 rumah (A-01..A-08, B-01..B-08, C-01..C-08, D-01..D-08)
        // Setiap rumah punya 1 atau 2 KK, total tepat 100 warga tambahan
        $generated = [];
        $counter = 0;
        $kkSeq = 1001;

        $housePlan = [];
        foreach (['A', 'B', 'C', 'D'] as $b) {
            for ($num = 1; $num <= 8; $num++) {
                $kode = sprintf('%s-%02d', $b, $num);
                $alamat = sprintf('%s No. %02d, Blok %s, RT 005/RW 012', $blokStreets[$b], $num, $b);
                // Rumah nomor 2, 4, 7 di tiap blok memiliki 2 KK dalam 1 rumah (8 rumah multi-KK)
                $kkCount = in_array($num, [3, 6], true) ? 2 : 1;
                $housePlan[] = [
                    'kode' => $kode,
                    'alamat' => $alamat,
                    'kk_count' => $kkCount,
                ];
            }
        }

        // Total KK = 24 * 1 + 8 * 2 = 40 KK.
        // Untuk menghasilkan tepat 100 warga: 20 KK berisi 3 jiwa (60) + 20 KK berisi 2 jiwa (40) = 100 jiwa!
        $kkIndex = 0;
        foreach ($housePlan as $house) {
            for ($k = 1; $k <= $house['kk_count']; $k++) {
                $kkIndex++;
                $noKk = sprintf('327605261126%04d', $kkSeq++);
                $membersInKk = ($kkIndex <= 20) ? 3 : 2;

                for ($m = 1; $m <= $membersInKk; $m++) {
                    $counter++;
                    $nik = sprintf('327605%06d%04d', 100000 + $counter, $counter);

                    if ($m === 1) {
                        $hub = 'Kepala Keluarga';
                        $jekel = 'Laki-Laki';
                        $nama = $maleNames[($counter - 1) % count($maleNames)] . ($counter > 30 ? ' ' . chr(65 + ($counter % 20)) : '');
                        $year = 1975 + ($counter % 20);
                    } elseif ($m === 2) {
                        $hub = 'Istri';
                        $jekel = 'Perempuan';
                        $nama = ucwords($femaleNames[($counter - 1) % count($femaleNames)]) . ($counter > 30 ? ' ' . chr(65 + (($counter + 5) % 20)) : '');
                        $year = 1978 + ($counter % 20);
                    } else {
                        $hub = 'Anak';
                        $jekel = ($counter % 2 === 0) ? 'Perempuan' : 'Laki-Laki';
                        $nama = $childNames[($counter - 1) % count($childNames)];
                        $year = 2006 + ($counter % 16);
                    }

                    $month = (($counter % 12) + 1);
                    $day = (($counter % 27) + 1);

                    $generated[] = [
                        'nik' => $nik,
                        'rfid_ktp' => null,
                        'no_kk' => $noKk,
                        'nama' => $nama,
                        'jekel' => $jekel,
                        'hubungan_keluarga' => $hub,
                        'tempat_lahir' => $cities[$counter % count($cities)],
                        'tanggal_lahir' => sprintf('%04d-%02d-%02d', $year, $month, $day),
                        'alamat' => $house['alamat'],
                        'no_rumah' => $house['kode'],
                        'no_hp' => sprintf('0812%08d', 10000000 + $counter),
                        'status_warga' => 'Aktif',
                    ];
                }
            }
        }

        foreach ($generated as $w) {
            DataWarga::updateOrCreate(['nik' => $w['nik']], $w);
        }
    }
}
