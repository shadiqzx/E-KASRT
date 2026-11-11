<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

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
	background: #f8fafc;
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
	color: #dc2626;
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
.kpi-accent-rose { background: linear-gradient(90deg, #dc2626, #f87171); }
.kpi-accent-orange { background: linear-gradient(90deg, #ea580c, #fb923c); }
.kpi-accent-blue { background: linear-gradient(90deg, #2563eb, #60a5fa); }
.kpi-accent-indigo { background: linear-gradient(90deg, #4f46e5, #818cf8); }

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
	background: #dc2626;
	color: #ffffff;
	border-color: #dc2626;
	box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
}

/* AI Financial Assistant Insight Card */
.ai-insight-card--keluar {
	background: linear-gradient(135deg, #fff1f2 0%, #fff5f5 50%, #fff7ed 100%);
	border: 1.5px solid #fecdd3;
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
.badge-amount-pill--keluar {
	font-family: 'JetBrains Mono', monospace;
	font-size: 14px;
	font-weight: 800;
	color: #be123c;
	background: #fff1f2;
	border: 1px solid #fecdd3;
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
.stamp-paid-seal--keluar {
	border: 3px double #dc2626;
	color: #dc2626;
	font-weight: 900;
	font-size: 13px;
	letter-spacing: 2px;
	padding: 5px 12px;
	border-radius: 8px;
	transform: rotate(-7deg);
	display: inline-block;
}

@media print {
	.no-print, .menu-sidebar, .header-desktop, .sidebar-overlay, .kas-hero-mesh--keluar, .fintech-kpi-grid, .view-mode-tabs, .category-chips-bar, .ai-insight-card--keluar, .btn-action-circle {
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
						Pencatatan belanja operasional, perbaikan jalan, lampu PJU, kebersihan, keamanan, dan kegiatan sosial RT.
					</p>
				</div>

				<div class="d-flex flex-wrap align-items-center" style="gap: 12px;">
					<!-- Quick Switcher -->
					<div class="kas-nav-switcher">
						<a href="<?= base_url('kasRT'); ?>">
							<i class="fas fa-arrow-down text-success"></i> Pemasukan
						</a>
						<a href="<?= base_url('kasRT/kasKeluar'); ?>" class="active">
							<i class="fas fa-arrow-up text-danger"></i> Pengeluaran
						</a>
						<a href="<?= base_url('kasRT/transfer'); ?>">
							<i class="fas fa-exchange-alt text-primary"></i> Transfer
						</a>
					</div>

					<!-- Broadcast WA Button -->
					<button onclick="shareKasKeluarWhatsApp('<?= rupiah($total_keluar ?? 0); ?>', '<?= rupiah($saldo_kas ?? 0); ?>')" class="btn btn-success font-weight-bold px-3 py-2 text-white shadow-sm" style="border-radius: 12px; font-size: 13.5px; background: #25D366; border: none;">
						<i class="fab fa-whatsapp mr-1 font-size-16"></i> Broadcast WA
					</button>

					<!-- Add Button -->
					<?php if ($user['role_id'] == 1 || $user['role_id'] == 3): ?>
					<button class="btn btn-light font-weight-bold px-4 py-2 text-danger shadow" data-toggle="modal" data-target="#addKasKeluarModal" style="border-radius: 12px; font-size: 14px;">
						<i class="fas fa-plus-circle mr-1"></i> + Catat Pengeluaran
					</button>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<!-- 4 Fintech KPI Cards -->
		<div class="fintech-kpi-grid">
			<!-- Total Pengeluaran -->
			<div class="fintech-kpi-card">
				<div class="kpi-accent-bar kpi-accent-rose"></div>
				<div class="d-flex justify-content-between align-items-center">
					<div class="kpi-icon-bubble" style="background: #fff1f2; color: #dc2626;">
						<i class="fas fa-hand-holding-usd"></i>
					</div>
					<span class="badge badge-danger px-2 py-1 font-weight-bold" style="font-size: 11px; border-radius: 6px;">
						AKUMULASI
					</span>
				</div>
				<small class="text-muted font-weight-bold text-uppercase d-block mb-1" style="font-size: 11px;">Total Pengeluaran</small>
				<div class="kpi-val text-danger">Rp <?= rupiah($total_keluar ?? 0); ?></div>
				<p class="kpi-sub"><i class="fas fa-receipt text-danger"></i> Seluruh biaya belanja tercatat</p>
			</div>

			<!-- Pengeluaran Bulan Ini -->
			<div class="fintech-kpi-card">
				<div class="kpi-accent-bar kpi-accent-orange"></div>
				<div class="d-flex justify-content-between align-items-center">
					<div class="kpi-icon-bubble" style="background: #fff7ed; color: #ea580c;">
						<i class="fas fa-calendar-minus"></i>
					</div>
					<span class="badge badge-warning px-2 py-1 font-weight-bold text-dark" style="font-size: 11px; border-radius: 6px;">
						<?= strtoupper(date('M Y')); ?>
					</span>
				</div>
				<small class="text-muted font-weight-bold text-uppercase d-block mb-1" style="font-size: 11px;">Belanja Bulan Ini</small>
				<div class="kpi-val" style="color: #ea580c;">Rp <?= rupiah($keluar_bulan_ini ?? 0); ?></div>
				<p class="kpi-sub"><strong><?= $count_bulan_ini ?? 0; ?></strong> transaksi belanja di bulan ini</p>
			</div>

			<!-- Sisa Saldo Kas RT -->
			<div class="fintech-kpi-card">
				<div class="kpi-accent-bar kpi-accent-blue"></div>
				<div class="d-flex justify-content-between align-items-center">
					<div class="kpi-icon-bubble" style="background: #eff6ff; color: #2563eb;">
						<i class="fas fa-wallet"></i>
					</div>
					<span class="badge <?= ($saldo_kas ?? 0) >= 0 ? 'badge-primary' : 'badge-danger'; ?> px-2 py-1 font-weight-bold" style="font-size: 11px; border-radius: 6px;">
						<?= ($saldo_kas ?? 0) >= 0 ? 'DANA AMAN' : 'DEFISIT'; ?>
					</span>
				</div>
				<small class="text-muted font-weight-bold text-uppercase d-block mb-1" style="font-size: 11px;">Sisa Saldo Kas RT</small>
				<div class="kpi-val <?= ($saldo_kas ?? 0) >= 0 ? 'text-primary' : 'text-danger'; ?>">
					Rp <?= rupiah($saldo_kas ?? 0); ?>
				</div>
				<p class="kpi-sub"><i class="fas fa-shield-alt text-primary"></i> Saldo tersedia di kas RT</p>
			</div>

			<!-- Rata-rata per Belanja -->
			<div class="fintech-kpi-card">
				<div class="kpi-accent-bar kpi-accent-indigo"></div>
				<div class="d-flex justify-content-between align-items-center">
					<div class="kpi-icon-bubble" style="background: #eef2ff; color: #4f46e5;">
						<i class="fas fa-file-invoice-dollar"></i>
					</div>
					<span class="badge badge-light border px-2 py-1 font-weight-bold" style="font-size: 11px; border-radius: 6px;">
						RATA-RATA
					</span>
				</div>
				<small class="text-muted font-weight-bold text-uppercase d-block mb-1" style="font-size: 11px;">Rata-Rata per Belanja</small>
				<div class="kpi-val" style="color: #4f46e5;">Rp <?= rupiah($rata_rata ?? 0); ?></div>
				<p class="kpi-sub">Total <strong><?= $count_total ?? count($keluar); ?></strong> data belanja tercatat</p>
			</div>
		</div>

		<!-- AI Financial Assistant Insight Card -->
		<div class="ai-insight-card--keluar">
			<div class="d-flex align-items-center">
				<div style="width: 48px; height: 48px; border-radius: 12px; background: #ffe4e6; color: #e11d48; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-right: 16px; flex-shrink: 0;">
					📊
				</div>
				<div>
					<h6 class="font-weight-bold mb-1 text-dark" style="font-size: 14.5px;">Monitoring Efisiensi Pengeluaran RT</h6>
					<p class="mb-0 text-muted" style="font-size: 13px;">
						Realisasi pengeluaran bulan ini tercatat <strong>Rp <?= rupiah($keluar_bulan_ini ?? 0); ?></strong>. 
						Total akumulasi pengeluaran sebanding dengan sisa saldo kas yang surplus sebesar <strong>Rp <?= rupiah($saldo_kas ?? 0); ?></strong>.
					</p>
				</div>
			</div>
			<div class="text-right">
				<button onclick="exportTableToCSV('laporan_pengeluaran_rt.csv')" class="btn btn-outline-danger btn-sm font-weight-bold px-3 py-2" style="border-radius: 8px;">
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
				<i class="fas fa-info-circle mr-1 text-danger"></i> Data pengeluaran diaudit secara berkala oleh pengurus
			</div>
		</div>

		<!-- Visual Analytics Section (Tab 2) -->
		<div id="analyticsSection" class="analytics-section-card" style="display: none;">
			<div class="row">
				<!-- Area Chart 6 Bulan -->
				<div class="col-lg-8 mb-4 mb-lg-0">
					<div class="d-flex justify-content-between align-items-center mb-3">
						<h6 class="font-weight-bold text-dark mb-0">
							<i class="fas fa-chart-area text-danger mr-1"></i> Tren Pengeluaran & Pemasukan 6 Bulan
						</h6>
						<small class="text-muted">Perbandingan Arus Kas Bulanan</small>
					</div>
					<div style="height: 280px; position: relative;">
						<canvas id="cashflowTrendChart"></canvas>
					</div>
				</div>

				<!-- Donut Chart Distribusi Kategori -->
				<div class="col-lg-4">
					<div class="d-flex justify-content-between align-items-center mb-3">
						<h6 class="font-weight-bold text-dark mb-0">
							<i class="fas fa-chart-pie text-danger mr-1"></i> Distribusi Kategori Belanja
						</h6>
						<small class="text-muted">Porsi Pengeluaran</small>
					</div>
					<div style="height: 240px; position: relative;">
						<canvas id="categoryDonutChart"></canvas>
					</div>
					<div class="text-center mt-2">
						<small class="text-muted font-weight-bold" style="font-size: 11px;">Kategori rutin: Perbaikan & Kebersihan</small>
					</div>
				</div>
			</div>
		</div>

		<!-- Category Filter Chips -->
		<div class="category-chips-bar" id="categoryChipsBar">
			<button type="button" class="category-chip active" onclick="filterByCategory('all', this)">
				🌟 Semua Belanja
			</button>
			<button type="button" class="category-chip" onclick="filterByCategory('perbaikan', this)">
				💡 Perbaikan Fasilitas & Lampu
			</button>
			<button type="button" class="category-chip" onclick="filterByCategory('kebersihan', this)">
				🧹 Kebersihan & Sampah
			</button>
			<button type="button" class="category-chip" onclick="filterByCategory('keamanan', this)">
				👮 Keamanan / Hansip
			</button>
			<button type="button" class="category-chip" onclick="filterByCategory('atk', this)">
				📄 ATK & Surat
			</button>
			<button type="button" class="category-chip" onclick="filterByCategory('konsumsi', this)">
				☕ Konsumsi Kerja Bakti
			</button>
			<button type="button" class="category-chip" onclick="filterByCategory('sosial', this)">
				🏥 Santunan & Sosial
			</button>
			<button type="button" class="category-chip" onclick="filterByCategory('kegiatan', this)">
				🎈 Acara Warga
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
						<input type="text" id="kasSearchInput" class="form-control form-control-sm" placeholder="Ketik keterangan belanja, no. ID, atau nominal..." style="padding-left: 38px; border-radius: 10px; border: 1.5px solid #e2e8f0; font-size: 13px;">
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
						Tampil <strong id="visibleCount" class="text-dark"><?= count($keluar); ?></strong> data &bull; 
						Subtotal: <strong id="visibleSubtotal" class="text-danger font-weight-bold" style="font-family: 'JetBrains Mono', monospace;">Rp <?= rupiah($total_keluar ?? 0); ?></strong>
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
							<th>Keterangan / Keperluan Belanja</th>
							<th style="width: 210px;" class="text-right">Nominal Belanja</th>
							<th style="width: 130px;" class="text-center no-print">Aksi</th>
						</tr>
					</thead>
					<tbody id="kasTableBody">
						<?php 
						$sum_table = 0;
						if (!empty($keluar)): 
							foreach ($keluar as $kel): 
								$sum_table += (float)$kel->jumlah;
								$is_today = ($kel->tanggal == date('Y-m-d'));
								
								// Kategori tag cerdas
								$ket_lower = strtolower($kel->keterangan);
								$cat_icon = '🛒';
								$cat_name = 'Operasional';
								$cat_class = 'bg-light text-dark';

								if (strpos($ket_lower, 'lampu') !== false || strpos($ket_lower, 'pju') !== false || strpos($ket_lower, 'jalan') !== false || strpos($ket_lower, 'perbaikan') !== false) {
									$cat_icon = '💡';
									$cat_name = 'Perbaikan';
									$cat_class = 'text-warning bg-light border border-warning';
								} else if (strpos($ket_lower, 'sampah') !== false || strpos($ket_lower, 'bersih') !== false) {
									$cat_icon = '🧹';
									$cat_name = 'Kebersihan';
									$cat_class = 'text-info bg-light border border-info';
								} else if (strpos($ket_lower, 'hansip') !== false || strpos($ket_lower, 'aman') !== false || strpos($ket_lower, 'ronda') !== false) {
									$cat_icon = '👮';
									$cat_name = 'Keamanan';
									$cat_class = 'text-primary bg-light border border-primary';
								} else if (strpos($ket_lower, 'atk') !== false || strpos($ket_lower, 'printer') !== false || strpos($ket_lower, 'kertas') !== false) {
									$cat_icon = '📄';
									$cat_name = 'ATK';
									$cat_class = 'text-secondary bg-light border';
								} else if (strpos($ket_lower, 'konsumsi') !== false || strpos($ket_lower, 'makan') !== false || strpos($ket_lower, 'snack') !== false) {
									$cat_icon = '☕';
									$cat_name = 'Konsumsi';
									$cat_class = 'text-orange bg-light border border-orange';
								} else if (strpos($ket_lower, 'santunan') !== false || strpos($ket_lower, 'duka') !== false || strpos($ket_lower, 'sosial') !== false) {
									$cat_icon = '🏥';
									$cat_name = 'Sosial';
									$cat_class = 'text-danger bg-light border border-danger';
								} else if (strpos($ket_lower, 'lomba') !== false || strpos($ket_lower, 'agustus') !== false) {
									$cat_icon = '🎈';
									$cat_name = 'Kegiatan';
									$cat_class = 'text-purple bg-light border border-purple';
								}
						?>
						<tr class="kas-row-item" 
							data-id="<?= htmlspecialchars($kel->idKas); ?>" 
							data-date="<?= $kel->tanggal; ?>" 
							data-amount="<?= (float)$kel->jumlah; ?>"
							data-ket="<?= strtolower(htmlspecialchars($kel->keterangan)); ?>"
							data-category="<?= strtolower($cat_name); ?>">
							
							<!-- Nomor ID -->
							<td>
								<span class="badge-id-kas">#<?= $kel->idKas; ?></span>
							</td>

							<!-- Tanggal -->
							<td>
								<div class="font-weight-bold text-dark">
									<?= date('d M Y', strtotime($kel->tanggal)); ?>
									<?php if ($is_today): ?>
										<span class="badge badge-danger px-2 ml-1" style="font-size: 10px; border-radius: 4px;">Hari Ini</span>
									<?php endif; ?>
								</div>
								<small class="text-muted"><?= date('l', strtotime($kel->tanggal)); ?></small>
							</td>

							<!-- Keterangan -->
							<td>
								<span class="badge <?= $cat_class; ?> px-2 py-1 mr-2 font-weight-bold" style="border-radius: 6px; font-size: 11px;">
									<?= $cat_icon; ?> <?= $cat_name; ?>
								</span>
								<strong class="text-dark" style="font-size: 13.5px;"><?= htmlspecialchars($kel->keterangan); ?></strong>
							</td>

							<!-- Nominal -->
							<td class="text-right">
								<span class="badge-amount-pill--keluar">
									<i class="fas fa-arrow-up"></i> - Rp <?= rupiah($kel->jumlah); ?>
								</span>
							</td>

							<!-- Aksi -->
							<td class="text-center no-print">
								<div class="d-inline-flex" style="gap: 6px;">
									<!-- View Bukti Modal -->
									<button type="button" class="btn-action-circle btn-view" title="Lihat Bukti Kwitansi" data-toggle="modal" data-target="#receiptModal<?= $kel->idKas; ?>">
										<i class="fas fa-file-invoice"></i>
									</button>

									<?php if ($user['role_id'] == 1 || $user['role_id'] == 3): ?>
									<!-- Edit Modal -->
									<button type="button" class="btn-action-circle btn-edit" title="Edit Data" data-toggle="modal" data-target="#editModal<?= $kel->idKas; ?>">
										<i class="fas fa-pen"></i>
									</button>

									<!-- Delete Button: FIXED FULL URL -->
									<button type="button" class="btn-action-circle btn-del" title="Hapus Data" onclick="confirmDeleteKas('<?= base_url('kasrt/delkas/' . $kel->idKas); ?>', '<?= $kel->idKas; ?>', '<?= htmlspecialchars(addslashes($kel->keterangan)); ?>', 'Rp <?= rupiah($kel->jumlah); ?>')">
										<i class="fas fa-trash-alt"></i>
									</button>
									<?php endif; ?>
								</div>
							</td>
						</tr>

						<!-- Modal Realistis Kwitansi Digital Kas Keluar -->
						<div class="modal fade" id="receiptModal<?= $kel->idKas; ?>" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content" style="border-radius: 18px; border: none; background: transparent;">
									<div class="realistic-receipt">
										<div class="d-flex justify-content-between align-items-start mb-3">
											<div>
												<span class="badge badge-danger px-2 py-1 font-weight-bold mb-1" style="font-size: 10.5px;">E-KASRT DIGITAL VOUCHER</span>
												<h5 class="font-weight-bold mb-0 text-dark">BUKTI PENGELUARAN KAS</h5>
												<small class="text-muted" style="font-family: 'JetBrains Mono';">ID: #<?= $kel->idKas; ?></small>
											</div>
											<div class="stamp-paid-seal--keluar">TERBAYAR</div>
										</div>

										<hr style="border-top: 2px dashed #e2e8f0;">

										<table class="table table-sm table-borderless mb-2" style="font-size: 13.5px;">
											<tr>
												<td style="width: 140px; color: #64748b;">Tanggal Catat</td>
												<td>: <strong><?= date('d F Y', strtotime($kel->tanggal)); ?></strong></td>
											</tr>
											<tr>
												<td style="color: #64748b;">Keperluan</td>
												<td>: <strong><?= htmlspecialchars($kel->keterangan); ?></strong></td>
											</tr>
											<tr>
												<td style="color: #64748b;">Kategori</td>
												<td>: <span class="badge badge-light border"><?= $cat_name; ?></span></td>
											</tr>
										</table>

										<div class="p-3 my-2" style="background: #fff1f2; border-radius: 12px; border: 1.5px solid #fecdd3;">
											<small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 11px;">Nominal Pengeluaran</small>
											<h3 class="font-weight-bold text-danger mb-0" style="font-family: 'JetBrains Mono', monospace;">
												- Rp <?= rupiah($kel->jumlah); ?>
											</h3>
										</div>

										<div class="p-2 mb-3 text-muted" style="background: #f8fafc; border-radius: 8px; font-size: 12.5px;">
											<span>Terbilang:</span><br>
											<strong class="text-dark"><em>"<?= function_exists('terbilang') ? terbilang($kel->jumlah) : ''; ?> Rupiah"</em></strong>
										</div>

										<div class="d-flex justify-content-between align-items-center pt-2 border-top">
											<a href="<?= base_url('kasRT/kwitansiKas/' . $kel->idKas); ?>" target="_blank" class="btn btn-danger btn-sm font-weight-bold px-3 py-2" style="border-radius: 8px;">
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

						<!-- Modal Edit Kas Keluar -->
						<?php if ($user['role_id'] == 1 || $user['role_id'] == 3): ?>
						<div class="modal fade" id="editModal<?= $kel->idKas; ?>" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content" style="border-radius: 18px; border: none; overflow: hidden;">
									<div class="modal-header text-white" style="background: linear-gradient(135deg, #7f1d1d, #dc2626);">
										<h5 class="modal-title font-weight-bold">
											<i class="fas fa-pen-square mr-2"></i>Edit Kas Keluar #<?= $kel->idKas; ?>
										</h5>
										<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
									</div>
									<div class="modal-body p-4">
										<?= form_open('kasRT/editKas'); ?>
											<input type="hidden" name="idKas" value="<?= $kel->idKas; ?>">
											<input type="hidden" name="jenis" value="keluar">

											<div class="form-group mb-3">
												<label class="font-weight-bold" style="font-size: 13px;">Tanggal Transaksi</label>
												<input class="form-control" type="date" name="tanggal" value="<?= $kel->tanggal; ?>" required style="border-radius: 9px;">
											</div>

											<div class="form-group mb-3">
												<label class="font-weight-bold" style="font-size: 13px;">Keterangan / Keperluan Belanja</label>
												<textarea class="form-control" name="keterangan" rows="2" required style="border-radius: 9px;"><?= htmlspecialchars($kel->keterangan); ?></textarea>
											</div>

											<div class="form-group mb-4">
												<label class="font-weight-bold" style="font-size: 13px;">Nominal (Rp)</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text font-weight-bold" style="border-radius: 9px 0 0 9px; background: #fff1f2; color: #dc2626;">Rp</span>
													</div>
													<input class="form-control" type="number" name="jumlah" value="<?= $kel->jumlah; ?>" required style="border-radius: 0 9px 9px 0; font-weight: 700; font-size: 16px;">
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
						<?php endif; ?>

						<?php 
							endforeach; 
						else: 
						?>
						<tr id="emptyRowPlaceholder">
							<td colspan="5" class="text-center py-5 text-muted">
								<i class="fas fa-hand-holding-usd fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
								<h5>Belum Ada Data Kas Keluar</h5>
								<p style="font-size: 13px;">Klik tombol "+ Catat Pengeluaran" untuk menambahkan belanja RT pertama.</p>
							</td>
						</tr>
						<?php endif; ?>
					</tbody>
					<tfoot>
						<tr style="background: #f8fafc; font-weight: 800;">
							<td colspan="3" class="text-right py-3" style="font-size: 13px; text-transform: uppercase; color: #475569;">
								TOTAL SELURUH PENGELUARAN:
							</td>
							<td class="text-right py-3">
								<span id="footerTotalDisplay" class="badge-amount-pill--keluar" style="font-size: 15px;">
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

<!-- Modal Tambah Kas Keluar -->
<?php if ($user['role_id'] == 1 || $user['role_id'] == 3): ?>
<div class="modal fade" id="addKasKeluarModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
			<div class="modal-header text-white" style="background: linear-gradient(135deg, #7f1d1d, #dc2626); padding: 22px 26px;">
				<div class="d-flex align-items-center">
					<div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-right: 12px;">
						<i class="fas fa-plus"></i>
					</div>
					<div>
						<h5 class="modal-title font-weight-bold text-white mb-0">Catat Pengeluaran Kas Baru</h5>
						<small class="text-white-50">Entri belanja operasional & kegiatan RT</small>
					</div>
				</div>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body p-4">
				<form action="<?= base_url('kasRT/addKas'); ?>" method="post">
					<input type="hidden" name="jenis" value="keluar">

					<div class="form-group mb-3">
						<label class="font-weight-bold text-dark" style="font-size: 13px;">Nomor ID Transaksi (Otomatis)</label>
						<input class="form-control" type="text" name="id_kas" value="3000<?= sprintf("%04s", $idKas); ?>" readonly style="background: #f1f5f9; font-weight: 700; font-family: 'JetBrains Mono'; border-radius: 9px;">
					</div>

					<div class="form-group mb-3">
						<div class="d-flex justify-content-between align-items-center mb-1">
							<label class="font-weight-bold text-dark mb-0" style="font-size: 13px;">Tanggal Belanja</label>
							<button type="button" class="btn btn-sm btn-link p-0 text-danger font-weight-bold" onclick="document.getElementById('addTanggalKeluar').value = '<?= date('Y-m-d'); ?>';" style="font-size: 11.5px;">
								Hari Ini
							</button>
						</div>
						<input class="form-control" type="date" name="tanggal" id="addTanggalKeluar" value="<?= date('Y-m-d'); ?>" required style="border-radius: 9px;">
					</div>

					<div class="form-group mb-3">
						<label class="font-weight-bold text-dark mb-1" style="font-size: 13px;">Keterangan / Keperluan Belanja</label>
						<textarea class="form-control mb-2" name="keterangan" id="addKetKeluar" rows="2" placeholder="Contoh: Beli Lampu PJU Blok C, Honor Petugas Kebersihan, Pembelian ATK, dll." required style="border-radius: 9px;"></textarea>
						
						<!-- Quick tags -->
						<div style="display: flex; flex-wrap: wrap; gap: 5px;">
							<button type="button" class="btn btn-sm btn-light border" onclick="setKetTagKeluar('Perbaikan Lampu Jalan & PJU')">💡 Lampu Jalan</button>
							<button type="button" class="btn btn-sm btn-light border" onclick="setKetTagKeluar('Petugas Kebersihan & Angkut Sampah')">🧹 Kebersihan</button>
							<button type="button" class="btn btn-sm btn-light border" onclick="setKetTagKeluar('Honor Keamanan / Hansip Ronda')">👮 Honor Hansip</button>
							<button type="button" class="btn btn-sm btn-light border" onclick="setKetTagKeluar('Pembelian ATK & Kertas Stempel')">📄 ATK RT</button>
							<button type="button" class="btn btn-sm btn-light border" onclick="setKetTagKeluar('Konsumsi Kerja Bakti Lingkungan')">☕ Kerja Bakti</button>
							<button type="button" class="btn btn-sm btn-light border" onclick="setKetTagKeluar('Santunan Warga Sakit / Duka')">🏥 Santunan Warga</button>
						</div>
					</div>

					<div class="form-group mb-4">
						<label class="font-weight-bold text-dark mb-1" style="font-size: 13px;">Nominal Uang (Rp)</label>
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<span class="input-group-text font-weight-bold" style="border-radius: 9px 0 0 9px; background: #fff1f2; color: #dc2626;">Rp</span>
							</div>
							<input class="form-control" type="number" name="jumlah" id="addJumlahKeluar" placeholder="0" required style="border-radius: 0 9px 9px 0; font-weight: 800; font-size: 17px;" oninput="previewRupiahLiveKeluar(this.value)">
						</div>

						<!-- Quick Nominal Shortcuts -->
						<div class="d-flex flex-wrap" style="gap: 5px;">
							<button type="button" class="btn btn-xs btn-outline-danger font-weight-bold" onclick="setNominalInputKeluar(50000)">+ 50rb</button>
							<button type="button" class="btn btn-xs btn-outline-danger font-weight-bold" onclick="setNominalInputKeluar(100000)">+ 100rb</button>
							<button type="button" class="btn btn-xs btn-outline-danger font-weight-bold" onclick="setNominalInputKeluar(250000)">+ 250rb</button>
							<button type="button" class="btn btn-xs btn-outline-danger font-weight-bold" onclick="setNominalInputKeluar(500000)">+ 500rb</button>
							<button type="button" class="btn btn-xs btn-outline-danger font-weight-bold" onclick="setNominalInputKeluar(1000000)">+ 1jt</button>
						</div>

						<div id="previewRupiahBoxKeluar" class="mt-2 p-2 text-danger font-weight-bold" style="background: #fff1f2; border-radius: 8px; font-size: 13px; display: none;">
							Preview: <span id="previewRupiahTextKeluar">Rp 0</span>
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
	var catLabels   = <?= json_encode($cat_labels ?? ['Perbaikan','Kebersihan','Keamanan','Operasional','Lainnya']); ?>;
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
						label: 'Pengeluaran (Rp)',
						data: chartKeluar,
						borderColor: '#dc2626',
						backgroundColor: 'rgba(220, 38, 38, 0.15)',
						fill: true,
						tension: 0.4,
						borderWidth: 3,
						pointRadius: 4,
						pointBackgroundColor: '#dc2626'
					},
					{
						label: 'Pemasukan (Rp)',
						data: chartMasuk,
						borderColor: '#059669',
						backgroundColor: 'rgba(5, 150, 105, 0.08)',
						fill: true,
						tension: 0.4,
						borderWidth: 2,
						pointRadius: 3,
						pointBackgroundColor: '#059669'
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
					backgroundColor: ['#dc2626', '#ea580c', '#3b82f6', '#8b5cf6', '#ec4899', '#f59e0b', '#64748b']
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
function setKetTagKeluar(txt) {
	var el = document.getElementById('addKetKeluar');
	if (el) { el.value = txt; el.focus(); }
}
function setNominalInputKeluar(val) {
	var el = document.getElementById('addJumlahKeluar');
	if (el) { el.value = val; previewRupiahLiveKeluar(val); }
}
function previewRupiahLiveKeluar(val) {
	var box = document.getElementById('previewRupiahBoxKeluar');
	var txt = document.getElementById('previewRupiahTextKeluar');
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
function shareKasKeluarWhatsApp(total, saldo) {
	var dateNow = '<?= date('F Y'); ?>';
	var text = '📢 *LAPORAN PENGELUARAN KAS RT (' + dateNow + ')*\n' +
			   '━━━━━━━━━━━━━━━━━━━\n' +
			   '🔴 *Total Belanja Kas* : Rp ' + total + '\n' +
			   '💰 *Sisa Saldo Kas RT* : Rp ' + saldo + '\n' +
			   '━━━━━━━━━━━━━━━━━━━\n' +
			   'Rincian belanja transparan untuk warga RT. Diterbitkan via E-KASRT.';
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
	if (text) text.innerHTML = 'Apakah Anda yakin ingin menghapus data belanja <strong>#' + id + '</strong> (' + ket + ' - ' + nominal + ')?';
	$('#modernDeleteModal').modal('show');
}
</script>
