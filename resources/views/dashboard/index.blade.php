@extends('layouts.app')

@section('title', 'Dashboard Eksekutif')

@section('content')
<style>
/* ================================================================
   EXECUTIVE GLASSMORPHISM DASHBOARD STYLING
   ================================================================ */
:root {
    --glass-bg: rgba(255, 255, 255, 0.80);
    --glass-border: rgba(255, 255, 255, 0.95);
    --glass-shadow: 0 10px 30px -4px rgba(15, 23, 42, 0.04), 0 0 0 1px rgba(226, 232, 240, 0.65);
    --glass-hover-shadow: 0 18px 40px -6px rgba(15, 23, 42, 0.09), 0 0 0 1px #cbd5e1;
}

/* 1. Hero Mesh Executive Banner */
.dash-hero-mesh {
    background: linear-gradient(135deg, #091224 0%, #0d2144 38%, #1e3a8a 75%, #0284c7 100%);
    border-radius: 26px;
    padding: 34px 38px;
    color: #ffffff;
    box-shadow: 0 20px 45px -12px rgba(2, 132, 199, 0.35);
    position: relative;
    overflow: hidden;
    margin-bottom: 28px;
    border: 1px solid rgba(255, 255, 255, 0.12);
}
.dash-hero-mesh::before {
    content: '';
    position: absolute;
    width: 380px;
    height: 380px;
    background: radial-gradient(circle, rgba(14, 165, 233, 0.35) 0%, rgba(6, 182, 212, 0) 70%);
    top: -100px;
    right: 8%;
    border-radius: 50%;
    filter: blur(50px);
    pointer-events: none;
}
.dash-hero-mesh::after {
    content: '';
    position: absolute;
    width: 280px;
    height: 280px;
    background: radial-gradient(circle, rgba(16, 185, 129, 0.25) 0%, rgba(16, 185, 129, 0) 70%);
    bottom: -80px;
    right: 32%;
    border-radius: 50%;
    filter: blur(45px);
    pointer-events: none;
}

.hero-pill-badge {
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.22);
    color: #bae6fd;
    font-size: 11.5px;
    font-weight: 800;
    letter-spacing: 0.8px;
    padding: 6px 14px;
    border-radius: 30px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px;
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
    font-size: 13.5px;
    font-weight: 700;
    padding: 10px 18px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(255, 255, 255, 0.18);
    backdrop-filter: blur(8px);
}
.hero-action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    color: #ffffff;
}

/* 2. Glassmorphism KPI Grid */
.glass-kpi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
    margin-bottom: 28px;
}
.glass-kpi-card {
    background: var(--glass-bg);
    backdrop-filter: blur(16px) saturate(180%);
    -webkit-backdrop-filter: blur(16px) saturate(180%);
    border-radius: 22px;
    padding: 24px 26px;
    border: 1px solid var(--glass-border);
    box-shadow: var(--glass-shadow);
    position: relative;
    overflow: hidden;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}
.glass-kpi-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--glass-hover-shadow);
    background: rgba(255, 255, 255, 0.92);
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
    width: 50px;
    height: 50px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.04);
}
.accent-blue .kpi-icon-glass { background: #f0f9ff; color: #0284c7; }
.accent-emerald .kpi-icon-glass { background: #ecfdf5; color: #059669; }
.accent-rose .kpi-icon-glass { background: #fff1f2; color: #e11d48; }
.accent-purple .kpi-icon-glass { background: #f5f3ff; color: #7c3aed; }

.kpi-title-label {
    font-size: 11.5px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    margin-bottom: 6px;
}
.kpi-amount-val {
    font-size: 27px;
    font-weight: 800;
    line-height: 1.15;
    letter-spacing: -0.6px;
    font-family: 'JetBrains Mono', 'Plus Jakarta Sans', monospace;
    margin-bottom: 8px;
}
.kpi-sub-indicator {
    font-size: 12.5px;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 0;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* 3. Glass Section Container */
.glass-section-card {
    background: var(--glass-bg);
    backdrop-filter: blur(16px) saturate(180%);
    -webkit-backdrop-filter: blur(16px) saturate(180%);
    border-radius: 22px;
    border: 1px solid var(--glass-border);
    box-shadow: var(--glass-shadow);
    padding: 26px;
    margin-bottom: 26px;
    transition: all 0.25s ease;
}

/* 4. Statement Table Styling */
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
    padding: 14px 18px;
    border-top: none;
    border-bottom: 1.5px solid #e2e8f0;
}
.table-custom-dash tbody td {
    padding: 16px 18px;
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

<!-- 1. HERO MESH EXECUTIVE BANNER -->
<div class="dash-hero-mesh">
    <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 20px;">
        <div>
            <div class="hero-pill-badge">
                <span class="pulsing-dot-green"></span>
                SISTEM INFORMASI E-KASRT &bull; {{ strtoupper(date('l, d F Y')) }}
            </div>
            <h1 class="font-weight-bold text-white mb-2" style="font-size: 28px; letter-spacing: -0.6px;">
                Dashboard Eksekutif Keuangan RT
            </h1>
            <p class="mb-0 text-white-50" style="font-size: 13.5px; max-width: 620px; line-height: 1.5;">
                Transparansi pembukuan kas lingkungan, monitoring iuran warga, dan integrasi smart IoT Posyandu balita digital berbasis e-KTP.
            </p>
        </div>

        <div class="d-flex flex-wrap align-items-center" style="gap: 10px;">
            <a href="{{ route('kas.masuk') }}" class="btn hero-action-btn" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%); color: #ffffff;">
                <i class="fas fa-plus-circle"></i> + Catat Pemasukan
            </a>
            <a href="{{ route('kas.keluar') }}" class="btn hero-action-btn" style="background: linear-gradient(135deg, #dc2626 0%, #f43f5e 100%); color: #ffffff;">
                <i class="fas fa-minus-circle"></i> - Catat Pengeluaran
            </a>
            <a href="{{ route('posyandu.index') }}" class="btn hero-action-btn" style="background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%); color: #ffffff;">
                <i class="fas fa-heartbeat"></i> Posyandu IoT
            </a>
        </div>
    </div>

    <!-- Mini Indicator Banner Bar -->
    <div class="mt-4 pt-3 d-flex flex-wrap align-items-center justify-content-between border-top" style="border-color: rgba(255,255,255,0.12) !important; font-size: 13px;">
        <div class="d-flex align-items-center text-white-50 mr-3 mb-2 mb-md-0">
            <i class="fas fa-shield-alt text-success mr-2 font-size-16"></i>
            Rasio Kesehatan Finansial RT: <strong class="text-white ml-1">{{ $rasio_keuangan }}% (Sangat Sehat)</strong>
        </div>
        <div class="d-flex align-items-center text-white-50">
            <i class="fas fa-calendar-check text-info mr-2"></i>
            Surplus Bulan Berjalan ({{ date('F Y') }}): <strong class="text-white ml-1 font-mono">Rp {{ rupiah($surplus_bulan_ini) }}</strong>
        </div>
    </div>
</div>

<!-- 2. 4 FINTECH GLASSMORPHIC KPI CARDS -->
<div class="glass-kpi-grid">
    <!-- Card 1: Total Pemasukan -->
    <div class="glass-kpi-card accent-emerald">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="kpi-icon-glass">
                <i class="fas fa-arrow-down text-success"></i>
            </div>
            <span class="badge badge-success px-2 py-1 font-weight-bold" style="font-size: 11px; border-radius: 6px; background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                AKUMULASI
            </span>
        </div>
        <div class="kpi-title-label">Total Pemasukan Kas</div>
        <div class="kpi-amount-val text-success" style="color: #059669 !important;">
            Rp {{ rupiah($total_masuk) }}
        </div>
        <p class="kpi-sub-indicator text-muted">
            <i class="fas fa-calendar-alt text-info"></i> + Rp {{ rupiah($masuk_bulan_ini) }} bulan ini
        </p>
    </div>

    <!-- Card 2: Total Pengeluaran -->
    <div class="glass-kpi-card accent-rose">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="kpi-icon-glass">
                <i class="fas fa-arrow-up text-danger"></i>
            </div>
            <span class="badge badge-danger px-2 py-1 font-weight-bold" style="font-size: 11px; border-radius: 6px; background: #fff1f2; color: #e11d48; border: 1px solid #fecdd3;">
                TERALOKASI
            </span>
        </div>
        <div class="kpi-title-label">Total Pengeluaran Kas</div>
        <div class="kpi-amount-val text-danger" style="color: #e11d48 !important;">
            Rp {{ rupiah($total_keluar) }}
        </div>
        <p class="kpi-sub-indicator text-muted">
            <i class="fas fa-receipt text-danger"></i> - Rp {{ rupiah($keluar_bulan_ini) }} bulan ini
        </p>
    </div>

    <!-- Card 3: Saldo Kas RT Saat Ini -->
    <div class="glass-kpi-card accent-blue">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="kpi-icon-glass">
                <i class="fas fa-wallet text-primary"></i>
            </div>
            <span class="badge px-2 py-1 font-weight-bold" style="font-size: 11px; border-radius: 6px; background: #f0f9ff; color: #0284c7; border: 1px solid #bae6fd;">
                {{ $saldo >= 0 ? 'SURPLUS BERSIH' : 'DEFISIT' }}
            </span>
        </div>
        <div class="kpi-title-label">Saldo Kas RT Saat Ini</div>
        <div class="kpi-amount-val text-primary" style="color: #0284c7 !important;">
            Rp {{ rupiah($saldo) }}
        </div>
        <p class="kpi-sub-indicator text-muted">
            <i class="fas fa-check-circle text-success"></i> Saldo kas likuid siap operasional
        </p>
    </div>

    <!-- Card 4: Data Kependudukan Warga -->
    <div class="glass-kpi-card accent-purple">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="kpi-icon-glass">
                <i class="fas fa-users" style="color: #7c3aed;"></i>
            </div>
            <span class="badge px-2 py-1 font-weight-bold" style="font-size: 11px; border-radius: 6px; background: #f5f3ff; color: #7c3aed; border: 1px solid #ddd6fe;">
                WARGA RT
            </span>
        </div>
        <div class="kpi-title-label">Total Warga Terdata</div>
        <div class="kpi-amount-val" style="color: #7c3aed;">
            {{ $total_warga }} <span style="font-size: 16px; font-weight: 600; color: #94a3b8;">Jiwa</span>
        </div>
        <p class="kpi-sub-indicator text-muted">
            <i class="fas fa-home" style="color: #7c3aed;"></i> {{ $total_kk }} KK &bull; {{ $total_balita }} Balita
        </p>
    </div>
</div>

<!-- 3. VISUAL ANALYTICS ROW (Chart.js Area Chart & Quick Insight) -->
<div class="row">
    <!-- Area Chart 6 Bulan -->
    <div class="col-lg-8 mb-4">
        <div class="glass-section-card h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="font-weight-bold text-dark mb-1">
                        <i class="fas fa-chart-area text-primary mr-2"></i>Tren Arus Kas 6 Bulan Terakhir
                    </h5>
                    <small class="text-muted">Komparasi laju arus kas masuk dan kas keluar lingkungan RT</small>
                </div>
                <span class="badge px-2 py-1 font-weight-bold" style="border-radius: 6px; font-size: 11px; background: #f1f5f9; color: #475569;">
                    Otomatis Terkini
                </span>
            </div>
            <div style="height: 280px; position: relative;">
                <canvas id="cashflowTrendChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Donut Chart & Posyandu Widget -->
    <div class="col-lg-4 mb-4">
        <div class="glass-section-card h-100 d-flex flex-column justify-content-between">
            <div>
                <h5 class="font-weight-bold text-dark mb-1">
                    <i class="fas fa-chart-pie text-success mr-2"></i>Rasio Alokasi Kas
                </h5>
                <small class="text-muted d-block mb-3">Proporsi saldo simpanan kas RT</small>
                <div style="height: 190px; position: relative;" class="my-2">
                    <canvas id="cashflowDonutChart"></canvas>
                </div>
            </div>

            <div class="p-3 mt-3" style="background: rgba(240, 253, 244, 0.85); border-radius: 14px; border: 1.5px solid #bbf7d0;">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div style="width: 36px; height: 36px; border-radius: 10px; background: #dcfce7; display: flex; align-items: center; justify-content: center; margin-right: 12px; font-size: 18px;">
                            👶
                        </div>
                        <div>
                            <strong class="text-dark d-block" style="font-size: 13px;">Posyandu Balita IoT</strong>
                            <small class="text-muted">Scanner e-KTP & RFID Siap</small>
                        </div>
                    </div>
                    <a href="{{ route('posyandu.index') }}" class="btn btn-sm btn-success font-weight-bold px-3 py-1" style="border-radius: 8px; background: #059669; border: none;">
                        Buka &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4. TRANSAKSI KAS TERBARU STATEMENT FEED -->
<div class="glass-section-card p-0" style="overflow: hidden;">
    <div class="p-3 px-4 border-bottom d-flex justify-content-between align-items-center flex-wrap" style="gap: 12px; background: rgba(248, 250, 252, 0.75);">
        <div>
            <h5 class="font-weight-bold text-dark mb-1">
                <i class="fas fa-history text-secondary mr-2"></i>Mutasi & Transaksi Kas RT Terbaru
            </h5>
            <small class="text-muted">Riwayat mutasi arus kas masuk, pengeluaran kas, dan transfer kas terbaru</small>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('kas.masuk') }}" class="btn btn-outline-primary btn-sm font-weight-bold" style="border-radius: 9px;">
                Lihat Semua Transaksi &rarr;
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-custom-dash mb-0">
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
                <tr>
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
                        <a href="{{ route('kas.kwitansi', $t->idKas) }}" target="_blank" class="btn btn-light btn-sm border text-primary font-weight-bold" title="Kwitansi Bukti" style="border-radius: 8px;">
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
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Area Chart Tren Arus Kas 6 Bulan
    var ctxTrend = document.getElementById('cashflowTrendChart');
    if (ctxTrend) {
        var labels = {!! json_encode($chart_labels) !!};
        var dataMasuk = {!! json_encode($chart_masuk) !!};
        var dataKeluar = {!! json_encode($chart_keluar) !!};

        new Chart(ctxTrend, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Pemasukan (Rp)',
                        data: dataMasuk,
                        borderColor: '#059669',
                        backgroundColor: 'rgba(5, 150, 105, 0.12)',
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
                        backgroundColor: 'rgba(225, 29, 72, 0.08)',
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
                        grid: { color: 'rgba(226, 232, 240, 0.7)' },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + Number(value).toLocaleString('id-ID');
                            },
                            font: { family: 'JetBrains Mono', size: 11 }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Plus Jakarta Sans', weight: '600', size: 11 } }
                    }
                }
            }
        });
    }

    // 2. Donut Chart Rasio Kas
    var ctxDonut = document.getElementById('cashflowDonutChart');
    if (ctxDonut) {
        var totalMasuk = {{ (float)$total_masuk }};
        var totalKeluar = {{ (float)$total_keluar }};
        var saldo = {{ max(0, (float)$saldo) }};

        new Chart(ctxDonut, {
            type: 'doughnut',
            data: {
                labels: ['Sisa Saldo Kas', 'Pengeluaran Kas'],
                datasets: [{
                    data: [saldo, totalKeluar],
                    backgroundColor: ['#0284c7', '#e11d48'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
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
                            font: { family: 'Plus Jakarta Sans', weight: '600', size: 11 },
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': Rp ' + Number(context.raw).toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>
@endsection
