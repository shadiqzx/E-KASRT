@extends('layouts.app')

@section('title', 'Pengurus RT')

@section('content')
<style>
.pengurus-hero {
    background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
    border-radius: 24px;
    padding: 32px 36px;
    color: #ffffff;
    box-shadow: 0 20px 40px -12px rgba(30, 41, 59, 0.4);
    margin-bottom: 26px;
}
.pengurus-card {
    background: #fff;
    border-radius: 18px;
    padding: 24px;
    border: 1px solid #e2e8f0;
    text-align: center;
    margin-bottom: 22px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.04);
}
</style>

<div class="pengurus-hero">
    <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 16px;">
        <div>
            <span class="badge badge-light px-3 py-1 font-weight-bold text-dark mb-2" style="border-radius: 20px; font-size: 11px;">
                <i class="fas fa-user-tie mr-1"></i> STRUKTUR ORGANISASI
            </span>
            <h2 class="font-weight-bold text-white mb-1">Struktur Pengurus Rukun Tetangga (RT)</h2>
            <p class="mb-0 text-white-50" style="font-size: 14px;">Daftar ketua RT, sekretaris, bendahara, serta seksi-seksi bidang lingkungan.</p>
        </div>
    </div>
</div>

<div class="row">
    @forelse($pengurus_list as $p)
    <div class="col-md-4">
        <div class="pengurus-card">
            <div style="width: 72px; height: 72px; border-radius: 50%; background: #e2e8f0; margin: 0 auto 14px; display: flex; align-items: center; justify-content: center; font-size: 28px; color: #475569;">
                <i class="fas fa-user"></i>
            </div>
            <h5 class="font-weight-bold text-dark mb-1">{{ $p->nama }}</h5>
            <span class="badge badge-primary px-3 py-1 mb-3" style="border-radius: 20px;">{{ $p->jabatan }}</span>
            <div style="font-size: 13px; color: #64748b;" class="text-left">
                <p class="mb-1"><i class="fas fa-phone mr-2 text-success"></i> {{ $p->no_hp ?: '-' }}</p>
                <p class="mb-1"><i class="fas fa-envelope mr-2 text-info"></i> {{ $p->email ?: '-' }}</p>
                <p class="mb-0"><i class="fas fa-calendar mr-2 text-warning"></i> Periode: {{ $p->periode_mulai }} - {{ $p->periode_selesai }}</p>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm p-5 text-center text-muted" style="border-radius: 20px;">
            <i class="fas fa-user-friends fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
            <h5>Belum Ada Data Pengurus RT</h5>
            <p style="font-size: 13px;">Data susunan pengurus RT belum diinputkan.</p>
        </div>
    </div>
    @endforelse
</div>
@endsection
