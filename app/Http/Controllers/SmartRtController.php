<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Aspirasi;
use App\Models\BankSampah;
use App\Models\DataKas;
use App\Models\DataRt;
use App\Models\DataWarga;
use App\Models\IuranPayment;
use App\Models\PengurusRt;
use App\Models\Surat;
use App\Models\TransaksiTransfer;
use App\Services\RfidTapService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;

class SmartRtController extends Controller
{
    // ==========================================
    // 1. KAS TRANSFER
    // ==========================================
    public function transfer()
    {
        $transfer_list = TransaksiTransfer::with('warga')->orderBy('id', 'DESC')->get();
        $total_masuk   = DataKas::where('jenis', 'Masuk')->sum('jumlah');
        $total_keluar  = DataKas::where('jenis', 'Keluar')->sum('jumlah');
        $saldo_kas     = $total_masuk - $total_keluar;
        $warga_list    = DataWarga::orderBy('nama', 'ASC')->get();

        return view('smartrt.transfer', compact('transfer_list', 'saldo_kas', 'warga_list'));
    }

    public function addTransfer(Request $request)
    {
        $request->validate([
            'jenis'      => 'required',
            'jumlah'     => 'required|numeric',
            'keterangan' => 'required',
        ]);

        TransaksiTransfer::create([
            'warga_id'      => $request->warga_id ?: null,
            'jenis'         => $request->jenis,
            'jumlah'        => $request->jumlah,
            'keterangan'    => $request->keterangan,
            'metode'        => $request->metode ?: 'Transfer Bank',
            'rekening_info' => $request->rekening_info ?: '-',
            'status'        => 'Disetujui',
            'created_at'    => now(),
        ]);

        // Catat juga ke DataKas
        DataKas::create([
            'keterangan' => '[TRANSFER] ' . $request->keterangan,
            'tanggal'    => date('Y-m-d'),
            'jumlah'     => $request->jumlah,
            'jenis'      => $request->jenis,
        ]);

        return redirect()->route('smartrt.transfer')->with('success', 'Transaksi transfer kas berhasil diproses!');
    }

    // ==========================================
    // 2. IURAN WARGA
    // ==========================================
    public function iuran()
    {
        $iuran_list = IuranPayment::with('warga')->orderBy('id', 'DESC')->get();
        $warga_list = DataWarga::orderBy('nama', 'ASC')->get();
        $total_terkumpul = IuranPayment::where('status', 'Disetujui')->sum('jumlah');

        return view('smartrt.iuran', compact('iuran_list', 'warga_list', 'total_terkumpul'));
    }

    public function iuranBayar(Request $request)
    {
        $request->validate([
            'warga_id' => 'required',
            'bulan'    => 'required',
            'tahun'    => 'required|numeric',
            'jumlah'   => 'required|numeric',
        ]);

        IuranPayment::create([
            'warga_id'      => $request->warga_id,
            'bulan'         => $request->bulan,
            'tahun'         => $request->tahun,
            'jumlah'        => $request->jumlah,
            'metode'        => $request->metode ?: 'Tunai',
            'status'        => 'Disetujui',
            'tanggal_bayar' => now(),
        ]);

        $warga = DataWarga::find($request->warga_id);
        $namaWarga = $warga ? $warga->nama : 'Warga';

        DataKas::create([
            'keterangan' => "Iuran Warga Bulan {$request->bulan} {$request->tahun} ({$namaWarga})",
            'tanggal'    => date('Y-m-d'),
            'jumlah'     => $request->jumlah,
            'jenis'      => 'Masuk',
        ]);

        return redirect()->route('smartrt.iuran')->with('success', 'Pembayaran iuran berhasil dicatat!');
    }

    public function iuranUpdateStatus($id, $status)
    {
        $i = IuranPayment::findOrFail($id);
        $i->update(['status' => $status]);
        return redirect()->route('smartrt.iuran')->with('success', 'Status iuran berhasil diperbarui!');
    }

    public function iuranQuickPay(Request $request)
    {
        $request->validate([
            'warga_id' => 'required',
            'bulan'    => 'required',
            'tahun'    => 'required',
            'jumlah'   => 'required|numeric',
        ]);

        $warga = DataWarga::find($request->warga_id);
        $namaWarga = $warga ? $warga->nama : 'Warga RT';

        IuranPayment::create([
            'warga_id'       => $request->warga_id,
            'bulan'          => $request->bulan,
            'tahun'          => $request->tahun,
            'jumlah'         => $request->jumlah,
            'metode'         => 'Tunai / Loket RFID',
            'status'         => 'Disetujui',
            'tanggal_bayar'  => date('Y-m-d'),
        ]);

        DataKas::create([
            'keterangan' => "Iuran Warga Bulan {$request->bulan} {$request->tahun} ({$namaWarga})",
            'tanggal'    => date('Y-m-d'),
            'jumlah'     => $request->jumlah,
            'jenis'      => 'Masuk',
        ]);

        return redirect()->route('smartrt.iuran')->with('success', "Pembayaran iuran {$namaWarga} ({$request->bulan} {$request->tahun}) berhasil dicatat & masuk kas!");
    }

    public function iuranPairKtp(Request $request)
    {
        $request->validate([
            'warga_id' => 'required',
            'rfid_ktp' => 'required',
        ]);

        $uid = strtoupper(trim(preg_replace('/[^A-Za-z0-9]/', '', $request->rfid_ktp)));
        $warga = DataWarga::findOrFail($request->warga_id);
        $warga->rfid_ktp = $uid;
        $warga->save();

        return redirect()->route('smartrt.iuran')->with('success', "e-KTP UID [{$uid}] berhasil ditautkan ke {$warga->nama}!");
    }

    public function iuranUnpairKtp($warga_id)
    {
        $warga = DataWarga::find($warga_id);
        if ($warga) {
            $oldUid = $warga->rfid_ktp;
            $warga->rfid_ktp = null;
            $warga->save();
            return redirect()->route('smartrt.iuran')->with('success', "Tautan e-KTP [{$oldUid}] pada {$warga->nama} berhasil dilepas.");
        }
        return redirect()->route('smartrt.iuran')->with('error', 'Data warga tidak ditemukan.');
    }

    public function iuranRfidTap(Request $request, RfidTapService $rfidService)
    {
        $rawUid = $request->input('uid') ?? $request->query('uid');
        if (empty($rawUid)) {
            return response()->json(['status' => 'ERROR', 'message' => 'Parameter UID kosong'], 400);
        }

        $uid = $rfidService->normalizeUid((string) $rawUid, true);
        $tapData = $rfidService->checkIuranStatus($uid);
        $rfidService->cacheLastScan($uid, null, [
            'warga_nama'   => $tapData['warga_id'] ? $tapData['nama_warga'] : null,
            'iuran_status' => $tapData['status'],
            'keterangan'   => $tapData['keterangan'],
        ]);

        return response()->json([
            'status' => 'OK',
            'code'   => 200,
            'data'   => $tapData,
        ]);
    }

    public function iuranLiveStream()
    {
        $lastTap = Cache::get('smartrt_last_iuran_tap');
        if ($lastTap) {
            $tapTime = \Carbon\Carbon::parse($lastTap['timestamp']);
            // Radar otomatis standby jika sudah lewat 7 detik
            if ($tapTime->diffInSeconds(now()) > 7) {
                $lastTap = null;
            }
        }

        return response()->json([
            'status'        => 'OK',
            'last_tap'      => $lastTap,
            'device_online' => (bool) Cache::get('rfid_device_online', false),
            'device_info'   => Cache::get('rfid_device_info'),
            'last_rfid_uid' => Cache::get('last_rfid_uid'),
        ]);
    }

    // ==========================================
    // 3. BANK SAMPAH
    // ==========================================
    public function banksampah()
    {
        $sampah_list = BankSampah::with('warga')->orderBy('id', 'DESC')->get();
        $warga_list  = DataWarga::orderBy('nama', 'ASC')->get();
        $total_berat = BankSampah::sum('berat');
        $total_poin  = BankSampah::sum('poin');

        return view('smartrt.banksampah', compact('sampah_list', 'warga_list', 'total_berat', 'total_poin'));
    }

    public function banksampahTambah(Request $request)
    {
        $request->validate([
            'warga_id'     => 'required',
            'jenis_sampah' => 'required',
            'berat'        => 'required|numeric',
        ]);

        $poin = (int)($request->berat * 100);

        BankSampah::create([
            'warga_id'     => $request->warga_id,
            'jenis_sampah' => $request->jenis_sampah,
            'berat'        => $request->berat,
            'poin'         => $poin,
            'tanggal'      => now(),
        ]);

        return redirect()->route('smartrt.banksampah')->with('success', 'Setoran bank sampah berhasil dicatat!');
    }

    // ==========================================
    // 4. SURAT PENGANTAR RT
    // ==========================================
    public function surat()
    {
        $surat_list = Surat::with('warga')->orderBy('id', 'DESC')->get();
        $warga_list = DataWarga::orderBy('nama', 'ASC')->get();

        return view('smartrt.surat', compact('surat_list', 'warga_list'));
    }

    public function suratAjukan(Request $request)
    {
        $request->validate([
            'warga_id'    => 'required',
            'jenis_surat' => 'required',
            'keperluan'   => 'required',
        ]);

        Surat::create([
            'warga_id'          => $request->warga_id,
            'jenis_surat'       => $request->jenis_surat,
            'keperluan'         => $request->keperluan,
            'status'            => 'Pending',
            'tanggal_pengajuan' => now(),
        ]);

        return redirect()->route('smartrt.surat')->with('success', 'Permohonan surat berhasil diajukan!');
    }

    public function suratUpdateStatus($id, $status)
    {
        $s = Surat::findOrFail($id);
        $s->update(['status' => $status]);
        return redirect()->route('smartrt.surat')->with('success', 'Status surat berhasil diperbarui!');
    }

    // ==========================================
    // 5. ASPIRASI WARGA
    // ==========================================
    public function aspirasi()
    {
        $aspirasi_list = Aspirasi::orderBy('id', 'DESC')->get();
        return view('smartrt.aspirasi', compact('aspirasi_list'));
    }

    public function aspirasiKirim(Request $request)
    {
        $request->validate([
            'nama_pengirim' => 'required',
            'kategori'      => 'required',
            'isi'           => 'required',
        ]);

        Aspirasi::create([
            'nama_pengirim' => $request->nama_pengirim,
            'kategori'      => $request->kategori,
            'isi'           => $request->isi,
            'tanggal_kirim' => now(),
        ]);

        return redirect()->route('smartrt.aspirasi')->with('success', 'Aspirasi Anda berhasil dikirim ke Pengurus RT!');
    }

    // ==========================================
    // 6. INVENTARIS / ASET RT
    // ==========================================
    public function aset()
    {
        $aset_list   = Aset::orderBy('id', 'DESC')->get();
        $total_items = Aset::sum('jumlah');

        return view('smartrt.aset', compact('aset_list', 'total_items'));
    }

    public function asetTambah(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jumlah'      => 'required|numeric',
            'kondisi'     => 'required',
        ]);

        Aset::create([
            'nama_barang' => $request->nama_barang,
            'jumlah'      => $request->jumlah,
            'kondisi'     => $request->kondisi,
            'lokasi'      => $request->lokasi ?: 'Gudang RT',
        ]);

        return redirect()->route('smartrt.aset')->with('success', 'Data aset inventaris berhasil ditambahkan!');
    }

    public function asetHapus($id)
    {
        Aset::destroy($id);
        return redirect()->route('smartrt.aset')->with('success', 'Aset berhasil dihapus!');
    }

    // ==========================================
    // 7. PENGURUS RT & PROFIL RT
    // ==========================================
    public function pengurus()
    {
        $pengurus_list = PengurusRt::all();
        return view('smartrt.pengurus', compact('pengurus_list'));
    }

    public function datart()
    {
        $profil = DataRt::first();
        return view('smartrt.datart', compact('profil'));
    }

    public function datartUpdate(Request $request)
    {
        $profil = DataRt::first() ?: new DataRt();
        $profil->fill($request->all());
        $profil->save();

        return redirect()->route('smartrt.datart')->with('success', 'Profil RT berhasil diperbarui!');
    }

    // ==========================================
    // 8. DATABASE & MIGRASI MANAGEMENT
    // ==========================================
    public function backup()
    {
        // 1. Ambil daftar file migrasi dan statusnya
        $migrationFiles = glob(database_path('migrations/*.php'));
        sort($migrationFiles);

        $ranMigrations = collect();
        if (Schema::hasTable('migrations')) {
            $ranMigrations = DB::table('migrations')->get()->keyBy('migration');
        }

        $migrations = [];
        foreach ($migrationFiles as $filePath) {
            $fileName = basename($filePath, '.php');
            $isRan = $ranMigrations->has($fileName);
            $record = $isRan ? $ranMigrations->get($fileName) : null;

            $migrations[] = [
                'name'      => $fileName,
                'file'      => basename($filePath),
                'status'    => $isRan ? 'Ran' : 'Pending',
                'batch'     => $record ? $record->batch : '-',
                'path'      => $filePath,
            ];
        }

        // 2. Ambil informasi tabel database
        $tables = [];
        $totalRows = 0;
        $totalBytes = 0;

        try {
            $tablesRaw = DB::select('SHOW TABLE STATUS');
            foreach ($tablesRaw as $t) {
                $rowCount = (int)($t->Rows ?? 0);
                $dataBytes = (int)($t->Data_length ?? 0) + (int)($t->Index_length ?? 0);
                $totalRows += $rowCount;
                $totalBytes += $dataBytes;

                $tables[] = [
                    'name'      => $t->Name,
                    'engine'    => $t->Engine ?? 'InnoDB',
                    'rows'      => $rowCount,
                    'size'      => $dataBytes > 1048576 
                                    ? round($dataBytes / 1048576, 2) . ' MB' 
                                    : round($dataBytes / 1024, 2) . ' KB',
                    'collation' => $t->Collation ?? 'utf8mb4',
                    'status'    => $rowCount > 0 ? 'Terisi' : 'Kosong',
                ];
            }
        } catch (\Throwable $e) {
            // Fallback jika terjadi kendala akses skema
        }

        $pendingCount = collect($migrations)->where('status', 'Pending')->count();
        $stats = [
            'total_tables'       => count($tables),
            'total_migrations'   => count($migrations),
            'ran_migrations'     => count($migrations) - $pendingCount,
            'pending_migrations' => $pendingCount,
            'total_rows'         => $totalRows,
            'total_size'         => $totalBytes > 1048576 
                                    ? round($totalBytes / 1048576, 2) . ' MB' 
                                    : round($totalBytes / 1024, 2) . ' KB',
            'database_name'      => config('database.connections.mysql.database', 'kasrt'),
        ];

        return view('smartrt.backup', compact('migrations', 'tables', 'stats'));
    }

    public function runMigrate()
    {
        try {
            Artisan::call('migrate', ['--force' => true]);
            $output = trim(Artisan::output());
            return redirect()->route('smartrt.backup')->with('success', '🚀 Migrasi database berhasil dijalankan! ' . ($output ?: 'Semua tabel telah termigrasi dengan skema terbaru.'));
        } catch (\Throwable $e) {
            return redirect()->route('smartrt.backup')->with('error', '❌ Gagal menjalankan migrasi: ' . $e->getMessage());
        }
    }

    public function runSeed()
    {
        try {
            Artisan::call('db:seed', ['--force' => true]);
            $output = trim(Artisan::output());
            return redirect()->route('smartrt.backup')->with('success', '🌱 Seeder database berhasil dijalankan! Data pokok warga, pengurus, posyandu sesi, & kas awal telah terisi: ' . ($output ?: 'Selesai.'));
        } catch (\Throwable $e) {
            return redirect()->route('smartrt.backup')->with('error', '❌ Gagal menjalankan seeder: ' . $e->getMessage());
        }
    }

    public function downloadSqlBackup()
    {
        try {
            $database = config('database.connections.mysql.database', 'kasrt');
            $tables = DB::select('SHOW FULL TABLES WHERE Table_type = "BASE TABLE"');
            $colName = "Tables_in_" . $database;

            $sql = "-- ========================================================\n";
            $sql .= "-- E-KASRT DATABASE BACKUP SYSTEM\n";
            $sql .= "-- Database: {$database}\n";
            $sql .= "-- Tanggal Ekspor: " . date('Y-m-d H:i:s') . "\n";
            $sql .= "-- ========================================================\n\n";
            $sql .= "SET FOREIGN_KEY_CHECKS=0;\n";
            $sql .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
            $sql .= "START TRANSACTION;\n";
            $sql .= "SET time_zone = \"+07:00\";\n\n";

            foreach ($tables as $tableObj) {
                $tableName = isset($tableObj->$colName) ? $tableObj->$colName : current((array)$tableObj);
                if (empty($tableName)) continue;

                $sql .= "-- --------------------------------------------------------\n";
                $sql .= "-- Struktur dari tabel `{$tableName}`\n";
                $sql .= "-- --------------------------------------------------------\n";
                $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";

                $createTableRes = DB::select("SHOW CREATE TABLE `{$tableName}`");
                $createTableSql = $createTableRes[0]->{'Create Table'} ?? '';
                $sql .= $createTableSql . ";\n\n";

                // Data
                $rows = DB::table($tableName)->get();
                if ($rows->count() > 0) {
                    $sql .= "-- Dumping data untuk tabel `{$tableName}` ({$rows->count()} baris)\n";
                    foreach ($rows->chunk(50) as $chunk) {
                        $sql .= "INSERT INTO `{$tableName}` VALUES ";
                        $valuesArr = [];
                        foreach ($chunk as $row) {
                            $rowArr = (array)$row;
                            $escapedValues = array_map(function ($val) {
                                if (is_null($val)) return 'NULL';
                                return "'" . addslashes((string)$val) . "'";
                            }, $rowArr);
                            $valuesArr[] = "(" . implode(", ", $escapedValues) . ")";
                        }
                        $sql .= implode(",\n", $valuesArr) . ";\n";
                    }
                    $sql .= "\n";
                }
            }

            $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";
            $sql .= "COMMIT;\n";

            $filename = "kasrt_backup_" . date('Y-m-d_His') . ".sql";

            return response($sql, 200, [
                'Content-Type'        => 'application/sql',
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            ]);
        } catch (\Throwable $e) {
            return redirect()->route('smartrt.backup')->with('error', 'Gagal mengekspor database: ' . $e->getMessage());
        }
    }
}

