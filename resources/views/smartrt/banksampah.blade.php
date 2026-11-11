@extends('layouts.app')

@section('title', 'Bank Sampah RT')

@section('content')
<style>
.sampah-hero {
    background: linear-gradient(135deg, #0f766e 0%, #0d9488 50%, #14b8a6 100%);
    border-radius: 24px;
    padding: 32px 36px;
    color: #ffffff;
    box-shadow: 0 20px 40px -12px rgba(13, 148, 136, 0.4);
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

<div class="sampah-hero">
    <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 16px;">
        <div>
            <span class="badge badge-light px-3 py-1 font-weight-bold text-info mb-2" style="border-radius: 20px; font-size: 11px;">
                <i class="fas fa-recycle mr-1"></i> LINGKUNGAN BERSIH
            </span>
            <h2 class="font-weight-bold text-white mb-1">Bank Sampah Digital RT</h2>
            <p class="mb-0 text-white-50" style="font-size: 14px;">Timbang, catat setoran sampah pilah warga, dan kumpulkan poin reward lingkungan.</p>
        </div>
        <div>
            <button class="btn btn-light font-weight-bold px-4 py-2 text-teal shadow" data-toggle="modal" data-target="#modalBankSampah" style="border-radius: 12px; color: #0d9488;">
                <i class="fas fa-plus-circle mr-1"></i> + Timbang Setoran Sampah
            </button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="kpi-card">
            <small class="text-muted text-uppercase font-weight-bold" style="font-size: 11px;">Total Berat Sampah Terkumpul</small>
            <h3 class="font-weight-bold text-info mb-0" style="font-family: 'JetBrains Mono';">{{ number_format($total_berat ?? 0, 1) }} Kg</h3>
        </div>
    </div>
    <div class="col-md-6">
        <div class="kpi-card">
            <small class="text-muted text-uppercase font-weight-bold" style="font-size: 11px;">Total Poin Reward Warga</small>
            <h3 class="font-weight-bold text-success mb-0" style="font-family: 'JetBrains Mono';">{{ number_format($total_poin ?? 0) }} Poin</h3>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header bg-white py-3 border-bottom font-weight-bold text-dark">
        Riwayat Penimbangan & Setoran Sampah Warga
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th>Warga Penyetor</th>
                    <th>Jenis Sampah</th>
                    <th>Berat</th>
                    <th>Poin Diperoleh</th>
                    <th>Waktu Timbang</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sampah_list as $s)
                <tr>
                    <td><strong>{{ $s->warga->nama ?? '-' }}</strong></td>
                    <td><span class="badge badge-light border">{{ $s->jenis_sampah }}</span></td>
                    <td class="font-weight-bold text-dark">{{ $s->berat }} Kg</td>
                    <td><span class="badge badge-success px-2 py-1">+{{ $s->poin }} Poin</span></td>
                    <td>{{ date('d M Y H:i', strtotime($s->tanggal)) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Belum ada data setoran bank sampah.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Bank Sampah -->
<div class="modal fade" id="modalBankSampah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #0f766e, #0d9488); padding: 22px;">
                <h5 class="modal-title font-weight-bold text-white mb-0">Catat Setoran Bank Sampah</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('smartrt.banksampah.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px;">Warga Penyetor</label>
                        <select name="warga_id" class="form-control" required style="border-radius: 9px;">
                            @foreach($warga_list as $w)
                                <option value="{{ $w->idWarga }}">{{ $w->nama }} (NIK: {{ $w->nik }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px;">Jenis Sampah</label>
                        <select name="jenis_sampah" class="form-control" style="border-radius: 9px;">
                            <option value="Plastik / Botol">Plastik / Botol</option>
                            <option value="Kardus / Kertas">Kardus / Kertas</option>
                            <option value="Kaleng / Logam">Kaleng / Logam</option>
                            <option value="Minyak Jelantah">Minyak Jelantah</option>
                            <option value="Kaca / Beling">Kaca / Beling</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-bold" style="font-size: 13px;">Berat Sampah (Kg)</label>
                        <input type="number" step="0.1" name="berat" class="form-control" placeholder="Contoh: 2.5" required style="border-radius: 9px; font-weight: bold; font-size: 16px;">
                    </div>

                    <div class="d-flex justify-content-end" style="gap: 8px;">
                        <button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                        <button type="submit" class="btn btn-success px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px; background: #0d9488; border: none;">
                            <i class="fas fa-check-circle mr-1"></i> Simpan Setoran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
