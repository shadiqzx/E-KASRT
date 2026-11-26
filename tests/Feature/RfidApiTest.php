<?php

namespace Tests\Feature;

use App\Models\DataWarga;
use App\Models\IuranPayment;
use App\Models\PosyanduBalita;
use App\Models\PosyanduSesi;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class RfidApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (config('database.default') !== 'sqlite') {
            $this->markTestSkipped('RfidApiTest hanya dijalankan di SQLite :memory:.');
        }

        Schema::dropIfExists('posyandu_tap_log');
        Schema::dropIfExists('posyandu_kehadiran');
        Schema::dropIfExists('posyandu_balita');
        Schema::dropIfExists('posyandu_sesi');
        Schema::dropIfExists('iuran_payment');
        Schema::dropIfExists('data_warga');

        Schema::create('data_warga', function (Blueprint $table) {
            $table->increments('idWarga');
            $table->string('nik', 50);
            $table->string('rfid_ktp', 50)->nullable();
            $table->string('no_kk', 20)->nullable();
            $table->string('nama', 100);
            $table->string('jekel', 20)->nullable();
            $table->string('hubungan_keluarga', 50)->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_rumah', 20)->nullable();
            $table->string('no_hp', 30)->nullable();
            $table->string('status_warga', 30)->nullable();
        });

        Schema::create('iuran_payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warga_id');
            $table->string('bulan', 30);
            $table->integer('tahun');
            $table->decimal('jumlah', 12, 2);
            $table->string('metode', 50)->nullable();
            $table->string('bukti_bayar', 255)->nullable();
            $table->string('status', 30);
            $table->timestamp('tanggal_bayar')->nullable();
        });

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
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('posyandu_balita', function (Blueprint $table) {
            $table->id();
            $table->string('nama_anak', 150);
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin', 20)->nullable();
            $table->unsignedBigInteger('warga_id')->nullable();
            $table->string('rfid_uid', 50)->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('posyandu_kehadiran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sesi_id');
            $table->unsignedBigInteger('balita_id');
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

        Schema::create('posyandu_tap_log', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 50);
            $table->string('status', 50);
            $table->string('keterangan', 255)->nullable();
            $table->unsignedBigInteger('warga_id')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    public function test_rfid_tap_and_heartbeat_reject_unauthorized_requests(): void
    {
        $this->postJson('/api/rfid/tap', [
            'uid'       => 'E3A82C10',
            'device_id' => 'esp32-scanner-02',
        ])->assertStatus(401);

        $this->postJson('/api/rfid/heartbeat', [
            'device_id' => 'esp32-scanner-02',
            'ip'        => '192.168.43.50',
        ], [
            'X-Device-Key' => 'wrong-key',
        ])->assertStatus(401);
    }

    public function test_heartbeat_sets_device_online_in_cache_and_returns_200(): void
    {
        $response = $this->postJson('/api/rfid/heartbeat', [
            'device_id' => 'esp32-scanner-02',
            'ip'        => '192.168.43.50',
        ], [
            'Authorization' => 'Bearer smartrw-rfid-device',
            'X-Device-Key'  => 'smartrw-rfid-device',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status'    => 'online',
                'device_id' => 'esp32-scanner-02',
                'ip'        => '192.168.43.50',
            ]);

        $this->assertTrue(Cache::get('rfid_device_online'));
    }

    public function test_tap_validates_uid_and_returns_422_when_missing(): void
    {
        $this->postJson('/api/rfid/tap', [
            'device_id' => 'esp32-scanner-02',
        ], [
            'X-Device-Key' => 'smartrw-rfid-device',
        ])->assertStatus(422);
    }

    public function test_tap_caches_last_rfid_uid_and_connects_to_warga_iuran_and_posyandu(): void
    {
        $bulanIndo = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
            '04' => 'April', '05' => 'Mei', '06' => 'Juni',
            '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
            '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
        ];

        $warga = DataWarga::create([
            'nik'      => '3276010101900001',
            'rfid_ktp' => 'E3A82C10',
            'nama'     => 'Siti Aminah',
            'no_rumah' => 'A-12',
        ]);

        IuranPayment::create([
            'warga_id'      => $warga->idWarga,
            'bulan'         => $bulanIndo[date('m')],
            'tahun'         => (int) date('Y'),
            'jumlah'        => 50000,
            'metode'        => 'Tunai',
            'status'        => 'Disetujui',
            'tanggal_bayar' => now(),
        ]);

        $sesi = PosyanduSesi::create([
            'nama_sesi' => 'Posyandu Test',
            'tanggal'   => date('Y-m-d'),
            'status'    => 'Aktif',
        ]);

        $balita = PosyanduBalita::create([
            'nama_anak'     => 'Adi Saputra',
            'jenis_kelamin' => 'L',
            'warga_id'      => $warga->idWarga,
        ]);

        $response = $this->postJson('/api/rfid/tap', [
            'uid'       => 'e3a82c10',
            'device_id' => 'esp32-scanner-02',
        ], [
            'Authorization' => 'Bearer smartrw-rfid-device',
            'X-Device-Key'  => 'smartrw-rfid-device',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success'   => true,
                'message'   => 'Kartu berhasil dibaca',
                'uid'       => 'E3A82C10',
                'device_id' => 'esp32-scanner-02',
                'data'      => [
                    'registered'   => true,
                    'warga_nama'   => 'Siti Aminah',
                    'iuran_status' => 'LUNAS',
                    'posyandu'     => 'success',
                ],
            ]);

        $this->assertSame('E3A82C10', Cache::get('last_rfid_uid'));
        $this->assertDatabaseHas('posyandu_kehadiran', [
            'sesi_id'      => $sesi->id,
            'balita_id'    => $balita->id,
            'metode_absen' => 'RFID',
            'rfid_uid'     => 'E3A82C10',
        ]);
        $this->assertDatabaseHas('posyandu_tap_log', [
            'uid'      => 'E3A82C10',
            'status'   => 'SUCCESS',
            'warga_id' => $warga->idWarga,
        ]);
    }
}
