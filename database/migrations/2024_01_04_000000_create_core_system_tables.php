<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Membuat tabel-tabel utama (data_warga, data_kas, user_role, tabel_kredit)
     * jika belum ada, agar ketika migrasi di lingkungan baru (misal VPS)
     * seluruh struktur tabel langsung terbentuk sempurna tanpa error.
     */
    public function up(): void
    {
        // 1. Tabel Data Warga
        if (!Schema::hasTable('data_warga')) {
            Schema::create('data_warga', function (Blueprint $table) {
                $table->increments('idWarga');
                $table->string('nik', 50)->index();
                $table->string('rfid_ktp', 50)->nullable()->index();
                $table->string('nama', 100);
                $table->string('jekel', 20)->nullable();
                $table->string('tempat_lahir', 50)->nullable();
                $table->date('tanggal_lahir')->nullable();
                $table->text('alamat')->nullable();
                $table->string('no_kk', 20)->nullable();
                $table->string('hubungan_keluarga', 50)->nullable();
                $table->string('no_rumah', 20)->nullable();
                $table->string('no_hp', 30)->nullable();
            });
        }

        // 2. Tabel Data Kas
        if (!Schema::hasTable('data_kas')) {
            Schema::create('data_kas', function (Blueprint $table) {
                $table->increments('idKas');
                $table->string('keterangan', 255);
                $table->date('tanggal');
                $table->string('jumlah', 50);
                $table->string('jenis', 20); // Masuk / Keluar
            });
        }

        // 3. Tabel User Role
        if (!Schema::hasTable('user_role')) {
            Schema::create('user_role', function (Blueprint $table) {
                $table->increments('id');
                $table->string('role', 50);
            });
        }

        // 4. Tabel Kredit
        if (!Schema::hasTable('tabel_kredit')) {
            Schema::create('tabel_kredit', function (Blueprint $table) {
                $table->increments('id');
                $table->string('keterangan', 255);
                $table->decimal('jumlah', 10, 2);
                $table->date('tanggal');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_kredit');
        Schema::dropIfExists('user_role');
        Schema::dropIfExists('data_kas');
        Schema::dropIfExists('data_warga');
    }
};

