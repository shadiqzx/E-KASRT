<?php

namespace App\Http\Controllers;

use App\Services\RfidTapService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class RfidController extends Controller
{
    private const DEFAULT_DEVICE_KEY = 'smartrw-rfid-device';

    public function __construct(private readonly RfidTapService $rfidService)
    {
    }

    /**
     * Terima event tap kartu RFID / e-KTP dari perangkat ESP32.
     * Endpoint: POST /api/rfid/tap
     */
    public function tap(Request $request): JsonResponse
    {
        if (!$this->isAuthorizedDevice($request)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: X-Device-Key atau Bearer Token tidak valid.',
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'uid'       => 'required|string|max:64',
            'device_id' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: field uid wajib diisi dan bertipe string.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $uid = strtoupper(trim((string) $request->input('uid')));
        if ($uid === '') {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: field uid tidak boleh kosong.',
            ], 422);
        }

        $deviceId = $request->input('device_id');

        // Hubungkan UID dengan modul Smart RT (cek warga & status iuran) serta Posyandu IoT
        $iuranData = $this->rfidService->checkIuranStatus($uid);
        $posyanduResult = $this->rfidService->recordPosyanduAttendance($uid, $deviceId);

        // Simpan UID sementara di Cache (30 detik) untuk auto-fill form & live monitoring frontend
        $this->rfidService->cacheLastScan($uid, $deviceId, [
            'warga_nama'   => $iuranData['warga_id'] ? $iuranData['nama_warga'] : ($posyanduResult['balita']->nama_anak ?? null),
            'iuran_status' => $iuranData['status'] ?? 'BELUM_TERDAFTAR',
            'posyandu'     => $posyanduResult['status'] ?? null,
            'keterangan'   => $posyanduResult['message'] ?? ($iuranData['keterangan'] ?? null),
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Kartu berhasil dibaca',
            'uid'       => $uid,
            'device_id' => $deviceId,
            'data'      => [
                'registered'    => (bool) ($posyanduResult['registered'] ?? false),
                'warga_nama'    => $iuranData['warga_id'] ? $iuranData['nama_warga'] : ($posyanduResult['balita']->nama_anak ?? null),
                'iuran_status'  => $iuranData['status'] ?? 'BELUM_TERDAFTAR',
                'iuran_detail'  => $iuranData['keterangan'] ?? null,
                'posyandu'      => $posyanduResult['status'] ?? null,
                'posyandu_note' => $posyanduResult['message'] ?? null,
            ],
        ], 200);
    }

    /**
     * Terima sinyal heartbeat berkala setiap 2 detik dari ESP32 untuk status online.
     * Endpoint: POST /api/rfid/heartbeat
     */
    public function heartbeat(Request $request): JsonResponse
    {
        if (!$this->isAuthorizedDevice($request)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: X-Device-Key atau Bearer Token tidak valid.',
            ], 401);
        }

        $deviceId = $request->input('device_id');
        $deviceIp = $request->input('ip') ?: $request->ip();

        Cache::put('rfid_device_online', true, 15);
        Cache::put('rfid_device_info', [
            'device_id' => $deviceId ?: 'esp32-scanner-02',
            'ip'        => $deviceIp,
            'last_seen' => now()->toIso8601String(),
            'time_text' => date('H:i:s') . ' WIB',
        ], 15);

        return response()->json([
            'status'    => 'online',
            'device_id' => $deviceId,
            'ip'        => $deviceIp,
        ], 200);
    }

    /**
     * Helper endpoint untuk frontend memantau status online ESP32 & auto-fill last_rfid_uid.
     * Endpoint: GET /api/rfid/status
     */
    public function status(): JsonResponse
    {
        $online = (bool) Cache::get('rfid_device_online', false);

        return response()->json([
            'online'        => $online,
            'status'        => $online ? 'online' : 'offline',
            'device'        => Cache::get('rfid_device_info'),
            'last_rfid_uid' => Cache::get('last_rfid_uid'),
            'last_tap'      => Cache::get('last_rfid_tap_detail'),
        ], 200);
    }

    /**
     * Validasi header keamanan X-Device-Key atau Authorization Bearer dari perangkat ESP32.
     */
    private function isAuthorizedDevice(Request $request): bool
    {
        $expectedKey = (string) env('RFID_DEVICE_KEY', self::DEFAULT_DEVICE_KEY);
        $deviceKey = $request->header('X-Device-Key');
        $bearerToken = $request->bearerToken();

        if ($deviceKey !== null && $deviceKey !== $expectedKey) {
            return false;
        }
        if ($bearerToken !== null && $bearerToken !== $expectedKey) {
            return false;
        }

        return ($deviceKey === $expectedKey) || ($bearerToken === $expectedKey);
    }
}
