@extends('layouts.app')

@section('title', 'Verifikasi Pendaftaran Warga Baru')

@section('content')
<style>
.verif-hero {
    background: linear-gradient(135deg, #064e3b 0%, #065f46 45%, #047857 100%);
    border-radius: 24px;
    padding: 30px 34px;
    color: #ffffff;
    box-shadow: 0 20px 45px -12px rgba(6, 78, 59, 0.45);
    margin-bottom: 24px;
    position: relative;
    overflow: hidden;
}
.verif-hero::after {
    content: '';
    position: absolute;
    right: -20px;
    bottom: -30px;
    width: 220px;
    height: 220px;
    background: radial-gradient(circle, rgba(16, 185, 129, 0.3) 0%, rgba(255,255,255,0) 70%);
    border-radius: 50%;
    pointer-events: none;
}
.bento-card {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid #eef2f6;
    padding: 22px 24px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
    transition: all 0.25s ease;
    height: 100%;
}
.bento-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.06);
}
.nav-pills-modern {
    background: #f1f5f9;
    border-radius: 16px;
    padding: 6px;
    gap: 6px;
    display: inline-flex;
}
.nav-pills-modern .nav-link {
    border-radius: 12px;
    font-weight: 600;
    color: #475569;
    padding: 9px 20px;
    transition: all 0.2s ease;
    border: none;
}
.nav-pills-modern .nav-link.active {
    background: #059669;
    color: #ffffff;
    box-shadow: 0 6px 14px rgba(5, 150, 105, 0.35);
}
.table-modern {
    margin-bottom: 0;
}
.table-modern thead th {
    background: #f8fafc;
    color: #475569;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    border: none;
    padding: 14px 18px;
    font-weight: 700;
}
.table-modern tbody td {
    padding: 14px 18px;
    vertical-align: middle;
    border-top: 1px solid #f1f5f9;
    font-size: 13.5px;
}
.table-modern tbody tr:hover {
    background-color: #f8fafc;
}
.badge-status {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 11.5px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.badge-status.success {
    background: #d1fae5;
    color: #065f46;
}
.badge-status.warning {
    background: #fef3c7;
    color: #92400e;
}
.badge-status.danger {
    background: #fee2e2;
    color: #991b1b;
}
.badge-status.info {
    background: #e0f2fe;
    color: #0369a1;
}
.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
}
</style>

{{-- Flash Alert Messages --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 16px; background: #ecfdf5; color: #065f46;" role="alert">
    <div class="d-flex align-items-center">
        <i class="fas fa-check-circle fa-lg mr-3 text-success"></i>
        <div style="font-size: 14px;">{{ session('success') }}</div>
    </div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color: #065f46;">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 16px; background: #fef2f2; color: #991b1b;" role="alert">
    <div class="d-flex align-items-center">
        <i class="fas fa-exclamation-triangle fa-lg mr-3 text-danger"></i>
        <div style="font-size: 14px;">{{ session('error') }}</div>
    </div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color: #991b1b;">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

{{-- Hero Banner --}}
<div class="verif-hero">
    <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 20px;">
        <div>
            <div class="d-flex align-items-center mb-2" style="gap: 8px;">
                <span class="badge badge-light px-3 py-1 font-weight-bold text-success" style="border-radius: 20px; font-size: 11px;">
                    <i class="fas fa-shield-alt mr-1"></i> VERIFIKASI KEAMANAN DATA
                </span>
                <span class="badge px-3 py-1 font-weight-bold" style="border-radius: 20px; font-size: 11px; background: rgba(255,255,255,0.2); color: #fff;">
                    <i class="fas fa-user-check mr-1"></i> SMART RT PORTAL
                </span>
            </div>
            <h2 class="font-weight-bold text-white mb-2" style="letter-spacing: -0.5px;">Verifikasi Pendaftaran Warga Baru</h2>
            <p class="mb-0 text-white-50" style="font-size: 14px; max-width: 640px;">
                Tinjau dan validasi calon warga yang mendaftar mandiri. Akun warga tidak akan aktif sebelum disetujui oleh Pengurus RT demi menjaga keamanan dan validitas data kependudukan.
            </p>
        </div>
        <div>
            @if($stats['pending'] > 0)
                <span class="badge badge-warning px-3 py-2 font-weight-bold shadow-sm" style="border-radius: 14px; font-size: 13px; background: #fbbf24; color: #78350f;">
                    <i class="fas fa-bell mr-1.5"></i> {{ $stats['pending'] }} Pendaftaran Menunggu
                </span>
            @else
                <span class="badge badge-light px-3 py-2 font-weight-bold text-success shadow-sm" style="border-radius: 14px; font-size: 13px;">
                    <i class="fas fa-check-circle mr-1.5"></i> Semua Pendaftaran Terverifikasi
                </span>
            @endif
        </div>
    </div>
</div>

{{-- KPI Summary Bento Cards --}}
<div class="row mb-4">
    <div class="col-xl-4 col-md-6 mb-3 mb-xl-0">
        <div class="bento-card" style="border-left: 4px solid #f59e0b;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted font-weight-bold" style="font-size: 12.5px; text-transform: uppercase;">Menunggu Verifikasi</span>
                <div style="width: 42px; height: 42px; border-radius: 12px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fas fa-user-clock"></i>
                </div>
            </div>
            <div class="h3 font-weight-bold text-dark mb-1">{{ $stats['pending'] }} <small class="text-muted font-weight-normal" style="font-size: 13px;">Antrean</small></div>
            <span class="badge-status warning">
                <i class="fas fa-hourglass-half"></i> Perlu Tindakan Pengurus RT
            </span>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-3 mb-xl-0">
        <div class="bento-card" style="border-left: 4px solid #10b981;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted font-weight-bold" style="font-size: 12.5px; text-transform: uppercase;">Warga Disetujui (Aktif)</span>
                <div style="width: 42px; height: 42px; border-radius: 12px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
            <div class="h3 font-weight-bold text-dark mb-1">{{ $stats['approved'] }} <small class="text-muted font-weight-normal" style="font-size: 13px;">Warga</small></div>
            <span class="badge-status success">
                <i class="fas fa-check-circle"></i> Memiliki Akses Login Portal
            </span>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-3 mb-xl-0">
        <div class="bento-card" style="border-left: 4px solid #ef4444;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted font-weight-bold" style="font-size: 12.5px; text-transform: uppercase;">Pendaftaran Ditolak</span>
                <div style="width: 42px; height: 42px; border-radius: 12px; background: #fee2e2; color: #dc2626; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fas fa-user-times"></i>
                </div>
            </div>
            <div class="h3 font-weight-bold text-dark mb-1">{{ $stats['rejected'] }} <small class="text-muted font-weight-normal" style="font-size: 13px;">Permohonan</small></div>
            <span class="badge-status danger">
                <i class="fas fa-ban"></i> Ditolak / Tidak Memenuhi Syarat
            </span>
        </div>
    </div>
</div>

{{-- Navigation Tabs & Content --}}
<div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header bg-white border-0 pt-4 px-4 pb-2 d-flex flex-wrap justify-content-between align-items-center" style="gap: 14px;">
        <ul class="nav nav-pills-modern" id="verifTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="tab-pending-link" data-toggle="pill" href="#tab-pending" role="tab">
                    <i class="fas fa-clock mr-1.5"></i> Menunggu Verifikasi ({{ $stats['pending'] }})
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-approved-link" data-toggle="pill" href="#tab-approved" role="tab">
                    <i class="fas fa-check-circle mr-1.5"></i> Riwayat Disetujui ({{ count($approved) }})
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-rejected-link" data-toggle="pill" href="#tab-rejected" role="tab">
                    <i class="fas fa-times-circle mr-1.5"></i> Riwayat Ditolak ({{ count($rejected) }})
                </a>
            </li>
        </ul>

        <div>
            <input type="text" id="verifSearchInput" class="form-control form-control-sm" placeholder="Cari nama, NIK, username..." style="border-radius: 10px; width: 230px; padding: 8px 14px;">
        </div>
    </div>

    <div class="card-body p-0">
        <div class="tab-content" id="verifTabsContent">

            {{-- TAB 1: MENUNGGU VERIFIKASI --}}
            <div class="tab-pane fade show active" id="tab-pending" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-modern" id="tablePending">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Calon Warga</th>
                                <th>NIK & Identitas</th>
                                <th>Kontak & Alamat</th>
                                <th>Waktu Daftar</th>
                                <th class="text-right">Aksi Keputusan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pending as $index => $u)
                                @php
                                    $warga = $u->dataWarga;
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-light text-primary mr-3 border">
                                                {{ strtoupper(substr($u->user ?: $u->username, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="font-weight-bold text-dark" style="font-size: 14px;">
                                                    {{ $u->user }}
                                                </div>
                                                <small class="text-muted font-monospace">@<span>{{ $u->username }}</span></small>
                                                @if($u->email)
                                                    <br><small class="text-muted"><i class="fas fa-envelope mr-1"></i>{{ $u->email }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="badge badge-light border text-dark px-2 py-1 font-weight-bold" style="font-size: 12px; border-radius: 6px;">
                                                <i class="fas fa-id-card text-info mr-1"></i> {{ $u->nik ?: ($warga->nik ?? '-') }}
                                            </span>
                                        </div>
                                        @if($warga && $warga->no_kk)
                                            <small class="text-muted d-block mt-1">
                                                <i class="fas fa-users mr-1"></i> KK: {{ $warga->no_kk }}
                                            </small>
                                        @endif
                                        @if($warga && $warga->jekel)
                                            <small class="text-muted d-block">
                                                <i class="fas fa-venus-mars mr-1"></i> {{ $warga->jekel == 'L' ? 'Laki-laki' : ($warga->jekel == 'P' ? 'Perempuan' : $warga->jekel) }}
                                            </small>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            @if($warga && $warga->no_hp)
                                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $warga->no_hp)) }}" target="_blank" class="text-success font-weight-bold" style="font-size: 13px; text-decoration: none;">
                                                    <i class="fab fa-whatsapp mr-1"></i> {{ $warga->no_hp }}
                                                </a>
                                            @else
                                                <span class="text-muted" style="font-size: 12.5px;">-</span>
                                            @endif
                                        </div>
                                        <small class="text-muted d-block mt-1">
                                            <i class="fas fa-home mr-1"></i> {{ $warga->alamat ?? 'Lingkungan RT' }} (No. {{ $warga->no_rumah ?? '-' }})
                                        </small>
                                    </td>
                                    <td>
                                        <span class="text-dark font-weight-bold" style="font-size: 13px;">
                                            {{ $u->tgl_daftar ? date('d M Y', strtotime($u->tgl_daftar)) : '-' }}
                                        </span>
                                        <small class="text-muted d-block" style="font-size: 11.5px;">
                                            {{ $u->tgl_daftar ? date('H:i', strtotime($u->tgl_daftar)) . ' WIB' : '' }}
                                        </small>
                                    </td>
                                    <td class="text-right">
                                        <div class="d-inline-flex" style="gap: 8px;">
                                            {{-- Form Setujui --}}
                                            <form action="{{ route('admin.warga.setujui', $u->user_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin MENYETUJUI pendaftaran warga {{ addslashes($u->user) }}? Akun akan langsung aktif.');">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success px-3 py-1.5 shadow-sm font-weight-bold" style="border-radius: 10px;">
                                                    <i class="fas fa-check mr-1"></i> Setujui
                                                </button>
                                            </form>

                                            {{-- Tombol Tolak (Buka Modal) --}}
                                            <button type="button" class="btn btn-sm btn-outline-danger px-3 py-1.5 font-weight-bold" style="border-radius: 10px;" onclick="openRejectModal({{ $u->user_id }}, '{{ addslashes($u->user) }}', '{{ $u->nik }}')">
                                                <i class="fas fa-times mr-1"></i> Tolak
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="py-4">
                                            <div class="mb-3" style="width: 64px; height: 64px; border-radius: 50%; background: #ecfdf5; color: #10b981; display: inline-flex; align-items: center; justify-content: center; font-size: 28px;">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                            <h5 class="font-weight-bold text-dark">Tidak Ada Antrean Verifikasi</h5>
                                            <p class="text-muted" style="font-size: 13.5px; max-width: 440px; margin: 0 auto;">
                                                Semua pendaftaran warga baru yang masuk telah ditinjau dan disetujui oleh pengurus RT.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- TAB 2: RIWAYAT DISETUJUI --}}
            <div class="tab-pane fade" id="tab-approved" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-modern" id="tableApproved">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Warga</th>
                                <th>NIK</th>
                                <th>Kontak & Alamat</th>
                                <th>Waktu Disetujui</th>
                                <th>Verifikator</th>
                                <th>Status Akun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($approved as $index => $u)
                                @php
                                    $warga = $u->dataWarga;
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div class="font-weight-bold text-dark">{{ $u->user }}</div>
                                        <small class="text-muted">@<span>{{ $u->username }}</span></small>
                                    </td>
                                    <td>
                                        <span class="badge badge-light border text-dark px-2 py-1" style="border-radius: 6px;">
                                            {{ $u->nik ?: ($warga->nik ?? '-') }}
                                        </span>
                                    </td>
                                    <td>
                                        <small class="d-block text-dark">{{ $warga->no_hp ?? '-' }}</small>
                                        <small class="text-muted">{{ $warga->alamat ?? '-' }} (No. {{ $warga->no_rumah ?? '-' }})</small>
                                    </td>
                                    <td>
                                        <span class="text-dark font-weight-bold" style="font-size: 13px;">
                                            {{ $u->tgl_verifikasi ? date('d M Y H:i', strtotime($u->tgl_verifikasi)) : ($u->tgl_daftar ? date('d M Y', strtotime($u->tgl_daftar)) : '-') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-status info">
                                            <i class="fas fa-user-shield"></i> {{ $u->verifikator ? $u->verifikator->user : 'Admin RT' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($u->is_active == 1)
                                            <span class="badge-status success"><i class="fas fa-check-circle"></i> Aktif</span>
                                        @else
                                            <span class="badge-status warning"><i class="fas fa-pause-circle"></i> Nonaktif</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">Belum ada riwayat warga disetujui.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- TAB 3: RIWAYAT DITOLAK --}}
            <div class="tab-pane fade" id="tab-rejected" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-modern" id="tableRejected">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Calon Warga</th>
                                <th>NIK</th>
                                <th>Alasan Penolakan</th>
                                <th>Waktu Penolakan</th>
                                <th>Verifikator</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rejected as $index => $u)
                                @php
                                    $warga = $u->dataWarga;
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div class="font-weight-bold text-dark">{{ $u->user }}</div>
                                        <small class="text-muted">@<span>{{ $u->username }}</span></small>
                                    </td>
                                    <td>
                                        <span class="badge badge-light border text-dark px-2 py-1" style="border-radius: 6px;">
                                            {{ $u->nik ?: ($warga->nik ?? '-') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="p-2 bg-light rounded text-danger" style="font-size: 12.5px; border-left: 3px solid #ef4444;">
                                            <i class="fas fa-info-circle mr-1"></i> {{ $u->alasan_tolak ?: 'Data tidak sesuai atau bukan warga lingkungan RT.' }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-dark font-weight-bold" style="font-size: 13px;">
                                            {{ $u->tgl_verifikasi ? date('d M Y H:i', strtotime($u->tgl_verifikasi)) : '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-status danger">
                                            <i class="fas fa-times-circle"></i> {{ $u->verifikator ? $u->verifikator->user : 'Admin RT' }}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        {{-- Tombol Setujui Ulang --}}
                                        <form action="{{ route('admin.warga.setujui', $u->user_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin MENYETUJUI ULANG akun {{ addslashes($u->user) }}?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success px-3 py-1 font-weight-bold" style="border-radius: 8px;">
                                                <i class="fas fa-redo mr-1"></i> Setujui Ulang
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">Belum ada riwayat penolakan pendaftaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- MODAL TOLAK PENDAFTARAN --}}
<div class="modal fade" id="modalReject" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 480px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            <div class="modal-header border-0 bg-danger text-white px-4 pt-4 pb-3">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-user-times mr-2"></i> Tolak Pendaftaran Warga
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formReject" method="POST" action="">
                @csrf
                <div class="modal-body px-4 py-3">
                    <p class="text-muted mb-3" style="font-size: 13.5px;">
                        Anda akan menolak pendaftaran akun calon warga <strong id="rejectNama" class="text-dark"></strong> (NIK: <span id="rejectNik" class="text-dark"></span>). Silakan berikan alasan penolakan agar calon warga mengetahui penyebabnya saat mengecek status.
                    </p>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark" style="font-size: 13px;">Alasan Penolakan</label>
                        <textarea name="alasan_tolak" id="alasanTolakInput" rows="3" class="form-control" placeholder="Contoh: NIK tidak terdaftar di buku induk RT / Alamat rumah tidak sesuai lingkungan RT 05..." style="border-radius: 12px; font-size: 13.5px;" required></textarea>
                    </div>

                    <div class="d-flex flex-wrap" style="gap: 6px;">
                        <button type="button" class="btn btn-sm btn-light border" onclick="setQuickReason('NIK / KK tidak terdaftar dalam wilayah RT')">NIK Tidak Sesuai</button>
                        <button type="button" class="btn btn-sm btn-light border" onclick="setQuickReason('Bukan penduduk domisili lingkungan RT setempat')">Bukan Warga Domisili</button>
                        <button type="button" class="btn btn-sm btn-light border" onclick="setQuickReason('Nomor rumah atau alamat tidak valid')">Alamat Tidak Valid</button>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-2">
                    <button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-danger px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 10px;">
                        <i class="fas fa-times-circle mr-1"></i> Konfirmasi Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openRejectModal(userId, nama, nik) {
    document.getElementById('rejectNama').innerText = nama;
    document.getElementById('rejectNik').innerText = nik || '-';
    document.getElementById('formReject').action = "{{ url('/admin/verifikasi_warga/tolak') }}/" + userId;
    document.getElementById('alasanTolakInput').value = '';
    $('#modalReject').modal('show');
}

function setQuickReason(reason) {
    document.getElementById('alasanTolakInput').value = reason;
}

// Live Search Filter
document.getElementById('verifSearchInput').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let activeTable = document.querySelector('.tab-pane.active table tbody');
    if (!activeTable) return;

    let rows = activeTable.getElementsByTagName('tr');
    for (let i = 0; i < rows.length; i++) {
        let text = rows[i].textContent.toLowerCase();
        rows[i].style.display = text.indexOf(filter) > -1 ? '' : 'none';
    }
});
</script>
@endsection

