<?php

namespace App\Services;

use App\Models\DataWarga;
use App\Models\IuranPayment;
use App\Models\PosyanduBalita;
use App\Models\PosyanduKehadiran;
use App\Models\PosyanduSesi;
use App\Models\PosyanduTapLog;
use Illuminate\Support\Facades\Cache;

class RfidTapService
{
    /**
     * Normalisasi string UID kartu RFID/e-KTP agar konsisten huruf kapital.
     */
    public function normalizeUid(string $rawUid, bool $stripNonAlnum = false): string
    {
        $clean = trim($rawUid);
        if ($stripNonAlnum) {
            $clean = (string) preg_replace('/[^A-Za-z0-9]/', '', $clean);
        }

        return strtoupper($clean);
    }

    /**
     * Simpan UID terakhir & status online ESP32 ke Cache untuk auto-fill & monitoring frontend.
     */
    public function cacheLastScan(string $uid, ?string $deviceId = null, array $iotSummary = []): void
    {
        Cache::put('last_rfid_uid', $uid, 30);
        Cache::put('rfid_device_online', true, 15);
        Cache::put('last_rfid_tap_detail', [
            'uid'       => $uid,
            'device_id' => $deviceId,
            'timestamp' => now()->toIso8601String(),
            'time_text' => date('H:i:s') . ' WIB',
            'summary'   => $iotSummary,
        ], 30);
    }

    /**
     * Cek data warga & status pembayaran Iuran RT bulan berjalan berdasarkan UID kartu.
     */
    public function checkIuranStatus(string $uid): array
    {
        $warga = DataWarga::where('rfid_ktp', $uid)->first();

        $bulanIndo = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
            '04' => 'April', '05' => 'Mei', '06' => 'Juni',
            '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
            '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
        ];
        $bulanIni = $bulanIndo[date('m')];
        $tahunIni = date('Y');

        if ($warga) {
            $payment = IuranPayment::where('warga_id', $warga->idWarga)
                ->where('bulan', $bulanIni)
                ->where('tahun', $tahunIni)
                ->where('status', 'Disetujui')
                ->first();

            $statusIuran = $payment ? 'LUNAS' : 'BELUM_BAYAR';
            $tapData = [
                'uid'        => $uid,
                'status'     => $statusIuran,
                'warga_id'   => $warga->idWarga,
                'nama_warga' => $warga->nama,
                'no_rumah'   => $warga->no_rumah ?? '-',
                'no_hp'      => $warga->no_hp ?? '-',
                'bulan'      => $bulanIni,
                'tahun'      => $tahunIni,
                'keterangan' => $payment
                    ? "Iuran bulan {$bulanIni} {$tahunIni} sudah LUNAS"
                    : "Iuran bulan {$bulanIni} {$tahunIni} BELUM dibayar (Rp 50.000)",
                'timestamp'  => now()->toIso8601String(),
                'time_text'  => date('H:i') . ' WIB',
            ];
        } else {
            $tapData = [
                'uid'        => $uid,
                'status'     => 'BELUM_TERDAFTAR',
                'warga_id'   => null,
                'nama_warga' => 'Kartu Belum Dikenal',
                'no_rumah'   => '-',
                'no_hp'      => '-',
                'bulan'      => $bulanIni,
                'tahun'      => $tahunIni,
                'keterangan' => "UID [{$uid}] belum ditautkan ke data warga",
                'timestamp'  => now()->toIso8601String(),
                'time_text'  => date('H:i') . ' WIB',
            ];
        }

        Cache::put('smartrt_last_iuran_tap', $tapData, 120);

        return $tapData;
    }

    /**
     * Hubungkan tap UID dengan logika absensi & tap log Posyandu Balita Digital.
     */
    public function recordPosyanduAttendance(string $uid, ?string $deviceId = null): array
    {
        $now = date('Y-m-d H:i:s');
        $sesiAktif = PosyanduSesi::where('status', 'Aktif')->first();
        $sourceSuffix = $deviceId ? " ({$deviceId})" : '';

        // 1. Cek apakah UID terdaftar di e-KTP Warga (Ibu Balita)
        $warga = DataWarga::where('rfid_ktp', $uid)->first();
        if ($warga) {
            $balitas = PosyanduBalita::where('warga_id', $warga->idWarga)->get();

            if (!$sesiAktif) {
                PosyanduTapLog::create([
                    'uid'        => $uid,
                    'status'     => 'NO_ACTIVE_SESSION',
                    'keterangan' => 'Ibu ' . $warga->nama . ' tap KTP' . $sourceSuffix . ' tapi belum ada Sesi Aktif',
                    'warga_id'   => $warga->idWarga,
                    'created_at' => $now,
                ]);

                return [
                    'status'     => 'warning',
                    'message'    => 'Sesi posyandu belum diaktifkan',
                    'registered' => true,
                    'warga'      => $warga,
                ];
            }

            if ($balitas->isEmpty()) {
                PosyanduTapLog::create([
                    'uid'        => $uid,
                    'status'     => 'NO_CHILDREN',
                    'keterangan' => 'KTP Ibu ' . $warga->nama . ' belum terdaftar memiliki balita',
                    'warga_id'   => $warga->idWarga,
                    'created_at' => $now,
                ]);

                return [
                    'status'     => 'warning',
                    'message'    => 'Belum ada balita terhubung ke Ibu ini',
                    'registered' => true,
                    'warga'      => $warga,
                ];
            }

            $anakHadir = [];
            foreach ($balitas as $balita) {
                $sudah = PosyanduKehadiran::where('sesi_id', $sesiAktif->id)
                    ->where('balita_id', $balita->id)
                    ->first();

                if (!$sudah) {
                    PosyanduKehadiran::create([
                        'sesi_id'      => $sesiAktif->id,
                        'balita_id'    => $balita->id,
                        'jam_datang'   => $now,
                        'metode_absen' => 'RFID',
                        'rfid_uid'     => $uid,
                    ]);
                    $anakHadir[] = $balita->nama_anak;
                }
            }

            if (!empty($anakHadir)) {
                $msg = 'Ibu ' . $warga->nama . ' tap KTP -> Balita: ' . implode(', ', $anakHadir) . ' hadir';
                PosyanduTapLog::create([
                    'uid'        => $uid,
                    'status'     => 'SUCCESS',
                    'keterangan' => $msg,
                    'warga_id'   => $warga->idWarga,
                    'created_at' => $now,
                ]);

                return [
                    'status'     => 'success',
                    'message'    => $msg,
                    'registered' => true,
                    'warga'      => $warga,
                ];
            }

            $msg = 'Ibu ' . $warga->nama . ' (' . $balitas->pluck('nama_anak')->implode(', ') . ') sudah absen sebelumnya';
            PosyanduTapLog::create([
                'uid'        => $uid,
                'status'     => 'ALREADY_CHECKED',
                'keterangan' => $msg,
                'warga_id'   => $warga->idWarga,
                'created_at' => $now,
            ]);

            return [
                'status'     => 'already_checked',
                'message'    => $msg,
                'registered' => true,
                'warga'      => $warga,
            ];
        }

        // 2. Cek apakah UID terdaftar di RFID Khusus Balita
        $balita = PosyanduBalita::where('rfid_uid', $uid)->first();
        if ($balita) {
            if (!$sesiAktif) {
                PosyanduTapLog::create([
                    'uid'        => $uid,
                    'status'     => 'NO_ACTIVE_SESSION',
                    'keterangan' => 'Kartu balita ' . $balita->nama_anak . ' tap tapi belum ada sesi aktif',
                    'created_at' => $now,
                ]);

                return [
                    'status'     => 'warning',
                    'message'    => 'Sesi posyandu belum diaktifkan',
                    'registered' => true,
                    'balita'     => $balita,
                ];
            }

            $sudah = PosyanduKehadiran::where('sesi_id', $sesiAktif->id)
                ->where('balita_id', $balita->id)
                ->first();

            if (!$sudah) {
                PosyanduKehadiran::create([
                    'sesi_id'      => $sesiAktif->id,
                    'balita_id'    => $balita->id,
                    'jam_datang'   => $now,
                    'metode_absen' => 'RFID',
                    'rfid_uid'     => $uid,
                ]);

                $msg = 'Balita ' . $balita->nama_anak . ' tercatat hadir via Kartu RFID';
                PosyanduTapLog::create([
                    'uid'        => $uid,
                    'status'     => 'SUCCESS',
                    'keterangan' => $msg,
                    'created_at' => $now,
                ]);

                return [
                    'status'     => 'success',
                    'message'    => $msg,
                    'registered' => true,
                    'balita'     => $balita,
                ];
            }

            $msg = 'Balita ' . $balita->nama_anak . ' sudah tercatat hadir sebelumnya';
            PosyanduTapLog::create([
                'uid'        => $uid,
                'status'     => 'ALREADY_CHECKED',
                'keterangan' => $msg,
                'created_at' => $now,
            ]);

            return [
                'status'     => 'already_checked',
                'message'    => $msg,
                'registered' => true,
                'balita'     => $balita,
            ];
        }

        // 3. Kartu Baru Belum Terdaftar
        PosyanduTapLog::create([
            'uid'        => $uid,
            'status'     => 'UNREGISTERED',
            'keterangan' => 'e-KTP baru belum terhubung' . $sourceSuffix . ': ' . $uid,
            'created_at' => $now,
        ]);

        return [
            'status'     => 'unregistered',
            'message'    => 'e-KTP belum terdaftar. Silakan hubungkan ke data warga.',
            'registered' => false,
        ];
    }
}
