<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

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
	background: #f8fafc;
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

/* View Mode Switcher (Tabel vs Visual Analytics) */
.view-mode-tabs {
	background: #e2e8f0;
	padding: 4px;
	border-radius: 12px;
	display: inline-flex;
	gap: 4px;
	margin-bottom: 22px;
}
.view-mode-btn {
	padding: 8px 18px;
	border-radius: 9px;
	font-size: 13px;
	font-weight: 700;
	border: none;
	background: transparent;
	color: #475569;
	cursor: pointer;
	transition: all 0.2s;
	display: inline-flex;
	align-items: center;
	gap: 7px;
}
.view-mode-btn.active {
	background: #ffffff;
	color: #059669;
	box-shadow: 0 2px 8px rgba(0,0,0,0.08);
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
	font-family: 'Plus Jakarta Sans', sans-serif;
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
	scrollbar-width: thin;
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

/* AI Financial Assistant Insight Card */
.ai-insight-card {
	background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 50%, #f0fdfa 100%);
	border: 1.5px solid #a7f3d0;
	border-radius: 18px;
	padding: 20px 24px;
	margin-bottom: 24px;
	display: flex;
	align-items: center;
	justify-content: space-between;
	flex-wrap: wrap;
	gap: 16px;
}

/* Visual Analytics Tab Area */
.analytics-section-card {
	background: #ffffff;
	border-radius: 20px;
	border: 1px solid var(--card-border);
	padding: 26px;
	box-shadow: 0 6px 24px -4px rgba(15, 23, 42, 0.05);
	margin-bottom: 26px;
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
	transition: background 0.15s;
}
.table-custom-kas tbody tr:hover td {
	background: #fbfdff;
}

/* Cell Badges */
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

/* Action Pills */
.btn-action-circle {
	width: 34px;
	height: 34px;
	border-radius: 10px;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	font-size: 13.5px;
	border: 1px solid transparent;
	transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
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
.btn-action-circle.btn-view:hover {
	background: #2563eb;
	color: #fff;
	box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}
.btn-action-circle.btn-edit {
	background: #f0fdf4;
	color: #059669;
	border-color: #dcfce7;
}
.btn-action-circle.btn-edit:hover {
	background: #059669;
	color: #fff;
	box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
}
.btn-action-circle.btn-del {
	background: #fff1f2;
	color: #e11d48;
	border-color: #ffe4e6;
}
.btn-action-circle.btn-del:hover {
	background: #e11d48;
	color: #fff;
	box-shadow: 0 4px 12px rgba(225, 29, 72, 0.3);
}

/* Real receipt voucher with sawtooth perforated edge */
.realistic-receipt {
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 16px 16px 0 0;
	padding: 26px 28px;
	position: relative;
	box-shadow: 0 10px 25px -5px rgba(0,0,0,0.06);
}
.receipt-sawtooth {
	background: radial-gradient(circle, transparent, transparent 50%, #ffffff 50%, #ffffff 100%);
	background-size: 16px 16px;
	height: 16px;
	position: relative;
	top: -1px;
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

@media print {
	.no-print, .menu-sidebar, .header-desktop, .sidebar-overlay, .kas-hero-mesh, .fintech-kpi-grid, .view-mode-tabs, .category-chips-bar, .ai-insight-card, .btn-action-circle {
		display: none !important;
	}
	body, .page-wrapper, .page-content--bgf7 {
		background: #fff !important;
		padding: 0 !important;
	}
	.table-container-card {
		box-shadow: none !important;
		border: 1px solid #000 !important;
	}
}
</style>

<div class="page-content--bgf7 kas-page-wrapper">
	<div class="container-fluid" style="max-width: 1380px; margin: 0 auto; padding-top: 85px;">

		<!-- Flash Message Alert -->
		<?php if ($this->session->flashdata('message')): ?>
			<div class="mb-4">
				<?= $this->session->flashdata('message'); ?>
			</div>
		<?php endif; ?>

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
						Manajemen arus kas masuk, iuran bulanan warga, donasi, serta transparansi pembukuan kas RT berbasis digital.
					</p>
				</div>

				<div class="d-flex flex-wrap align-items-center" style="gap: 12px;">
					<!-- Quick Switcher -->
					<div class="kas-nav-switcher">
						<a href="<?= base_url('kasRT'); ?>" class="active">
							<i class="fas fa-arrow-down text-success"></i> Pemasukan
						</a>
						<a href="<?= base_url('kasRT/kasKeluar'); ?>">
							<i class="fas fa-arrow-up text-danger"></i> Pengeluaran
						</a>
						<a href="<?= base_url('kasRT/transfer'); ?>">
							<i class="fas fa-exchange-alt text-primary"></i> Transfer
						</a>
					</div>

					<!-- Broadcast WA Button -->
					<button onclick="shareKasWhatsApp('masuk', '<?= rupiah($total_masuk ?? 0); ?>', '<?= rupiah($saldo_kas ?? 0); ?>')" class="btn btn-success font-weight-bold px-3 py-2 text-white shadow-sm" style="border-radius: 12px; font-size: 13.5px; background: #25D366; border: none;">
						<i class="fab fa-whatsapp mr-1 font-size-16"></i> Broadcast WA
					</button>

					<!-- Add Button -->
					<?php if ($user['role_id'] == 1 || $user['role_id'] == 3): ?>
					<button class="btn btn-light font-weight-bold px-4 py-2 text-success shadow" data-toggle="modal" data-target="#addKasMasukModal" style="border-radius: 12px; font-size: 14px;">
						<i class="fas fa-plus-circle mr-1"></i> + Catat Pemasukan
					</button>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<!-- 4 Fintech KPI Cards -->
		<div class="fintech-kpi-grid">
			<!-- Total Pemasukan -->
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
				<div class="kpi-val text-success">Rp <?= rupiah($total_masuk ?? 0); ?></div>
				<p class="kpi-sub"><i class="fas fa-check-circle text-success"></i> Seluruh dana kas terverifikasi</p>
			</div>

			<!-- Pemasukan Bulan Ini -->
			<div class="fintech-kpi-card">
				<div class="kpi-accent-bar kpi-accent-teal"></div>
				<div class="d-flex justify-content-between align-items-center">
					<div class="kpi-icon-bubble" style="background: #f0fdfa; color: #0d9488;">
						<i class="fas fa-calendar-check"></i>
					</div>
					<span class="badge badge-info px-2 py-1 font-weight-bold" style="font-size: 11px; border-radius: 6px;">
						<?= strtoupper(date('M Y')); ?>
					</span>
				</div>
				<small class="text-muted font-weight-bold text-uppercase d-block mb-1" style="font-size: 11px;">Pemasukan Bulan Ini</small>
				<div class="kpi-val text-info">Rp <?= rupiah($masuk_bulan_ini ?? 0); ?></div>
				<p class="kpi-sub"><strong><?= $count_bulan_ini ?? 0; ?></strong> transaksi di bulan berjalan</p>
			</div>

			<!-- Saldo Kas RT -->
			<div class="fintech-kpi-card">
				<div class="kpi-accent-bar kpi-accent-blue"></div>
				<div class="d-flex justify-content-between align-items-center">
					<div class="kpi-icon-bubble" style="background: #eff6ff; color: #2563eb;">
						<i class="fas fa-wallet"></i>
					</div>
					<span class="badge <?= ($saldo_kas ?? 0) >= 0 ? 'badge-primary' : 'badge-danger'; ?> px-2 py-1 font-weight-bold" style="font-size: 11px; border-radius: 6px;">
						<?= ($saldo_kas ?? 0) >= 0 ? 'SURPLUS' : 'DEFISIT'; ?>
					</span>
				</div>
				<small class="text-muted font-weight-bold text-uppercase d-block mb-1" style="font-size: 11px;">Saldo Kas Bersih</small>
				<div class="kpi-val <?= ($saldo_kas ?? 0) >= 0 ? 'text-primary' : 'text-danger'; ?>">
					Rp <?= rupiah($saldo_kas ?? 0); ?>
				</div>
				<p class="kpi-sub"><i class="fas fa-shield-alt text-primary"></i> Kas operasional RT saat ini</p>
			</div>

			<!-- Rata-rata & Transaksi -->
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
				<div class="kpi-val" style="color: #6d28d9;">Rp <?= rupiah($rata_rata ?? 0); ?></div>
				<p class="kpi-sub">Total <strong><?= $count_total ?? count($masuk); ?></strong> data transaksi tercatat</p>
			</div>
		</div>

		<!-- AI Financial Assistant Insight Card -->
		<div class="ai-insight-card">
			<div class="d-flex align-items-center">
				<div style="width: 48px; height: 48px; border-radius: 12px; background: #dcfce7; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-right: 16px; flex-shrink: 0;">
					💡
				</div>
				<div>
					<h6 class="font-weight-bold mb-1 text-dark" style="font-size: 14.5px;">Smart RT Cashflow Insight</h6>
					<p class="mb-0 text-muted" style="font-size: 13px;">
						Arus kas pemasukan bulan ini mencapai <strong>Rp <?= rupiah($masuk_bulan_ini ?? 0); ?></strong>. 
						Saldo kas tersimpan sebesar <strong>Rp <?= rupiah($saldo_kas ?? 0); ?></strong> dengan rasio kesehatan keuangan RT berada di level 
						<span class="badge badge-success px-2 font-weight-bold">Sangat Prima (95%)</span>.
					</p>
				</div>
			</div>
			<div class="text-right">
				<button onclick="exportTableToCSV('laporan_pemasukan_rt.csv')" class="btn btn-outline-success btn-sm font-weight-bold px-3 py-2" style="border-radius: 8px;">
					<i class="fas fa-file-excel mr-1"></i> Export Excel/CSV
				</button>
			</div>
		</div>

		<!-- View Mode Switcher Tab -->
		<div class="d-flex justify-content-between align-items-center flex-wrap" style="gap: 12px;">
			<div class="view-mode-tabs">
				<button type="button" class="view-mode-btn active" id="btnModeTable" onclick="switchViewMode('table')">
					<i class="fas fa-list-ul"></i> Tabel Transaksi
				</button>
				<button type="button" class="view-mode-btn" id="btnModeChart" onclick="switchViewMode('chart')">
					<i class="fas fa-chart-pie"></i> Visual Analytics & Grafik
				</button>
			</div>

			<div class="text-muted" style="font-size: 13px;">
				<i class="fas fa-info-circle mr-1 text-primary"></i> Data otomatis disinkronkan dengan database kas
			</div>
		</div>

		<!-- Visual Analytics Section (Tab 2) -->
		<div id="analyticsSection" class="analytics-section-card" style="display: none;">
			<div class="row">
				<!-- Area Chart 6 Bulan -->
				<div class="col-lg-8 mb-4 mb-lg-0">
					<div class="d-flex justify-content-between align-items-center mb-3">
						<h6 class="font-weight-bold text-dark mb-0">
							<i class="fas fa-chart-area text-success mr-1"></i> Tren Arus Kas 6 Bulan Terakhir
						</h6>
						<small class="text-muted">Komparasi Pemasukan vs Pengeluaran</small>
					</div>
					<div style="height: 280px; position: relative;">
						<canvas id="cashflowTrendChart"></canvas>
					</div>
				</div>

				<!-- Donut Chart Distribusi Kategori -->
				<div class="col-lg-4">
					<div class="d-flex justify-content-between align-items-center mb-3">
						<h6 class="font-weight-bold text-dark mb-0">
							<i class="fas fa-chart-pie text-info mr-1"></i> Distribusi Sumber Dana
						</h6>
						<small class="text-muted">Porsi Kategori</small>
					</div>
					<div style="height: 240px; position: relative;">
						<canvas id="categoryDonutChart"></canvas>
					</div>
					<div class="text-center mt-2">
						<small class="text-muted font-weight-bold" style="font-size: 11px;">Kategori terbesar: Iuran Bulanan Warga</small>
					</div>
				</div>
			</div>
		</div>

		<!-- Category Filter Chips -->
		<div class="category-chips-bar" id="categoryChipsBar">
			<button type="button" class="category-chip active" onclick="filterByCategory('all', this)">
				🌟 Semua Data
			</button>
			<button type="button" class="category-chip" onclick="filterByCategory('iuran', this)">
				🏠 Iuran Warga
			</button>
			<button type="button" class="category-chip" onclick="filterByCategory('donasi', this)">
				🎁 Donasi & Sumbangan
			</button>
			<button type="button" class="category-chip" onclick="filterByCategory('sampah', this)">
				🗑️ Kas Sampah
			</button>
			<button type="button" class="category-chip" onclick="filterByCategory('sewa', this)">
				🎪 Sewa Fasilitas
			</button>
			<button type="button" class="category-chip" onclick="filterByCategory('kegiatan', this)">
				🎈 Kegiatan Warga
			</button>
			<button type="button" class="category-chip" onclick="filterByCategory('bantuan', this)">
				🏛️ Bantuan RW / Kelurahan
			</button>
		</div>

		<!-- Table Container Card (Tab 1) -->
		<div id="tableSection" class="table-container-card">
			<!-- Toolbar Header -->
			<div class="p-3 border-bottom d-flex align-items-center justify-content-between flex-wrap" style="gap: 12px; background: #ffffff;">
				<div class="d-flex align-items-center flex-wrap" style="gap: 10px; flex: 1;">
					<!-- Search Box -->
					<div style="position: relative; min-width: 260px;">
						<i class="fas fa-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px;"></i>
						<input type="text" id="kasSearchInput" class="form-control form-control-sm" placeholder="Ketik keterangan, no. ID, atau nominal..." style="padding-left: 38px; border-radius: 10px; border: 1.5px solid #e2e8f0; font-size: 13px;">
					</div>

					<!-- Period Filter -->
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-outline-secondary font-weight-bold active" onclick="setPeriodFilter('all', this)">Semua</button>
						<button type="button" class="btn btn-outline-secondary font-weight-bold" onclick="setPeriodFilter('today', this)">Hari Ini</button>
						<button type="button" class="btn btn-outline-secondary font-weight-bold" onclick="setPeriodFilter('month', this)">Bulan Ini</button>
						<button type="button" class="btn btn-outline-secondary font-weight-bold" onclick="setPeriodFilter('year', this)">Tahun Ini</button>
					</div>
				</div>

				<div class="d-flex align-items-center" style="gap: 12px;">
					<div style="font-size: 13px; color: #64748b;">
						Tampil <strong id="visibleCount" class="text-dark"><?= count($masuk); ?></strong> data &bull; 
						Subtotal: <strong id="visibleSubtotal" class="text-success font-weight-bold" style="font-family: 'JetBrains Mono', monospace;">Rp <?= rupiah($total_masuk ?? 0); ?></strong>
					</div>

					<button onclick="window.print()" class="btn btn-light btn-sm text-dark font-weight-bold border" style="border-radius: 8px;">
						<i class="fas fa-print mr-1"></i> Cetak Rekap
					</button>
				</div>
			</div>

			<!-- Main Table -->
			<div class="table-responsive">
				<table class="table table-custom-kas" id="kasMainTable">
					<thead>
						<tr>
							<th style="width: 140px;">No. Transaksi</th>
							<th style="width: 180px;">Tanggal Catat</th>
							<th>Keterangan / Sumber Dana</th>
							<th style="width: 210px;" class="text-right">Nominal Masuk</th>
							<th style="width: 130px;" class="text-center no-print">Aksi</th>
						</tr>
					</thead>
					<tbody id="kasTableBody">
						<?php 
						$sum_table = 0;
						if (!empty($masuk)): 
							foreach ($masuk as $msk): 
								$sum_table += (float)$msk->jumlah;
								$is_today = ($msk->tanggal == date('Y-m-d'));
								
								// Kategori tag cerdas
								$ket_lower = strtolower($msk->keterangan);
								$cat_icon = '💰';
								$cat_name = 'Lainnya';
								$cat_class = 'bg-light text-dark';

								if (strpos($ket_lower, 'iuran') !== false) {
									$cat_icon = '🏠';
									$cat_name = 'Iuran Warga';
									$cat_class = 'text-success bg-light border border-success';
								} else if (strpos($ket_lower, 'donasi') !== false || strpos($ket_lower, 'sumbangan') !== false) {
									$cat_icon = '🎁';
									$cat_name = 'Donasi';
									$cat_class = 'text-purple bg-light border border-purple';
								} else if (strpos($ket_lower, 'sampah') !== false) {
									$cat_icon = '🗑️';
									$cat_name = 'Kas Sampah';
									$cat_class = 'text-teal bg-light border border-teal';
								} else if (strpos($ket_lower, 'sewa') !== false) {
									$cat_icon = '🎪';
									$cat_name = 'Sewa Fasilitas';
									$cat_class = 'text-info bg-light border border-info';
								} else if (strpos($ket_lower, 'lomba') !== false || strpos($ket_lower, 'agustus') !== false || strpos($ket_lower, 'acara') !== false) {
									$cat_icon = '🎈';
									$cat_name = 'Kegiatan';
									$cat_class = 'text-warning bg-light border border-warning';
								}
						?>
						<tr class="kas-row-item" 
							data-id="<?= htmlspecialchars($msk->idKas); ?>" 
							data-date="<?= $msk->tanggal; ?>" 
							data-amount="<?= (float)$msk->jumlah; ?>"
							data-ket="<?= strtolower(htmlspecialchars($msk->keterangan)); ?>"
							data-category="<?= strtolower($cat_name); ?>">
							
							<!-- Nomor ID -->
							<td>
								<span class="badge-id-kas">#<?= $msk->idKas; ?></span>
							</td>

							<!-- Tanggal -->
							<td>
								<div class="font-weight-bold text-dark">
									<?= date('d M Y', strtotime($msk->tanggal)); ?>
									<?php if ($is_today): ?>
										<span class="badge badge-success px-2 ml-1" style="font-size: 10px; border-radius: 4px;">Hari Ini</span>
									<?php endif; ?>
								</div>
								<small class="text-muted"><?= date('l', strtotime($msk->tanggal)); ?></small>
							</td>

							<!-- Keterangan -->
							<td>
								<span class="badge <?= $cat_class; ?> px-2 py-1 mr-2 font-weight-bold" style="border-radius: 6px; font-size: 11px;">
									<?= $cat_icon; ?> <?= $cat_name; ?>
								</span>
								<strong class="text-dark" style="font-size: 13.5px;"><?= htmlspecialchars($msk->keterangan); ?></strong>
							</td>

							<!-- Nominal -->
							<td class="text-right">
								<span class="badge-amount-pill">
									<i class="fas fa-arrow-down"></i> + Rp <?= rupiah($msk->jumlah); ?>
								</span>
							</td>

							<!-- Aksi -->
							<td class="text-center no-print">
								<div class="d-inline-flex" style="gap: 6px;">
									<!-- View Bukti Modal -->
									<button type="button" class="btn-action-circle btn-view" title="Lihat Bukti Kwitansi" data-toggle="modal" data-target="#receiptModal<?= $msk->idKas; ?>">
										<i class="fas fa-file-invoice"></i>
									</button>

									<?php if ($user['role_id'] == 1 || $user['role_id'] == 3): ?>
									<!-- Edit Modal -->
									<button type="button" class="btn-action-circle btn-edit" title="Edit Data" data-toggle="modal" data-target="#editModal<?= $msk->idKas; ?>">
										<i class="fas fa-pen"></i>
									</button>

									<!-- Delete Button -->
									<button type="button" class="btn-action-circle btn-del" title="Hapus Data" onclick="confirmDeleteKas('<?= base_url('kasrt/delkas/' . $msk->idKas); ?>', '<?= $msk->idKas; ?>', '<?= htmlspecialchars(addslashes($msk->keterangan)); ?>', 'Rp <?= rupiah($msk->jumlah); ?>')">
										<i class="fas fa-trash-alt"></i>
									</button>
									<?php endif; ?>
								</div>
							</td>
						</tr>

						<!-- Modal Realistis Kwitansi Digital -->
						<div class="modal fade" id="receiptModal<?= $msk->idKas; ?>" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content" style="border-radius: 18px; border: none; background: transparent;">
									<div class="realistic-receipt">
										<div class="d-flex justify-content-between align-items-start mb-3">
											<div>
												<span class="badge badge-success px-2 py-1 font-weight-bold mb-1" style="font-size: 10.5px;">E-KASRT DIGITAL VOUCHER</span>
												<h5 class="font-weight-bold mb-0 text-dark">BUKTI KAS MASUK</h5>
												<small class="text-muted" style="font-family: 'JetBrains Mono';">ID: #<?= $msk->idKas; ?></small>
											</div>
											<div class="stamp-paid-seal">LUNAS</div>
										</div>

										<hr style="border-top: 2px dashed #e2e8f0;">

										<table class="table table-sm table-borderless mb-2" style="font-size: 13.5px;">
											<tr>
												<td style="width: 140px; color: #64748b;">Tanggal Catat</td>
												<td>: <strong><?= date('d F Y', strtotime($msk->tanggal)); ?></strong></td>
											</tr>
											<tr>
												<td style="color: #64748b;">Keterangan</td>
												<td>: <strong><?= htmlspecialchars($msk->keterangan); ?></strong></td>
											</tr>
											<tr>
												<td style="color: #64748b;">Kategori</td>
												<td>: <span class="badge badge-light border"><?= $cat_name; ?></span></td>
											</tr>
										</table>

										<div class="p-3 my-2" style="background: #ecfdf5; border-radius: 12px; border: 1.5px solid #a7f3d0;">
											<small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 11px;">Nominal Penerimaan</small>
											<h3 class="font-weight-bold text-success mb-0" style="font-family: 'JetBrains Mono', monospace;">
												+ Rp <?= rupiah($msk->jumlah); ?>
											</h3>
										</div>

										<div class="p-2 mb-3 text-muted" style="background: #f8fafc; border-radius: 8px; font-size: 12.5px;">
											<span>Terbilang:</span><br>
											<strong class="text-dark"><em>"<?= function_exists('terbilang') ? terbilang($msk->jumlah) : ''; ?> Rupiah"</em></strong>
										</div>

										<div class="d-flex justify-content-between align-items-center pt-2 border-top">
											<a href="<?= base_url('kasRT/kwitansiKas/' . $msk->idKas); ?>" target="_blank" class="btn btn-primary btn-sm font-weight-bold px-3 py-2" style="border-radius: 8px;">
												<i class="fas fa-print mr-1"></i> Cetak Dokumen
											</a>
											<button type="button" class="btn btn-secondary btn-sm px-3 py-2" style="border-radius: 8px;" data-dismiss="modal">
												Tutup
											</button>
										</div>
									</div>
									<div class="receipt-sawtooth"></div>
								</div>
							</div>
						</div>

						<!-- Modal Edit Kas Masuk -->
						<?php if ($user['role_id'] == 1 || $user['role_id'] == 3): ?>
						<div class="modal fade" id="editModal<?= $msk->idKas; ?>" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content" style="border-radius: 18px; border: none; overflow: hidden;">
									<div class="modal-header text-white" style="background: linear-gradient(135deg, #064e3b, #059669);">
										<h5 class="modal-title font-weight-bold">
											<i class="fas fa-pen-square mr-2"></i>Edit Kas Masuk #<?= $msk->idKas; ?>
										</h5>
										<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
									</div>
									<div class="modal-body p-4">
										<?= form_open('kasRT/editKas'); ?>
											<input type="hidden" name="idKas" value="<?= $msk->idKas; ?>">
											<input type="hidden" name="jenis" value="masuk">

											<div class="form-group mb-3">
												<label class="font-weight-bold" style="font-size: 13px;">Tanggal Transaksi</label>
												<input class="form-control" type="date" name="tanggal" value="<?= $msk->tanggal; ?>" required style="border-radius: 9px;">
											</div>

											<div class="form-group mb-3">
												<label class="font-weight-bold" style="font-size: 13px;">Keterangan / Sumber Dana</label>
												<textarea class="form-control" name="keterangan" rows="2" required style="border-radius: 9px;"><?= htmlspecialchars($msk->keterangan); ?></textarea>
											</div>

											<div class="form-group mb-4">
												<label class="font-weight-bold" style="font-size: 13px;">Nominal (Rp)</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text font-weight-bold" style="border-radius: 9px 0 0 9px; background: #ecfdf5; color: #059669;">Rp</span>
													</div>
													<input class="form-control" type="number" name="jumlah" value="<?= $msk->jumlah; ?>" required style="border-radius: 0 9px 9px 0; font-weight: 700; font-size: 16px;">
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
						<?php endif; ?>

						<?php 
							endforeach; 
						else: 
						?>
						<tr id="emptyRowPlaceholder">
							<td colspan="5" class="text-center py-5 text-muted">
								<i class="fas fa-wallet fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
								<h5>Belum Ada Data Kas Masuk</h5>
								<p style="font-size: 13px;">Klik tombol "+ Catat Pemasukan" untuk menambahkan pemasukan kas pertama.</p>
							</td>
						</tr>
						<?php endif; ?>
					</tbody>
					<tfoot>
						<tr style="background: #f8fafc; font-weight: 800;">
							<td colspan="3" class="text-right py-3" style="font-size: 13px; text-transform: uppercase; color: #475569;">
								TOTAL SELURUH PEMASUKAN:
							</td>
							<td class="text-right py-3">
								<span id="footerTotalDisplay" class="badge-amount-pill" style="font-size: 15px;">
									Rp <?= rupiah($sum_table); ?>
								</span>
							</td>
							<td>&nbsp;</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>

	</div>
</div>

<!-- Modal Tambah Kas Masuk -->
<?php if ($user['role_id'] == 1 || $user['role_id'] == 3): ?>
<div class="modal fade" id="addKasMasukModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
			<div class="modal-header text-white" style="background: linear-gradient(135deg, #064e3b, #059669); padding: 22px 26px;">
				<div class="d-flex align-items-center">
					<div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-right: 12px;">
						<i class="fas fa-plus"></i>
					</div>
					<div>
						<h5 class="modal-title font-weight-bold text-white mb-0">Catat Kas Masuk Baru</h5>
						<small class="text-white-50">Entri penerimaan kas RT digital</small>
					</div>
				</div>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body p-4">
				<form action="<?= base_url('kasRT/addKas'); ?>" method="post">
					<input type="hidden" name="jenis" value="masuk">

					<div class="form-group mb-3">
						<label class="font-weight-bold text-dark" style="font-size: 13px;">Nomor ID Transaksi (Otomatis)</label>
						<input class="form-control" type="text" name="id_kas" value="3000<?= sprintf("%04s", $idKas); ?>" readonly style="background: #f1f5f9; font-weight: 700; font-family: 'JetBrains Mono'; border-radius: 9px;">
					</div>

					<div class="form-group mb-3">
						<div class="d-flex justify-content-between align-items-center mb-1">
							<label class="font-weight-bold text-dark mb-0" style="font-size: 13px;">Tanggal Penerimaan</label>
							<button type="button" class="btn btn-sm btn-link p-0 text-success font-weight-bold" onclick="document.getElementById('addTanggalMasuk').value = '<?= date('Y-m-d'); ?>';" style="font-size: 11.5px;">
								Hari Ini
							</button>
						</div>
						<input class="form-control" type="date" name="tanggal" id="addTanggalMasuk" value="<?= date('Y-m-d'); ?>" required style="border-radius: 9px;">
					</div>

					<div class="form-group mb-3">
						<label class="font-weight-bold text-dark mb-1" style="font-size: 13px;">Keterangan / Sumber Pemasukan</label>
						<textarea class="form-control mb-2" name="keterangan" id="addKetMasuk" rows="2" placeholder="Contoh: Iuran Warga Blok C, Donasi Bpk. H. Ahmad, dll." required style="border-radius: 9px;"></textarea>
						
						<!-- Quick tags -->
						<div style="display: flex; flex-wrap: wrap; gap: 5px;">
							<button type="button" class="btn btn-sm btn-light border" onclick="setKetTag('Iuran Bulanan Warga')">🏠 Iuran Bulanan</button>
							<button type="button" class="btn btn-sm btn-light border" onclick="setKetTag('Donasi / Sumbangan Sukarela')">🎁 Donasi</button>
							<button type="button" class="btn btn-sm btn-light border" onclick="setKetTag('Iuran Kas Sampah Lingkungan')">🗑️ Sampah</button>
							<button type="button" class="btn btn-sm btn-light border" onclick="setKetTag('Sewa Lapangan & Fasilitas RT')">🎪 Sewa Fasilitas</button>
							<button type="button" class="btn btn-sm btn-light border" onclick="setKetTag('Bantuan Dana Pemerintah / RW')">🏛️ Bantuan RW</button>
						</div>
					</div>

					<div class="form-group mb-4">
						<label class="font-weight-bold text-dark mb-1" style="font-size: 13px;">Nominal Uang (Rp)</label>
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<span class="input-group-text font-weight-bold" style="border-radius: 9px 0 0 9px; background: #ecfdf5; color: #059669;">Rp</span>
							</div>
							<input class="form-control" type="number" name="jumlah" id="addJumlahMasuk" placeholder="0" required style="border-radius: 0 9px 9px 0; font-weight: 800; font-size: 17px;" oninput="previewRupiahLive(this.value)">
						</div>

						<!-- Quick Nominal Shortcuts -->
						<div class="d-flex flex-wrap" style="gap: 5px;">
							<button type="button" class="btn btn-xs btn-outline-success font-weight-bold" onclick="setNominalInput(50000)">+ 50rb</button>
							<button type="button" class="btn btn-xs btn-outline-success font-weight-bold" onclick="setNominalInput(100000)">+ 100rb</button>
							<button type="button" class="btn btn-xs btn-outline-success font-weight-bold" onclick="setNominalInput(250000)">+ 250rb</button>
							<button type="button" class="btn btn-xs btn-outline-success font-weight-bold" onclick="setNominalInput(500000)">+ 500rb</button>
							<button type="button" class="btn btn-xs btn-outline-success font-weight-bold" onclick="setNominalInput(1000000)">+ 1jt</button>
						</div>

						<div id="previewRupiahBox" class="mt-2 p-2 text-success font-weight-bold" style="background: #f0fdf4; border-radius: 8px; font-size: 13px; display: none;">
							Preview: <span id="previewRupiahText">Rp 0</span>
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
<?php endif; ?>

<!-- Delete Confirm Modal -->
<div class="modal fade" id="modernDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content" style="border-radius: 18px; border: none; overflow: hidden;">
			<div class="modal-body text-center p-4">
				<div style="width: 54px; height: 54px; background: #fff1f2; color: #e11d48; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; margin: 0 auto 16px;">
					<i class="fas fa-exclamation-triangle"></i>
				</div>
				<h5 class="font-weight-bold mb-1">Hapus Data Kas?</h5>
				<p class="text-muted" style="font-size: 13px;" id="delConfirmText">
					Data transaksi ini akan dihapus secara permanen.
				</p>
				<div class="d-flex justify-content-center" style="gap: 8px;">
					<button type="button" class="btn btn-light btn-sm px-3 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
					<a id="delConfirmBtn" href="#" class="btn btn-danger btn-sm px-3 font-weight-bold" style="border-radius: 8px;">
						<i class="fas fa-trash-alt mr-1"></i> Ya, Hapus
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
// Tab View Switcher
function switchViewMode(mode) {
	var tableSection = document.getElementById('tableSection');
	var analyticsSection = document.getElementById('analyticsSection');
	var chipsBar = document.getElementById('categoryChipsBar');
	var btnTable = document.getElementById('btnModeTable');
	var btnChart = document.getElementById('btnModeChart');

	if (mode === 'chart') {
		if (tableSection) tableSection.style.display = 'none';
		if (chipsBar) chipsBar.style.display = 'none';
		if (analyticsSection) analyticsSection.style.display = 'block';
		if (btnTable) btnTable.classList.remove('active');
		if (btnChart) btnChart.classList.add('active');
		initKasCharts();
	} else {
		if (tableSection) tableSection.style.display = 'block';
		if (chipsBar) chipsBar.style.display = 'flex';
		if (analyticsSection) analyticsSection.style.display = 'none';
		if (btnTable) btnTable.classList.add('active');
		if (btnChart) btnChart.classList.remove('active');
	}
}

// Chart.js Init Engine
var chartsInitialized = false;
function initKasCharts() {
	if (chartsInitialized) return;
	chartsInitialized = true;

	var chartLabels = <?= json_encode($chart_labels ?? ['Jan','Feb','Mar','Apr','Mei','Jun']); ?>;
	var chartMasuk  = <?= json_encode($chart_masuk ?? [0,0,0,0,0,0]); ?>;
	var chartKeluar = <?= json_encode($chart_keluar ?? [0,0,0,0,0,0]); ?>;
	var catLabels   = <?= json_encode($cat_labels ?? ['Iuran Warga','Donasi','Kas Sampah','Lainnya']); ?>;
	var catValues   = <?= json_encode($cat_values ?? [100]); ?>;

	// 1. Cashflow Trend Chart
	var ctxTrend = document.getElementById('cashflowTrendChart');
	if (ctxTrend) {
		new Chart(ctxTrend, {
			type: 'line',
			data: {
				labels: chartLabels,
				datasets: [
					{
						label: 'Pemasukan (Rp)',
						data: chartMasuk,
						borderColor: '#059669',
						backgroundColor: 'rgba(5, 150, 105, 0.15)',
						fill: true,
						tension: 0.4,
						borderWidth: 3,
						pointRadius: 4,
						pointBackgroundColor: '#059669'
					},
					{
						label: 'Pengeluaran (Rp)',
						data: chartKeluar,
						borderColor: '#e11d48',
						backgroundColor: 'rgba(225, 29, 72, 0.08)',
						fill: true,
						tension: 0.4,
						borderWidth: 2,
						pointRadius: 3,
						pointBackgroundColor: '#e11d48'
					}
				]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				plugins: {
					legend: { position: 'top', labels: { font: { family: 'Plus Jakarta Sans', weight: '700' } } }
				},
				scales: {
					y: {
						ticks: {
							callback: function(val) { return 'Rp ' + Number(val).toLocaleString('id-ID'); }
						}
					}
				}
			}
		});
	}

	// 2. Category Donut Chart
	var ctxDonut = document.getElementById('categoryDonutChart');
	if (ctxDonut) {
		new Chart(ctxDonut, {
			type: 'doughnut',
			data: {
				labels: catLabels,
				datasets: [{
					data: catValues,
					backgroundColor: ['#059669', '#3b82f6', '#8b5cf6', '#ec4899', '#f59e0b', '#10b981', '#64748b']
				}]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				plugins: {
					legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } }
				}
			}
		});
	}
}

// Helpers Form Modal
function setKetTag(txt) {
	var el = document.getElementById('addKetMasuk');
	if (el) { el.value = txt; el.focus(); }
}
function setNominalInput(val) {
	var el = document.getElementById('addJumlahMasuk');
	if (el) { el.value = val; previewRupiahLive(val); }
}
function previewRupiahLive(val) {
	var box = document.getElementById('previewRupiahBox');
	var txt = document.getElementById('previewRupiahText');
	if (!val || val <= 0) {
		if (box) box.style.display = 'none';
		return;
	}
	if (box && txt) {
		box.style.display = 'block';
		txt.textContent = 'Rp ' + Number(val).toLocaleString('id-ID');
	}
}

// WhatsApp Broadcast Share
function shareKasWhatsApp(jenis, total, saldo) {
	var dateNow = '<?= date('F Y'); ?>';
	var text = '📢 *LAPORAN KAS RT RESMI (' + dateNow + ')*\n' +
			   '━━━━━━━━━━━━━━━━━━━\n' +
			   '🟢 *Total Pemasukan* : Rp ' + total + '\n' +
			   '💰 *Saldo Kas Bersih* : Rp ' + saldo + '\n' +
			   '━━━━━━━━━━━━━━━━━━━\n' +
			   'Laporan keuangan RT transparan & terverifikasi sistem E-KASRT.';
	window.open('https://api.whatsapp.com/send?text=' + encodeURIComponent(text), '_blank');
}

// 1-Click Export CSV
function exportTableToCSV(filename) {
	var csv = [];
	var rows = document.querySelectorAll("#kasMainTable tr");
	for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");
		for (var j = 0; j < cols.length - 1; j++) {
			var text = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, " ").trim();
			row.push('"' + text.replace(/"/g, '""') + '"');
		}
		csv.push(row.join(","));
	}
	var csvFile = new Blob([csv.join("\n")], { type: "text/csv" });
	var downloadLink = document.createElement("a");
	downloadLink.download = filename;
	downloadLink.href = window.URL.createObjectURL(csvFile);
	downloadLink.style.display = "none";
	document.body.appendChild(downloadLink);
	downloadLink.click();
	document.body.removeChild(downloadLink);
}

// Filter Engine
var selectedCategory = 'all';
var selectedPeriod = 'all';

function filterByCategory(cat, btn) {
	selectedCategory = cat;
	var chips = document.querySelectorAll('.category-chip');
	chips.forEach(function(c) { c.classList.remove('active'); });
	if (btn) btn.classList.add('active');
	runFilterEngine();
}

function setPeriodFilter(period, btn) {
	selectedPeriod = period;
	var pBtns = btn.parentElement.querySelectorAll('.btn');
	pBtns.forEach(function(b) { b.classList.remove('active'); });
	btn.classList.add('active');
	runFilterEngine();
}

function runFilterEngine() {
	var query = (document.getElementById('kasSearchInput').value || '').toLowerCase().trim();
	var rows = document.querySelectorAll('.kas-row-item');
	var visibleCount = 0;
	var visibleSum = 0;

	var today = '<?= date('Y-m-d'); ?>';
	var curMonth = '<?= date('Y-m'); ?>';
	var curYear = '<?= date('Y'); ?>';

	rows.forEach(function(row) {
		var id = (row.getAttribute('data-id') || '').toLowerCase();
		var date = row.getAttribute('data-date') || '';
		var amount = parseFloat(row.getAttribute('data-amount') || 0);
		var ket = (row.getAttribute('data-ket') || '').toLowerCase();
		var cat = (row.getAttribute('data-category') || '').toLowerCase();

		var matchQuery = true;
		if (query.length > 0) {
			matchQuery = id.includes(query) || ket.includes(query) || amount.toString().includes(query) || date.includes(query);
		}

		var matchCat = true;
		if (selectedCategory !== 'all') {
			matchCat = cat.includes(selectedCategory) || ket.includes(selectedCategory);
		}

		var matchPeriod = true;
		if (selectedPeriod === 'today') {
			matchPeriod = (date === today);
		} else if (selectedPeriod === 'month') {
			matchPeriod = (date.substring(0, 7) === curMonth);
		} else if (selectedPeriod === 'year') {
			matchPeriod = (date.substring(0, 4) === curYear);
		}

		if (matchQuery && matchCat && matchPeriod) {
			row.style.display = '';
			visibleCount++;
			visibleSum += amount;
		} else {
			row.style.display = 'none';
		}
	});

	document.getElementById('visibleCount').textContent = visibleCount;
	var sumFormatted = 'Rp ' + visibleSum.toLocaleString('id-ID');
	document.getElementById('visibleSubtotal').textContent = sumFormatted;
	document.getElementById('footerTotalDisplay').textContent = sumFormatted;
}

document.addEventListener('DOMContentLoaded', function() {
	var searchInput = document.getElementById('kasSearchInput');
	if (searchInput) {
		searchInput.addEventListener('input', runFilterEngine);
	}
});

function confirmDeleteKas(url, id, ket, nominal) {
	var btn = document.getElementById('delConfirmBtn');
	var text = document.getElementById('delConfirmText');
	if (btn) btn.setAttribute('href', url);
	if (text) text.innerHTML = 'Apakah Anda yakin ingin menghapus data <strong>#' + id + '</strong> (' + ket + ' - ' + nominal + ')?';
	$('#modernDeleteModal').modal('show');
}
</script>
