@extends('layouts.app')

@section('title', 'Pengeluaran Kas RT')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap');

:root {
	--rose-primary: #dc2626;
	--rose-dark: #7f1d1d;
	--rose-light: #f43f5e;
	--rose-glow: rgba(244, 63, 94, 0.28);
	--slate-bg: #f8fafc;
	--card-border: rgba(226, 232, 240, 0.85);
}

.kas-page-wrapper {
	font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
	color: #0f172a;
	padding-bottom: 60px;
}

/* Hero Mesh Gradient Header */
.kas-hero-mesh--keluar {
	background: linear-gradient(135deg, #450a0a 0%, #7f1d1d 35%, #dc2626 75%, #ea580c 100%);
	border-radius: 24px;
	padding: 34px 38px;
	color: #ffffff;
	box-shadow: 0 20px 40px -15px rgba(220, 38, 38, 0.45);
	position: relative;
	overflow: hidden;
	margin-bottom: 28px;
	border: 1px solid rgba(255, 255, 255, 0.12);
}
.kas-hero-mesh--keluar::before {
	content: '';
	position: absolute;
	width: 320px;
	height: 320px;
	background: radial-gradient(circle, rgba(234, 88, 12, 0.35) 0%, rgba(234, 88, 12, 0) 70%);
	top: -80px;
	right: 15%;
	border-radius: 50%;
	filter: blur(40px);
	pointer-events: none;
}
.hero-glass-pill--keluar {
	background: rgba(255, 255, 255, 0.15);
	backdrop-filter: blur(12px);
	-webkit-backdrop-filter: blur(12px);
	border: 1px solid rgba(255, 255, 255, 0.25);
	color: #fecdd3;
	font-size: 11.5px;
	font-weight: 800;
	letter-spacing: 0.8px;
	padding: 5px 14px;
	border-radius: 30px;
	display: inline-flex;
	align-items: center;
	gap: 6px;
	margin-bottom: 12px;
	text-transform: uppercase;
}
.hero-pulsing-dot--red {
	width: 8px;
	height: 8px;
	background: #f87171;
	border-radius: 50%;
	box-shadow: 0 0 0 0 rgba(248, 113, 113, 0.7);
	animation: pulseRed 2s infinite;
}
@keyframes pulseRed {
	0% { box-shadow: 0 0 0 0 rgba(248, 113, 113, 0.7); }
	70% { box-shadow: 0 0 0 8px rgba(248, 113, 113, 0); }
	100% { box-shadow: 0 0 0 0 rgba(248, 113, 113, 0); }
}

/* Nav Switcher Pill */
.kas-nav-switcher {
	display: inline-flex;
	background: rgba(0, 0, 0, 0.22);
	padding: 5px;
	border-radius: 14px;
	backdrop-filter: blur(8px);
	border: 1px solid rgba(255, 255, 255, 0.1);
}
.kas-nav-switcher a {
	padding: 9px 18px;
	border-radius: 10px;
	font-size: 13px;
	font-weight: 700;
	color: rgba(255, 255, 255, 0.85);
	text-decoration: none;
	transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
	display: inline-flex;
	align-items: center;
	gap: 7px;
}
.kas-nav-switcher a.active {
	background: #ffffff;
	color: #7f1d1d;
	box-shadow: 0 4px 14px rgba(0,0,0,0.18);
	transform: translateY(-1px);
}
.kas-nav-switcher a:hover:not(.active) {
	background: rgba(255,255,255,0.18);
	color: #fff;
}

/* 4 Fintech KPI Cards */
.fintech-kpi-grid {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
	gap: 18px;
	margin-bottom: 26px;
}
.fintech-kpi-card {
	background: #ffffff;
	border-radius: 18px;
	padding: 22px 24px;
	border: 1px solid var(--card-border);
	box-shadow: 0 4px 20px -3px rgba(15, 23, 42, 0.05);
	position: relative;
	overflow: hidden;
	transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}
.fintech-kpi-card:hover {
	transform: translateY(-4px);
	box-shadow: 0 14px 28px -5px rgba(15, 23, 42, 0.1);
	border-color: #cbd5e1;
}
.kpi-accent-bar {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	height: 4px;
}
.kpi-accent-rose { background: linear-gradient(90deg, #dc2626, #f87171); }
.kpi-accent-orange { background: linear-gradient(90deg, #ea580c, #fb923c); }
.kpi-accent-blue { background: linear-gradient(90deg, #2563eb, #60a5fa); }
.kpi-accent-purple { background: linear-gradient(90deg, #7c3aed, #a78bfa); }

.kpi-icon-bubble {
	width: 48px;
	height: 48px;
	border-radius: 14px;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 22px;
	margin-bottom: 14px;
}
.kpi-val {
	font-size: 26px;
	font-weight: 800;
	color: #0f172a;
	line-height: 1.15;
	margin-bottom: 4px;
	letter-spacing: -0.5px;
}
.kpi-sub {
	font-size: 12.5px;
	color: #64748b;
	font-weight: 500;
	margin-bottom: 0;
	display: flex;
	align-items: center;
	gap: 5px;
}

/* Category Filter Chips Bar */
.category-chips-bar {
	display: flex;
	align-items: center;
	gap: 8px;
	overflow-x: auto;
	padding-bottom: 6px;
	margin-bottom: 20px;
}
.category-chip {
	padding: 8px 16px;
	border-radius: 30px;
	font-size: 12.5px;
	font-weight: 700;
	background: #ffffff;
	border: 1px solid #e2e8f0;
	color: #475569;
	white-space: nowrap;
	cursor: pointer;
	transition: all 0.2s;
	display: inline-flex;
	align-items: center;
	gap: 6px;
}
.category-chip:hover {
	background: #f1f5f9;
	border-color: #cbd5e1;
	transform: translateY(-1px);
}
.category-chip.active {
	background: #dc2626;
	color: #ffffff;
	border-color: #dc2626;
	box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
}

/* Data Table Card */
.table-container-card {
	background: #ffffff;
	border-radius: 20px;
	border: 1px solid var(--card-border);
	box-shadow: 0 8px 26px -4px rgba(15, 23, 42, 0.05);
	overflow: hidden;
}
.table-custom-kas {
	width: 100%;
	border-collapse: separate;
	border-spacing: 0;
	margin-bottom: 0;
}
.table-custom-kas thead th {
	background: #f8fafc;
	color: #475569;
	font-size: 11px;
	font-weight: 800;
	text-transform: uppercase;
	letter-spacing: 0.7px;
	padding: 16px 20px;
	border-top: none;
	border-bottom: 1.5px solid #e2e8f0;
}
.table-custom-kas tbody td {
	padding: 18px 20px;
	vertical-align: middle;
	border-top: 1px solid #f1f5f9;
	font-size: 13.5px;
}
.table-custom-kas tbody tr:hover td {
	background: #fbfdff;
}

.badge-id-kas {
	font-family: 'JetBrains Mono', monospace;
	font-size: 12px;
	font-weight: 700;
	background: #f1f5f9;
	color: #1e293b;
	padding: 4px 10px;
	border-radius: 8px;
	border: 1px solid #e2e8f0;
}
.badge-amount-pill--red {
	font-family: 'JetBrains Mono', monospace;
	font-size: 14px;
	font-weight: 800;
	color: #dc2626;
	background: #fef2f2;
	border: 1px solid #fecdd3;
	padding: 6px 14px;
	border-radius: 10px;
	display: inline-flex;
	align-items: center;
	gap: 6px;
}

.btn-action-circle {
	width: 34px;
	height: 34px;
	border-radius: 10px;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	font-size: 13.5px;
	border: 1px solid transparent;
	transition: all 0.2s;
	background: #f8fafc;
	color: #475569;
	cursor: pointer;
}
.btn-action-circle:hover {
	transform: translateY(-2px);
}
.btn-action-circle.btn-edit {
	background: #fff7ed;
	color: #ea580c;
	border-color: #ffedd5;
}
.btn-action-circle.btn-del {
	background: #fff1f2;
	color: #e11d48;
	border-color: #ffe4e6;
}
</style>

<div class="kas-page-wrapper">
	<!-- Hero Mesh Gradient Header -->
	<div class="kas-hero-mesh--keluar">
		<div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 20px;">
			<div>
				<div class="hero-glass-pill--keluar">
					<span class="hero-pulsing-dot--red"></span>
					SISTEM KEUANGAN RT &bull; KAS KELUAR
				</div>
				<h1 class="font-weight-bold text-white mb-2" style="font-size: 28px; letter-spacing: -0.6px;">
					Pengeluaran Kas RT
				</h1>
				<p class="mb-0 text-white-50" style="font-size: 14px; max-width: 580px;">
					Pencatatan alokasi biaya operasional, pemeliharaan lingkungan, kegiatan sosial warga, dan transparansi belanja RT.
				</p>
			</div>

			<div class="d-flex flex-wrap align-items-center" style="gap: 12px;">
				<div class="kas-nav-switcher">
					<a href="{{ route('kas.masuk') }}">
						<i class="fas fa-arrow-down text-success"></i> Pemasukan
					</a>
					<a href="{{ route('kas.keluar') }}" class="active">
						<i class="fas fa-arrow-up text-danger"></i> Pengeluaran
					</a>
				</div>

				<button class="btn btn-light font-weight-bold px-4 py-2 text-danger shadow" data-toggle="modal" data-target="#addKasKeluarModal" style="border-radius: 12px; font-size: 14px;">
					<i class="fas fa-minus-circle mr-1"></i> + Catat Pengeluaran
				</button>
			</div>
		</div>
	</div>

	<!-- 4 Fintech KPI Cards -->
	<div class="fintech-kpi-grid">
		<div class="fintech-kpi-card">
			<div class="kpi-accent-bar kpi-accent-rose"></div>
			<div class="d-flex justify-content-between align-items-center">
				<div class="kpi-icon-bubble" style="background: #fef2f2; color: #dc2626;">
					<i class="fas fa-hand-holding-usd"></i>
				</div>
				<span class="badge badge-danger px-2 py-1 font-weight-bold" style="font-size: 11px; border-radius: 6px;">
					AKUMULASI
				</span>
			</div>
			<small class="text-muted font-weight-bold text-uppercase d-block mb-1" style="font-size: 11px;">Total Pengeluaran</small>
			<div class="kpi-val text-danger">Rp {{ rupiah($total_keluar ?? 0) }}</div>
			<p class="kpi-sub"><i class="fas fa-check-circle text-danger"></i> Seluruh biaya teralokasi</p>
		</div>

		<div class="fintech-kpi-card">
			<div class="kpi-accent-bar kpi-accent-orange"></div>
			<div class="d-flex justify-content-between align-items-center">
				<div class="kpi-icon-bubble" style="background: #fff7ed; color: #ea580c;">
					<i class="fas fa-calendar-minus"></i>
				</div>
				<span class="badge badge-warning px-2 py-1 font-weight-bold text-white" style="font-size: 11px; border-radius: 6px; background: #ea580c;">
					{{ strtoupper(date('M Y')) }}
				</span>
			</div>
			<small class="text-muted font-weight-bold text-uppercase d-block mb-1" style="font-size: 11px;">Pengeluaran Bulan Ini</small>
			<div class="kpi-val text-warning" style="color: #ea580c !important;">Rp {{ rupiah($keluar_bulan_ini ?? 0) }}</div>
			<p class="kpi-sub"><strong>{{ $count_bulan_ini ?? 0 }}</strong> pengeluaran di bulan berjalan</p>
		</div>

		<div class="fintech-kpi-card">
			<div class="kpi-accent-bar kpi-accent-blue"></div>
			<div class="d-flex justify-content-between align-items-center">
				<div class="kpi-icon-bubble" style="background: #eff6ff; color: #2563eb;">
					<i class="fas fa-wallet"></i>
				</div>
				<span class="badge {{ ($saldo_kas ?? 0) >= 0 ? 'badge-primary' : 'badge-danger' }} px-2 py-1 font-weight-bold" style="font-size: 11px; border-radius: 6px;">
					{{ ($saldo_kas ?? 0) >= 0 ? 'SURPLUS' : 'DEFISIT' }}
				</span>
			</div>
			<small class="text-muted font-weight-bold text-uppercase d-block mb-1" style="font-size: 11px;">Sisa Saldo Kas</small>
			<div class="kpi-val {{ ($saldo_kas ?? 0) >= 0 ? 'text-primary' : 'text-danger' }}">
				Rp {{ rupiah($saldo_kas ?? 0) }}
			</div>
			<p class="kpi-sub"><i class="fas fa-shield-alt text-primary"></i> Dana kas tersedia saat ini</p>
		</div>

		<div class="fintech-kpi-card">
			<div class="kpi-accent-bar kpi-accent-purple"></div>
			<div class="d-flex justify-content-between align-items-center">
				<div class="kpi-icon-bubble" style="background: #f5f3ff; color: #7c3aed;">
					<i class="fas fa-chart-line"></i>
				</div>
				<span class="badge badge-light border px-2 py-1 font-weight-bold" style="font-size: 11px; border-radius: 6px;">
					RATA-RATA
				</span>
			</div>
			<small class="text-muted font-weight-bold text-uppercase d-block mb-1" style="font-size: 11px;">Rata-Rata per Belanja</small>
			<div class="kpi-val" style="color: #6d28d9;">Rp {{ rupiah($rata_rata ?? 0) }}</div>
			<p class="kpi-sub">Total <strong>{{ $count_total ?? count($keluar) }}</strong> data transaksi keluar</p>
		</div>
	</div>

	<!-- Category Filter Chips -->
	<div class="category-chips-bar" id="categoryChipsBar">
		<button type="button" class="category-chip active" onclick="filterByCategory('all', this)">🌟 Semua Data</button>
		<button type="button" class="category-chip" onclick="filterByCategory('sampah', this)">🗑️ Petugas Sampah</button>
		<button type="button" class="category-chip" onclick="filterByCategory('keamanan', this)">👮 Keamanan / Hansip</button>
		<button type="button" class="category-chip" onclick="filterByCategory('perbaikan', this)">🛠️ Perbaikan / Fasilitas</button>
		<button type="button" class="category-chip" onclick="filterByCategory('kegiatan', this)">🎈 Kegiatan / Sosial</button>
	</div>

	<!-- Main Table Section -->
	<div class="table-container-card">
		<div class="p-3 border-bottom d-flex align-items-center justify-content-between flex-wrap" style="gap: 12px; background: #ffffff;">
			<div class="d-flex align-items-center flex-wrap" style="gap: 10px; flex: 1;">
				<div style="position: relative; min-width: 260px;">
					<i class="fas fa-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px;"></i>
					<input type="text" id="kasSearchInput" class="form-control form-control-sm" placeholder="Ketik keperluan atau nominal..." style="padding-left: 38px; border-radius: 10px; border: 1.5px solid #e2e8f0; font-size: 13px;" onkeyup="searchKasTable()">
				</div>
			</div>
			<div style="font-size: 13px; color: #64748b;">
				Tampil <strong class="text-dark">{{ count($keluar) }}</strong> data transaksi
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-custom-kas" id="kasMainTable">
				<thead>
					<tr>
						<th style="width: 140px;">No. Transaksi</th>
						<th style="width: 180px;">Tanggal Keluar</th>
						<th>Keterangan / Keperluan</th>
						<th style="width: 210px;" class="text-right">Nominal Keluar</th>
						<th style="width: 130px;" class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody id="kasTableBody">
					@forelse($keluar as $klr)
					@php
						$ket_lower = strtolower($klr->keterangan);
						$cat_icon = '💸';
						$cat_name = 'Operasional';
						if (str_contains($ket_lower, 'sampah')) {
							$cat_icon = '🗑️';
							$cat_name = 'Sampah';
						} elseif (str_contains($ket_lower, 'keamanan') || str_contains($ket_lower, 'hansip') || str_contains($ket_lower, 'satpam')) {
							$cat_icon = '👮';
							$cat_name = 'Keamanan';
						} elseif (str_contains($ket_lower, 'perbaikan') || str_contains($ket_lower, 'lampu') || str_contains($ket_lower, 'pos')) {
							$cat_icon = '🛠️';
							$cat_name = 'Perbaikan';
						} elseif (str_contains($ket_lower, 'lomba') || str_contains($ket_lower, 'rapat') || str_contains($ket_lower, 'sosial')) {
							$cat_icon = '🎈';
							$cat_name = 'Kegiatan';
						}
					@endphp
					<tr class="kas-row-item" data-ket="{{ strtolower($klr->keterangan) }}" data-category="{{ strtolower($cat_name) }}">
						<td><span class="badge-id-kas">#{{ $klr->idKas }}</span></td>
						<td>
							<div class="font-weight-bold text-dark">{{ date('d M Y', strtotime($klr->tanggal)) }}</div>
							<small class="text-muted">{{ date('l', strtotime($klr->tanggal)) }}</small>
						</td>
						<td>
							<span class="badge badge-light border px-2 py-1 mr-2 font-weight-bold" style="border-radius: 6px; font-size: 11px;">
								{{ $cat_icon }} {{ $cat_name }}
							</span>
							<strong class="text-dark">{{ $klr->keterangan }}</strong>
						</td>
						<td class="text-right">
							<span class="badge-amount-pill--red">
								<i class="fas fa-arrow-up"></i> - Rp {{ rupiah($klr->jumlah) }}
							</span>
						</td>
						<td class="text-center">
							<div class="d-inline-flex" style="gap: 6px;">
								<!-- Edit Modal Button -->
								<button type="button" class="btn-action-circle btn-edit" title="Edit Data" data-toggle="modal" data-target="#editModal{{ $klr->idKas }}">
									<i class="fas fa-pen"></i>
								</button>
								<!-- Delete Button -->
								<a href="{{ route('kas.destroy', $klr->idKas) }}" class="btn-action-circle btn-del" title="Hapus Data" onclick="return confirm('Apakah Anda yakin ingin menghapus data pengeluaran ini?')">
									<i class="fas fa-trash-alt"></i>
								</a>
							</div>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="5" class="text-center py-5 text-muted">
							<i class="fas fa-receipt fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
							<h5>Belum Ada Data Pengeluaran</h5>
							<p style="font-size: 13px;">Klik tombol "+ Catat Pengeluaran" untuk menambahkan pengeluaran baru.</p>
						</td>
					</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal Tambah Kas Keluar -->
<div class="modal fade" id="addKasKeluarModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
			<div class="modal-header text-white" style="background: linear-gradient(135deg, #7f1d1d, #dc2626); padding: 22px 26px;">
				<h5 class="modal-title font-weight-bold text-white mb-0"><i class="fas fa-minus mr-2"></i>Catat Pengeluaran Kas Baru</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body p-4">
				<form action="{{ route('kas.store') }}" method="POST">
					@csrf
					<input type="hidden" name="jenis" value="Keluar">

					<div class="form-group mb-3">
						<label class="font-weight-bold text-dark" style="font-size: 13px;">Tanggal Pengeluaran</label>
						<input class="form-control" type="date" name="tanggal" value="{{ date('Y-m-d') }}" required style="border-radius: 9px;">
					</div>

					<div class="form-group mb-3">
						<label class="font-weight-bold text-dark mb-1" style="font-size: 13px;">Keterangan / Keperluan Belanja</label>
						<textarea class="form-control mb-2" name="keterangan" id="addKetKeluar" rows="2" placeholder="Contoh: Honor petugas kebersihan, beli lampu jalan RT..." required style="border-radius: 9px;"></textarea>
						<div class="d-flex flex-wrap" style="gap: 5px;">
							<button type="button" class="btn btn-sm btn-light border" onclick="document.getElementById('addKetKeluar').value = 'Gaji Petugas Kebersihan Sampah RT'">🗑️ Gaji Sampah</button>
							<button type="button" class="btn btn-sm btn-light border" onclick="document.getElementById('addKetKeluar').value = 'Honor Hansip / Keamanan RT'">👮 Keamanan</button>
							<button type="button" class="btn btn-sm btn-light border" onclick="document.getElementById('addKetKeluar').value = 'Perbaikan Lampu Penerangan Jalan RT'">🛠️ Lampu Jalan</button>
						</div>
					</div>

					<div class="form-group mb-4">
						<label class="font-weight-bold text-dark mb-1" style="font-size: 13px;">Nominal (Rp)</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text font-weight-bold" style="border-radius: 9px 0 0 9px; background: #fef2f2; color: #dc2626;">Rp</span>
							</div>
							<input class="form-control" type="number" name="jumlah" placeholder="0" required style="border-radius: 0 9px 9px 0; font-weight: 800; font-size: 17px;">
						</div>
					</div>

					<div class="d-flex justify-content-end" style="gap: 8px;">
						<button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
						<button type="submit" class="btn btn-danger px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px; background: #dc2626;">
							<i class="fas fa-check-circle mr-1"></i> Simpan Pengeluaran
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modals Edit Kas Keluar -->
@foreach($keluar as $klr)
<div class="modal fade" id="editModal{{ $klr->idKas }}" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 18px; border: none; overflow: hidden;">
			<div class="modal-header text-white" style="background: linear-gradient(135deg, #7f1d1d, #dc2626);">
				<h5 class="modal-title font-weight-bold">
					<i class="fas fa-pen mr-2"></i>Edit Pengeluaran #{{ $klr->idKas }}
				</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body p-4">
				<form action="{{ route('kas.update', $klr->idKas) }}" method="POST">
					@csrf
					<div class="form-group mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">Tanggal Transaksi</label>
						<input class="form-control" type="date" name="tanggal" value="{{ $klr->tanggal }}" required style="border-radius: 9px;">
					</div>

					<div class="form-group mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">Keterangan / Keperluan</label>
						<textarea class="form-control" name="keterangan" rows="2" required style="border-radius: 9px;">{{ $klr->keterangan }}</textarea>
					</div>

					<div class="form-group mb-4">
						<label class="font-weight-bold" style="font-size: 13px;">Nominal (Rp)</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text font-weight-bold" style="border-radius: 9px 0 0 9px; background: #fef2f2; color: #dc2626;">Rp</span>
							</div>
							<input class="form-control" type="number" name="jumlah" value="{{ $klr->jumlah }}" required style="border-radius: 0 9px 9px 0; font-weight: 700; font-size: 16px;">
						</div>
					</div>

					<div class="d-flex justify-content-end" style="gap: 8px;">
						<button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
						<button type="submit" class="btn btn-danger px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px; background: #dc2626;">
							<i class="fas fa-save mr-1"></i> Simpan Perubahan
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endforeach

<script>
function filterByCategory(cat, btn) {
	document.querySelectorAll('.category-chip').forEach(b => b.classList.remove('active'));
	if (btn) btn.classList.add('active');

	let rows = document.querySelectorAll('.kas-row-item');
	rows.forEach(r => {
		let itemCat = r.getAttribute('data-category') || '';
		if (cat === 'all' || itemCat.includes(cat)) {
			r.style.display = '';
		} else {
			r.style.display = 'none';
		}
	});
}

function searchKasTable() {
	let input = document.getElementById('kasSearchInput').value.toLowerCase();
	let rows = document.querySelectorAll('.kas-row-item');
	rows.forEach(r => {
		let text = r.innerText.toLowerCase();
		r.style.display = text.includes(input) ? '' : 'none';
	});
}
</script>
@endsection

