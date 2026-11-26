@extends('layouts.app')

@section('title', 'Dashboard Eksekutif')

@section('content')
@php
    $hourNow = (int) date('H');
    $greetingText = $hourNow < 11 ? 'Selamat Pagi' : ($hourNow < 15 ? 'Selamat Siang' : ($hourNow < 18 ? 'Selamat Sore' : 'Selamat Malam'));
    $rtBadge = $data_rt && !empty($data_rt->rt_number)
        ? ('RT ' . $data_rt->rt_number . ($data_rt->rw_number ? ' / RW ' . $data_rt->rw_number : '') . ($data_rt->kelurahan ? ' • ' . $data_rt->kelurahan : ''))
        : 'Portal Digital Smart RT';
@endphp

<style>
:root {
    --glass-bg: rgba(255, 255, 255, 0.88);
    --glass-border: rgba(255, 255, 255, 0.96);
    --glass-shadow: 0 10px 30px -4px rgba(15, 23, 42, 0.05), 0 0 0 1px rgba(226, 232, 240, 0.7);
    --glass-hover-shadow: 0 18px 40px -6px rgba(15, 23, 42, 0.1), 0 0 0 1px #cbd5e1;
}

/* 1. Executive Greeting Mesh Banner */
.dash-hero-mesh {
    background: linear-gradient(135deg, #071022 0%, #0d2144 40%, #1d4ed8 78%, #0284c7 100%);
    border-radius: 24px;
    padding: 28px 34px;
    color: #ffffff;
    box-shadow: 0 22px 48px -12px rgba(2, 132, 199, 0.35);
    position: relative;
    overflow: hidden;
    margin-bottom: 24px;
    border: 1px solid rgba(255, 255, 255, 0.14);
}
.dash-hero-mesh::before {
    content: '';
    position: absolute;
    width: 380px;
    height: 380px;
    background: radial-gradient(circle, rgba(56, 189, 248, 0.32) 0%, rgba(6, 182, 212, 0) 70%);
    top: -110px;
    right: 6%;
    border-radius: 50%;
    filter: blur(50px);
    pointer-events: none;
}
.dash-hero-mesh::after {
    content: '';
    position: absolute;
    width: 280px;
    height: 280px;
    background: radial-gradient(circle, rgba(16, 185, 129, 0.24) 0%, rgba(16, 185, 129, 0) 70%);
    bottom: -90px;
    right: 30%;
    border-radius: 50%;
    filter: blur(45px);
    pointer-events: none;
}

.hero-pill-badge {
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.22);
    color: #bae6fd;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.7px;
    padding: 5px 13px;
    border-radius: 30px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
    text-transform: uppercase;
}
.pulsing-dot-green {
    width: 8px;
    height: 8px;
    background: #34d399;
    border-radius: 50%;
    box-shadow: 0 0 0 0 rgba(52, 211, 153, 0.8);
    animation: pulseDot 2s infinite;
}
@keyframes pulseDot {
    0% { box-shadow: 0 0 0 0 rgba(52, 211, 153, 0.8); }
    70% { box-shadow: 0 0 0 8px rgba(52, 211, 153, 0); }
    100% { box-shadow: 0 0 0 0 rgba(52, 211, 153, 0); }
}

.hero-action-btn {
    border-radius: 12px;
    font-size: 13px;
    font-weight: 700;
    padding: 9px 16px;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    text-decoration: none !important;
}
.hero-action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 22px rgba(0, 0, 0, 0.24);
    color: #ffffff;
}

.hero-status-chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 11px;
    border-radius: 99px;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none !important;
    transition: all 0.2s;
}
.hero-status-chip:hover {
    transform: translateY(-1px);
    opacity: 0.92;
}

/* 2. Fintech KPI Grid */
.glass-kpi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(245px, 1fr));
    gap: 18px;
    margin-bottom: 24px;
}
.glass-kpi-card {
    background: var(--glass-bg);
    backdrop-filter: blur(16px) saturate(180%);
    -webkit-backdrop-filter: blur(16px) saturate(180%);
    border-radius: 20px;
    padding: 22px 24px;
    border: 1px solid var(--glass-border);
    box-shadow: var(--glass-shadow);
    position: relative;
    overflow: hidden;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}
.glass-kpi-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--glass-hover-shadow);
}
.glass-kpi-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
}
.glass-kpi-card.accent-blue::before { background: linear-gradient(90deg, #0284c7, #38bdf8); }
.glass-kpi-card.accent-emerald::before { background: linear-gradient(90deg, #059669, #34d399); }
.glass-kpi-card.accent-rose::before { background: linear-gradient(90deg, #e11d48, #fb7185); }
.glass-kpi-card.accent-purple::before { background: linear-gradient(90deg, #7c3aed, #c084fc); }

.kpi-icon-glass {
    width: 46px;
    height: 46px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
}
.accent-blue .kpi-icon-glass { background: rgba(14, 165, 233, 0.14); color: #0284c7; }
.accent-emerald .kpi-icon-glass { background: rgba(16, 185, 129, 0.14); color: #059669; }
.accent-rose .kpi-icon-glass { background: rgba(244, 63, 94, 0.14); color: #e11d48; }
.accent-purple .kpi-icon-glass { background: rgba(139, 92, 246, 0.14); color: #7c3aed; }

.kpi-title-label {
    font-size: 11px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    margin-bottom: 5px;
}
.kpi-amount-val {
    font-size: 25px;
    font-weight: 800;
    line-height: 1.15;
    letter-spacing: -0.6px;
    font-family: 'JetBrains Mono', 'Plus Jakarta Sans', monospace;
    margin-bottom: 7px;
}
.kpi-sub-indicator {
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 0;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* 3. Quick Access 1-Click Action Hub */
.quick-access-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
    gap: 14px;
    margin-bottom: 24px;
}
.qa-tile {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 14px 16px;
    border-radius: 16px;
    background: rgba(255, 255, 255, 0.88);
    border: 1px solid rgba(226, 232, 240, 0.85);
    box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
    text-decoration: none !important;
    color: inherit;
    position: relative;
    transition: all 0.2s cubic-bezier(0.22, 1, 0.36, 1);
}
.qa-tile:hover {
    transform: translateY(-3px);
    border-color: #38bdf8;
    box-shadow: 0 12px 26px -6px rgba(2, 132, 199, 0.18);
}
body.dark-exec .qa-tile {
    background: rgba(15, 23, 42, 0.86);
    border-color: rgba(148, 163, 184, 0.18);
}
.qa-icon {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}
.qa-title {
    font-size: 13px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 2px;
}
.qa-sub {
    font-size: 11px;
    color: #64748b;
    line-height: 1.25;
}
.qa-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 2px 7px;
    border-radius: 99px;
    font-size: 10px;
    font-weight: 800;
    background: #f59e0b;
    color: #ffffff;
}

/* 4. Section Containers & Mutasi Feed */
.glass-section-card {
    background: var(--glass-bg);
    backdrop-filter: blur(16px) saturate(180%);
    -webkit-backdrop-filter: blur(16px) saturate(180%);
    border-radius: 20px;
    border: 1px solid var(--glass-border);
    box-shadow: var(--glass-shadow);
    padding: 24px;
    margin-bottom: 24px;
    transition: all 0.25s ease;
}

.tx-filter-pill {
    border: 1px solid #e2e8f0;
    background: #ffffff;
    color: #475569;
    font-size: 12px;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 99px;
    cursor: pointer;
    transition: all 0.18s;
}
.tx-filter-pill.active,
.tx-filter-pill:hover {
    background: #0284c7;
    color: #ffffff;
    border-color: #0284c7;
}
body.dark-exec .tx-filter-pill {
    background: #1e293b;
    border-color: rgba(148, 163, 184, 0.25);
    color: #cbd5e1;
}
body.dark-exec .tx-filter-pill.active {
    background: #0284c7;
    color: #ffffff;
}

.table-custom-dash {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}
.table-custom-dash thead th {
    background: #f8fafc;
    color: #475569;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.7px;
    padding: 13px 18px;
    border-top: none;
    border-bottom: 1.5px solid #e2e8f0;
}
.table-custom-dash tbody td {
    padding: 14px 18px;
    vertical-align: middle;
    border-top: 1px solid #f1f5f9;
    font-size: 13.5px;
}
.table-custom-dash tbody tr:hover td {
    background: #f8faff;
}

.badge-tag-flow {
    padding: 5px 11px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.badge-tag-flow.masuk {
    background: #ecfdf5;
    color: #047857;
    border: 1px solid #a7f3d0;
}
.badge-tag-flow.keluar {
    background: #fff1f2;
    color: #be123c;
    border: 1px solid #fecdd3;
}
</style>

<!-- 1. EXECUTIVE GREETING BANNER -->
<div class="dash-hero-mesh">
    <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 18px; position: relative; z-index: 2;">
        <div>
            <div class="hero-pill-badge">
                <span class="pulsing-dot-green"></span>
                {{ $rtBadge }} &bull; {{ date('d M Y') }}
            </div>
            <h1 class="font-weight-bold text-white mb-2" style="font-size: 26px; letter-spacing: -0.6px;">
                {{ $greetingText }}, {{ Auth::user()->user ?? 'Administrator' }}!
            </h1>
            <p class="mb-0" style="font-size: 13.5px; color: #cbd5e1; max-width: 620px; line-height: 1.5;">
                Kelola pemasukan, pengeluaran, iuran warga, verifikasi pendaftaran, dan pantau scanner RFID Posyandu dari satu kendali terpusat.
            </p>
        </div>

        <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
            <a href="{{ route('kas.masuk') }}" class="btn hero-action-btn" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%); color: #ffffff;">
                <i class="fas fa-plus-circle"></i> Catat Pemasukan
            </a>
            <a href="{{ route('kas.keluar') }}" class="btn hero-action-btn" style="background: linear-gradient(135deg, #dc2626 0%, #f43f5e 100%); color: #ffffff;">
                <i class="fas fa-minus-circle"></i> Catat Pengeluaran
            </a>
            <a href="{{ route('kas.laporan') }}" class="btn hero-action-btn" style="background: rgba(255, 255, 255, 0.14); color: #ffffff;">
                <i class="fas fa-file-invoice-dollar"></i> Laporan
            </a>
            <a href="{{ route('posyandu.index') }}" class="btn hero-action-btn" style="background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%); color: #ffffff;">
                <i class="fas fa-heartbeat"></i> Posyandu IoT
            </a>
        </div>
    </div>

    <!-- Live Operational & Task Queue Strip -->
    <div class="mt-4 pt-3 d-flex flex-wrap align-items-center justify-content-between border-top" style="border-color: rgba(255,255,255,0.14) !important; font-size: 12.5px; gap: 10px; position: relative; z-index: 2;">
        <div class="d-flex flex-wrap align-items-center" style="gap: 14px;">
            <span style="color: #cbd5e1;">
                <i class="fas fa-shield-alt text-success mr-1"></i>
                Kesehatan Kas: <strong class="text-white">{{ $rasio_keuangan }}% Likuid</strong>
            </span>
            <span style="color: #cbd5e1;">
                <i class="fas fa-chart-line text-info mr-1"></i>
                Surplus {{ date('M Y') }}: <strong class="text-white font-mono">Rp {{ rupiah($surplus_bulan_ini) }}</strong>
            </span>
        </div>

        <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
            @if(($pending_verifikasi ?? 0) > 0)
                <a href="{{ route('admin.warga.verifikasi') }}" class="hero-status-chip" style="background: rgba(245, 158, 11, 0.24); border: 1px solid rgba(251, 191, 36, 0.55); color: #fde68a;">
                    <i class="fas fa-user-clock"></i>
                    <span>{{ $pending_verifikasi }} Verifikasi Warga Menunggu &rarr;</span>
                </a>
            @endif
            @if(($pending_surat ?? 0) > 0)
                <a href="{{ route('smartrt.surat') }}" class="hero-status-chip" style="background: rgba(56, 189, 248, 0.22); border: 1px solid rgba(125, 211, 252, 0.5); color: #e0f2fe;">
                    <i class="fas fa-envelope-open-text"></i>
                    <span>{{ $pending_surat }} Surat Perlu Diproses &rarr;</span>
                </a>
            @endif
            <a href="{{ route('posyandu.index') }}" class="hero-status-chip" style="background: {{ !empty($rfid_online) ? 'rgba(16, 185, 129, 0.25)' : 'rgba(255, 255, 255, 0.12)' }}; border: 1px solid {{ !empty($rfid_online) ? 'rgba(52, 211, 153, 0.55)' : 'rgba(255, 255, 255, 0.25)' }}; color: #ffffff;">
                <i class="fas fa-satellite-dish"></i>
                <span>ESP32 RFID {{ !empty($rfid_online) ? 'Online' : 'Standby' }}</span>
            </a>
        </div>
    </div>
</div>

<!-- 2. 4 FINTECH GLASSMORPHIC KPI CARDS -->
<div class="glass-kpi-grid">
    <div class="glass-kpi-card accent-emerald">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="kpi-icon-glass">
                <i class="fas fa-arrow-down text-success"></i>
            </div>
            <span class="badge px-2 py-1 font-weight-bold" style="font-size: 10.5px; border-radius: 6px; background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                AKUMULASI
            </span>
        </div>
        <div class="kpi-title-label">Total Pemasukan Kas</div>
        <div class="kpi-amount-val text-success dash-countup" style="color: #059669 !important;">
            Rp {{ rupiah($total_masuk) }}
        </div>
        <p class="kpi-sub-indicator">
            <i class="fas fa-calendar-alt text-info"></i> + Rp {{ rupiah($masuk_bulan_ini) }} bulan ini
        </p>
    </div>

    <div class="glass-kpi-card accent-rose">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="kpi-icon-glass">
                <i class="fas fa-arrow-up text-danger"></i>
            </div>
            <span class="badge px-2 py-1 font-weight-bold" style="font-size: 10.5px; border-radius: 6px; background: #fff1f2; color: #e11d48; border: 1px solid #fecdd3;">
                TERALOKASI
            </span>
        </div>
        <div class="kpi-title-label">Total Pengeluaran Kas</div>
        <div class="kpi-amount-val text-danger dash-countup" style="color: #e11d48 !important;">
            Rp {{ rupiah($total_keluar) }}
        </div>
        <p class="kpi-sub-indicator">
            <i class="fas fa-receipt text-danger"></i> - Rp {{ rupiah($keluar_bulan_ini) }} bulan ini
        </p>
    </div>

    <div class="glass-kpi-card accent-blue">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="kpi-icon-glass">
                <i class="fas fa-wallet text-primary"></i>
            </div>
            <span class="badge px-2 py-1 font-weight-bold" style="font-size: 10.5px; border-radius: 6px; background: #f0f9ff; color: #0284c7; border: 1px solid #bae6fd;">
                {{ $saldo >= 0 ? 'SURPLUS BERSIH' : 'DEFISIT' }}
            </span>
        </div>
        <div class="kpi-title-label">Saldo Kas RT Saat Ini</div>
        <div class="kpi-amount-val text-primary dash-countup" style="color: #0284c7 !important;">
            Rp {{ rupiah($saldo) }}
        </div>
        <div style="height: 5px; border-radius: 99px; background: rgba(148,163,184,0.2); overflow: hidden; margin-bottom: 7px;">
            <div style="height: 100%; width: {{ max(4, min(100, (int)$rasio_keuangan)) }}%; background: linear-gradient(90deg, #0284c7, #10b981); border-radius: 99px;"></div>
        </div>
        <p class="kpi-sub-indicator">
            <i class="fas fa-check-circle text-success"></i> Likuiditas kas {{ $rasio_keuangan }}% terjaga
        </p>
    </div>

    <div class="glass-kpi-card accent-purple">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="kpi-icon-glass">
                <i class="fas fa-users" style="color: #7c3aed;"></i>
            </div>
            <span class="badge px-2 py-1 font-weight-bold" style="font-size: 10.5px; border-radius: 6px; background: #f5f3ff; color: #7c3aed; border: 1px solid #ddd6fe;">
                WARGA RT
            </span>
        </div>
        <div class="kpi-title-label">Total Warga Terdata</div>
        <div class="kpi-amount-val dash-countup" style="color: #7c3aed;">
            {{ $total_warga }} <span style="font-size: 15px; font-weight: 600; color: #94a3b8;">Jiwa</span>
        </div>
        <p class="kpi-sub-indicator">
            <i class="fas fa-home" style="color: #7c3aed;"></i> {{ $total_kk }} KK &bull; {{ $total_balita }} Balita Posyandu
        </p>
    </div>
</div>

<!-- 3. AKSES CEPAT 1-KLIK LAYANAN SMART RT -->
<div class="d-flex align-items-center justify-content-between mb-2">
    <h6 class="font-weight-bold text-uppercase mb-0" style="font-size: 11.5px; letter-spacing: 0.8px; color: #64748b;">
        <i class="fas fa-bolt text-warning mr-1"></i> Pintasan Cepat Layanan Utama (1-Klik)
    </h6>
    <button type="button" class="btn btn-sm btn-link font-weight-bold p-0" style="font-size: 12px;" onclick="window.openKasCommand && window.openKasCommand()">
        Buka Semua Menu (Ctrl+K) &rarr;
    </button>
</div>
<div class="quick-access-grid">
    <a href="{{ route('kas.masuk') }}" class="qa-tile">
        <div class="qa-icon" style="background: rgba(16, 185, 129, 0.14); color: #059669;"><i class="fas fa-coins"></i></div>
        <div>
            <div class="qa-title">Pemasukan Kas</div>
            <div class="qa-sub">Catat dana masuk &amp; kwitansi</div>
        </div>
    </a>
    <a href="{{ route('kas.keluar') }}" class="qa-tile">
        <div class="qa-icon" style="background: rgba(244, 63, 94, 0.14); color: #e11d48;"><i class="fas fa-hand-holding-usd"></i></div>
        <div>
            <div class="qa-title">Pengeluaran Kas</div>
            <div class="qa-sub">Belanja operasional RT</div>
        </div>
    </a>
    <a href="{{ route('admin.warga.verifikasi') }}" class="qa-tile">
        <div class="qa-icon" style="background: rgba(245, 158, 11, 0.16); color: #d97706;"><i class="fas fa-user-check"></i></div>
        <div>
            <div class="qa-title">Verifikasi Warga</div>
            <div class="qa-sub">Setujui pendaftar akun baru</div>
        </div>
        @if(($pending_verifikasi ?? 0) > 0)
            <span class="qa-badge">{{ $pending_verifikasi }} Baru</span>
        @endif
    </a>
    <a href="{{ route('smartrt.iuran') }}" class="qa-tile">
        <div class="qa-icon" style="background: rgba(14, 165, 233, 0.15); color: #0284c7;"><i class="fas fa-money-check-alt"></i></div>
        <div>
            <div class="qa-title">Iuran Warga</div>
            <div class="qa-sub">Bayar cepat &amp; tagihan bulanan</div>
        </div>
    </a>
    <a href="{{ route('posyandu.index') }}" class="qa-tile">
        <div class="qa-icon" style="background: rgba(225, 29, 72, 0.14); color: #e11d48;"><i class="fas fa-heartbeat"></i></div>
        <div>
            <div class="qa-title">Posyandu Balita IoT</div>
            <div class="qa-sub">Absensi RFID e-KTP &amp; KMS</div>
        </div>
    </a>
    <a href="{{ route('smartrt.surat') }}" class="qa-tile">
        <div class="qa-icon" style="background: rgba(99, 102, 241, 0.14); color: #4f46e5;"><i class="fas fa-envelope-open-text"></i></div>
        <div>
            <div class="qa-title">Surat Pengantar</div>
            <div class="qa-sub">Domisili, SKCK &amp; keterangan</div>
        </div>
        @if(($pending_surat ?? 0) > 0)
            <span class="qa-badge" style="background:#0284c7;">{{ $pending_surat }}</span>
        @endif
    </a>
    <a href="{{ route('warga.index') }}" class="qa-tile">
        <div class="qa-icon" style="background: rgba(139, 92, 246, 0.14); color: #7c3aed;"><i class="fas fa-users"></i></div>
        <div>
            <div class="qa-title">Master Data Warga</div>
            <div class="qa-sub">Kelola KK, NIK &amp; kartu RFID</div>
        </div>
    </a>
    <a href="{{ route('smartrt.backup') }}" class="qa-tile">
        <div class="qa-icon" style="background: rgba(13, 148, 136, 0.14); color: #0d9488;"><i class="fas fa-database"></i></div>
        <div>
            <div class="qa-title">Backup &amp; Restore</div>
            <div class="qa-sub">Download SQL &amp; sync database</div>
        </div>
    </a>
</div>

<!-- 4. VISUAL ANALYTICS ROW -->
<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="glass-section-card h-100">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3" style="gap: 10px;">
                <div>
                    <h5 class="font-weight-bold text-dark mb-1">
                        <i class="fas fa-chart-area text-primary mr-2"></i>Tren Arus Kas 6 Bulan Terakhir
                    </h5>
                    <small class="text-muted">Komparasi laju arus kas masuk dan kas keluar lingkungan RT</small>
                </div>
                <span class="badge px-2 py-1 font-weight-bold" style="border-radius: 6px; font-size: 11px; background: #e0f2fe; color: #0369a1;">
                    Sinkron Real-Time
                </span>
            </div>
            <div style="height: 280px; position: relative;">
                <canvas id="cashflowTrendChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="glass-section-card h-100 d-flex flex-column justify-content-between">
            <div>
                <h5 class="font-weight-bold text-dark mb-1">
                    <i class="fas fa-chart-pie text-success mr-2"></i>Rasio Alokasi Kas
                </h5>
                <small class="text-muted d-block mb-3">Proporsi saldo simpanan vs pengeluaran kas RT</small>
                <div style="height: 185px; position: relative;" class="my-2">
                    <canvas id="cashflowDonutChart"></canvas>
                </div>
            </div>

            <div class="p-3 mt-3" style="background: rgba(240, 253, 244, 0.9); border-radius: 14px; border: 1.5px solid #bbf7d0;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="d-flex align-items-center">
                        <div style="width: 36px; height: 36px; border-radius: 10px; background: #dcfce7; display: flex; align-items: center; justify-content: center; margin-right: 10px; font-size: 16px; color: #059669;">
                            <i class="fas fa-satellite-dish"></i>
                        </div>
                        <div>
                            <strong class="text-dark d-block" style="font-size: 13px; color: #0f172a !important;">Posyandu Balita IoT</strong>
                            <small style="color: #475569; font-size: 11.5px;">
                                {{ !empty($rfid_online) ? 'Scanner ESP32 Aktif' : 'Siap Terima Tap e-KTP' }}
                            </small>
                        </div>
                    </div>
                    <a href="{{ route('posyandu.index') }}" class="btn btn-sm btn-success font-weight-bold px-3 py-1" style="border-radius: 8px; background: #059669; border: none;">
                        Buka &rarr;
                    </a>
                </div>
                <div class="d-flex justify-content-between align-items-center pt-2 border-top" style="border-color: #bbf7d0 !important; font-size: 11.5px; color: #065f46;">
                    <span>Sesi: <strong>{{ $sesi_aktif ? $sesi_aktif->judul_sesi : 'Belum ada sesi aktif' }}</strong></span>
                    @if(!empty($last_rfid_uid))
                        <code style="background: #dcfce7; color: #047857; padding: 1px 6px; border-radius: 5px;">UID: {{ $last_rfid_uid }}</code>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 5. MUTASI & TRANSAKSI KAS TERBARU WITH LIVE FILTER -->
<div class="glass-section-card p-0" style="overflow: hidden;">
    <div class="p-3 px-4 border-bottom d-flex justify-content-between align-items-center flex-wrap" style="gap: 12px; background: rgba(248, 250, 252, 0.78);">
        <div>
            <h5 class="font-weight-bold text-dark mb-1">
                <i class="fas fa-history text-primary mr-2"></i>Mutasi &amp; Transaksi Kas RT Terbaru
            </h5>
            <small class="text-muted">Menampilkan hingga 15 transaksi terakhir &bull; Filter instan tanpa reload</small>
        </div>
        <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
            <div class="d-flex align-items-center" style="gap: 5px;">
                <button type="button" class="tx-filter-pill active" data-tx-filter="all" onclick="filterDashTx('all', this)">Semua</button>
                <button type="button" class="tx-filter-pill" data-tx-filter="masuk" onclick="filterDashTx('masuk', this)">Masuk</button>
                <button type="button" class="tx-filter-pill" data-tx-filter="keluar" onclick="filterDashTx('keluar', this)">Keluar</button>
            </div>
            <input type="text" id="dashTxSearch" class="form-control form-control-sm" placeholder="Cari uraian / tanggal..." style="width: 190px; height: 32px; font-size: 12.5px;">
            <a href="{{ route('kas.masuk') }}" class="btn btn-outline-primary btn-sm font-weight-bold" style="border-radius: 9px;">
                Lihat Semua &rarr;
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-custom-dash mb-0" id="dashTxTable">
            <thead>
                <tr>
                    <th style="width: 140px;">Tanggal</th>
                    <th>Keterangan / Uraian Transaksi</th>
                    <th style="width: 140px;">Jenis</th>
                    <th style="width: 200px;" class="text-right">Nominal (Rp)</th>
                    <th style="width: 110px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi_terbaru as $t)
                @php
                    $isMasuk = (strtolower(trim($t->jenis)) === 'masuk');
                @endphp
                <tr data-tx-type="{{ $isMasuk ? 'masuk' : 'keluar' }}">
                    <td>
                        <div class="font-weight-bold text-dark">{{ date('d M Y', strtotime($t->tanggal)) }}</div>
                        <small class="text-muted">{{ date('l', strtotime($t->tanggal)) }}</small>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div style="width: 34px; height: 34px; border-radius: 8px; background: {{ $isMasuk ? '#ecfdf5' : '#fff1f2' }}; color: {{ $isMasuk ? '#059669' : '#e11d48' }}; display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">
                                <i class="fas {{ $isMasuk ? 'fa-arrow-down' : 'fa-arrow-up' }} font-size-14"></i>
                            </div>
                            <strong class="text-dark" style="font-size: 13.5px; font-weight: 700;">{{ $t->keterangan }}</strong>
                        </div>
                    </td>
                    <td>
                        @if($isMasuk)
                            <span class="badge-tag-flow masuk">
                                <i class="fas fa-arrow-down"></i> Pemasukan
                            </span>
                        @else
                            <span class="badge-tag-flow keluar">
                                <i class="fas fa-arrow-up"></i> Pengeluaran
                            </span>
                        @endif
                    </td>
                    <td class="text-right">
                        <span class="font-weight-bold font-mono" style="font-size: 14.5px; color: {{ $isMasuk ? '#047857' : '#be123c' }};">
                            {{ $isMasuk ? '+' : '-' }} Rp {{ rupiah($t->jumlah) }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('kas.kwitansi', $t->idKas) }}" target="_blank" class="btn btn-light btn-sm border text-primary font-weight-bold" title="Cetak Kwitansi Bukti" style="border-radius: 8px;">
                            <i class="fas fa-receipt mr-1"></i> Bukti
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">
                        <i class="fas fa-receipt fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
                        <h5>Belum Ada Riwayat Transaksi Kas</h5>
                        <p style="font-size: 13px;">Transaksi yang dicatat akan otomatis tampil di sini secara real-time.</p>
                    </td>
                </tr>
                @endforelse
                <tr id="dashTxEmptySearch" style="display: none;">
                    <td colspan="5" class="text-center py-4 text-muted" style="font-size: 13.5px;">
                        Tidak ada mutasi yang sesuai dengan filter atau kata kunci pencarian.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Smooth Count-Up on Dashboard KPI Values
    document.querySelectorAll('.dash-countup').forEach(function(el) {
        var spanSuffix = el.querySelector('span');
        if (spanSuffix && el.firstChild) {
            var targetInt = parseInt((el.firstChild.textContent || '').replace(/\D/g, ''), 10);
            if (!targetInt || targetInt <= 0) return;
            var t0 = performance.now();
            (function step(now) {
                var p = Math.min(1, (now - t0) / 800);
                var ease = 1 - Math.pow(1 - p, 3);
                el.firstChild.textContent = Math.round(targetInt * ease) + ' ';
                if (p < 1) requestAnimationFrame(step);
                else el.firstChild.textContent = targetInt + ' ';
            })(performance.now());
            return;
        }
        var raw = el.textContent.trim();
        var m = raw.match(/^(Rp\s*)([0-9][0-9.]*)$/);
        if (!m) return;
        var target = parseInt(m[2].replace(/\./g, ''), 10);
        if (!target || target <= 0) return;
        var start = performance.now();
        (function stepRp(now) {
            var p = Math.min(1, (now - start) / 950);
            var ease = 1 - Math.pow(1 - p, 4);
            var val = Math.round(target * ease);
            el.textContent = 'Rp ' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            if (p < 1) requestAnimationFrame(stepRp);
            else el.textContent = raw;
        })(performance.now());
    });

    // Live Client Filter + Search on Mutasi Kas Table
    var currentType = 'all';
    var searchInp = document.getElementById('dashTxSearch');
    window.filterDashTx = function(type, btnEl) {
        currentType = type || 'all';
        if (btnEl) {
            document.querySelectorAll('.tx-filter-pill').forEach(function(b) { b.classList.remove('active'); });
            btnEl.classList.add('active');
        }
        applyDashTxFilter();
    };
    function applyDashTxFilter() {
        var q = searchInp ? (searchInp.value || '').trim().toLowerCase() : '';
        var rows = document.querySelectorAll('#dashTxTable tbody tr[data-tx-type]');
        var visibleCount = 0;
        rows.forEach(function(row) {
            var typeOk = (currentType === 'all' || row.getAttribute('data-tx-type') === currentType);
            var textOk = (!q || (row.textContent || '').toLowerCase().indexOf(q) !== -1);
            var show = typeOk && textOk;
            row.style.display = show ? '' : 'none';
            if (show) visibleCount++;
        });
        var emptyRow = document.getElementById('dashTxEmptySearch');
        if (emptyRow) emptyRow.style.display = (rows.length > 0 && visibleCount === 0) ? '' : 'none';
    }
    if (searchInp) searchInp.addEventListener('input', applyDashTxFilter);

    // Chart.js Area Chart 6 Bulan & Donut Chart
    var trendChart = null;
    var donutChart = null;
    function isDarkDash() {
        return document.body.classList.contains('dark-exec');
    }

    var ctxTrend = document.getElementById('cashflowTrendChart');
    if (ctxTrend && typeof Chart !== 'undefined') {
        var labels = {!! json_encode($chart_labels) !!};
        var dataMasuk = {!! json_encode($chart_masuk) !!};
        var dataKeluar = {!! json_encode($chart_keluar) !!};

        trendChart = new Chart(ctxTrend, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Pemasukan (Rp)',
                        data: dataMasuk,
                        borderColor: '#059669',
                        backgroundColor: 'rgba(5, 150, 105, 0.14)',
                        borderWidth: 2.8,
                        fill: true,
                        tension: 0.38,
                        pointRadius: 4,
                        pointBackgroundColor: '#059669'
                    },
                    {
                        label: 'Pengeluaran (Rp)',
                        data: dataKeluar,
                        borderColor: '#e11d48',
                        backgroundColor: 'rgba(225, 29, 72, 0.09)',
                        borderWidth: 2.5,
                        fill: true,
                        tension: 0.38,
                        pointRadius: 3.5,
                        pointBackgroundColor: '#e11d48'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: isDarkDash() ? '#e2e8f0' : '#334155',
                            font: { family: 'Plus Jakarta Sans', weight: '700', size: 12 },
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': Rp ' + Number(context.raw).toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        grid: { color: isDarkDash() ? 'rgba(148, 163, 184, 0.16)' : 'rgba(226, 232, 240, 0.7)' },
                        ticks: {
                            color: isDarkDash() ? '#94a3b8' : '#64748b',
                            callback: function(value) {
                                return 'Rp ' + Number(value).toLocaleString('id-ID');
                            },
                            font: { family: 'JetBrains Mono', size: 11 }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            color: isDarkDash() ? '#94a3b8' : '#64748b',
                            font: { family: 'Plus Jakarta Sans', weight: '600', size: 11 }
                        }
                    }
                }
            }
        });
    }

    var ctxDonut = document.getElementById('cashflowDonutChart');
    if (ctxDonut && typeof Chart !== 'undefined') {
        var totalKeluar = {{ (float)$total_keluar }};
        var saldo = {{ max(0, (float)$saldo) }};
        var hasData = (saldo > 0 || totalKeluar > 0);

        donutChart = new Chart(ctxDonut, {
            type: 'doughnut',
            data: {
                labels: hasData ? ['Sisa Saldo Kas', 'Pengeluaran Kas'] : ['Belum Ada Transaksi'],
                datasets: [{
                    data: hasData ? [saldo, totalKeluar] : [1],
                    backgroundColor: hasData ? ['#0284c7', '#e11d48'] : ['#cbd5e1'],
                    borderWidth: 2,
                    borderColor: isDarkDash() ? '#0f172a' : '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: isDarkDash() ? '#e2e8f0' : '#334155',
                            font: { family: 'Plus Jakarta Sans', weight: '600', size: 11 },
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                if (!hasData) return 'Belum ada data transaksi';
                                return context.label + ': Rp ' + Number(context.raw).toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    }

    window.addEventListener('dash:theme', function(ev) {
        var dark = ev && ev.detail && ev.detail.dark;
        if (trendChart) {
            trendChart.options.plugins.legend.labels.color = dark ? '#e2e8f0' : '#334155';
            trendChart.options.scales.y.grid.color = dark ? 'rgba(148, 163, 184, 0.16)' : 'rgba(226, 232, 240, 0.7)';
            trendChart.options.scales.y.ticks.color = dark ? '#94a3b8' : '#64748b';
            trendChart.options.scales.x.ticks.color = dark ? '#94a3b8' : '#64748b';
            trendChart.update();
        }
        if (donutChart) {
            donutChart.data.datasets[0].borderColor = dark ? '#0f172a' : '#ffffff';
            donutChart.options.plugins.legend.labels.color = dark ? '#e2e8f0' : '#334155';
            donutChart.update();
        }
    });
});
</script>
@endsection
