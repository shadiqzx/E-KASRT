<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SmartRtSeeder extends Seeder
{
    public function run(): void
    {
        // ── Aset RT ─────────────────────────────────────────────
        if (DB::table('aset')->count() === 0) {
            DB::table('aset')->insert([
                ['nama_barang' => 'Tenda Besi 4x6', 'jumlah' => 2, 'kondisi' => 'Baik', 'lokasi' => 'Gudang RT'],
                ['nama_barang' => 'Sound System Portable', 'jumlah' => 1, 'kondisi' => 'Baik', 'lokasi' => 'Rumah Pak RT'],
                ['nama_barang' => 'Kursi Plastik Hijau', 'jumlah' => 50, 'kondisi' => 'Baik', 'lokasi' => 'Gudang RT'],
                ['nama_barang' => 'Meja Lipat', 'jumlah' => 10, 'kondisi' => 'Baik', 'lokasi' => 'Gudang RT'],
                ['nama_barang' => 'Proyektor HDMI', 'jumlah' => 1, 'kondisi' => 'Baik', 'lokasi' => 'Balai RT'],
            ]);
        }

        // ── Pengurus RT ──────────────────────────────────────────
        if (DB::table('pengurus_rt')->count() === 0) {
            DB::table('pengurus_rt')->insert([
                [
                    'nama'            => 'Budi Santoso',
                    'jabatan'         => 'Ketua RT',
                    'no_hp'           => '081234567890',
                    'email'           => 'ketua@kasrt.id',
                    'alamat'          => 'Jl. Kenanga No. 1, Blok A',
                    'foto'            => null,
                    'periode_mulai'   => '2024',
                    'periode_selesai' => '2026',
                    'status_aktif'    => 'Aktif',
                ],
                [
                    'nama'            => 'Siti Rahayu',
                    'jabatan'         => 'Sekretaris RT',
                    'no_hp'           => '082345678901',
                    'email'           => 'sekretaris@kasrt.id',
                    'alamat'          => 'Jl. Kenanga No. 5, Blok B',
                    'foto'            => null,
                    'periode_mulai'   => '2024',
                    'periode_selesai' => '2026',
                    'status_aktif'    => 'Aktif',
                ],
                [
                    'nama'            => 'Ahmad Fauzi',
                    'jabatan'         => 'Bendahara RT',
                    'no_hp'           => '083456789012',
                    'email'           => 'bendahara@kasrt.id',
                    'alamat'          => 'Jl. Melati No. 3, Blok C',
                    'foto'            => null,
                    'periode_mulai'   => '2024',
                    'periode_selesai' => '2026',
                    'status_aktif'    => 'Aktif',
                ],
                [
                    'nama'            => 'Dewi Lestari',
                    'jabatan'         => 'Kader Posyandu',
                    'no_hp'           => '084567890123',
                    'email'           => null,
                    'alamat'          => 'Jl. Anggrek No. 7, Blok D',
                    'foto'            => null,
                    'periode_mulai'   => '2024',
                    'periode_selesai' => '2026',
                    'status_aktif'    => 'Aktif',
                ],
            ]);
        }

        // ── Aspirasi sample ──────────────────────────────────────
        if (DB::table('aspirasi')->count() === 0) {
            DB::table('aspirasi')->insert([
                [
                    'nama_pengirim' => 'Yohan Riki',
                    'kategori'      => 'Saran',
                    'isi'           => 'Mohon lampu jalan di gang belakang diperbaiki, sudah 2 minggu mati.',
                    'tanggal_kirim' => now()->subDays(5),
                ],
                [
                    'nama_pengirim' => 'Ahmad Sidiq',
                    'kategori'      => 'Keluhan',
                    'isi'           => 'Saluran air di depan rumah sering mampet saat hujan deras.',
                    'tanggal_kirim' => now()->subDays(2),
                ],
                [
                    'nama_pengirim' => 'Anonim',
                    'kategori'      => 'Apresiasi',
                    'isi'           => 'Terima kasih pengurus RT sudah mengadakan kerja bakti minggu lalu, lingkungan jadi bersih!',
                    'tanggal_kirim' => now()->subDay(),
                ],
            ]);
        }
    }
}

