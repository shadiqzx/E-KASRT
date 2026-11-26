<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel ai_settings dan ai_chat_logs untuk layanan AI Customer Service E-KASRT.
     */
    public function up(): void
    {
        if (!Schema::hasTable('ai_settings')) {
            Schema::create('ai_settings', function (Blueprint $table) {
                $table->id();
                $table->string('bot_name', 80)->default('KasBot AI');
                $table->text('welcome_message')->nullable();
                $table->text('gemini_api_key')->nullable();
                $table->string('gemini_model', 80)->default('gemini-2.5-flash');
                $table->text('system_prompt')->nullable();
                $table->string('whatsapp_cs', 30)->nullable();
                $table->boolean('is_enabled')->default(true);
                $table->timestamp('updated_at')->nullable();
            });

            DB::table('ai_settings')->insert([
                'bot_name'        => 'KasBot AI (CS E-KASRT)',
                'welcome_message' => 'Halo! Saya Asisten Virtual E-KASRT. Silakan tanyakan seputar Saldo Kas RT, Iuran Warga, Cara Daftar & Cek Verifikasi Akun, Jadwal Posyandu Balita, Surat Pengantar, Bank Sampah, atau layanan RT lainnya.',
                'gemini_model'    => 'gemini-2.5-flash',
                'is_enabled'      => true,
                'updated_at'      => now(),
            ]);
        }

        if (!Schema::hasTable('ai_chat_logs')) {
            Schema::create('ai_chat_logs', function (Blueprint $table) {
                $table->id();
                $table->string('session_id', 120)->index();
                $table->unsignedBigInteger('user_id')->nullable()->index();
                $table->string('sender_name', 100)->nullable();
                $table->text('user_message');
                $table->text('bot_reply');
                $table->string('detected_intent', 60)->default('general')->index();
                $table->string('engine_used', 30)->default('smart-nlp');
                $table->timestamp('created_at')->useCurrent();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_chat_logs');
        Schema::dropIfExists('ai_settings');
    }
};
