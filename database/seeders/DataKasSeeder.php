<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataKas;

class DataKasSeeder extends Seeder
{
    public function run(): void
    {
        if (DataKas::count() === 0) {
            $kas = [
                ['keterangan' => 'Beli Printer L5190', 'tanggal' => '2026-06-01', 'jumlah' => '3750000', 'jenis' => 'Keluar'],
                ['keterangan' => 'Iuran warga mingguan', 'tanggal' => '2026-06-05', 'jumlah' => '5900000', 'jenis' => 'Masuk'],
                ['keterangan' => 'Iuran warga bulanan', 'tanggal' => '2026-06-10', 'jumlah' => '7800000', 'jenis' => 'Masuk'],
                ['keterangan' => 'Pembelian dispenser balai warga', 'tanggal' => '2026-06-15', 'jumlah' => '560000', 'jenis' => 'Keluar'],
                ['keterangan' => 'Pembelian ATK dan stempel RT', 'tanggal' => '2026-06-20', 'jumlah' => '100000', 'jenis' => 'Keluar'],
                ['keterangan' => 'Dana Lomba 17 Agustus', 'tanggal' => '2026-07-01', 'jumlah' => '3000000', 'jenis' => 'Keluar'],
                ['keterangan' => 'Iuran kebersihan lingkungan', 'tanggal' => '2026-07-05', 'jumlah' => '2500000', 'jenis' => 'Masuk'],
            ];

            foreach ($kas as $k) {
                DataKas::create($k);
            }
        }
    }
}

