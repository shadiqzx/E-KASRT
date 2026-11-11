@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    .dash-kpi-card {
        background: #fff;
        border-radius: 18px;
        padding: 22px 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px -3px rgba(15,23,42,0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        margin-bottom: 20px;
    }
    .dash-kpi-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
    }
    .dash-kpi-card.emerald::before { background: linear-gradient(90deg, #059669, #34d399); }
    .dash-kpi-card.rose::before { background: linear-gradient(90deg, #e11d48, #fb7185); }
    .dash-kpi-card.blue::before { background: linear-gradient(90deg, #0284c7, #38bdf8); }
    .dash-kpi-card.purple::before { background: linear-gradient(90deg, #7c3aed, #c084fc); }

    .dash-kpi-val {
        font-size: 26px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.1;
    }
    .dash-kpi-lbl {
        font-size: 12px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 6px;
    }
    .dash-kpi-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }
    .emerald .dash-kpi-icon { background: #ecfdf5; color: #059669; }
    .rose .dash-kpi-icon { background: #fff1f2; color: #e11d48; }
    .blue .dash-kpi-icon { background: #f0f9ff; color: #0284c7; }
    .purple .dash-kpi-icon { background: #f5f3ff; color: #7c3aed; }
</style>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div>
        <h2 class="font-weight-bold text-dark mb-1">Dashboard Ikhtisar RT</h2>
        <p class="text-muted mb-0" style="font-size: 14px;">Selamat datang di Sistem Informasi Keuangan & Smart RT.</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex gap-2" style="gap: 10px;">
        <a href="{{ route('kas.masuk') }}" class="btn btn-success btn-sm font-weight-bold px-3 py-2" style="border-radius: 10px;">
            <i class="fas fa-plus mr-1"></i> Catat Pemasukan
        </a>
        <a href="{{ route('posyandu.index') }}" class="btn btn-primary btn-sm font-weight-bold px-3 py-2" style="border-radius: 10px;">
            <i class="fas fa-heartbeat mr-1"></i> Posyandu IoT
        </a>
    </div>
</div>

<!-- 4 KPI Cards -->
<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="dash-kpi-card emerald">
            <div>
                <div class="dash-kpi-val">Rp {{ number_format($total_masuk, 0, ',', '.') }}</div>
                <div class="dash-kpi-lbl">Total Pemasukan</div>
            </div>
            <div class="dash-kpi-icon">💰</div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="dash-kpi-card rose">
            <div>
                <div class="dash-kpi-val">Rp {{ number_format($total_keluar, 0, ',', '.') }}</div>
                <div class="dash-kpi-lbl">Total Pengeluaran</div>
            </div>
            <div class="dash-kpi-icon">💸</div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="dash-kpi-card blue">
            <div>
                <div class="dash-kpi-val">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
                <div class="dash-kpi-lbl">Saldo Kas Saat Ini</div>
            </div>
            <div class="dash-kpi-icon">🏦</div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="dash-kpi-card purple">
            <div>
                <div class="dash-kpi-val">{{ $total_warga }}</div>
                <div class="dash-kpi-lbl">Total Warga Terdata</div>
            </div>
            <div class="dash-kpi-icon">👥</div>
        </div>
    </div>
</div>

<!-- Transaksi Terbaru Table -->
<div class="card border-0 shadow-sm mt-2" style="border-radius: 18px; overflow: hidden;">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="font-weight-bold text-dark mb-0">Transaksi Kas RT Terbaru</h5>
        <a href="{{ route('kas.masuk') }}" class="btn btn-outline-primary btn-sm font-weight-bold" style="border-radius: 8px;">
            Lihat Semua Transaksi
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-top-0">Tanggal</th>
                        <th class="border-top-0">Keterangan</th>
                        <th class="border-top-0">Jenis</th>
                        <th class="border-top-0 text-right">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi_terbaru as $t)
                        <tr>
                            <td>{{ date('d M Y', strtotime($t->tanggal)) }}</td>
                            <td><strong class="text-dark">{{ $t->keterangan }}</strong></td>
                            <td>
                                @if($t->jenis === 'Masuk')
                                    <span class="badge badge-success px-2 py-1">Pemasukan</span>
                                @else
                                    <span class="badge badge-danger px-2 py-1">Pengeluaran</span>
                                @endif
                            </td>
                            <td class="text-right font-weight-bold {{ $t->jenis === 'Masuk' ? 'text-success' : 'text-danger' }}">
                                {{ $t->jenis === 'Masuk' ? '+' : '-' }} Rp {{ number_format($t->jumlah, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada transaksi kas tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

