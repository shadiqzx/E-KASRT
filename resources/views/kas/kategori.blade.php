@extends('layouts.app')

@section('title', 'Kategori Kas RT')

@section('content')
<style>
.kategori-hero {
    background: linear-gradient(135deg, #0284c7 0%, #0369a1 50%, #075985 100%);
    border-radius: 24px;
    padding: 32px 36px;
    color: #ffffff;
    box-shadow: 0 20px 40px -12px rgba(2, 132, 199, 0.4);
    margin-bottom: 26px;
}
</style>

<div class="kategori-hero">
    <span class="badge badge-light px-3 py-1 font-weight-bold text-primary mb-2" style="border-radius: 20px; font-size: 11px;">
        <i class="fas fa-tags mr-1"></i> STRUKTUR KAS
    </span>
    <h2 class="font-weight-bold text-white mb-1">Kategori Pembukuan Kas RT</h2>
    <p class="mb-0 text-white-50" style="font-size: 14px;">Klasifikasi pos penerimaan dan pos pengeluaran anggaran lingkungan RT.</p>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
            <h5 class="font-weight-bold text-success mb-3"><i class="fas fa-arrow-down mr-2"></i>Pos Pemasukan</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>🏠 Iuran Bulanan Warga</span>
                    <span class="badge badge-success px-2 py-1">Rutin</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>🎁 Donasi & Sumbangan Sukarela</span>
                    <span class="badge badge-info px-2 py-1">Insidental</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>🗑️ Kas Pengelolaan Sampah Lingkungan</span>
                    <span class="badge badge-success px-2 py-1">Rutin</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>🎪 Sewa Fasilitas / Lapangan RT</span>
                    <span class="badge badge-primary px-2 py-1">Layanan</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
            <h5 class="font-weight-bold text-danger mb-3"><i class="fas fa-arrow-up mr-2"></i>Pos Pengeluaran</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>🗑️ Honor Petugas Kebersihan / Sampah</span>
                    <span class="badge badge-danger px-2 py-1">Operasional</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>👮 Honor Petugas Hansip / Keamanan</span>
                    <span class="badge badge-danger px-2 py-1">Operasional</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>🛠️ Perbaikan Fasilitas & Lampu Jalan</span>
                    <span class="badge badge-warning px-2 py-1">Pemeliharaan</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>🎈 Kegiatan Sosial / HUT RI / Posyandu</span>
                    <span class="badge badge-info px-2 py-1">Sosial</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
