@extends('layouts.app')

@section('title', 'Laporan Rekapitulasi Kas RT')

@section('content')
<style>
.laporan-hero {
    background: linear-gradient(135deg, #1e293b 0%, #0f766e 50%, #059669 100%);
    border-radius: 24px;
    padding: 32px 36px;
    color: #ffffff;
    box-shadow: 0 20px 40px -12px rgba(5, 150, 105, 0.4);
    margin-bottom: 26px;
}
@media print {
    .menu-sidebar, .header-desktop, .laporan-hero, .filter-card, .btn-print-box {
        display: none !important;
    }
    .page-container {
        padding-left: 0 !important;
    }
    .main-content {
        padding-top: 0 !important;
    }
}
</style>

<div class="laporan-hero">
    <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 16px;">
        <div>
            <span class="badge badge-light px-3 py-1 font-weight-bold text-success mb-2" style="border-radius: 20px; font-size: 11px;">
                <i class="fas fa-file-invoice-dollar mr-1"></i> PEMBUKUAN KEUANGAN
            </span>
            <h2 class="font-weight-bold text-white mb-1">Laporan Rekapitulasi Kas RT</h2>
            <p class="mb-0 text-white-50" style="font-size: 14px;">Rekapitulasi pembukuan arus kas masuk dan kas keluar dengan filter rentang tanggal.</p>
        </div>
        <div class="btn-print-box">
            <button onclick="window.print()" class="btn btn-light font-weight-bold px-4 py-2 text-dark shadow" style="border-radius: 12px;">
                <i class="fas fa-print mr-1"></i> Cetak Laporan (Print / PDF)
            </button>
        </div>
    </div>
</div>

<!-- Filter Card -->
<div class="card border-0 shadow-sm filter-card mb-4" style="border-radius: 20px;">
    <div class="card-body p-4">
        <form action="{{ route('kas.laporan') }}" method="GET" class="row align-items-end">
            <div class="col-md-4 form-group mb-3 mb-md-0">
                <label class="font-weight-bold" style="font-size: 13px;">Dari Tanggal</label>
                <input type="date" name="tgl_mulai" class="form-control" value="{{ $tgl_mulai }}" style="border-radius: 9px;">
            </div>
            <div class="col-md-4 form-group mb-3 mb-md-0">
                <label class="font-weight-bold" style="font-size: 13px;">Sampai Tanggal</label>
                <input type="date" name="tgl_selesai" class="form-control" value="{{ $tgl_selesai }}" style="border-radius: 9px;">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary btn-block font-weight-bold py-2 shadow-sm" style="border-radius: 9px;">
                    <i class="fas fa-filter mr-1"></i> Filter Data
                </button>
            </div>
        </form>
    </div>
</div>

<!-- 3 Summary Badges -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 16px; background: #ecfdf5;">
            <small class="text-muted font-weight-bold text-uppercase">Total Pemasukan</small>
            <h4 class="font-weight-bold text-success mb-0" style="font-family: 'JetBrains Mono';">+ Rp {{ rupiah($total_masuk) }}</h4>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 16px; background: #fff1f2;">
            <small class="text-muted font-weight-bold text-uppercase">Total Pengeluaran</small>
            <h4 class="font-weight-bold text-danger mb-0" style="font-family: 'JetBrains Mono';">- Rp {{ rupiah($total_keluar) }}</h4>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 16px; background: #eff6ff;">
            <small class="text-muted font-weight-bold text-uppercase">Saldo Periode Ini</small>
            <h4 class="font-weight-bold text-primary mb-0" style="font-family: 'JetBrains Mono';">Rp {{ rupiah($saldo) }}</h4>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header bg-white py-3 border-bottom font-weight-bold text-dark d-flex justify-content-between align-items-center">
        <span>Tabel Pembukuan Kas ({{ date('d/m/Y', strtotime($tgl_mulai)) }} s/d {{ date('d/m/Y', strtotime($tgl_selesai)) }})</span>
        <span class="badge badge-light border">{{ count($kas_list) }} Transaksi</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th style="width: 130px;">Tanggal</th>
                    <th>Keterangan / Transaksi</th>
                    <th style="width: 140px;">Jenis</th>
                    <th style="width: 180px;" class="text-right">Nominal (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kas_list as $k)
                <tr>
                    <td>{{ date('d M Y', strtotime($k->tanggal)) }}</td>
                    <td><strong>{{ $k->keterangan }}</strong></td>
                    <td>
                        <span class="badge {{ $k->jenis === 'Masuk' ? 'badge-success' : 'badge-danger' }} px-2 py-1">
                            {{ $k->jenis }}
                        </span>
                    </td>
                    <td class="text-right font-weight-bold {{ $k->jenis === 'Masuk' ? 'text-success' : 'text-danger' }}" style="font-family: 'JetBrains Mono';">
                        {{ $k->jenis === 'Masuk' ? '+' : '-' }} Rp {{ rupiah($k->jumlah) }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">Tidak ada transaksi pada rentang tanggal ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
