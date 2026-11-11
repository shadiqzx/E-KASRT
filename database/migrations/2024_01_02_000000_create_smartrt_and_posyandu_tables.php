<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Data RT & Profile
        if (!Schema::hasTable('data_rt')) {
            Schema::create('data_rt', function (Blueprint $table) {
                $table->id();
                $table->string('rt_number', 10)->default('005');
                $table->string('rw_number', 10)->default('012');
                $table->string('kelurahan', 100)->nullable();
                $table->string('kecamatan', 100)->nullable();
                $table->string('kota', 100)->nullable();
                $table->string('provinsi', 100)->nullable();
                $table->string('kode_pos', 10)->nullable();
                $table->string('luas_wilayah', 50)->nullable();
                $table->integer('jumlah_kk')->default(0);
                $table->text('visi')->nullable();
                $table->text('misi')->nullable();
                $table->text('sejarah')->nullable();
                $table->string('qris_image', 255)->nullable();
                $table->string('jam_kerja_rt', 100)->nullable();
                $table->string('norek_bca', 100)->nullable();
                $table->string('norek_mandiri', 100)->nullable();
            });

            DB::table('data_rt')->insert([
                'rt_number' => '005',
                'rw_number' => '012',
                'kelurahan' => 'Mekarjaya',
                'kecamatan' => 'Sukmajaya',
                'kota' => 'Kota Depok',
                'provinsi' => 'Jawa Barat',
                'kode_pos' => '16411',
                'luas_wilayah' => '4.5 Ha',
                'jumlah_kk' => 34,
                'visi' => 'Mewujudkan lingkungan RT yang transparan, aman, cerdas, dan guyub rukun berbasis teknologi digital.',
                'misi' => 'Meningkatkan transparansi pembukuan kas, pelayanan surat digital cepat, dan kesehatan posyandu terpadu.',
                'jam_kerja_rt' => 'Senin - Sabtu (19:00 - 21:00 WIB)',
                'norek_bca' => '1234567890 an Kas RT 005',
                'norek_mandiri' => '9876543210 an RT 005 Peduli',
            ]);
        }

        // 2. Pengurus RT
        if (!Schema::hasTable('pengurus_rt')) {
            Schema::create('pengurus_rt', function (Blueprint $table) {
                $table->id();
                $table->string('nama', 150);
                $table->string('jabatan', 100);
                $table->string('no_hp', 30)->nullable();
                $table->string('email', 100)->nullable();
                $table->text('alamat')->nullable();
                $table->string('foto', 255)->nullable();
                $table->string('periode_mulai', 10)->nullable();
                $table->string('periode_selesai', 10)->nullable();
                $table->string('status_aktif', 20)->default('Aktif');
            });
        }

        // 3. Posyandu Balita
        if (!Schema::hasTable('posyandu_balita')) {
            Schema::create('posyandu_balita', function (Blueprint $table) {
                $table->id();
                $table->string('nama_anak', 150);
                $table->date('tanggal_lahir')->nullable();
                $table->string('jenis_kelamin', 20)->nullable();
                $table->unsignedBigInteger('warga_id')->nullable();
                $table->string('rfid_uid', 50)->nullable()->index();
                $table->timestamp('created_at')->useCurrent();
            });
        }

        // 4. Posyandu Sesi
        if (!Schema::hasTable('posyandu_sesi')) {
            Schema::create('posyandu_sesi', function (Blueprint $table) {
                $table->id();
                $table->string('nama_sesi', 150);
                $table->date('tanggal');
                $table->string('waktu_mulai', 10)->nullable();
                $table->string('waktu_selesai', 10)->nullable();
                $table->string('lokasi', 150)->nullable();
                $table->string('petugas', 150)->nullable();
                $table->text('catatan')->nullable();
                $table->string('status', 20)->default('Aktif');
                $table->timestamp('created_at')->useCurrent();
            });
        }

        // 5. Posyandu Kehadiran
        if (!Schema::hasTable('posyandu_kehadiran')) {
            Schema::create('posyandu_kehadiran', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('sesi_id')->nullable()->index();
                $table->unsignedBigInteger('balita_id')->nullable()->index();
                $table->string('jam_datang', 20)->nullable();
                $table->string('metode_absen', 50)->default('RFID');
                $table->decimal('berat_badan', 5, 2)->nullable();
                $table->decimal('tinggi_badan', 5, 2)->nullable();
                $table->decimal('lingkar_kepala', 5, 2)->nullable();
                $table->decimal('lila', 5, 2)->nullable();
                $table->string('status_gizi', 50)->nullable();
                $table->string('vitamin_a', 20)->default('Tidak');
                $table->string('obat_cacing', 20)->default('Tidak');
                $table->string('imunisasi', 100)->nullable();
                $table->text('catatan')->nullable();
                $table->string('rfid_uid', 50)->nullable();
            });
        }

        // 6. Posyandu Tap Log
        if (!Schema::hasTable('posyandu_tap_log')) {
            Schema::create('posyandu_tap_log', function (Blueprint $table) {
                $table->id();
                $table->string('uid', 50);
                $table->string('status', 50)->default('Success');
                $table->string('keterangan', 255)->nullable();
                $table->unsignedBigInteger('warga_id')->nullable();
                $table->timestamp('created_at')->useCurrent();
            });
        }

        // 7. Surat Pengantar
        if (!Schema::hasTable('surat')) {
            Schema::create('surat', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('warga_id')->nullable()->index();
                $table->string('jenis_surat', 100);
                $table->text('keperluan');
                $table->string('status', 30)->default('Menunggu');
                $table->text('keterangan_admin')->nullable();
                $table->date('tanggal_pengajuan')->nullable();
            });
        }

        // 8. Aspirasi & Pengaduan
        if (!Schema::hasTable('aspirasi')) {
            Schema::create('aspirasi', function (Blueprint $table) {
                $table->id();
                $table->string('nama_pengirim', 150)->nullable();
                $table->string('kategori', 100)->nullable();
                $table->text('isi');
                $table->date('tanggal_kirim')->nullable();
            });
        }

        // 9. Aset RT
        if (!Schema::hasTable('aset')) {
            Schema::create('aset', function (Blueprint $table) {
                $table->id();
                $table->string('nama_barang', 150);
                $table->integer('jumlah')->default(1);
                $table->string('kondisi', 50)->default('Baik');
                $table->string('lokasi', 150)->nullable();
            });
        }

        // 10. Bank Sampah
        if (!Schema::hasTable('bank_sampah')) {
            Schema::create('bank_sampah', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('warga_id')->nullable()->index();
                $table->string('jenis_sampah', 100);
                $table->decimal('berat', 8, 2)->default(0);
                $table->integer('poin')->default(0);
                $table->date('tanggal')->nullable();
            });
        }

        // 11. Iuran Payment
        if (!Schema::hasTable('iuran_payment')) {
            Schema::create('iuran_payment', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('warga_id')->nullable()->index();
                $table->string('bulan', 20);
                $table->string('tahun', 10);
                $table->decimal('jumlah', 15, 2)->default(0);
                $table->string('metode', 50)->default('Tunai');
                $table->string('bukti_bayar', 255)->nullable();
                $table->string('status', 30)->default('Lunas');
                $table->date('tanggal_bayar')->nullable();
            });
        }

        // 12. Transaksi Transfer
        if (!Schema::hasTable('transaksi_transfer')) {
            Schema::create('transaksi_transfer', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('warga_id')->nullable()->index();
                $table->string('jenis', 30)->default('Transfer Masuk');
                $table->decimal('jumlah', 15, 2)->default(0);
                $table->string('keterangan', 255)->nullable();
                $table->string('metode', 50)->nullable();
                $table->string('bukti_bayar', 255)->nullable();
                $table->string('rekening_info', 255)->nullable();
                $table->string('status', 30)->default('Selesai');
                $table->timestamp('created_at')->useCurrent();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_transfer');
        Schema::dropIfExists('iuran_payment');
        Schema::dropIfExists('bank_sampah');
        Schema::dropIfExists('aset');
        Schema::dropIfExists('aspirasi');
        Schema::dropIfExists('surat');
        Schema::dropIfExists('posyandu_tap_log');
        Schema::dropIfExists('posyandu_kehadiran');
        Schema::dropIfExists('posyandu_sesi');
        Schema::dropIfExists('posyandu_balita');
        Schema::dropIfExists('pengurus_rt');
        Schema::dropIfExists('data_rt');
    }
};
