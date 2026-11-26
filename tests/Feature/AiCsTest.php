<?php

namespace Tests\Feature;

use App\Models\AiSetting;
use App\Models\DataKas;
use App\Models\DataRt;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AiCsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (config('database.default') !== 'sqlite') {
            $this->markTestSkipped('AiCsTest hanya dijalankan di SQLite :memory:.');
        }

        foreach (['ai_chat_logs', 'ai_settings', 'data_kas', 'data_rt', 'data_warga', 'pengurus_rt', 'posyandu_balita', 'posyandu_sesi', 'bank_sampah', 'aset', 'users'] as $tbl) {
            Schema::dropIfExists($tbl);
        }

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

        AiSetting::create([
            'bot_name'        => 'KasBot AI Test',
            'welcome_message' => 'Halo Warga!',
            'is_enabled'      => true,
        ]);

        Schema::create('ai_chat_logs', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 120);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('sender_name', 100)->nullable();
            $table->text('user_message');
            $table->text('bot_reply');
            $table->string('detected_intent', 60)->default('general');
            $table->string('engine_used', 30)->default('smart-nlp');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('data_rt', function (Blueprint $table) {
            $table->id();
            $table->string('rt_number', 10)->default('005');
            $table->string('rw_number', 10)->default('012');
            $table->string('kelurahan', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kota', 100)->nullable();
            $table->string('jam_kerja_rt', 100)->nullable();
            $table->string('norek_bca', 100)->nullable();
            $table->string('norek_mandiri', 100)->nullable();
            $table->integer('jumlah_kk')->default(0);
        });

        DataRt::create([
            'rt_number'     => '005',
            'rw_number'     => '012',
            'kelurahan'     => 'Mekarjaya',
            'kecamatan'     => 'Sukmajaya',
            'kota'          => 'Kota Depok',
            'jam_kerja_rt'  => 'Senin - Sabtu 19:00-21:00',
            'norek_bca'     => '1234567890',
            'norek_mandiri' => '0987654321',
        ]);

        Schema::create('data_kas', function (Blueprint $table) {
            $table->increments('idKas');
            $table->string('keterangan', 255);
            $table->date('tanggal');
            $table->string('jumlah', 50);
            $table->string('jenis', 20);
        });

        DataKas::create([
            'keterangan' => 'Iuran Bulan Ini',
            'tanggal'    => date('Y-m-d'),
            'jumlah'     => 1500000,
            'jenis'      => 'Masuk',
        ]);

        Schema::create('data_warga', function (Blueprint $table) {
            $table->increments('idWarga');
            $table->string('nik', 50);
            $table->string('nama', 100);
        });

        Schema::create('pengurus_rt', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->string('jabatan', 100);
            $table->string('no_hp', 30)->nullable();
            $table->string('status_aktif', 20)->default('Aktif');
        });

        Schema::create('posyandu_balita', function (Blueprint $table) {
            $table->id();
            $table->string('nama_anak', 150);
        });

        Schema::create('posyandu_sesi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sesi', 150);
            $table->date('tanggal');
            $table->string('waktu_mulai', 10)->nullable();
            $table->string('lokasi', 150)->nullable();
            $table->string('petugas', 150)->nullable();
            $table->string('status', 20)->default('Aktif');
        });

        Schema::create('bank_sampah', function (Blueprint $table) {
            $table->id();
            $table->decimal('berat', 8, 2)->default(0);
        });

        Schema::create('aset', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang', 150);
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('user', 100);
            $table->string('nik', 50)->nullable();
            $table->string('username', 50);
            $table->string('password', 150);
            $table->tinyInteger('is_active')->default(0);
            $table->string('status_verifikasi', 30)->default('Menunggu Verifikasi');
            $table->timestamp('tgl_daftar')->nullable();
            $table->text('alasan_tolak')->nullable();
            $table->tinyInteger('role_id')->default(4);
            $table->string('email', 100)->nullable();
        });
    }

    public function test_ai_cs_validates_empty_message(): void
    {
        $this->postJson('/api/ai-cs/chat', ['message' => ''])
            ->assertStatus(422);
    }

    public function test_ai_cs_answers_live_kas_saldo_and_logs_chat(): void
    {
        $res = $this->postJson('/api/ai-cs/chat', [
            'message' => 'berapa saldo kas rt sekarang?',
        ]);

        $res->assertStatus(200)
            ->assertJson([
                'success' => true,
                'intent'  => 'kas_saldo',
            ]);

        $this->assertStringContainsString('1.500.000', (string) $res->json('reply'));
        $this->assertDatabaseHas('ai_chat_logs', [
            'detected_intent' => 'kas_saldo',
        ]);
    }

    public function test_ai_cs_checks_citizen_registration_verification_status_by_nik(): void
    {
        User::create([
            'user'              => 'Andi Warga Baru',
            'nik'               => '3276050101990007',
            'username'          => 'andiwarga07',
            'password'          => bcrypt('secret'),
            'is_active'         => 0,
            'status_verifikasi' => 'Menunggu Verifikasi',
            'tgl_daftar'        => now(),
        ]);

        $res = $this->postJson('/api/ai-cs/chat', [
            'message' => 'cek status 3276050101990007',
        ]);

        $res->assertStatus(200)
            ->assertJson([
                'success' => true,
                'intent'  => 'check_registration_status',
            ]);

        $this->assertStringContainsString('Menunggu Verifikasi', (string) $res->json('reply'));
        $this->assertStringContainsString('Andi Warga Baru', (string) $res->json('reply'));
    }

    public function test_ai_cs_history_and_reset_session_work(): void
    {
        $this->getJson('/ai-cs/history')
            ->assertStatus(200)
            ->assertJson([
                'bot_name'   => 'KasBot AI Test',
                'is_enabled' => true,
            ]);

        $this->postJson('/ai-cs/chat', ['message' => 'cara bayar iuran'])
            ->assertStatus(200)
            ->assertJson(['intent' => 'iuran_bayar']);

        $this->postJson('/ai-cs/reset')->assertStatus(200)->assertJson(['success' => true]);

        $historyAfter = $this->getJson('/ai-cs/history')->assertStatus(200);
        $this->assertCount(0, $historyAfter->json('messages'));
    }
}
