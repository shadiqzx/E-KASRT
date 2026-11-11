<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menambahkan kolom rfid_ktp, no_hp, tempat_lahir, tanggal_lahir
     * ke tabel data_warga yang sudah ada di production.
     * Semua penambahan dilakukan dengan hasColumn guard agar idempotent.
     */
    public function up(): void
    {
        Schema::table('data_warga', function (Blueprint $table) {
            if (!Schema::hasColumn('data_warga', 'rfid_ktp')) {
                $table->string('rfid_ktp', 50)->nullable()->after('nik')
                      ->comment('UID RFID e-KTP untuk tap Posyandu IoT');
            }
            if (!Schema::hasColumn('data_warga', 'no_hp')) {
                $table->string('no_hp', 20)->nullable()->after('no_rumah')
                      ->comment('Nomor WhatsApp / HP warga');
            }
            if (!Schema::hasColumn('data_warga', 'tempat_lahir')) {
                $table->string('tempat_lahir', 100)->nullable()->after('no_hp');
            }
            if (!Schema::hasColumn('data_warga', 'tanggal_lahir')) {
                $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_warga', function (Blueprint $table) {
            $cols = ['rfid_ktp', 'no_hp', 'tempat_lahir', 'tanggal_lahir'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('data_warga', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
