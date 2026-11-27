<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('data_warga')) {
            Schema::table('data_warga', function (Blueprint $table) {
                $table->string('no_kk', 50)->nullable()->change();
                $table->string('no_rumah', 50)->nullable()->change();
                $table->string('tempat_lahir', 100)->nullable()->change();
                $table->date('tanggal_lahir')->nullable()->change();
                $table->text('alamat')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        // Non-destructive
    }
};
