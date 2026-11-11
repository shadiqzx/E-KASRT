@extends('layouts.app')

@section('title', 'Aset & Inventaris RT')

@section('content')
<style>
.aset-hero {
    background: linear-gradient(135deg, #78350f 0%, #b45309 50%, #f59e0b 100%);
    border-radius: 24px;
    padding: 32px 36px;
    color: #ffffff;
    box-shadow: 0 20px 40px -12px rgba(245, 158, 11, 0.4);
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

<div class="aset-hero">
    <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 16px;">
        <div>
            <span class="badge badge-light px-3 py-1 font-weight-bold text-warning mb-2" style="border-radius: 20px; font-size: 11px;">
                <i class="fas fa-boxes mr-1"></i> INVENTARIS LINGKUNGAN
            </span>
            <h2 class="font-weight-bold text-white mb-1">Aset & Inventaris Milik RT</h2>
            <p class="mb-0 text-white-50" style="font-size: 14px;">Pendataan barang, tenda, kursi, sound system, genset, dan fasilitas bersama warga.</p>
        </div>
        <div>
            <button class="btn btn-light font-weight-bold px-4 py-2 text-warning shadow" data-toggle="modal" data-target="#modalTambahAset" style="border-radius: 12px; color: #b45309 !important;">
                <i class="fas fa-plus-circle mr-1"></i> + Tambah Barang / Aset
            </button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="kpi-card">
            <small class="text-muted text-uppercase font-weight-bold" style="font-size: 11px;">Total Unit Barang Terdata</small>
            <h3 class="font-weight-bold text-warning mb-0" style="font-family: 'JetBrains Mono'; color: #b45309 !important;">{{ $total_items }} Unit</h3>
        </div>
    </div>
    <div class="col-md-6">
        <div class="kpi-card">
            <small class="text-muted text-uppercase font-weight-bold" style="font-size: 11px;">Jumlah Jenis Barang</small>
            <h3 class="font-weight-bold text-primary mb-0">{{ count($aset_list) }} Macam Barang</h3>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header bg-white py-3 border-bottom font-weight-bold text-dark">
        Daftar Inventaris & Aset RT
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th>Nama Barang / Alat</th>
                    <th>Jumlah Unit</th>
                    <th>Kondisi</th>
                    <th>Lokasi Penyimpanan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aset_list as $a)
                <tr>
                    <td><strong class="text-dark">{{ $a->nama_barang }}</strong></td>
                    <td class="font-weight-bold">{{ $a->jumlah }} Unit</td>
                    <td>
                        @if($a->kondisi === 'Baik')
                            <span class="badge badge-success px-2 py-1">Baik</span>
                        @elseif($a->kondisi === 'Rusak Ringan')
                            <span class="badge badge-warning px-2 py-1">Rusak Ringan</span>
                        @else
                            <span class="badge badge-danger px-2 py-1">Rusak Berat</span>
                        @endif
                    </td>
                    <td><span class="badge badge-light border">{{ $a->lokasi }}</span></td>
                    <td class="text-center">
                        <a href="{{ route('smartrt.aset.destroy', $a->id) }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus aset ini?')">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Belum ada barang inventaris terdata.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Aset -->
<div class="modal fade" id="modalTambahAset" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #78350f, #b45309); padding: 22px;">
                <h5 class="modal-title font-weight-bold text-white mb-0">Tambah Aset / Barang Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('smartrt.aset.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px;">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" placeholder="Contoh: Kursi Plastik Hijau, Tenda 4x6" required style="border-radius: 9px;">
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold" style="font-size: 13px;">Jumlah Unit</label>
                            <input type="number" name="jumlah" class="form-control" placeholder="0" required style="border-radius: 9px;">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold" style="font-size: 13px;">Kondisi</label>
                            <select name="kondisi" class="form-control" style="border-radius: 9px;">
                                <option value="Baik">Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-bold" style="font-size: 13px;">Lokasi Penyimpanan</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Gudang Pos RT, Rumah Pak RT" style="border-radius: 9px;">
                    </div>

                    <div class="d-flex justify-content-end" style="gap: 8px;">
                        <button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                        <button type="submit" class="btn btn-warning px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px; background: #b45309; border: none; color: #fff;">
                            <i class="fas fa-check-circle mr-1"></i> Simpan Aset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
