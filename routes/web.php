<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\SmartRtController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

// Authentication Routes (supports both modern /login and legacy /auth)
Route::match(['get', 'post'], '/auth', [AuthController::class, 'showLogin']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');
Route::match(['get', 'post'], '/auth/logout', [AuthController::class, 'logout']);

// Public Welcome / Landing Page (Portal Selamat Datang & Sekilas Fitur E-KASRT)
Route::get('/', function () {
    $total_masuk  = (float) \App\Models\DataKas::where('jenis', 'Masuk')->sum('jumlah');
    $total_keluar = (float) \App\Models\DataKas::where('jenis', 'Keluar')->sum('jumlah');
    $saldo        = $total_masuk - $total_keluar;
    $total_warga  = \App\Models\DataWarga::count();
    $total_balita = \App\Models\PosyanduBalita::count();
    $total_kk     = \App\Models\DataWarga::whereNotNull('no_kk')->where('no_kk', '!=', '')->distinct('no_kk')->count('no_kk') ?: 34;

    return view('welcome', compact('saldo', 'total_masuk', 'total_keluar', 'total_warga', 'total_balita', 'total_kk'));
})->name('welcome');

// ESP32 RFID IoT & Polling Endpoints (Public/API with API Key)
Route::match(['get', 'post'], '/smartrt/posyandu_rfid_tap', [PosyanduController::class, 'rfidTap'])->name('posyandu.rfid_tap');
Route::get('/smartrt/posyandu_live_stream', [PosyanduController::class, 'liveStream'])->name('posyandu.live_stream');
Route::get('/smartrt/download_firmware_ino', [PosyanduController::class, 'downloadFirmwareIno'])->name('posyandu.download_ino');
Route::get('/smartrt/download_firmware_zip', [PosyanduController::class, 'downloadFirmwareZip'])->name('posyandu.download_zip');
Route::get('/smartrt/posyandu_cetak_kms/{id}', [PosyanduController::class, 'cetakKms'])->name('posyandu.cetak_kms');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 1. Kas Transaksi (supports both /kas-masuk and /kasRT)
    Route::get('/kas-masuk', [KasController::class, 'masuk'])->name('kas.masuk');
    Route::get('/kasRT', [KasController::class, 'masuk']);
    Route::get('/kas-keluar', [KasController::class, 'keluar'])->name('kas.keluar');
    Route::get('/kasRT/kasKeluar', [KasController::class, 'keluar']);
    Route::post('/kas/store', [KasController::class, 'store'])->name('kas.store');
    Route::post('/kas/update/{id}', [KasController::class, 'update'])->name('kas.update');
    Route::get('/kas/delete/{id}', [KasController::class, 'destroy'])->name('kas.destroy');
    Route::get('/kas/kwitansi/{id}', [KasController::class, 'kwitansi'])->name('kas.kwitansi');
    Route::get('/kasRT/kwitansiKas/{id}', [KasController::class, 'kwitansi']);

    // Laporan & Kategori Kas
    Route::get('/kas/laporan', [KasController::class, 'laporan'])->name('kas.laporan');
    Route::get('/kasRT/laporan', [KasController::class, 'laporan']);
    Route::get('/kas/kategori', [KasController::class, 'kategori'])->name('kas.kategori');
    Route::get('/kasRT/kategori', [KasController::class, 'kategori']);

    // Transfer Kas
    Route::get('/transfer', [SmartRtController::class, 'transfer'])->name('smartrt.transfer');
    Route::get('/kasRT/transfer', [SmartRtController::class, 'transfer']);
    Route::get('/smartrt/transfer', [SmartRtController::class, 'transfer']);
    Route::post('/kasRT/addTransfer', [SmartRtController::class, 'addTransfer'])->name('smartrt.transfer.store');
    Route::post('/smartrt/addTransfer', [SmartRtController::class, 'addTransfer']);

    // 2. Master Data Warga
    Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
    Route::post('/warga/store', [WargaController::class, 'store'])->name('warga.store');
    Route::post('/warga/update/{id}', [WargaController::class, 'update'])->name('warga.update');
    Route::get('/warga/delete/{id}', [WargaController::class, 'destroy'])->name('warga.destroy');

    // Pengurus RT & Profil RT
    Route::get('/smartrt/pengurus', [SmartRtController::class, 'pengurus'])->name('smartrt.pengurus');
    Route::get('/smartrt/datart', [SmartRtController::class, 'datart'])->name('smartrt.datart');
    Route::post('/smartrt/datart_update', [SmartRtController::class, 'datartUpdate'])->name('smartrt.datart.update');

    // 3. Layanan Smart RT: Posyandu Balita Digital
    Route::get('/smartrt/posyandu', [PosyanduController::class, 'index'])->name('posyandu.index');
    Route::post('/smartrt/posyandu_pair_ktp', [PosyanduController::class, 'pairKtp'])->name('posyandu.pair_ktp');
    Route::post('/smartrt/posyandu_sesi_tambah', [PosyanduController::class, 'sesiTambah'])->name('posyandu.sesi_tambah');
    Route::get('/smartrt/posyandu_sesi_status/{id}/{status}', [PosyanduController::class, 'sesiStatus'])->name('posyandu.sesi_status');
    Route::post('/smartrt/posyandu_hadir_manual', [PosyanduController::class, 'hadirManual'])->name('posyandu.hadir_manual');
    Route::post('/smartrt/posyandu_update_pemeriksaan/{id}', [PosyanduController::class, 'updatePemeriksaan'])->name('posyandu.update_pemeriksaan');
    Route::post('/smartrt/posyandu_balita_tambah', [PosyanduController::class, 'balitaTambah'])->name('posyandu.balita_tambah');
    Route::get('/smartrt/posyandu_balita_hapus/{id}', [PosyanduController::class, 'balitaHapus'])->name('posyandu.balita_hapus');

    // 4. Layanan Smart RT: Iuran Warga
    Route::get('/smartrt/iuran', [SmartRtController::class, 'iuran'])->name('smartrt.iuran');
    Route::post('/smartrt/iuran_bayar', [SmartRtController::class, 'iuranBayar'])->name('smartrt.iuran.bayar');
    Route::get('/smartrt/iuran_update_status/{id}/{status}', [SmartRtController::class, 'iuranUpdateStatus'])->name('smartrt.iuran.status');

    // 5. Layanan Smart RT: Bank Sampah
    Route::get('/smartrt/banksampah', [SmartRtController::class, 'banksampah'])->name('smartrt.banksampah');
    Route::post('/smartrt/banksampah_tambah', [SmartRtController::class, 'banksampahTambah'])->name('smartrt.banksampah.store');

    // 6. Layanan Smart RT: Surat Pengantar RT
    Route::get('/smartrt/surat', [SmartRtController::class, 'surat'])->name('smartrt.surat');
    Route::post('/smartrt/surat_ajukan', [SmartRtController::class, 'suratAjukan'])->name('smartrt.surat.ajukan');
    Route::get('/smartrt/surat_update_status/{id}/{status}', [SmartRtController::class, 'suratUpdateStatus'])->name('smartrt.surat.status');

    // 7. Layanan Smart RT: Aspirasi Warga
    Route::get('/smartrt/aspirasi', [SmartRtController::class, 'aspirasi'])->name('smartrt.aspirasi');
    Route::post('/smartrt/aspirasi_kirim', [SmartRtController::class, 'aspirasiKirim'])->name('smartrt.aspirasi.kirim');

    // 8. Layanan Smart RT: Aset RT
    Route::get('/smartrt/aset', [SmartRtController::class, 'aset'])->name('smartrt.aset');
    Route::post('/smartrt/aset_tambah', [SmartRtController::class, 'asetTambah'])->name('smartrt.aset.store');
    Route::get('/smartrt/aset_hapus/{id}', [SmartRtController::class, 'asetHapus'])->name('smartrt.aset.destroy');

    // 9. Pengaturan: User Management & Backup
    Route::get('/admin/user', [AdminUserController::class, 'index'])->name('admin.user');
    Route::post('/admin/user/store', [AdminUserController::class, 'store'])->name('admin.user.store');
    Route::post('/admin/user/update/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');
    Route::get('/admin/user/toggle/{id}', [AdminUserController::class, 'toggleActive'])->name('admin.user.toggle');
    Route::get('/smartrt/backup', [SmartRtController::class, 'backup'])->name('smartrt.backup');
});
