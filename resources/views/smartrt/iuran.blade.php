@extends('layouts.app')

@section('title', 'Iuran Warga RT')

@section('content')
<style>
.iuran-hero {
    background: linear-gradient(135deg, #064e3b 0%, #059669 50%, #10b981 100%);
    border-radius: 24px;
    padding: 32px 36px;
    color: #ffffff;
    box-shadow: 0 20px 40px -12px rgba(5, 150, 105, 0.4);
    margin-bottom: 26px;
}
.kpi-card {
    background: #fff;
    border-radius: 18px;
    padding: 22px;
    border: 1px solid #e2e8f0;
    margin-bottom: 22px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.04);
}
</style>

<div class="iuran-hero">
    <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 16px;">
        <div>
            <span class="badge badge-light px-3 py-1 font-weight-bold text-success mb-2" style="border-radius: 20px; font-size: 11px;">
                <i class="fas fa-coins mr-1"></i> IURAN BULANAN DIGITAL
            </span>
            <h2 class="font-weight-bold text-white mb-1">Pengelolaan Iuran Warga RT</h2>
            <p class="mb-0 text-white-50" style="font-size: 14px;">Rekap pembayaran iuran bulanan kebersihan, keamanan, dan kas sosial warga.</p>
        </div>
        <div>
            <button class="btn btn-light font-weight-bold px-4 py-2 text-success shadow" data-toggle="modal" data-target="#modalBayarIuran" style="border-radius: 12px;">
                <i class="fas fa-plus-circle mr-1"></i> + Catat Bayar Iuran
            </button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="kpi-card">
            <small class="text-muted text-uppercase font-weight-bold" style="font-size: 11px;">Total Iuran Terverifikasi</small>
            <h3 class="font-weight-bold text-success mb-0" style="font-family: 'JetBrains Mono';">Rp {{ rupiah($total_terkumpul ?? 0) }}</h3>
        </div>
    </div>
    <div class="col-md-6">
        <div class="kpi-card">
            <small class="text-muted text-uppercase font-weight-bold" style="font-size: 11px;">Total Transaksi Iuran</small>
            <h3 class="font-weight-bold text-primary mb-0">{{ count($iuran_list) }} Pembayaran</h3>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header bg-white py-3 border-bottom font-weight-bold text-dark">
        Daftar Pembayaran Iuran Warga
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th>Warga</th>
                    <th>Periode</th>
                    <th>Nominal</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th>Tanggal Bayar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($iuran_list as $i)
                <tr>
                    <td>
                        <strong class="text-dark">{{ $i->warga->nama ?? '-' }}</strong>
                        <small class="d-block text-muted">NIK: {{ $i->warga->nik ?? '-' }}</small>
                    </td>
                    <td><span class="badge badge-light border">{{ $i->bulan }} {{ $i->tahun }}</span></td>
                    <td class="font-weight-bold text-success" style="font-family: 'JetBrains Mono';">Rp {{ rupiah($i->jumlah) }}</td>
                    <td><span class="badge badge-light border">{{ $i->metode }}</span></td>
                    <td>
                        @if($i->status === 'Disetujui')
                            <span class="badge badge-success px-2 py-1">Lunas</span>
                        @else
                            <span class="badge badge-warning px-2 py-1">{{ $i->status }}</span>
                        @endif
                    </td>
                    <td>{{ date('d M Y H:i', strtotime($i->tanggal_bayar)) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Belum ada riwayat pembayaran iuran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Bayar Iuran -->
<div class="modal fade" id="modalBayarIuran" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #064e3b, #059669); padding: 22px;">
                <h5 class="modal-title font-weight-bold text-white mb-0">Catat Pembayaran Iuran</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('smartrt.iuran.bayar') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px;">Pilih Warga</label>
                        <select name="warga_id" class="form-control" required style="border-radius: 9px;">
                            @foreach($warga_list as $w)
                                <option value="{{ $w->idWarga }}">{{ $w->nama }} (NIK: {{ $w->nik }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold" style="font-size: 13px;">Bulan</label>
                            <select name="bulan" class="form-control" style="border-radius: 9px;">
                                @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bln)
                                    <option value="{{ $bln }}" {{ date('F') == $bln ? 'selected' : '' }}>{{ $bln }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold" style="font-size: 13px;">Tahun</label>
                            <input type="number" name="tahun" class="form-control" value="{{ date('Y') }}" required style="border-radius: 9px;">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px;">Nominal Iuran (Rp)</label>
                        <input type="number" name="jumlah" class="form-control" value="50000" required style="border-radius: 9px; font-weight: bold; font-size: 16px;">
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-bold" style="font-size: 13px;">Metode Pembayaran</label>
                        <select name="metode" class="form-control" style="border-radius: 9px;">
                            <option value="Tunai">Tunai</option>
                            <option value="QR">QRIS</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end" style="gap: 8px;">
                        <button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                        <button type="submit" class="btn btn-success px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px; background: #059669;">
                            <i class="fas fa-check-circle mr-1"></i> Simpan Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

