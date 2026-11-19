@extends('layouts.app')

@section('title', 'Database & Migrasi Kas RT')

@section('content')
<style>
.db-hero {
    background: linear-gradient(135deg, #064e3b 0%, #065f46 45%, #047857 100%);
    border-radius: 24px;
    padding: 32px 36px;
    color: #ffffff;
    box-shadow: 0 20px 45px -12px rgba(6, 78, 59, 0.45);
    margin-bottom: 26px;
    position: relative;
    overflow: hidden;
}
.db-hero::after {
    content: '';
    position: absolute;
    right: -30px;
    bottom: -40px;
    width: 240px;
    height: 240px;
    background: radial-gradient(circle, rgba(16, 185, 129, 0.25) 0%, rgba(255,255,255,0) 70%);
    border-radius: 50%;
    pointer-events: none;
}
.hero-btn-glass {
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: #ffffff;
    backdrop-filter: blur(8px);
    transition: all 0.25s ease;
    border-radius: 12px;
    font-weight: 600;
    padding: 10px 18px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.hero-btn-glass:hover {
    background: rgba(255, 255, 255, 0.28);
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
.bento-card {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid #eef2f6;
    padding: 22px 24px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
    transition: all 0.25s ease;
    height: 100%;
}
.bento-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.06);
    border-color: #d1fae5;
}
.nav-pills-modern {
    background: #f1f5f9;
    border-radius: 16px;
    padding: 6px;
    gap: 6px;
    display: inline-flex;
}
.nav-pills-modern .nav-link {
    border-radius: 12px;
    font-weight: 600;
    color: #475569;
    padding: 9px 20px;
    transition: all 0.2s ease;
    border: none;
}
.nav-pills-modern .nav-link.active {
    background: #059669;
    color: #ffffff;
    box-shadow: 0 6px 14px rgba(5, 150, 105, 0.35);
}
.table-modern {
    margin-bottom: 0;
}
.table-modern thead th {
    background: #f8fafc;
    color: #475569;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    border: none;
    padding: 14px 18px;
    font-weight: 700;
}
.table-modern tbody td {
    padding: 14px 18px;
    vertical-align: middle;
    border-top: 1px solid #f1f5f9;
    font-size: 13.5px;
}
.table-modern tbody tr:hover {
    background-color: #f8fafc;
}
.badge-status {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 11.5px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.badge-status.success {
    background: #d1fae5;
    color: #065f46;
}
.badge-status.warning {
    background: #fef3c7;
    color: #92400e;
}
.badge-status.info {
    background: #e0f2fe;
    color: #0369a1;
}
.badge-status.neutral {
    background: #f1f5f9;
    color: #475569;
}
</style>

{{-- Flash Alert Messages --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 16px; background: #ecfdf5; color: #065f46;" role="alert">
    <div class="d-flex align-items-center">
        <i class="fas fa-check-circle fa-lg mr-3 text-success"></i>
        <div style="font-size: 14px;">{{ session('success') }}</div>
    </div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color: #065f46;">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 16px; background: #fef2f2; color: #991b1b;" role="alert">
    <div class="d-flex align-items-center">
        <i class="fas fa-exclamation-triangle fa-lg mr-3 text-danger"></i>
        <div style="font-size: 14px;">{{ session('error') }}</div>
    </div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color: #991b1b;">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

{{-- Hero Banner --}}
<div class="db-hero">
    <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 20px;">
        <div>
            <div class="d-flex align-items-center mb-2" style="gap: 8px;">
                <span class="badge badge-light px-3 py-1 font-weight-bold text-success" style="border-radius: 20px; font-size: 11px;">
                    <i class="fas fa-database mr-1"></i> MYSQL 8.4 ENGINE
                </span>
                <span class="badge px-3 py-1 font-weight-bold" style="border-radius: 20px; font-size: 11px; background: rgba(255,255,255,0.2); color: #fff;">
                    <i class="fas fa-code-branch mr-1"></i> LARAVEL 11 MIGRATION
                </span>
            </div>
            <h2 class="font-weight-bold text-white mb-2" style="letter-spacing: -0.5px;">Pusat Kendali Migrasi & Database Kas RT</h2>
            <p class="mb-0 text-white-50" style="font-size: 14px; max-width: 620px;">
                Pantau skema tabel, eksekusi migrasi skema baru, isi data pokok warga (seeder), dan unduh backup database riil langsung dari panel website.
            </p>
        </div>
        <div class="d-flex flex-wrap align-items-center" style="gap: 10px;">
            <button type="button" class="hero-btn-glass" data-toggle="modal" data-target="#modalMigrate" title="Jalankan php artisan migrate --force">
                <i class="fas fa-play text-warning"></i>
                <span>Jalankan Migrasi</span>
            </button>
            <button type="button" class="hero-btn-glass" data-toggle="modal" data-target="#modalSeed" title="Jalankan php artisan db:seed --force">
                <i class="fas fa-seedling text-success"></i>
                <span>Isi Data / Seeder</span>
            </button>
            <a href="{{ route('smartrt.database.export') }}" class="hero-btn-glass" style="background: rgba(255,255,255,0.92); color: #064e3b;" title="Download Full SQL Dump">
                <i class="fas fa-download text-success"></i>
                <span>Download SQL</span>
            </a>
        </div>
    </div>
</div>

{{-- Bento KPI Summary Cards --}}
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
        <div class="bento-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted font-weight-bold" style="font-size: 12.5px; text-transform: uppercase;">Total Tabel</span>
                <div style="width: 42px; height: 42px; border-radius: 12px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fas fa-table"></i>
                </div>
            </div>
            <div class="h3 font-weight-bold text-dark mb-1">{{ $stats['total_tables'] }} <small class="text-muted font-weight-normal" style="font-size: 13px;">Tabel</small></div>
            <span class="badge-status success">
                <i class="fas fa-check-circle"></i> Database: {{ $stats['database_name'] }}
            </span>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
        <div class="bento-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted font-weight-bold" style="font-size: 12.5px; text-transform: uppercase;">File Migrasi</span>
                <div style="width: 42px; height: 42px; border-radius: 12px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fas fa-layer-group"></i>
                </div>
            </div>
            <div class="h3 font-weight-bold text-dark mb-1">{{ $stats['total_migrations'] }} <small class="text-muted font-weight-normal" style="font-size: 13px;">File</small></div>
            @if ($stats['pending_migrations'] == 0)
                <span class="badge-status success">
                    <i class="fas fa-check-double"></i> 100% Termigrasi
                </span>
            @else
                <span class="badge-status warning">
                    <i class="fas fa-clock"></i> {{ $stats['pending_migrations'] }} File Pending
                </span>
            @endif
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
        <div class="bento-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted font-weight-bold" style="font-size: 12.5px; text-transform: uppercase;">Total Record Baris</span>
                <div style="width: 42px; height: 42px; border-radius: 12px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fas fa-list-ol"></i>
                </div>
            </div>
            <div class="h3 font-weight-bold text-dark mb-1">{{ number_format($stats['total_rows'], 0, ',', '.') }} <small class="text-muted font-weight-normal" style="font-size: 13px;">Baris</small></div>
            <span class="badge-status info">
                <i class="fas fa-sync-alt"></i> Seluruh Tabel Aktif
            </span>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
        <div class="bento-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted font-weight-bold" style="font-size: 12.5px; text-transform: uppercase;">Ukuran Database</span>
                <div style="width: 42px; height: 42px; border-radius: 12px; background: #f3e8ff; color: #9333ea; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fas fa-hdd"></i>
                </div>
            </div>
            <div class="h3 font-weight-bold text-dark mb-1">{{ $stats['total_size'] }}</div>
            <span class="badge-status neutral">
                <i class="fas fa-shield-alt"></i> InnoDB Engine
            </span>
        </div>
    </div>
</div>

{{-- Navigation Tabs & Tables --}}
<div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header bg-white border-0 pt-4 px-4 pb-2 d-flex flex-wrap justify-content-between align-items-center" style="gap: 14px;">
        <ul class="nav nav-pills-modern" id="dbTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="tab-migrate-link" data-toggle="pill" href="#tab-migrate" role="tab">
                    <i class="fas fa-code-branch mr-1.5"></i> Status File Migrasi ({{ count($migrations) }})
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-tables-link" data-toggle="pill" href="#tab-tables" role="tab">
                    <i class="fas fa-table mr-1.5"></i> Tabel Database ({{ count($tables) }})
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-sync-link" data-toggle="pill" href="#tab-sync" role="tab">
                    <i class="fas fa-info-circle mr-1.5"></i> Panduan Local vs VPS
                </a>
            </li>
        </ul>

        <div>
            <input type="text" id="dbSearchInput" class="form-control form-control-sm" placeholder="Cari file / tabel..." style="border-radius: 10px; width: 220px; padding: 8px 14px;">
        </div>
    </div>

    <div class="card-body p-0">
        <div class="tab-content" id="dbTabsContent">
            {{-- TAB 1: STATUS FILE MIGRASI --}}
            <div class="tab-pane fade show active" id="tab-migrate" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-modern" id="tableMigrations">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Nama File Migrasi</th>
                                <th style="width: 140px;">Status</th>
                                <th style="width: 100px;">Batch</th>
                                <th style="width: 180px;">Keterangan Tabel</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($migrations as $index => $m)
                            <tr>
                                <td class="text-muted font-weight-bold">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div style="width: 34px; height: 34px; border-radius: 8px; background: #f1f5f9; color: #475569; display: flex; align-items: center; justify-content: center; margin-right: 12px; font-size: 14px;">
                                            <i class="fas fa-file-code"></i>
                                        </div>
                                        <div>
                                            <strong class="text-dark d-block" style="font-size: 13.5px;">{{ $m['file'] }}</strong>
                                            <small class="text-muted font-mono" style="font-size: 11px;">database/migrations/{{ $m['file'] }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($m['status'] === 'Ran')
                                        <span class="badge-status success">
                                            <i class="fas fa-check-circle"></i> Sudah Berjalan
                                        </span>
                                    @else
                                        <span class="badge-status warning">
                                            <i class="fas fa-clock"></i> Pending (Belum)
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($m['batch'] !== '-')
                                        <span class="badge badge-light px-2.5 py-1 text-primary font-weight-bold" style="border-radius: 8px; font-size: 12px;">
                                            Batch #{{ $m['batch'] }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">
                                        @if (str_contains($m['name'], 'users'))
                                            Autentikasi & Akun Pengguna
                                        @elseif (str_contains($m['name'], 'cache'))
                                            Cache & Session Management
                                        @elseif (str_contains($m['name'], 'jobs'))
                                            Queue Jobs & Failed Jobs
                                        @elseif (str_contains($m['name'], 'transactions'))
                                            Pencatatan Keuangan Transaksi
                                        @elseif (str_contains($m['name'], 'smartrt_and_posyandu'))
                                            Posyandu, Aset, Surat, Profil RT
                                        @elseif (str_contains($m['name'], 'add_rfid'))
                                            Kolom RFID & No HP Data Warga
                                        @elseif (str_contains($m['name'], 'core_system'))
                                            Data Warga, Kas Pokok & User Role
                                        @else
                                            Skema Database Kas RT
                                        @endif
                                    </small>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Tidak ada file migrasi yang ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- TAB 2: TABEL DATABASE --}}
            <div class="tab-pane fade" id="tab-tables" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-modern" id="tableDatabase">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Nama Tabel</th>
                                <th style="width: 140px;">Jumlah Baris</th>
                                <th style="width: 130px;">Ukuran Data</th>
                                <th style="width: 120px;">Engine</th>
                                <th style="width: 140px;">Status Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tables as $index => $t)
                            <tr>
                                <td class="text-muted font-weight-bold">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div style="width: 34px; height: 34px; border-radius: 8px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; margin-right: 12px; font-size: 14px;">
                                            <i class="fas fa-table"></i>
                                        </div>
                                        <div>
                                            <strong class="text-dark font-mono" style="font-size: 14px;">{{ $t['name'] }}</strong>
                                            <small class="text-muted d-block" style="font-size: 11px;">Collation: {{ $t['collation'] }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light px-2.5 py-1 font-weight-bold text-dark" style="border-radius: 8px; font-size: 12.5px;">
                                        {{ number_format($t['rows'], 0, ',', '.') }} record
                                    </span>
                                </td>
                                <td class="text-muted font-mono" style="font-size: 13px;">{{ $t['size'] }}</td>
                                <td>
                                    <span class="badge badge-light text-secondary font-weight-bold" style="border-radius: 6px; font-size: 11px;">
                                        {{ $t['engine'] }}
                                    </span>
                                </td>
                                <td>
                                    @if ($t['status'] === 'Terisi')
                                        <span class="badge-status success">
                                            <i class="fas fa-check"></i> Terisi Data
                                        </span>
                                    @else
                                        <span class="badge-status neutral">
                                            <i class="fas fa-minus-circle"></i> Kosong (0)
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Tidak ada tabel terdeteksi di database.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- TAB 3: PANDUAN LOCAL VS VPS --}}
            <div class="tab-pane fade p-4" id="tab-sync" role="tabpanel">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="p-3 border rounded-lg h-100" style="border-radius: 16px; background: #f8fafc; border-color: #e2e8f0 !important;">
                            <div class="d-flex align-items-center mb-2">
                                <div style="width: 36px; height: 36px; border-radius: 10px; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 16px; margin-right: 12px;">
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                <h6 class="font-weight-bold mb-0 text-dark">Mengapa Data di VPS Kosong Saat Pindah?</h6>
                            </div>
                            <p class="text-muted mb-2" style="font-size: 13px; line-height: 1.6;">
                                Saat deploy pertama ke VPS, perintah <code>php artisan migrate</code> hanya membuat struktur skema tabel kosong. Data warga, pengurus, dan transaksi di lokal Anda tidak otomatis ter-copy kecuali dijalankan seeder atau di-import dari file SQL.
                            </p>
                            <div class="p-2.5 bg-white rounded border" style="font-size: 12px;">
                                <strong class="text-dark">Solusi Instan:</strong> Klik tombol <strong class="text-success"><i class="fas fa-seedling"></i> Isi Data / Seeder</strong> di atas, maka sistem otomatis mengisi data warga pokok, sesi posyandu balita, dan saldo kas awal ke VPS!
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="p-3 border rounded-lg h-100" style="border-radius: 16px; background: #f8fafc; border-color: #e2e8f0 !important;">
                            <div class="d-flex align-items-center mb-2">
                                <div style="width: 36px; height: 36px; border-radius: 10px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 16px; margin-right: 12px;">
                                    <i class="fas fa-cloud-download-alt"></i>
                                </div>
                                <h6 class="font-weight-bold mb-0 text-dark">Sinkronisasi Database Riil Menggunakan File .SQL</h6>
                            </div>
                            <p class="text-muted mb-2" style="font-size: 13px; line-height: 1.6;">
                                Jika Anda memiliki data lengkap di lokal komputer atau ingin membuat salinan cadangan berkala dari server live VPS, gunakan tombol <strong class="text-success"><i class="fas fa-download"></i> Download SQL</strong>. File SQL yang diunduh mencakup seluruh 26 tabel dan seluruh baris data secara akurat.
                            </p>
                            <div class="p-2.5 bg-white rounded border" style="font-size: 12px;">
                                <strong class="text-dark">Fitur Otomatis:</strong> File ekspor dilengkapi <code>SET FOREIGN_KEY_CHECKS=0;</code> sehingga aman di-import ke phpMyAdmin atau MySQL CLI tanpa hambatan relasi.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL: JALANKAN MIGRASI --}}
<div class="modal fade" id="modalMigrate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div class="d-flex align-items-center">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-right: 14px;">
                        <i class="fas fa-play"></i>
                    </div>
                    <div>
                        <h5 class="modal-title font-weight-bold text-dark">Jalankan Migrasi Database</h5>
                        <small class="text-muted">Perbarui skema tabel ke versi terbaru</small>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('smartrt.database.migrate') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <p class="text-muted mb-3" style="font-size: 13.5px;">
                        Perintah ini akan menjalankan seluruh file migrasi pending menggunakan:
                        <br>
                        <code class="d-block mt-1 p-2 bg-light rounded text-dark font-weight-bold">php artisan migrate --force</code>
                    </p>
                    <div class="alert alert-info border-0 mb-0" style="border-radius: 12px; font-size: 12.5px;">
                        <i class="fas fa-info-circle mr-1"></i> Aman dijalankan kapan saja. Tabel yang sudah ada tidak akan dihapus atau diduplikasi.
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 px-4">
                    <button type="button" class="btn btn-light font-weight-bold px-4" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-primary font-weight-bold px-4" style="border-radius: 10px;">
                        <i class="fas fa-bolt mr-1"></i> Eksekusi Migrasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL: JALANKAN SEEDER --}}
<div class="modal fade" id="modalSeed" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div class="d-flex align-items-center">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-right: 14px;">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <div>
                        <h5 class="modal-title font-weight-bold text-dark">Isi Data Awal (Seeder)</h5>
                        <small class="text-muted">Populate data warga pokok, sesi, dan kas</small>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('smartrt.database.seed') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <p class="text-muted mb-3" style="font-size: 13.5px;">
                        Perintah ini akan mengisi data awal sistem yang meliputi:
                    </p>
                    <ul class="text-muted pl-3 mb-3" style="font-size: 13px; line-height: 1.8;">
                        <li><strong>Akun Admin:</strong> <code>admin@kasrt.com</code> / <code>admin123</code></li>
                        <li><strong>Data Warga Pokok:</strong> Yohan Riki (UID e-KTP Siap Tap), Ahmad Sidiq, Echa Jesica, Rudi Hidayat, Elisabet, dll.</li>
                        <li><strong>Sesi Posyandu Balita:</strong> Sesi aktif hari ini & balita tertaut.</li>
                        <li><strong>Data Aset & Pengurus RT:</strong> Ketua RT, Sekretaris, Bendahara, Inventaris.</li>
                        <li><strong>Data Kas Awal:</strong> Pembukuan transaksi pemasukan & pengeluaran.</li>
                    </ul>
                    <div class="alert alert-warning border-0 mb-0" style="border-radius: 12px; font-size: 12.5px;">
                        <i class="fas fa-shield-alt mr-1"></i> Data warga menggunakan pengecekan NIK unik sehingga tidak akan menduplikasi warga yang sudah ada.
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 px-4">
                    <button type="button" class="btn btn-light font-weight-bold px-4" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-success font-weight-bold px-4" style="border-radius: 10px;">
                        <i class="fas fa-seedling mr-1"></i> Jalankan Seeder
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('dbSearchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            const activeTab = document.querySelector('.tab-pane.active');
            if (activeTab) {
                const rows = activeTab.querySelectorAll('tbody tr');
                rows.forEach(function(row) {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(query) ? '' : 'none';
                });
            }
        });
    }
});
</script>
@endpush
@endsection
