@extends('layouts.app')

@section('title', 'Transfer Kas RT')

@section('content')
<style>
.transfer-hero {
    background: linear-gradient(135deg, #1e1b4b 0%, #4338ca 50%, #0284c7 100%);
    border-radius: 24px;
    padding: 32px 36px;
    color: #ffffff;
    box-shadow: 0 20px 40px -12px rgba(67, 56, 202, 0.4);
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

<div class="transfer-hero">
    <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 16px;">
        <div>
            <span class="badge badge-light px-3 py-1 font-weight-bold text-primary mb-2" style="border-radius: 20px; font-size: 11px;">
                <i class="fas fa-exchange-alt mr-1"></i> MUTASI DANA RT
            </span>
            <h2 class="font-weight-bold text-white mb-1">Transfer & Mutasi Kas RT</h2>
            <p class="mb-0 text-white-50" style="font-size: 14px;">Catat perpindahan kas operasional tunai, bank transfer, dan QRIS RT.</p>
        </div>
        <div>
            <button class="btn btn-light font-weight-bold px-4 py-2 text-primary shadow" data-toggle="modal" data-target="#modalTransfer" style="border-radius: 12px;">
                <i class="fas fa-plus-circle mr-1"></i> + Buat Transfer Kas
            </button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="kpi-card">
            <small class="text-muted text-uppercase font-weight-bold" style="font-size: 11px;">Saldo Kas Tersedia</small>
            <h3 class="font-weight-bold text-success mb-0" style="font-family: 'JetBrains Mono';">Rp {{ rupiah($saldo_kas ?? 0) }}</h3>
        </div>
    </div>
    <div class="col-md-6">
        <div class="kpi-card">
            <small class="text-muted text-uppercase font-weight-bold" style="font-size: 11px;">Total Riwayat Mutasi</small>
            <h3 class="font-weight-bold text-primary mb-0">{{ count($transfer_list) }} Transaksi</h3>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header bg-white py-3 border-bottom font-weight-bold text-dark">
        Riwayat Transfer & Mutasi Kas
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th>Waktu</th>
                    <th>Warga Terkait</th>
                    <th>Jenis</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                    <th>Metode</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transfer_list as $t)
                <tr>
                    <td>{{ date('d M Y H:i', strtotime($t->created_at)) }}</td>
                    <td><strong>{{ $t->warga->nama ?? '-' }}</strong></td>
                    <td>
                        <span class="badge {{ $t->jenis === 'Masuk' ? 'badge-success' : 'badge-danger' }} px-2 py-1">
                            {{ $t->jenis }}
                        </span>
                    </td>
                    <td class="font-weight-bold {{ $t->jenis === 'Masuk' ? 'text-success' : 'text-danger' }}" style="font-family: 'JetBrains Mono';">
                        {{ $t->jenis === 'Masuk' ? '+' : '-' }} Rp {{ rupiah($t->jumlah) }}
                    </td>
                    <td>{{ $t->keterangan }}</td>
                    <td><span class="badge badge-light border">{{ $t->metode }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Belum ada transaksi transfer kas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Transfer -->
<div class="modal fade" id="modalTransfer" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #1e1b4b, #4338ca); padding: 22px;">
                <h5 class="modal-title font-weight-bold text-white mb-0">Catat Transfer Kas Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('smartrt.transfer.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px;">Warga Terkait (Opsional)</label>
                        <select name="warga_id" class="form-control" style="border-radius: 9px;">
                            <option value="">-- Bukan Transaksi Perorangan --</option>
                            @foreach($warga_list as $w)
                                <option value="{{ $w->idWarga }}">{{ $w->nama }} (NIK: {{ $w->nik }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold" style="font-size: 13px;">Jenis Mutasi</label>
                            <select name="jenis" class="form-control" style="border-radius: 9px;">
                                <option value="Masuk">Masuk (Penerimaan)</option>
                                <option value="Keluar">Keluar (Pengeluaran)</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold" style="font-size: 13px;">Metode</label>
                            <select name="metode" class="form-control" style="border-radius: 9px;">
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="QR">QRIS</option>
                                <option value="Tunai">Tunai</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px;">Nominal (Rp)</label>
                        <input type="number" name="jumlah" class="form-control" placeholder="0" required style="border-radius: 9px; font-weight: bold; font-size: 16px;">
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px;">Keterangan / Keperluan</label>
                        <textarea name="keterangan" class="form-control" rows="2" placeholder="Contoh: Pemindahan kas tunai ke rekening operasional RT" required style="border-radius: 9px;"></textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-bold" style="font-size: 13px;">Info Rekening / Tujuan</label>
                        <input type="text" name="rekening_info" class="form-control" placeholder="Contoh: BCA 12345678 a/n RT 01" style="border-radius: 9px;">
                    </div>

                    <div class="d-flex justify-content-end" style="gap: 8px;">
                        <button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px;">
                            <i class="fas fa-check-circle mr-1"></i> Simpan Mutasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
