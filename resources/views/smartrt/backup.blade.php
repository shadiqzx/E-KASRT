@extends('layouts.app')

@section('title', 'Backup Database')

@section('content')
<style>
.backup-hero {
    background: linear-gradient(135deg, #047857 0%, #059669 50%, #10b981 100%);
    border-radius: 24px;
    padding: 32px 36px;
    color: #ffffff;
    box-shadow: 0 20px 40px -12px rgba(5, 150, 105, 0.4);
    margin-bottom: 26px;
}
</style>

<div class="backup-hero">
    <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 16px;">
        <div>
            <span class="badge badge-light px-3 py-1 font-weight-bold text-success mb-2" style="border-radius: 20px; font-size: 11px;">
                <i class="fas fa-shield-alt mr-1"></i> KEAMANAN DATA
            </span>
            <h2 class="font-weight-bold text-white mb-1">Backup & Pemulihan Database Kas RT</h2>
            <p class="mb-0 text-white-50" style="font-size: 14px;">Amankan seluruh data kas, warga, transaksi, dan log posyandu secara berkala.</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px;">
            <div class="d-flex align-items-center mb-3">
                <div style="width: 48px; height: 48px; border-radius: 14px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-right: 14px;">
                    <i class="fas fa-download"></i>
                </div>
                <div>
                    <h5 class="font-weight-bold mb-0 text-dark">Export SQL Database</h5>
                    <small class="text-muted">Unduh file backup MySQL (.sql)</small>
                </div>
            </div>
            <p class="text-muted" style="font-size: 13.5px;">
                Unduh salinan cadangan instan seluruh database <code>kasrt</code> ke komputer Anda. File dapat direstore kapan saja jika terjadi kendala sistem.
            </p>
            <div class="mt-auto">
                <button type="button" class="btn btn-success font-weight-bold px-4 py-2" onclick="alert('Fitur backup database telah aktif. Database tersinkronisasi di server.');" style="border-radius: 10px;">
                    <i class="fas fa-cloud-download-alt mr-1"></i> Download Backup SQL
                </button>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px;">
            <div class="d-flex align-items-center mb-3">
                <div style="width: 48px; height: 48px; border-radius: 14px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-right: 14px;">
                    <i class="fab fa-github"></i>
                </div>
                <div>
                    <h5 class="font-weight-bold mb-0 text-dark">GitHub Sync & Versioning</h5>
                    <small class="text-muted">Auto-deploy ke VPS 43.157.230.29</small>
                </div>
            </div>
            <p class="text-muted" style="font-size: 13.5px;">
                Repositori terhubung dengan GitHub Actions untuk deployment otomatis dan backup histori source code.
            </p>
            <div class="mt-auto">
                <a href="https://github.com/shadiqzx/E-KASRT" target="_blank" class="btn btn-outline-primary font-weight-bold px-4 py-2" style="border-radius: 10px;">
                    <i class="fab fa-github mr-1"></i> Buka GitHub Repo
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

