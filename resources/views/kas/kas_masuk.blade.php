@extends('layouts.app')

@section('title', 'Pemasukan Kas RT')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap');

:root {
	--emerald-primary: #059669;
	--emerald-dark: #064e3b;
	--emerald-light: #10b981;
	--emerald-glow: rgba(16, 185, 129, 0.28);
	--slate-bg: #f8fafc;
	--card-border: rgba(226, 232, 240, 0.85);
}

.kas-page-wrapper {
	font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
	color: #0f172a;
	padding-bottom: 60px;
}

/* Hero Mesh Gradient Header */
.kas-hero-mesh {
	background: linear-gradient(135deg, #022c22 0%, #064e3b 40%, #059669 80%, #0d9488 100%);
	border-radius: 24px;
	padding: 34px 38px;
	color: #ffffff;
	box-shadow: 0 20px 40px -15px rgba(5, 150, 105, 0.45);
	position: relative;
	overflow: hidden;
	margin-bottom: 28px;
	border: 1px solid rgba(255, 255, 255, 0.12);
}
.kas-hero-mesh::before {
	content: '';
	position: absolute;
	width: 320px;
	height: 320px;
	background: radial-gradient(circle, rgba(16, 185, 129, 0.35) 0%, rgba(16, 185, 129, 0) 70%);
	top: -80px;
	right: 15%;
	border-radius: 50%;
	filter: blur(40px);
	pointer-events: none;
}
.hero-glass-pill {
	background: rgba(255, 255, 255, 0.15);
	backdrop-filter: blur(12px);
	-webkit-backdrop-filter: blur(12px);
	border: 1px solid rgba(255, 255, 255, 0.25);
	color: #a7f3d0;
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
.hero-pulsing-dot {
	width: 8px;
	height: 8px;
	background: #34d399;
	border-radius: 50%;
	box-shadow: 0 0 0 0 rgba(52, 211, 153, 0.7);
	animation: pulseGreen 2s infinite;
}
@keyframes pulseGreen {
	0% { box-shadow: 0 0 0 0 rgba(52, 211, 153, 0.7); }
	70% { box-shadow: 0 0 0 8px rgba(52, 211, 153, 0); }
	100% { box-shadow: 0 0 0 0 rgba(52, 211, 153, 0); }
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
	color: #064e3b;
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
.kpi-accent-emerald { background: linear-gradient(90deg, #059669, #34d399); }
.kpi-accent-teal { background: linear-gradient(90deg, #0d9488, #2dd4bf); }
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
	background: #059669;
	color: #ffffff;
	border-color: #059669;
	box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
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
.badge-amount-pill {
	font-family: 'JetBrains Mono', monospace;
	font-size: 14px;
	font-weight: 800;
	color: #047857;
	background: #ecfdf5;
	border: 1px solid #a7f3d0;
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
.btn-action-circle.btn-view {
	background: #eff6ff;
	color: #2563eb;
	border-color: #dbeafe;
}
.btn-action-circle.btn-edit {
	background: #f0fdf4;
	color: #059669;
	border-color: #dcfce7;
}
.btn-action-circle.btn-del {
	background: #fff1f2;
	color: #e11d48;
	border-color: #ffe4e6;
}

.realistic-receipt {
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 16px;
	padding: 26px 28px;
	position: relative;
	box-shadow: 0 10px 25px -5px rgba(0,0,0,0.06);
}
.stamp-paid-seal {
	border: 3px double #059669;
	color: #059669;
	font-weight: 900;
	font-size: 13px;
	letter-spacing: 2px;
	padding: 5px 12px;
	border-radius: 8px;
	transform: rotate(-7deg);
	display: inline-block;
}
</style>

<div class="kas-page-wrapper">
	<!-- Hero Mesh Gradient Header -->
	<div class="kas-hero-mesh">
		<div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 20px;">
			<div>
				<div class="hero-glass-pill">
					<span class="hero-pulsing-dot"></span>
					SISTEM KEUANGAN RT &bull; KAS MASUK
				</div>
				<h1 class="font-weight-bold text-white mb-2" style="font-size: 28px; letter-spacing: -0.6px;">
					Pemasukan Kas RT
				</h1>
				<p class="mb-0 text-white-50" style="font-size: 14px; max-width: 580px;">
					Manajemen arus kas masuk, iuran bulanan warga, donasi, serta transparansi pembukuan kas RT digital.
				</p>
			</div>

			<div class="d-flex flex-wrap align-items-center" style="gap: 12px;">
				<div class="kas-nav-switcher">
					<a href="{{ route('kas.masuk') }}" class="active">
						<i class="fas fa-arrow-down text-success"></i> Pemasukan
					</a>
					<a href="{{ route('kas.keluar') }}">
						<i class="fas fa-arrow-up text-danger"></i> Pengeluaran
					</a>
				</div>

				<button class="btn btn-light font-weight-bold px-4 py-2 text-success shadow" data-toggle="modal" data-target="#addKasMasukModal" style="border-radius: 12px; font-size: 14px;">
					<i class="fas fa-plus-circle mr-1"></i> + Catat Pemasukan
				</button>
			</div>
		</div>
	</div>

	<!-- 4 Fintech KPI Cards -->
	<div class="fintech-kpi-grid">
		<div class="fintech-kpi-card">
			<div class="kpi-accent-bar kpi-accent-emerald"></div>
			<div class="d-flex justify-content-between align-items-center">
				<div class="kpi-icon-bubble" style="background: #ecfdf5; color: #059669;">
					<i class="fas fa-coins"></i>
				</div>
				<span class="badge badge-success px-2 py-1 font-weight-bold" style="font-size: 11px; border-radius: 6px;">
					AKUMULASI
				</span>
			</div>
			<small class="text-muted font-weight-bold text-uppercase d-block mb-1" style="font-size: 11px;">Total Pemasukan</small>
			<div class="kpi-val text-success">Rp {{ rupiah($total_masuk ?? 0) }}</div>
			<p class="kpi-sub"><i class="fas fa-check-circle text-success"></i> Seluruh dana kas terverifikasi</p>
		</div>

		<div class="fintech-kpi-card">
			<div class="kpi-accent-bar kpi-accent-teal"></div>
			<div class="d-flex justify-content-between align-items-center">
				<div class="kpi-icon-bubble" style="background: #f0fdfa; color: #0d9488;">
					<i class="fas fa-calendar-check"></i>
				</div>
				<span class="badge badge-info px-2 py-1 font-weight-bold" style="font-size: 11px; border-radius: 6px;">
					{{ strtoupper(date('M Y')) }}
				</span>
			</div>
			<small class="text-muted font-weight-bold text-uppercase d-block mb-1" style="font-size: 11px;">Pemasukan Bulan Ini</small>
			<div class="kpi-val text-info">Rp {{ rupiah($masuk_bulan_ini ?? 0) }}</div>
			<p class="kpi-sub"><strong>{{ $count_bulan_ini ?? 0 }}</strong> transaksi di bulan berjalan</p>
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
			<small class="text-muted font-weight-bold text-uppercase d-block mb-1" style="font-size: 11px;">Saldo Kas Bersih</small>
			<div class="kpi-val {{ ($saldo_kas ?? 0) >= 0 ? 'text-primary' : 'text-danger' }}">
				Rp {{ rupiah($saldo_kas ?? 0) }}
			</div>
			<p class="kpi-sub"><i class="fas fa-shield-alt text-primary"></i> Kas operasional RT saat ini</p>
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
			<small class="text-muted font-weight-bold text-uppercase d-block mb-1" style="font-size: 11px;">Rata-Rata per Transaksi</small>
			<div class="kpi-val" style="color: #6d28d9;">Rp {{ rupiah($rata_rata ?? 0) }}</div>
			<p class="kpi-sub">Total <strong>{{ $count_total ?? count($masuk) }}</strong> data transaksi tercatat</p>
		</div>
	</div>

	<!-- Category Filter Chips -->
	<div class="category-chips-bar" id="categoryChipsBar">
		<button type="button" class="category-chip active" onclick="filterByCategory('all', this)">🌟 Semua Data</button>
		<button type="button" class="category-chip" onclick="filterByCategory('iuran', this)">🏠 Iuran Warga</button>
		<button type="button" class="category-chip" onclick="filterByCategory('donasi', this)">🎁 Donasi & Sumbangan</button>
		<button type="button" class="category-chip" onclick="filterByCategory('sampah', this)">🗑️ Kas Sampah</button>
		<button type="button" class="category-chip" onclick="filterByCategory('sewa', this)">🎪 Sewa Fasilitas</button>
	</div>

	<!-- Main Table Section -->
	<div class="table-container-card">
		<div class="p-3 border-bottom d-flex align-items-center justify-content-between flex-wrap" style="gap: 12px; background: #ffffff;">
			<div class="d-flex align-items-center flex-wrap" style="gap: 10px; flex: 1;">
				<div style="position: relative; min-width: 260px;">
					<i class="fas fa-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px;"></i>
					<input type="text" id="kasSearchInput" class="form-control form-control-sm" placeholder="Ketik keterangan atau nominal..." style="padding-left: 38px; border-radius: 10px; border: 1.5px solid #e2e8f0; font-size: 13px;" onkeyup="searchKasTable()">
				</div>
			</div>
			<div style="font-size: 13px; color: #64748b;">
				Tampil <strong class="text-dark">{{ count($masuk) }}</strong> data transaksi
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-custom-kas" id="kasMainTable">
				<thead>
					<tr>
						<th style="width: 140px;">No. Transaksi</th>
						<th style="width: 180px;">Tanggal Catat</th>
						<th>Keterangan / Sumber Dana</th>
						<th style="width: 210px;" class="text-right">Nominal Masuk</th>
						<th style="width: 130px;" class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody id="kasTableBody">
					@forelse($masuk as $msk)
					@php
						$ket_lower = strtolower($msk->keterangan);
						$cat_icon = '💰';
						$cat_name = 'Lainnya';
						if (str_contains($ket_lower, 'iuran')) {
							$cat_icon = '🏠';
							$cat_name = 'Iuran Warga';
						} elseif (str_contains($ket_lower, 'donasi') || str_contains($ket_lower, 'sumbangan')) {
							$cat_icon = '🎁';
							$cat_name = 'Donasi';
						} elseif (str_contains($ket_lower, 'sampah')) {
							$cat_icon = '🗑️';
							$cat_name = 'Kas Sampah';
						} elseif (str_contains($ket_lower, 'sewa')) {
							$cat_icon = '🎪';
							$cat_name = 'Sewa Fasilitas';
						}
					@endphp
					<tr class="kas-row-item" data-ket="{{ strtolower($msk->keterangan) }}" data-category="{{ strtolower($cat_name) }}">
						<td><span class="badge-id-kas">#{{ $msk->idKas }}</span></td>
						<td>
							<div class="font-weight-bold text-dark">{{ date('d M Y', strtotime($msk->tanggal)) }}</div>
							<small class="text-muted">{{ date('l', strtotime($msk->tanggal)) }}</small>
						</td>
						<td>
							<span class="badge badge-light border px-2 py-1 mr-2 font-weight-bold" style="border-radius: 6px; font-size: 11px;">
								{{ $cat_icon }} {{ $cat_name }}
							</span>
							<strong class="text-dark">{{ $msk->keterangan }}</strong>
						</td>
						<td class="text-right">
							<span class="badge-amount-pill">
								<i class="fas fa-arrow-down"></i> + Rp {{ rupiah($msk->jumlah) }}
							</span>
						</td>
						<td class="text-center">
							<div class="d-inline-flex" style="gap: 6px;">
								<!-- Kwitansi Modal Button -->
								<button type="button" class="btn-action-circle btn-view" title="Lihat Bukti Kwitansi" data-toggle="modal" data-target="#receiptModal{{ $msk->idKas }}">
									<i class="fas fa-file-invoice"></i>
								</button>
								<!-- Edit Modal Button -->
								<button type="button" class="btn-action-circle btn-edit" title="Edit Data" data-toggle="modal" data-target="#editModal{{ $msk->idKas }}">
									<i class="fas fa-pen"></i>
								</button>
								<!-- Delete Button -->
								<a href="{{ route('kas.destroy', $msk->idKas) }}" class="btn-action-circle btn-del" title="Hapus Data" onclick="return confirm('Apakah Anda yakin ingin menghapus data kas masuk ini?')">
									<i class="fas fa-trash-alt"></i>
								</a>
							</div>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="5" class="text-center py-5 text-muted">
							<i class="fas fa-wallet fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
							<h5>Belum Ada Data Kas Masuk</h5>
							<p style="font-size: 13px;">Klik tombol "+ Catat Pemasukan" untuk menambahkan pemasukan kas pertama.</p>
						</td>
					</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal Tambah Kas Masuk -->
<div class="modal fade" id="addKasMasukModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
			<div class="modal-header text-white" style="background: linear-gradient(135deg, #064e3b, #059669); padding: 22px 26px;">
				<h5 class="modal-title font-weight-bold text-white mb-0"><i class="fas fa-plus mr-2"></i>Catat Kas Masuk Baru</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body p-4">
				<form action="{{ route('kas.store') }}" method="POST">
					@csrf
					<input type="hidden" name="jenis" value="Masuk">

					<div class="form-group mb-3">
						<label class="font-weight-bold text-dark" style="font-size: 13px;">Tanggal Penerimaan</label>
						<input class="form-control" type="date" name="tanggal" value="{{ date('Y-m-d') }}" required style="border-radius: 9px;">
					</div>

					<div class="form-group mb-3">
						<label class="font-weight-bold text-dark mb-1" style="font-size: 13px;">Keterangan / Sumber Pemasukan</label>
						<textarea class="form-control mb-2" name="keterangan" id="addKet" rows="2" placeholder="Contoh: Iuran Warga Blok C, Donasi Bpk. H. Ahmad..." required style="border-radius: 9px;"></textarea>
						<div class="d-flex flex-wrap" style="gap: 5px;">
							<button type="button" class="btn btn-sm btn-light border" onclick="document.getElementById('addKet').value = 'Iuran Bulanan Warga RT'">🏠 Iuran Bulanan</button>
							<button type="button" class="btn btn-sm btn-light border" onclick="document.getElementById('addKet').value = 'Donasi / Sumbangan Sukarela Warga'">🎁 Donasi</button>
							<button type="button" class="btn btn-sm btn-light border" onclick="document.getElementById('addKet').value = 'Kas Pengelolaan Sampah Lingkungan'">🗑️ Kas Sampah</button>
						</div>
					</div>

					<div class="form-group mb-4">
						<label class="font-weight-bold text-dark mb-1" style="font-size: 13px;">Nominal (Rp)</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text font-weight-bold" style="border-radius: 9px 0 0 9px; background: #ecfdf5; color: #059669;">Rp</span>
							</div>
							<input class="form-control" type="number" name="jumlah" placeholder="0" required style="border-radius: 0 9px 9px 0; font-weight: 800; font-size: 17px;">
						</div>
					</div>

					<div class="d-flex justify-content-end" style="gap: 8px;">
						<button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
						<button type="submit" class="btn btn-success px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px; background: #059669;">
							<i class="fas fa-check-circle mr-1"></i> Simpan Pemasukan
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modals Detail Kwitansi & Edit Kas Masuk -->
@foreach($masuk as $msk)
<!-- Modal Bukti Kwitansi Digital -->
<div class="modal fade" id="receiptModal{{ $msk->idKas }}" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 18px; border: none; background: transparent;">
			<div class="realistic-receipt">
				<div class="d-flex justify-content-between align-items-start mb-3">
					<div>
						<span class="badge badge-success px-2 py-1 font-weight-bold mb-1" style="font-size: 10.5px;">E-KASRT DIGITAL VOUCHER</span>
						<h5 class="font-weight-bold mb-0 text-dark">BUKTI KAS MASUK</h5>
						<small class="text-muted" style="font-family: 'JetBrains Mono';">ID: #{{ $msk->idKas }}</small>
					</div>
					<div class="d-flex align-items-center" style="gap: 12px;">
						<div class="stamp-paid-seal">LUNAS</div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
				</div>

				<hr style="border-top: 2px dashed #e2e8f0;">

				<table class="table table-sm table-borderless mb-2" style="font-size: 13.5px;">
					<tr>
						<td style="width: 140px; color: #64748b;">Tanggal Catat</td>
						<td>: <strong>{{ date('d F Y', strtotime($msk->tanggal)) }}</strong></td>
					</tr>
					<tr>
						<td style="color: #64748b;">Keterangan</td>
						<td>: <strong>{{ $msk->keterangan }}</strong></td>
					</tr>
				</table>

				<div class="p-3 my-2" style="background: #ecfdf5; border-radius: 12px; border: 1.5px solid #a7f3d0;">
					<small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 11px;">Nominal Penerimaan</small>
					<h3 class="font-weight-bold text-success mb-0" style="font-family: 'JetBrains Mono', monospace;">
						+ Rp {{ rupiah($msk->jumlah) }}
					</h3>
				</div>

				<div class="p-2 mb-3 text-muted" style="background: #f8fafc; border-radius: 8px; font-size: 12.5px;">
					<span>Terbilang:</span><br>
					<strong class="text-dark"><em>"{{ terbilang($msk->jumlah) }} Rupiah"</em></strong>
				</div>

				<div class="d-flex justify-content-end">
					<button type="button" class="btn btn-secondary btn-sm px-3 py-2 font-weight-bold" style="border-radius: 8px;" data-dismiss="modal">
						Tutup
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Edit Kas Masuk -->
<div class="modal fade" id="editModal{{ $msk->idKas }}" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 18px; border: none; overflow: hidden;">
			<div class="modal-header text-white" style="background: linear-gradient(135deg, #064e3b, #059669);">
				<h5 class="modal-title font-weight-bold">
					<i class="fas fa-pen mr-2"></i>Edit Kas Masuk #{{ $msk->idKas }}
				</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body p-4">
				<form action="{{ route('kas.update', $msk->idKas) }}" method="POST">
					@csrf
					<div class="form-group mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">Tanggal Transaksi</label>
						<input class="form-control" type="date" name="tanggal" value="{{ $msk->tanggal }}" required style="border-radius: 9px;">
					</div>

					<div class="form-group mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">Keterangan / Sumber Dana</label>
						<textarea class="form-control" name="keterangan" rows="2" required style="border-radius: 9px;">{{ $msk->keterangan }}</textarea>
					</div>

					<div class="form-group mb-4">
						<label class="font-weight-bold" style="font-size: 13px;">Nominal (Rp)</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text font-weight-bold" style="border-radius: 9px 0 0 9px; background: #ecfdf5; color: #059669;">Rp</span>
							</div>
							<input class="form-control" type="number" name="jumlah" value="{{ $msk->jumlah }}" required style="border-radius: 0 9px 9px 0; font-weight: 700; font-size: 16px;">
						</div>
					</div>

					<div class="d-flex justify-content-end" style="gap: 8px;">
						<button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
						<button type="submit" class="btn btn-success px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px; background: #059669;">
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

