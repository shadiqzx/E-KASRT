@extends('layouts.app')

@section('title', 'Data & Profil RT')

@section('content')
<style>
.profil-hero {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
    border-radius: 24px;
    padding: 32px 36px;
    color: #ffffff;
    box-shadow: 0 20px 40px -12px rgba(15, 23, 42, 0.4);
    margin-bottom: 26px;
}
</style>

<div class="profil-hero">
    <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 16px;">
        <div>
            <span class="badge badge-light px-3 py-1 font-weight-bold text-dark mb-2" style="border-radius: 20px; font-size: 11px;">
                <i class="fas fa-landmark mr-1"></i> IDENTITAS WILAYAH
            </span>
            <h2 class="font-weight-bold text-white mb-1">Profil & Informasi Wilayah RT</h2>
            <p class="mb-0 text-white-50" style="font-size: 14px;">Data kependudukan, nomor rekening kas RT, jam layanan, dan visi misi RT.</p>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
    <div class="card-body p-4">
        <form action="{{ route('smartrt.datart.update') }}" method="POST">
            @csrf
            <h5 class="font-weight-bold text-dark mb-3">Wilayah Administrasi RT</h5>
            <div class="row">
                <div class="col-md-3 form-group mb-3">
                    <label class="font-weight-bold" style="font-size: 13px;">Nomor RT</label>
                    <input type="text" name="rt_number" class="form-control" value="{{ $profil->rt_number ?? '01' }}" style="border-radius: 9px;">
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label class="font-weight-bold" style="font-size: 13px;">Nomor RW</label>
                    <input type="text" name="rw_number" class="form-control" value="{{ $profil->rw_number ?? '05' }}" style="border-radius: 9px;">
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label class="font-weight-bold" style="font-size: 13px;">Kelurahan / Desa</label>
                    <input type="text" name="kelurahan" class="form-control" value="{{ $profil->kelurahan ?? '' }}" style="border-radius: 9px;">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group mb-3">
                    <label class="font-weight-bold" style="font-size: 13px;">Kecamatan</label>
                    <input type="text" name="kecamatan" class="form-control" value="{{ $profil->kecamatan ?? '' }}" style="border-radius: 9px;">
                </div>
                <div class="col-md-4 form-group mb-3">
                    <label class="font-weight-bold" style="font-size: 13px;">Kota / Kabupaten</label>
                    <input type="text" name="kota" class="form-control" value="{{ $profil->kota ?? '' }}" style="border-radius: 9px;">
                </div>
                <div class="col-md-4 form-group mb-3">
                    <label class="font-weight-bold" style="font-size: 13px;">Kode Pos</label>
                    <input type="text" name="kode_pos" class="form-control" value="{{ $profil->kode_pos ?? '' }}" style="border-radius: 9px;">
                </div>
            </div>

            <hr class="my-4">

            <h5 class="font-weight-bold text-dark mb-3">Layanan & Rekening Kas RT</h5>
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label class="font-weight-bold" style="font-size: 13px;">Jam Layanan RT</label>
                    <input type="text" name="jam_kerja_rt" class="form-control" value="{{ $profil->jam_kerja_rt ?? 'Senin - Sabtu (19:00 - 21:00 WIB)' }}" style="border-radius: 9px;">
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label class="font-weight-bold" style="font-size: 13px;">Rekening Kas BCA</label>
                    <input type="text" name="norek_bca" class="form-control" value="{{ $profil->norek_bca ?? '' }}" placeholder="No. Rekening a/n Kas RT" style="border-radius: 9px;">
                </div>
            </div>

            <div class="form-group mb-4">
                <label class="font-weight-bold" style="font-size: 13px;">Visi & Misi RT</label>
                <textarea name="visi" class="form-control mb-2" rows="2" placeholder="Visi RT..." style="border-radius: 9px;">{{ $profil->visi ?? '' }}</textarea>
                <textarea name="misi" class="form-control" rows="2" placeholder="Misi RT..." style="border-radius: 9px;">{{ $profil->misi ?? '' }}</textarea>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 10px;">
                    <i class="fas fa-save mr-1"></i> Simpan Perubahan Profil RT
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
