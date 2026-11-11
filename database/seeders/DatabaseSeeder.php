<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@kasrt.com'],
            [
                'name'              => 'Admin RT',
                'password'          => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // Buat data transaksi contoh
        $contohData = [
            ['type' => 'pemasukan',    'amount' => 150000,  'description' => 'Iuran bulanan – Warga No. 1',   'transaction_date' => '2026-07-01'],
            ['type' => 'pemasukan',    'amount' => 150000,  'description' => 'Iuran bulanan – Warga No. 2',   'transaction_date' => '2026-07-01'],
            ['type' => 'pemasukan',    'amount' => 150000,  'description' => 'Iuran bulanan – Warga No. 3',   'transaction_date' => '2026-07-02'],
            ['type' => 'pemasukan',    'amount' => 150000,  'description' => 'Iuran bulanan – Warga No. 4',   'transaction_date' => '2026-07-03'],
            ['type' => 'pemasukan',    'amount' => 150000,  'description' => 'Iuran bulanan – Warga No. 5',   'transaction_date' => '2026-07-03'],
            ['type' => 'pengeluaran',  'amount' => 85000,   'description' => 'Bayar tagihan listrik pos',     'transaction_date' => '2026-07-05'],
            ['type' => 'pengeluaran',  'amount' => 120000,  'description' => 'Beli alat kebersihan',          'transaction_date' => '2026-07-07'],
            ['type' => 'pemasukan',    'amount' => 300000,  'description' => 'Donasi acara 17 Agustus',       'transaction_date' => '2026-07-10'],
            ['type' => 'pengeluaran',  'amount' => 200000,  'description' => 'Perbaikan jalan gang',          'transaction_date' => '2026-07-12'],
            ['type' => 'pemasukan',    'amount' => 150000,  'description' => 'Iuran bulanan – Warga No. 6',   'transaction_date' => '2026-07-15'],
            ['type' => 'pengeluaran',  'amount' => 75000,   'description' => 'Snack rapat RT',                'transaction_date' => '2026-07-17'],
            ['type' => 'pemasukan',    'amount' => 500000,  'description' => 'Sumbangan pembangunan pos',     'transaction_date' => '2026-07-17'],
        ];

        // Hapus data lama milik admin dulu (opsional, agar bersih)
        Transaction::where('user_id', $admin->id)->delete();

        foreach ($contohData as $data) {
            Transaction::create(array_merge($data, ['user_id' => $admin->id]));
        }

        echo "\n✅ Admin berhasil dibuat:\n";
        echo "   Email   : admin@kasrt.com\n";
        echo "   Password: admin123\n";
        echo "   Transaksi contoh: " . count($contohData) . " data\n\n";

        // Jalankan SmartRT seeder (aset, pengurus, aspirasi)
        $this->call(SmartRtSeeder::class);

        echo "✅ SmartRT seed data berhasil diisi!\n\n";
    }
}
