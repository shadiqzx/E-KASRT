@extends('layouts.app')

@section('title', 'Surat Pengantar RT')

@section('content')
<style>
.surat-hero {
    background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #38bdf8 100%);
    border-radius: 24px;
    padding: 32px 36px;
    color: #ffffff;
    box-shadow: 0 20px 40px -12px rgba(37, 99, 235, 0.4);
    margin-bottom: 26px;
}
</style>

<div class="surat-hero">
    <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 16px;">
        <div>
            <span class="badge badge-light px-3 py-1 font-weight-bold text-primary mb-2" style="border-radius: 20px; font-size: 11px;">
                <i class="fas fa-file-signature mr-1"></i> LAYANAN ADMINISTRASI
            </span>
            <h2 class="font-weight-bold text-white mb-1">Surat Pengantar RT Online</h2>
            <p class="mb-0 text-white-50" style="font-size: 14px;">Permohonan dan verifikasi surat pengantar domisili, pembuatan KTP, SKCK, dan kelurahan.</p>
        </div>
        <div>
            <button class="btn btn-light font-weight-bold px-4 py-2 text-primary shadow" data-toggle="modal" data-target="#modalAjukanSurat" style="border-radius: 12px;">
                <i class="fas fa-plus-circle mr-1"></i> + Ajukan Surat Baru
            </button>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header bg-white py-3 border-bottom font-weight-bold text-dark">
        Daftar Permohonan Surat Pengantar Warga
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th>Warga Pemohon</th>
                    <th>Jenis Surat</th>
                    <th>Keperluan</th>
                    <th>Status</th>
                    <th>Tanggal Pengajuan</th>
                    <th class="text-center">Aksi Verifikasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surat_list as $s)
                <tr>
                    <td>
                        <strong>{{ $s->warga->nama ?? '-' }}</strong>
                        <small class="d-block text-muted">NIK: {{ $s->warga->nik ?? '-' }}</small>
                    </td>
                    <td><span class="badge badge-light border">{{ $s->jenis_surat }}</span></td>
                    <td>{{ $s->keperluan }}</td>
                    <td>
                        @if($s->status === 'Disetujui')
                            <span class="badge badge-success px-2 py-1">Disetujui</span>
                        @elseif($s->status === 'Ditolak')
                            <span class="badge badge-danger px-2 py-1">Ditolak</span>
                        @else
                            <span class="badge badge-warning px-2 py-1">Pending</span>
                        @endif
                    </td>
                    <td>{{ date('d M Y H:i', strtotime($s->tanggal_pengajuan)) }}</td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('smartrt.surat.status', [$s->id, 'Disetujui']) }}" class="btn btn-success" title="Setujui">
                                <i class="fas fa-check"></i>
                            </a>
                            <a href="{{ route('smartrt.surat.status', [$s->id, 'Ditolak']) }}" class="btn btn-danger" title="Tolak">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Belum ada pengajuan surat pengantar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Ajukan Surat -->
<div class="modal fade" id="modalAjukanSurat" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #1e3a8a, #2563eb); padding: 22px;">
                <h5 class="modal-title font-weight-bold text-white mb-0">Ajukan Surat Pengantar</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('smartrt.surat.ajukan') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px;">Warga Pemohon</label>
                        <select name="warga_id" class="form-control" required style="border-radius: 9px;">
                            @foreach($warga_list as $w)
                                <option value="{{ $w->idWarga }}">{{ $w->nama }} (NIK: {{ $w->nik }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px;">Jenis Surat Pengantar</label>
                        <select name="jenis_surat" class="form-control" style="border-radius: 9px;">
                            <option value="Surat Pengantar KTP / KK">Surat Pengantar KTP / KK</option>
                            <option value="Surat Keterangan Domisili">Surat Keterangan Domisili</option>
                            <option value="Surat Pengantar SKCK">Surat Pengantar SKCK</option>
                            <option value="Surat Keterangan Tidak Mampu (SKTM)">Surat Keterangan Tidak Mampu (SKTM)</option>
                            <option value="Surat Keterangan Usaha">Surat Keterangan Usaha</option>
                            <option value="Surat Keterangan Kematian">Surat Keterangan Kematian</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-bold" style="font-size: 13px;">Keperluan Pembuatan</label>
                        <textarea name="keperluan" class="form-control" rows="3" placeholder="Jelaskan tujuan dan instansi yang dituju..." required style="border-radius: 9px;"></textarea>
                    </div>

                    <div class="d-flex justify-content-end" style="gap: 8px;">
                        <button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px;">
                            <i class="fas fa-paper-plane mr-1"></i> Ajukan Surat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
