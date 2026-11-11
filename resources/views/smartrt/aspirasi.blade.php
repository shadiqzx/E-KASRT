@extends('layouts.app')

@section('title', 'Aspirasi Warga')

@section('content')
<style>
.aspirasi-hero {
    background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 50%, #a855f7 100%);
    border-radius: 24px;
    padding: 32px 36px;
    color: #ffffff;
    box-shadow: 0 20px 40px -12px rgba(124, 58, 237, 0.4);
    margin-bottom: 26px;
}
.aspirasi-card {
    background: #fff;
    border-radius: 18px;
    padding: 22px;
    border: 1px solid #e2e8f0;
    margin-bottom: 18px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.04);
}
</style>

<div class="aspirasi-hero">
    <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 16px;">
        <div>
            <span class="badge badge-light px-3 py-1 font-weight-bold text-purple mb-2" style="border-radius: 20px; font-size: 11px; color: #7c3aed;">
                <i class="fas fa-bullhorn mr-1"></i> SUARA WARGA
            </span>
            <h2 class="font-weight-bold text-white mb-1">Aspirasi & Pengaduan Warga RT</h2>
            <p class="mb-0 text-white-50" style="font-size: 14px;">Saluran terbuka untuk menyampaikan keluhan lingkungan, saran perbaikan fasilitas, dan ide kegiatan RT.</p>
        </div>
        <div>
            <button class="btn btn-light font-weight-bold px-4 py-2 shadow" data-toggle="modal" data-target="#modalAspirasi" style="border-radius: 12px; color: #7c3aed;">
                <i class="fas fa-comment-dots mr-1"></i> + Tulis Aspirasi
            </button>
        </div>
    </div>
</div>

<div class="row">
    @forelse($aspirasi_list as $a)
    <div class="col-md-6">
        <div class="aspirasi-card">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="badge {{ $a->kategori === 'Keluhan' ? 'badge-danger' : ($a->kategori === 'Saran' ? 'badge-info' : 'badge-success') }} px-2 py-1">
                    {{ $a->kategori }}
                </span>
                <small class="text-muted">{{ date('d M Y H:i', strtotime($a->tanggal_kirim)) }}</small>
            </div>
            <p class="text-dark mb-2" style="font-size: 14px; font-style: italic;">"{{ $a->isi }}"</p>
            <div class="d-flex align-items-center mt-3 pt-2 border-top">
                <div style="width: 28px; height: 28px; border-radius: 50%; background: #f3e8ff; color: #7c3aed; display: flex; align-items: center; justify-content: center; font-size: 12px; margin-right: 8px;">
                    <i class="fas fa-user"></i>
                </div>
                <strong style="font-size: 13px;" class="text-muted">{{ $a->nama_pengirim }}</strong>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm p-5 text-center text-muted" style="border-radius: 20px;">
            <i class="fas fa-comments fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
            <h5>Belum Ada Aspirasi Warga</h5>
            <p style="font-size: 13px;">Warga belum mengirimkan aspirasi atau saran.</p>
        </div>
    </div>
    @endforelse
</div>

<!-- Modal Tulis Aspirasi -->
<div class="modal fade" id="modalAspirasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #4c1d95, #7c3aed); padding: 22px;">
                <h5 class="modal-title font-weight-bold text-white mb-0">Kirim Aspirasi / Saran</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('smartrt.aspirasi.kirim') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px;">Nama Pengirim</label>
                        <input type="text" name="nama_pengirim" class="form-control" placeholder="Nama Anda (atau Anonim)" required style="border-radius: 9px;">
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px;">Kategori</label>
                        <select name="kategori" class="form-control" style="border-radius: 9px;">
                            <option value="Saran">Saran & Ide</option>
                            <option value="Keluhan">Keluhan Lingkungan</option>
                            <option value="Apresiasi">Apresiasi</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-bold" style="font-size: 13px;">Isi Aspirasi / Pesan</label>
                        <textarea name="isi" class="form-control" rows="4" placeholder="Tuliskan aspirasi Anda dengan santun dan jelas..." required style="border-radius: 9px;"></textarea>
                    </div>

                    <div class="d-flex justify-content-end" style="gap: 8px;">
                        <button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px; background: #7c3aed; border: none;">
                            <i class="fas fa-paper-plane mr-1"></i> Kirim Aspirasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
