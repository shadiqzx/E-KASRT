<?php

namespace App\Http\Controllers;

use App\Models\DataWarga;
use App\Models\PosyanduBalita;
use App\Models\PosyanduKehadiran;
use App\Models\PosyanduSesi;
use App\Models\PosyanduTapLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PosyanduController extends Controller
{
    public function index()
    {
        $sesi_aktif = PosyanduSesi::where('status', 'Aktif')->first();
        $sesi_list  = PosyanduSesi::orderBy('id', 'DESC')->get();

        $kehadiran_hari_ini = [];
        if ($sesi_aktif) {
            $kehadiran_hari_ini = DB::table('posyandu_kehadiran')
                ->join('posyandu_balita', 'posyandu_balita.id', '=', 'posyandu_kehadiran.balita_id')
                ->leftJoin('data_warga', 'data_warga.idWarga', '=', 'posyandu_balita.warga_id')
                ->select(
                    'posyandu_kehadiran.*',
                    'posyandu_balita.nama_anak',
                    'posyandu_balita.jenis_kelamin',
                    'posyandu_balita.tanggal_lahir',
                    'data_warga.nama as nama_ortu',
                    'data_warga.nik as nik_ortu',
                    'data_warga.rfid_ktp as rfid_ktp_ibu'
                )
                ->where('posyandu_kehadiran.sesi_id', $sesi_aktif->id)
                ->orderBy('posyandu_kehadiran.id', 'DESC')
                ->get();
        }

        $balita_list = DB::table('posyandu_balita')
            ->leftJoin('data_warga', 'data_warga.idWarga', '=', 'posyandu_balita.warga_id')
            ->select('posyandu_balita.*', 'data_warga.nama as nama_ortu', 'data_warga.nik as nik_ortu', 'data_warga.rfid_ktp as rfid_ktp_ibu')
            ->orderBy('posyandu_balita.id', 'DESC')
            ->get();

        $warga_list = DataWarga::orderBy('nama', 'ASC')->get();

        $total_balita  = PosyanduBalita::count();
        $total_ktp_ibu = DataWarga::whereNotNull('rfid_ktp')->where('rfid_ktp', '!=', '')->count();
        $total_hadir   = count($kehadiran_hari_ini);

        return view('smartrt.posyandu_kelola', compact(
            'sesi_aktif',
            'sesi_list',
            'kehadiran_hari_ini',
            'balita_list',
            'warga_list',
            'total_balita',
            'total_ktp_ibu',
            'total_hadir'
        ));
    }

    public function liveStream()
    {
        $sesi_aktif = PosyanduSesi::where('status', 'Aktif')->first();

        $recent = PosyanduTapLog::orderBy('id', 'DESC')->limit(10)->get();

        $total_hadir = 0;
        if ($sesi_aktif) {
            $total_hadir = PosyanduKehadiran::where('sesi_id', $sesi_aktif->id)->count();
        }

        return response()->json([
            'status'      => 'ok',
            'total_hadir' => $total_hadir,
            'logs'        => $recent
        ]);
    }

    public function rfidTap(Request $request)
    {
        $api_key = $request->input('api_key') ?: $request->query('api_key');
        if ($api_key !== 'kasrt2025') {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized API Key'], 401);
        }

        $uid = strtoupper(trim($request->input('uid') ?: $request->query('uid')));
        if (empty($uid)) {
            return response()->json(['status' => 'error', 'message' => 'UID is required'], 400);
        }

        $now = date('Y-m-d H:i:s');
        $sesi_aktif = PosyanduSesi::where('status', 'Aktif')->first();

        // 1. Cek apakah UID terdaftar di e-KTP Warga (Ibu)
        $warga = DataWarga::where('rfid_ktp', $uid)->first();
        if ($warga) {
            $balitas = PosyanduBalita::where('warga_id', $warga->idWarga)->get();

            if (!$sesi_aktif) {
                PosyanduTapLog::create([
                    'uid'        => $uid,
                    'status'     => 'NO_ACTIVE_SESSION',
                    'keterangan' => 'Ibu ' . $warga->nama . ' tap KTP tapi belum ada Sesi Aktif',
                    'warga_id'   => $warga->idWarga,
                    'created_at' => $now
                ]);
                return response()->json(['status' => 'warning', 'message' => 'Sesi posyandu belum diaktifkan']);
            }

            if ($balitas->isEmpty()) {
                PosyanduTapLog::create([
                    'uid'        => $uid,
                    'status'     => 'NO_CHILDREN',
                    'keterangan' => 'KTP Ibu ' . $warga->nama . ' belum terdaftar memiliki balita',
                    'warga_id'   => $warga->idWarga,
                    'created_at' => $now
                ]);
                return response()->json(['status' => 'warning', 'message' => 'Belum ada balita terhubung ke Ibu ini']);
            }

            $anak_hadir = [];
            foreach ($balitas as $b) {
                $sudah = PosyanduKehadiran::where('sesi_id', $sesi_aktif->id)->where('balita_id', $b->id)->first();
                if (!$sudah) {
                    PosyanduKehadiran::create([
                        'sesi_id'      => $sesi_aktif->id,
                        'balita_id'    => $b->id,
                        'jam_datang'   => $now,
                        'metode_absen' => 'RFID',
                        'rfid_uid'     => $uid
                    ]);
                    $anak_hadir[] = $b->nama_anak;
                }
            }

            if (!empty($anak_hadir)) {
                $msg = 'Ibu ' . $warga->nama . ' tap KTP -> Balita: ' . implode(', ', $anak_hadir) . ' hadir';
                PosyanduTapLog::create([
                    'uid'        => $uid,
                    'status'     => 'SUCCESS',
                    'keterangan' => $msg,
                    'warga_id'   => $warga->idWarga,
                    'created_at' => $now
                ]);
                return response()->json(['status' => 'success', 'message' => $msg]);
            } else {
                $msg = 'Ibu ' . $warga->nama . ' (' . $balitas->pluck('nama_anak')->implode(', ') . ') sudah absen sebelumnya';
                PosyanduTapLog::create([
                    'uid'        => $uid,
                    'status'     => 'ALREADY_CHECKED',
                    'keterangan' => $msg,
                    'warga_id'   => $warga->idWarga,
                    'created_at' => $now
                ]);
                return response()->json(['status' => 'already_checked', 'message' => $msg]);
            }
        }

        // 2. Cek apakah UID terdaftar di RFID Khusus Balita
        $balita = PosyanduBalita::where('rfid_uid', $uid)->first();
        if ($balita) {
            if (!$sesi_aktif) {
                PosyanduTapLog::create([
                    'uid'        => $uid,
                    'status'     => 'NO_ACTIVE_SESSION',
                    'keterangan' => 'Kartu balita ' . $balita->nama_anak . ' tap tapi belum ada sesi aktif',
                    'created_at' => $now
                ]);
                return response()->json(['status' => 'warning', 'message' => 'Sesi posyandu belum diaktifkan']);
            }

            $sudah = PosyanduKehadiran::where('sesi_id', $sesi_aktif->id)->where('balita_id', $balita->id)->first();
            if (!$sudah) {
                PosyanduKehadiran::create([
                    'sesi_id'      => $sesi_aktif->id,
                    'balita_id'    => $balita->id,
                    'jam_datang'   => $now,
                    'metode_absen' => 'RFID',
                    'rfid_uid'     => $uid
                ]);

                $msg = 'Balita ' . $balita->nama_anak . ' tercatat hadir via Kartu RFID';
                PosyanduTapLog::create([
                    'uid'        => $uid,
                    'status'     => 'SUCCESS',
                    'keterangan' => $msg,
                    'created_at' => $now
                ]);
                return response()->json(['status' => 'success', 'message' => $msg]);
            } else {
                $msg = 'Balita ' . $balita->nama_anak . ' sudah tercatat hadir sebelumnya';
                PosyanduTapLog::create([
                    'uid'        => $uid,
                    'status'     => 'ALREADY_CHECKED',
                    'keterangan' => $msg,
                    'created_at' => $now
                ]);
                return response()->json(['status' => 'already_checked', 'message' => $msg]);
            }
        }

        // 3. Kartu Baru Belum Terdaftar
        PosyanduTapLog::create([
            'uid'        => $uid,
            'status'     => 'UNREGISTERED',
            'keterangan' => 'e-KTP baru belum terhubung: ' . $uid,
            'created_at' => $now
        ]);
        return response()->json(['status' => 'unregistered', 'message' => 'e-KTP belum terdaftar. Silakan hubungkan ke data warga.']);
    }

    public function pairKtp(Request $request)
    {
        $warga_id = $request->input('warga_id');
        $uid      = strtoupper(trim($request->input('rfid_uid')));

        $warga = DataWarga::find($warga_id);
        if (!$warga) {
            return redirect()->back()->with('error', 'Warga tidak ditemukan');
        }

        $warga->rfid_ktp = $uid;
        $warga->save();

        // Otomatis hadirkan balita jika ada sesi aktif
        $sesi_aktif = PosyanduSesi::where('status', 'Aktif')->first();
        $anak_hadir = [];
        $now = date('Y-m-d H:i:s');

        if ($sesi_aktif) {
            $balitas = PosyanduBalita::where('warga_id', $warga_id)->get();
            foreach ($balitas as $b) {
                $sudah = PosyanduKehadiran::where('sesi_id', $sesi_aktif->id)->where('balita_id', $b->id)->first();
                if (!$sudah) {
                    PosyanduKehadiran::create([
                        'sesi_id'      => $sesi_aktif->id,
                        'balita_id'    => $b->id,
                        'jam_datang'   => $now,
                        'metode_absen' => 'RFID',
                        'rfid_uid'     => $uid
                    ]);
                    $anak_hadir[] = $b->nama_anak;
                }
            }
        }

        $ket_log = 'Ibu ' . $warga->nama . ' tap KTP';
        if (!empty($anak_hadir)) {
            $ket_log .= ' -> Balita: ' . implode(', ', $anak_hadir) . ' hadir';
        } else {
            $ket_log .= ' berhasil dihubungkan ke sistem';
        }

        PosyanduTapLog::where('uid', $uid)->update([
            'status'     => 'SUCCESS',
            'warga_id'   => $warga_id,
            'keterangan' => $ket_log
        ]);

        $pesan = 'Berhasil! e-KTP (' . $uid . ') berhasil dihubungkan dengan ' . $warga->nama . '.';
        if (!empty($anak_hadir)) {
            $pesan .= ' Balita ' . implode(', ', $anak_hadir) . ' otomatis dicatat hadir!';
        }

        return redirect()->route('posyandu.index')->with('success', $pesan);
    }

    public function sesiTambah(Request $request)
    {
        PosyanduSesi::create([
            'nama_sesi'     => $request->input('nama_sesi'),
            'tanggal'       => $request->input('tanggal'),
            'waktu_mulai'   => $request->input('waktu_mulai'),
            'lokasi'        => $request->input('lokasi'),
            'petugas'       => $request->input('petugas'),
            'catatan'       => $request->input('catatan'),
            'status'        => 'Dijadwalkan',
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('posyandu.index')->with('success', 'Sesi Posyandu berhasil dibuat!');
    }

    public function sesiStatus($id, $status)
    {
        if ($status === 'Aktif') {
            PosyanduSesi::where('id', '!=', $id)->where('status', 'Aktif')->update(['status' => 'Selesai']);
        }

        $sesi = PosyanduSesi::findOrFail($id);
        $sesi->status = $status;
        $sesi->save();

        return redirect()->route('posyandu.index')->with('success', 'Status sesi diperbarui menjadi ' . $status);
    }

    public function hadirManual(Request $request)
    {
        $sesi_id   = $request->input('sesi_id');
        $balita_id = $request->input('balita_id');

        $sudah = PosyanduKehadiran::where('sesi_id', $sesi_id)->where('balita_id', $balita_id)->first();
        if ($sudah) {
            return redirect()->route('posyandu.index')->with('warning', 'Balita ini sudah diabsen sebelumnya.');
        }

        PosyanduKehadiran::create([
            'sesi_id'      => $sesi_id,
            'balita_id'    => $balita_id,
            'jam_datang'   => date('Y-m-d H:i:s'),
            'metode_absen' => 'MANUAL',
            'berat_badan'  => $request->input('berat_badan') ?: null,
            'tinggi_badan' => $request->input('tinggi_badan') ?: null,
        ]);

        return redirect()->route('posyandu.index')->with('success', 'Kehadiran balita berhasil dicatat manual!');
    }

    public function updatePemeriksaan(Request $request, $id)
    {
        $k = PosyanduKehadiran::findOrFail($id);
        $k->update([
            'berat_badan'    => $request->input('berat_badan'),
            'tinggi_badan'   => $request->input('tinggi_badan'),
            'lingkar_kepala' => $request->input('lingkar_kepala'),
            'lila'           => $request->input('lila'),
            'status_gizi'    => $request->input('status_gizi'),
            'vitamin_a'      => $request->input('vitamin_a'),
            'obat_cacing'    => $request->input('obat_cacing'),
            'imunisasi'      => $request->input('imunisasi'),
            'catatan'        => $request->input('catatan'),
        ]);

        return redirect()->route('posyandu.index')->with('success', 'Data pemeriksaan KMS balita berhasil disimpan!');
    }

    public function balitaTambah(Request $request)
    {
        PosyanduBalita::create([
            'nama_anak'     => $request->input('nama_anak'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'warga_id'      => $request->input('warga_id'),
            'rfid_uid'      => $request->input('rfid_uid') ?: null,
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('posyandu.index')->with('success', 'Data balita berhasil ditambahkan!');
    }

    public function balitaHapus($id)
    {
        PosyanduKehadiran::where('balita_id', $id)->delete();
        PosyanduBalita::destroy($id);
        return redirect()->route('posyandu.index')->with('success', 'Data balita dan riwayatnya berhasil dihapus!');
    }

    public function downloadFirmwareIno()
    {
        $file = public_path('firmware_esp32/esp32_rfid_posyandu/esp32_rfid_posyandu.ino');
        if (file_exists($file)) {
            return response()->download($file, 'esp32_rfid_posyandu.ino');
        }
        return abort(404);
    }

    public function downloadFirmwareZip()
    {
        $file = public_path('firmware_esp32/esp32_rfid_posyandu.zip');
        if (file_exists($file)) {
            return response()->download($file, 'esp32_rfid_posyandu.zip');
        }
        return abort(404);
    }

    public function cetakKms($balita_id)
    {
        $balita = DB::table('posyandu_balita')
            ->leftJoin('data_warga', 'data_warga.idWarga', '=', 'posyandu_balita.warga_id')
            ->select('posyandu_balita.*', 'data_warga.nama AS nama_ortu', 'data_warga.nik AS nik_ortu', 'data_warga.alamat', 'data_warga.no_rumah')
            ->where('posyandu_balita.id', $balita_id)
            ->first();

        if (!$balita) abort(404);

        $riwayat = DB::table('posyandu_kehadiran')
            ->join('posyandu_sesi', 'posyandu_sesi.id', '=', 'posyandu_kehadiran.sesi_id')
            ->select('posyandu_kehadiran.*', 'posyandu_sesi.nama_sesi', 'posyandu_sesi.tanggal')
            ->where('posyandu_kehadiran.balita_id', $balita_id)
            ->orderBy('posyandu_sesi.tanggal', 'ASC')
            ->get();

        return view('smartrt.posyandu_kms_print', compact('balita', 'riwayat'));
    }
}

