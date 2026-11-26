<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menambahkan kolom verifikasi pendaftaran akun warga ke tabel users dan data_warga.
     */
    public function up(): void
    {
        // 1. Tambah kolom verifikasi di tabel users
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'nik')) {
                $table->string('nik', 50)->nullable()->index()->after('user');
            }
            if (!Schema::hasColumn('users', 'status_verifikasi')) {
                $table->string('status_verifikasi', 30)->default('Disetujui')->index()->after('is_active');
            }
            if (!Schema::hasColumn('users', 'tgl_daftar')) {
                $table->timestamp('tgl_daftar')->nullable()->after('status_verifikasi');
            }
            if (!Schema::hasColumn('users', 'alasan_tolak')) {
                $table->text('alasan_tolak')->nullable()->after('tgl_daftar');
            }
            if (!Schema::hasColumn('users', 'verifikator_id')) {
                $table->unsignedBigInteger('verifikator_id')->nullable()->after('alasan_tolak');
            }
            if (!Schema::hasColumn('users', 'tgl_verifikasi')) {
                $table->timestamp('tgl_verifikasi')->nullable()->after('verifikator_id');
            }
        });

        // 2. Tambah kolom status_warga di tabel data_warga
        Schema::table('data_warga', function (Blueprint $table) {
            if (!Schema::hasColumn('data_warga', 'status_warga')) {
                $table->string('status_warga', 30)->default('Terverifikasi')->after('nama');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $cols = ['nik', 'status_verifikasi', 'tgl_daftar', 'alasan_tolak', 'verifikator_id', 'tgl_verifikasi'];
            foreach ($cols as $c) {
                if (Schema::hasColumn('users', $c)) {
                    $table->dropColumn($c);
                }
            }
        });

        Schema::table('data_warga', function (Blueprint $table) {
            if (Schema::hasColumn('data_warga', 'status_warga')) {
                $table->dropColumn('status_warga');
            }
        });
    }
};
