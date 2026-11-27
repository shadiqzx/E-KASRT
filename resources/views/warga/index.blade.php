@extends('layouts.app')

@section('title', 'Data Warga & Peta Rumah 3D')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap');

.warga-page-wrapper {
	font-family: 'Plus Jakarta Sans', sans-serif;
	color: #0f172a;
	padding-bottom: 60px;
}
.warga-hero-mesh {
	background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4338ca 80%, #0284c7 100%);
	border-radius: 24px;
	padding: 30px 34px;
	color: #ffffff;
	box-shadow: 0 20px 40px -15px rgba(67, 56, 202, 0.45);
	position: relative;
	overflow: hidden;
	margin-bottom: 22px;
	border: 1px solid rgba(255, 255, 255, 0.14);
}
.hero-glass-pill--purple {
	background: rgba(255, 255, 255, 0.15);
	backdrop-filter: blur(12px);
	border: 1px solid rgba(255, 255, 255, 0.25);
	color: #e0e7ff;
	font-size: 11.5px;
	font-weight: 800;
	letter-spacing: 0.8px;
	padding: 5px 14px;
	border-radius: 30px;
	display: inline-flex;
	align-items: center;
	gap: 6px;
	margin-bottom: 10px;
	text-transform: uppercase;
}
.warga-kpi-grid {
	display: grid;
	grid-template-columns: repeat(4, minmax(0, 1fr));
	gap: 16px;
	margin-bottom: 22px;
}
.warga-kpi-card {
	background: #ffffff;
	border: 1px solid rgba(226, 232, 240, 0.9);
	border-radius: 18px;
	padding: 18px 20px;
	box-shadow: 0 6px 20px -6px rgba(15, 23, 42, 0.06);
	display: flex;
	align-items: center;
	gap: 14px;
	transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.warga-kpi-card:hover {
	transform: translateY(-2px);
	box-shadow: 0 12px 26px -8px rgba(15, 23, 42, 0.1);
}
.warga-kpi-icon {
	width: 46px;
	height: 46px;
	border-radius: 14px;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 19px;
	flex-shrink: 0;
}
.warga-kpi-val {
	font-size: 24px;
	font-weight: 800;
	line-height: 1.1;
	color: #0f172a;
	font-family: 'JetBrains Mono', monospace;
}
.warga-kpi-lbl {
	font-size: 12px;
	font-weight: 700;
	color: #64748b;
	margin-top: 2px;
}
.warga-mode-bar {
	background: #ffffff;
	border: 1px solid rgba(226, 232, 240, 0.9);
	border-radius: 18px;
	padding: 14px 18px;
	margin-bottom: 20px;
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	justify-content: space-between;
	gap: 12px;
	box-shadow: 0 6px 20px -6px rgba(15, 23, 42, 0.05);
}
.mode-pill-group {
	display: inline-flex;
	background: #f1f5f9;
	padding: 4px;
	border-radius: 12px;
	gap: 4px;
	flex-wrap: wrap;
}
.mode-pill-btn {
	border: none;
	background: transparent;
	color: #475569;
	font-size: 13px;
	font-weight: 700;
	padding: 8px 14px;
	border-radius: 9px;
	cursor: pointer;
	transition: all 0.2s ease;
	display: inline-flex;
	align-items: center;
	gap: 7px;
}
.mode-pill-btn.active {
	background: linear-gradient(135deg, #4338ca, #0284c7);
	color: #ffffff;
	box-shadow: 0 4px 12px rgba(67, 56, 202, 0.3);
}
.blok-filter-group {
	display: inline-flex;
	flex-wrap: wrap;
	gap: 6px;
	align-items: center;
}
.blok-chip-btn {
	border: 1px solid #cbd5e1;
	background: #ffffff;
	color: #475569;
	font-size: 12px;
	font-weight: 700;
	padding: 5px 12px;
	border-radius: 999px;
	cursor: pointer;
	transition: all 0.18s ease;
}
.blok-chip-btn.active {
	background: #1e293b;
	color: #ffffff;
	border-color: #1e293b;
}
.blok-chip-btn.multi-active {
	background: #f59e0b;
	color: #ffffff;
	border-color: #d97706;
}
/* Rumah Cards Grid */
.rumah-grid {
	display: grid;
	grid-template-columns: repeat(2, minmax(0, 1fr));
	gap: 18px;
}
.rumah-card {
	background: #ffffff;
	border-radius: 20px;
	border: 1px solid rgba(226, 232, 240, 0.95);
	box-shadow: 0 8px 24px -6px rgba(15, 23, 42, 0.06);
	overflow: hidden;
	display: flex;
	flex-direction: column;
	transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.rumah-card:hover {
	transform: translateY(-2px);
	box-shadow: 0 14px 32px -8px rgba(15, 23, 42, 0.1);
}
.rumah-card.is-multi-kk {
	border-color: rgba(245, 158, 11, 0.55);
}
.rumah-card-head {
	padding: 16px 20px;
	background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 100%);
	border-bottom: 1px solid #e2e8f0;
	display: flex;
	align-items: flex-start;
	justify-content: space-between;
	gap: 12px;
}
.rumah-card.is-multi-kk .rumah-card-head {
	background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
	border-bottom-color: #fde68a;
}
.rumah-code-badge {
	font-family: 'JetBrains Mono', monospace;
	font-size: 13px;
	font-weight: 800;
	padding: 6px 12px;
	border-radius: 10px;
	background: #1e1b4b;
	color: #ffffff;
	display: inline-flex;
	align-items: center;
	gap: 6px;
}
.rumah-card.is-multi-kk .rumah-code-badge {
	background: #b45309;
}
.kk-block {
	margin: 12px 16px 0 16px;
	border: 1px solid #e2e8f0;
	border-radius: 14px;
	overflow: hidden;
	background: #f8fafc;
}
.kk-block:last-child {
	margin-bottom: 16px;
}
.kk-block-head {
	padding: 9px 14px;
	background: #eef2ff;
	border-bottom: 1px solid #e0e7ff;
	display: flex;
	align-items: center;
	justify-content: space-between;
	gap: 8px;
	font-size: 12px;
	font-weight: 800;
	color: #3730a3;
}
.kk-member-row {
	padding: 10px 14px;
	background: #ffffff;
	border-top: 1px solid #f1f5f9;
	display: flex;
	align-items: center;
	justify-content: space-between;
	gap: 10px;
}
.kk-member-row:first-child {
	border-top: none;
}

/* 3D Mini-Map Game Studio */
.map3d-shell {
	display: grid;
	grid-template-columns: 1.65fr 1fr;
	gap: 18px;
	align-items: stretch;
}
.map3d-viewport-card {
	position: relative;
	border-radius: 22px;
	overflow: hidden;
	background: radial-gradient(circle at 50% 35%, #0f172a 0%, #020617 100%);
	border: 1px solid rgba(56, 189, 248, 0.3);
	box-shadow: 0 22px 44px -12px rgba(2, 6, 23, 0.55);
	min-height: 540px;
}
#warga3dCanvas {
	width: 100%;
	height: 540px;
	display: block;
	cursor: grab;
	touch-action: none;
}
#warga3dCanvas:active {
	cursor: grabbing;
}
.map3d-hud-top {
	position: absolute;
	top: 14px;
	left: 14px;
	right: 14px;
	display: flex;
	align-items: center;
	justify-content: space-between;
	flex-wrap: wrap;
	gap: 8px;
	pointer-events: none;
	z-index: 5;
}
.map3d-hud-pill {
	pointer-events: auto;
	background: rgba(15, 23, 42, 0.82);
	backdrop-filter: blur(12px);
	border: 1px solid rgba(56, 189, 248, 0.35);
	color: #e0f2fe;
	border-radius: 999px;
	padding: 6px 13px;
	font-size: 11.5px;
	font-weight: 700;
	display: inline-flex;
	align-items: center;
	gap: 7px;
}
.map3d-controls {
	pointer-events: auto;
	display: inline-flex;
	gap: 6px;
	flex-wrap: wrap;
}
.map3d-btn {
	background: rgba(15, 23, 42, 0.85);
	backdrop-filter: blur(10px);
	border: 1px solid rgba(148, 163, 184, 0.35);
	color: #f8fafc;
	border-radius: 10px;
	padding: 6px 11px;
	font-size: 11.5px;
	font-weight: 700;
	cursor: pointer;
	transition: all 0.18s ease;
}
.map3d-btn:hover,
.map3d-btn.active {
	background: #0284c7;
	border-color: #38bdf8;
	color: #ffffff;
}
.map3d-legend {
	position: absolute;
	bottom: 14px;
	left: 14px;
	background: rgba(15, 23, 42, 0.84);
	backdrop-filter: blur(12px);
	border: 1px solid rgba(148, 163, 184, 0.25);
	border-radius: 14px;
	padding: 9px 13px;
	display: flex;
	flex-wrap: wrap;
	gap: 12px;
	font-size: 11px;
	font-weight: 700;
	color: #cbd5e1;
	z-index: 5;
}
.legend-dot {
	width: 10px;
	height: 10px;
	border-radius: 3px;
	display: inline-block;
	margin-right: 5px;
}
.map3d-inspector {
	background: #ffffff;
	border-radius: 22px;
	border: 1px solid rgba(226, 232, 240, 0.95);
	box-shadow: 0 12px 30px -8px rgba(15, 23, 42, 0.08);
	padding: 20px;
	display: flex;
	flex-direction: column;
	max-height: 540px;
	overflow-y: auto;
}
.table-container-card {
	background: #ffffff;
	border-radius: 20px;
	border: 1px solid rgba(226, 232, 240, 0.85);
	box-shadow: 0 8px 26px -4px rgba(15, 23, 42, 0.05);
	overflow: hidden;
}
.table-custom-warga {
	width: 100%;
	border-collapse: separate;
	border-spacing: 0;
}
.table-custom-warga thead th {
	background: #f8fafc;
	color: #475569;
	font-size: 11px;
	font-weight: 800;
	text-transform: uppercase;
	letter-spacing: 0.7px;
	padding: 14px 18px;
	border-top: none;
	border-bottom: 1.5px solid #e2e8f0;
}
.table-custom-warga tbody td {
	padding: 14px 18px;
	vertical-align: middle;
	border-top: 1px solid #f1f5f9;
	font-size: 13.5px;
}
.badge-nik {
	font-family: 'JetBrains Mono', monospace;
	font-size: 12px;
	font-weight: 700;
	background: #f1f5f9;
	color: #1e293b;
	padding: 4px 9px;
	border-radius: 8px;
	border: 1px solid #e2e8f0;
}
.btn-action-circle {
	width: 32px;
	height: 32px;
	border-radius: 9px;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	font-size: 12.5px;
	border: 1px solid transparent;
	transition: all 0.2s;
	background: #f8fafc;
	color: #475569;
	cursor: pointer;
}
.btn-action-circle.btn-edit {
	background: #e0e7ff;
	color: #4338ca;
	border-color: #c7d2fe;
}
.btn-action-circle.btn-del {
	background: #fff1f2;
	color: #e11d48;
	border-color: #ffe4e6;
}

/* Dark Mode Compatibility */
body.dark-exec .warga-page-wrapper { color: #e2e8f0; }
body.dark-exec .warga-kpi-card,
body.dark-exec .warga-mode-bar,
body.dark-exec .rumah-card,
body.dark-exec .map3d-inspector,
body.dark-exec .table-container-card {
	background: #0f172a;
	border-color: rgba(148, 163, 184, 0.2);
	color: #f1f5f9;
}
body.dark-exec .warga-kpi-val { color: #f8fafc; }
body.dark-exec .rumah-card-head { background: #1e293b; border-bottom-color: rgba(148, 163, 184, 0.2); }
body.dark-exec .rumah-card.is-multi-kk .rumah-card-head { background: rgba(180, 83, 9, 0.22); border-bottom-color: rgba(245, 158, 11, 0.35); }
body.dark-exec .kk-block { background: #1e293b; border-color: rgba(148, 163, 184, 0.2); }
body.dark-exec .kk-block-head { background: rgba(67, 56, 202, 0.25); border-bottom-color: rgba(99, 102, 241, 0.3); color: #c7d2fe; }
body.dark-exec .kk-member-row { background: #0f172a; border-top-color: rgba(148, 163, 184, 0.12); }
body.dark-exec .mode-pill-group { background: #1e293b; }
body.dark-exec .mode-pill-btn { color: #cbd5e1; }
body.dark-exec .blok-chip-btn { background: #1e293b; border-color: rgba(148, 163, 184, 0.25); color: #cbd5e1; }
body.dark-exec .table-custom-warga thead th { background: #1e293b; color: #cbd5e1; border-bottom-color: rgba(148, 163, 184, 0.2); }
body.dark-exec .table-custom-warga tbody td { border-top-color: rgba(148, 163, 184, 0.12); }
body.dark-exec .badge-nik { background: #1e293b; color: #e2e8f0; border-color: rgba(148, 163, 184, 0.25); }

@media (max-width: 1100px) {
	.warga-kpi-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
	.rumah-grid { grid-template-columns: 1fr; }
	.map3d-shell { grid-template-columns: 1fr; }
	.map3d-inspector { max-height: none; }
}
@media (max-width: 600px) {
	.warga-kpi-grid { grid-template-columns: 1fr; }
	.warga-hero-mesh { padding: 22px 18px; }
}
</style>

<div class="warga-page-wrapper">
	<!-- Hero Mesh Gradient Header -->
	<div class="warga-hero-mesh">
		<div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 20px;">
			<div>
				<div class="hero-glass-pill--purple">
					<i class="fas fa-home mr-1"></i> SMART RT KEPENDUDUKAN &amp; PETA 3D
				</div>
				<h1 class="font-weight-bold text-white mb-2" style="font-size: 27px; letter-spacing: -0.6px;">
					Data Warga, Kartu Keluarga &amp; Mini-Map Rumah 3D
				</h1>
				<p class="mb-0 text-white-50" style="font-size: 13.5px; max-width: 640px;">
					Pantau penghuni berdasarkan rumah dan alamat, lihat berapa KK di setiap rumah, serta jelajahi denah rumah RT dalam mode 3D Mini-Map interaktif.
				</p>
			</div>

			<div class="d-flex flex-wrap align-items-center" style="gap: 10px;">
				<button type="button" class="btn btn-outline-light font-weight-bold px-3 py-2" onclick="switchWargaMode('map3d')" style="border-radius: 12px; font-size: 13.5px;">
					<i class="fas fa-cube mr-1"></i> Buka Peta Rumah 3D
				</button>
				<button class="btn btn-light font-weight-bold px-4 py-2 text-primary shadow" data-toggle="modal" data-target="#addWargaModal" style="border-radius: 12px; font-size: 13.5px;">
					<i class="fas fa-user-plus mr-1"></i> Tambah Data Warga
				</button>
			</div>
		</div>
	</div>

	<!-- 4 KPI Summary Cards -->
	<div class="warga-kpi-grid">
		<div class="warga-kpi-card">
			<div class="warga-kpi-icon" style="background: rgba(99, 102, 241, 0.14); color: #4f46e5;">
				<i class="fas fa-users"></i>
			</div>
			<div>
				<div class="warga-kpi-val">{{ $totalWarga }}</div>
				<div class="warga-kpi-lbl">Total Warga Terdata (Jiwa)</div>
			</div>
		</div>
		<div class="warga-kpi-card">
			<div class="warga-kpi-icon" style="background: rgba(14, 165, 233, 0.14); color: #0284c7;">
				<i class="fas fa-home"></i>
			</div>
			<div>
				<div class="warga-kpi-val">{{ $totalRumah }}</div>
				<div class="warga-kpi-lbl">Total Rumah Terdata (Unit)</div>
			</div>
		</div>
		<div class="warga-kpi-card">
			<div class="warga-kpi-icon" style="background: rgba(16, 185, 129, 0.14); color: #059669;">
				<i class="fas fa-id-card"></i>
			</div>
			<div>
				<div class="warga-kpi-val">{{ $totalKk }}</div>
				<div class="warga-kpi-lbl">Total Kepala Keluarga (KK)</div>
			</div>
		</div>
		<div class="warga-kpi-card">
			<div class="warga-kpi-icon" style="background: rgba(245, 158, 11, 0.16); color: #d97706;">
				<i class="fas fa-layer-group"></i>
			</div>
			<div>
				<div class="warga-kpi-val">{{ $rumahMultiKk }}</div>
				<div class="warga-kpi-lbl">Rumah Multi-KK (&gt;1 KK)</div>
			</div>
		</div>
	</div>

	<!-- Mode Switcher & Search / Filter Bar -->
	<div class="warga-mode-bar">
		<div class="mode-pill-group">
			<button type="button" class="mode-pill-btn active" id="tabBtnRumah" onclick="switchWargaMode('rumah')">
				<i class="fas fa-house-user"></i> Per Rumah &amp; KK ({{ $totalRumah }})
			</button>
			<button type="button" class="mode-pill-btn" id="tabBtnMap3d" onclick="switchWargaMode('map3d')">
				<i class="fas fa-cube"></i> Mini-Map 3D RT
			</button>
			<button type="button" class="mode-pill-btn" id="tabBtnTabel" onclick="switchWargaMode('tabel')">
				<i class="fas fa-list"></i> Tabel Individu ({{ $totalWarga }})
			</button>
		</div>

		<div class="d-flex flex-wrap align-items-center" style="gap: 10px; flex: 1; justify-content: flex-end;">
			<div class="blok-filter-group" id="blokFilterGroup">
				<button type="button" class="blok-chip-btn active" data-blok="ALL" onclick="setBlokFilter('ALL', this)">Semua</button>
				<button type="button" class="blok-chip-btn" data-blok="A" onclick="setBlokFilter('A', this)">Blok A</button>
				<button type="button" class="blok-chip-btn" data-blok="B" onclick="setBlokFilter('B', this)">Blok B</button>
				<button type="button" class="blok-chip-btn" data-blok="C" onclick="setBlokFilter('C', this)">Blok C</button>
				<button type="button" class="blok-chip-btn" data-blok="D" onclick="setBlokFilter('D', this)">Blok D</button>
				<button type="button" class="blok-chip-btn" id="btnOnlyMultiKk" onclick="toggleMultiKkFilter(this)">Multi-KK (2+)</button>
			</div>

			<div style="position: relative; min-width: 240px;">
				<i class="fas fa-search" style="position: absolute; left: 13px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 13px;"></i>
				<input type="text" id="wargaSearchInput" class="form-control form-control-sm" placeholder="Cari rumah, alamat, nama, NIK, KK..." style="padding-left: 35px; border-radius: 10px; border: 1.5px solid #e2e8f0; font-size: 13px; height: 36px;" onkeyup="applyWargaFilters()">
			</div>
		</div>
	</div>

	<!-- PANEL 1: TAMPILAN PER RUMAH & KK -->
	<div id="panelRumahView">
		<div class="rumah-grid" id="rumahGridContainer">
			@forelse($rumahGroups as $rumah)
			<div class="rumah-card {{ $rumah['total_kk'] > 1 ? 'is-multi-kk' : '' }}"
				 data-blok="{{ $rumah['blok'] }}"
				 data-kk="{{ $rumah['total_kk'] }}"
				 data-search="{{ strtolower($rumah['kode_rumah'] . ' ' . $rumah['alamat'] . ' ' . collect($rumah['kk_groups'])->pluck('no_kk')->implode(' ') . ' ' . collect($rumah['kk_groups'])->flatMap(fn($k) => $k['anggota'])->pluck('nama')->implode(' ') . ' ' . collect($rumah['kk_groups'])->flatMap(fn($k) => $k['anggota'])->pluck('nik')->implode(' ')) }}">
				<div class="rumah-card-head">
					<div>
						<div class="d-flex align-items-center flex-wrap" style="gap: 8px; margin-bottom: 6px;">
							<span class="rumah-code-badge">
								<i class="fas fa-home"></i> Rumah {{ $rumah['kode_rumah'] }}
							</span>
							<span class="badge {{ $rumah['total_kk'] > 1 ? 'badge-warning text-dark' : 'badge-primary' }} px-2 py-1" style="border-radius: 8px; font-weight: 800;">
								{{ $rumah['total_kk'] }} KK
							</span>
							<span class="badge badge-info px-2 py-1" style="border-radius: 8px; font-weight: 700;">
								{{ $rumah['total_jiwa'] }} Jiwa
							</span>
						</div>
						<div style="font-size: 13px; font-weight: 600; opacity: 0.88;">
							<i class="fas fa-map-marker-alt text-danger mr-1"></i> {{ $rumah['alamat'] }}
						</div>
					</div>
					<button type="button" class="btn btn-sm btn-outline-primary font-weight-bold" onclick="focusHouseOn3D('{{ $rumah['key'] }}')" style="border-radius: 10px; white-space: nowrap;">
						<i class="fas fa-cube mr-1"></i> Map 3D
					</button>
				</div>

				<div>
					@foreach($rumah['kk_groups'] as $kkIdx => $kk)
					<div class="kk-block">
						<div class="kk-block-head">
							<span>
								<i class="fas fa-id-card mr-1"></i> KK #{{ $kkIdx + 1 }}: <span style="font-family: 'JetBrains Mono', monospace;">{{ $kk['no_kk'] }}</span>
							</span>
							<span class="badge badge-light border text-dark">{{ count($kk['anggota']) }} Anggota</span>
						</div>
						<div>
							@foreach($kk['anggota'] as $member)
							<div class="kk-member-row">
								<div style="min-width: 0;">
									<div class="d-flex align-items-center flex-wrap" style="gap: 6px;">
										<strong style="font-size: 13.5px;">{{ $member->nama }}</strong>
										@if(!empty($member->hubungan_keluarga))
											<span class="badge {{ stripos($member->hubungan_keluarga, 'kepala') !== false ? 'badge-success' : 'badge-secondary' }}" style="font-size: 10px;">
												{{ $member->hubungan_keluarga }}
											</span>
										@endif
										@if(!empty($member->rfid_ktp))
											<span class="badge badge-info" style="font-size: 10px; font-family: 'JetBrains Mono';">
												<i class="fas fa-wifi mr-1"></i>{{ $member->rfid_ktp }}
											</span>
										@endif
									</div>
									<div style="font-size: 11.5px; opacity: 0.72; font-family: 'JetBrains Mono', monospace;">
										NIK: {{ $member->nik }} &bull; {{ $member->jekel }}
									</div>
								</div>
								<div class="d-inline-flex" style="gap: 5px; flex-shrink: 0;">
									<button type="button" class="btn-action-circle btn-edit" title="Edit Data Warga" data-toggle="modal" data-target="#editWargaModal{{ $member->idWarga }}">
										<i class="fas fa-pen"></i>
									</button>
									<a href="{{ route('warga.destroy', $member->idWarga) }}" class="btn-action-circle btn-del" title="Hapus Data Warga" onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')">
										<i class="fas fa-trash-alt"></i>
									</a>
								</div>
							</div>
							@endforeach
						</div>
					</div>
					@endforeach
				</div>
			</div>
			@empty
			<div class="col-12 text-center py-5 text-muted">
				<i class="fas fa-home fa-3x mb-3" style="opacity: 0.3;"></i>
				<h5>Belum Ada Data Rumah &amp; Warga</h5>
			</div>
			@endforelse
		</div>
	</div>

	<!-- PANEL 2: MINI-MAP 3D KAWASAN RT (ALA GAME) -->
	<div id="panelMap3dView" style="display: none;">
		<div class="map3d-shell">
			<div class="map3d-viewport-card">
				<div class="map3d-hud-top">
					<div class="map3d-hud-pill">
						<span style="width: 8px; height: 8px; border-radius: 50%; background: #34d399; display: inline-block;"></span>
						<span>MINI-MAP 3D KAWASAN RT ({{ $totalRumah }} RUMAH &bull; {{ $totalKk }} KK)</span>
					</div>
					<div class="map3d-controls">
						<button type="button" class="map3d-btn active" id="btnCamIso" onclick="window.WargaMap3D && WargaMap3D.setView('iso', this)">Isometric 3D</button>
						<button type="button" class="map3d-btn" id="btnCamTop" onclick="window.WargaMap3D && WargaMap3D.setView('top', this)">Top-Down Map</button>
						<button type="button" class="map3d-btn" onclick="window.WargaMap3D && WargaMap3D.zoom(-4)">+</button>
						<button type="button" class="map3d-btn" onclick="window.WargaMap3D && WargaMap3D.zoom(4)">-</button>
						<button type="button" class="map3d-btn" onclick="window.WargaMap3D && WargaMap3D.reset()">Reset</button>
					</div>
				</div>

				<canvas id="warga3dCanvas"></canvas>

				<div class="map3d-legend">
					<span><span class="legend-dot" style="background: #0ea5e9;"></span>1 KK</span>
					<span><span class="legend-dot" style="background: #f59e0b;"></span>Multi-KK (2+ KK)</span>
					<span><span class="legend-dot" style="background: #10b981;"></span>Rumah Terpilih</span>
					<span style="opacity: 0.85;">Drag: Putar &bull; Klik Rumah: Lihat KK &amp; Penghuni</span>
				</div>
			</div>

			<!-- HUD Inspector Detail Rumah yang Diklik -->
			<div class="map3d-inspector" id="map3dInspector">
				<div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
					<div>
						<span style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #0284c7;">
							<i class="fas fa-crosshairs mr-1"></i> INSPEKTOR RUMAH 3D
						</span>
						<h4 class="font-weight-bold mb-0 mt-1" id="inspTitle">Pilih Rumah di Peta 3D</h4>
					</div>
					<span class="badge badge-primary px-3 py-2" id="inspBadgeKk" style="border-radius: 10px; font-size: 12px;">- KK</span>
				</div>
				<div id="inspBody" style="font-size: 13px;">
					<div class="text-center py-4 text-muted">
						<i class="fas fa-hand-pointer fa-2x mb-2" style="opacity: 0.4;"></i>
						<p class="mb-0">Klik salah satu rumah di Mini-Map 3D untuk melihat alamat lengkap, jumlah KK, dan daftar penghuninya.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- PANEL 3: TABEL INDIVIDU KLASIK -->
	<div id="panelTabelView" style="display: none;">
		<div class="table-container-card">
			<div class="table-responsive">
				<table class="table table-custom-warga" id="wargaMainTable">
					<thead>
						<tr>
							<th style="width: 50px;">No</th>
							<th style="width: 165px;">NIK / No. KK</th>
							<th>Nama Lengkap</th>
							<th style="width: 110px;">Gender</th>
							<th style="width: 180px;">Tempat, Tgl Lahir</th>
							<th>Rumah &amp; Alamat</th>
							<th style="width: 135px;">Smart RFID</th>
							<th style="width: 100px;" class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody id="wargaTableBody">
						@forelse($warga as $idx => $w)
						<tr class="warga-row-item" data-blok="{{ strtoupper(substr((string) $w->no_rumah, 0, 1)) }}">
							<td class="text-muted font-weight-bold">{{ $idx + 1 }}</td>
							<td>
								<span class="badge-nik">{{ $w->nik }}</span>
								@if(!empty($w->no_kk))
									<small class="d-block text-muted mt-1" style="font-family: 'JetBrains Mono'; font-size: 10.5px;">KK: {{ $w->no_kk }}</small>
								@endif
							</td>
							<td>
								<strong style="font-size: 13.5px;">{{ $w->nama }}</strong>
								@if(!empty($w->hubungan_keluarga))
									<small class="d-block text-muted">{{ $w->hubungan_keluarga }}</small>
								@endif
							</td>
							<td>
								@if(strtolower($w->jekel) === 'laki-laki' || strtolower($w->jekel) === 'l')
									<span class="badge badge-primary px-2 py-1 font-weight-bold">Laki-laki</span>
								@else
									<span class="badge badge-info px-2 py-1 font-weight-bold">Perempuan</span>
								@endif
							</td>
							<td>
								<div>{{ $w->tempat_lahir ?: '-' }}</div>
								<small class="text-muted">{{ !empty($w->tanggal_lahir) ? date('d-m-Y', strtotime($w->tanggal_lahir)) : '-' }}</small>
							</td>
							<td>
								<span class="badge badge-dark mr-1">{{ $w->no_rumah ?: 'N/A' }}</span>
								<span>{{ $w->alamat }}</span>
							</td>
							<td>
								@if(!empty($w->rfid_ktp))
									<span class="badge badge-success px-2 py-1 font-weight-bold" style="font-family: 'JetBrains Mono';">
										<i class="fas fa-check-circle mr-1"></i>{{ $w->rfid_ktp }}
									</span>
								@else
									<span class="badge badge-light border text-muted px-2 py-1">Belum Terhubung</span>
								@endif
							</td>
							<td class="text-center">
								<div class="d-inline-flex" style="gap: 6px;">
									<button type="button" class="btn-action-circle btn-edit" title="Edit Data Warga" data-toggle="modal" data-target="#editWargaModal{{ $w->idWarga }}">
										<i class="fas fa-pen"></i>
									</button>
									<a href="{{ route('warga.destroy', $w->idWarga) }}" class="btn-action-circle btn-del" title="Hapus Data Warga" onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')">
										<i class="fas fa-trash-alt"></i>
									</a>
								</div>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="8" class="text-center py-5 text-muted">
								<h5>Belum Ada Data Warga</h5>
							</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal Tambah Warga -->
<div class="modal fade" id="addWargaModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
			<div class="modal-header text-white" style="background: linear-gradient(135deg, #312e81, #4338ca); padding: 22px 26px;">
				<h5 class="modal-title font-weight-bold text-white mb-0"><i class="fas fa-user-plus mr-2"></i>Tambah Data Warga Baru</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body p-4">
				<form action="{{ route('warga.store') }}" method="POST">
					@csrf
					<div class="row">
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">NIK</label>
							<input class="form-control" type="text" name="nik" placeholder="16 digit NIK" required style="border-radius: 9px;">
						</div>
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">No. Kartu Keluarga (KK)</label>
							<input class="form-control" type="text" name="no_kk" placeholder="16 digit No. KK" style="border-radius: 9px;">
						</div>
					</div>

					<div class="row">
						<div class="col-md-7 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Nama Lengkap</label>
							<input class="form-control" type="text" name="nama" placeholder="Nama warga" required style="border-radius: 9px;">
						</div>
						<div class="col-md-5 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Hubungan Keluarga</label>
							<select class="form-control" name="hubungan_keluarga" style="border-radius: 9px;">
								<option value="Kepala Keluarga">Kepala Keluarga</option>
								<option value="Istri">Istri</option>
								<option value="Anak">Anak</option>
								<option value="Orang Tua">Orang Tua</option>
								<option value="Famili Lain">Famili Lain</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Jenis Kelamin</label>
							<select class="form-control" name="jekel" style="border-radius: 9px;">
								<option value="Laki-Laki">Laki-laki</option>
								<option value="Perempuan">Perempuan</option>
							</select>
						</div>
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">UID e-KTP (Opsional)</label>
							<div class="input-group">
								<input class="form-control" type="text" name="rfid_ktp" placeholder="Contoh: E3A82C10" style="border-radius: 9px 0 0 9px; font-family: 'JetBrains Mono'; text-transform: uppercase;">
								<div class="input-group-append">
									<button type="button" class="btn btn-outline-primary btn-sm font-weight-bold" onclick="fillLastRfidUid(this)" title="Ambil UID scan kartu terakhir dari ESP32" style="border-radius: 0 9px 9px 0;">
										Scan
									</button>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Tempat Lahir</label>
							<input class="form-control" type="text" name="tempat_lahir" placeholder="Kota lahir" style="border-radius: 9px;">
						</div>
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Tanggal Lahir</label>
							<input class="form-control" type="date" name="tanggal_lahir" style="border-radius: 9px;">
						</div>
					</div>

					<div class="row">
						<div class="col-md-8 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Alamat Lengkap</label>
							<input class="form-control" type="text" name="alamat" placeholder="Jl. Mawar No. 01, Blok A" style="border-radius: 9px;">
						</div>
						<div class="col-md-4 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Kode Rumah</label>
							<input class="form-control" type="text" name="no_rumah" placeholder="Misal: A-01" style="border-radius: 9px;">
						</div>
					</div>

					<div class="d-flex justify-content-end" style="gap: 8px;">
						<button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
						<button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px;">
							<i class="fas fa-check-circle mr-1"></i> Simpan Warga
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modals Edit Warga -->
@foreach($warga as $w)
<div class="modal fade" id="editWargaModal{{ $w->idWarga }}" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
			<div class="modal-header text-white" style="background: linear-gradient(135deg, #312e81, #4338ca); padding: 22px 26px;">
				<h5 class="modal-title font-weight-bold text-white mb-0"><i class="fas fa-user-edit mr-2"></i>Edit Data Warga: {{ $w->nama }}</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body p-4">
				<form action="{{ route('warga.update', $w->idWarga) }}" method="POST">
					@csrf
					<div class="row">
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">NIK</label>
							<input class="form-control" type="text" name="nik" value="{{ $w->nik }}" required style="border-radius: 9px;">
						</div>
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">No. Kartu Keluarga (KK)</label>
							<input class="form-control" type="text" name="no_kk" value="{{ $w->no_kk }}" style="border-radius: 9px;">
						</div>
					</div>

					<div class="row">
						<div class="col-md-7 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Nama Lengkap</label>
							<input class="form-control" type="text" name="nama" value="{{ $w->nama }}" required style="border-radius: 9px;">
						</div>
						<div class="col-md-5 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Hubungan Keluarga</label>
							<select class="form-control" name="hubungan_keluarga" style="border-radius: 9px;">
								@foreach(['Kepala Keluarga', 'Istri', 'Anak', 'Orang Tua', 'Famili Lain'] as $hubOpt)
									<option value="{{ $hubOpt }}" {{ strcasecmp((string) $w->hubungan_keluarga, $hubOpt) === 0 ? 'selected' : '' }}>{{ $hubOpt }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Jenis Kelamin</label>
							<select class="form-control" name="jekel" style="border-radius: 9px;">
								<option value="Laki-Laki" {{ strtolower($w->jekel) === 'laki-laki' || strtolower($w->jekel) === 'l' ? 'selected' : '' }}>Laki-laki</option>
								<option value="Perempuan" {{ strtolower($w->jekel) === 'perempuan' || strtolower($w->jekel) === 'p' ? 'selected' : '' }}>Perempuan</option>
							</select>
						</div>
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">UID e-KTP (Opsional)</label>
							<div class="input-group">
								<input class="form-control" type="text" name="rfid_ktp" value="{{ $w->rfid_ktp }}" placeholder="Contoh: E3A82C10" style="border-radius: 9px 0 0 9px; font-family: 'JetBrains Mono'; text-transform: uppercase;">
								<div class="input-group-append">
									<button type="button" class="btn btn-outline-primary btn-sm font-weight-bold" onclick="fillLastRfidUid(this)" title="Ambil UID scan kartu terakhir dari ESP32" style="border-radius: 0 9px 9px 0;">
										Scan
									</button>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Tempat Lahir</label>
							<input class="form-control" type="text" name="tempat_lahir" value="{{ $w->tempat_lahir }}" style="border-radius: 9px;">
						</div>
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Tanggal Lahir</label>
							<input class="form-control" type="date" name="tanggal_lahir" value="{{ $w->tanggal_lahir }}" style="border-radius: 9px;">
						</div>
					</div>

					<div class="row">
						<div class="col-md-8 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Alamat Lengkap</label>
							<input class="form-control" type="text" name="alamat" value="{{ $w->alamat }}" style="border-radius: 9px;">
						</div>
						<div class="col-md-4 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Kode Rumah</label>
							<input class="form-control" type="text" name="no_rumah" value="{{ $w->no_rumah }}" style="border-radius: 9px;">
						</div>
					</div>

					<div class="d-flex justify-content-end" style="gap: 8px;">
						<button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
						<button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px;">
							<i class="fas fa-save mr-1"></i> Simpan Perubahan
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endforeach

<script type="application/json" id="wargaMapHousesJson">{!! json_encode($mapHouses) !!}</script>
<script>
var currentBlokFilter = 'ALL';
var onlyMultiKk = false;
var currentWargaMode = 'rumah';

function switchWargaMode(mode) {
	currentWargaMode = mode;
	document.getElementById('panelRumahView').style.display = (mode === 'rumah') ? '' : 'none';
	document.getElementById('panelMap3dView').style.display = (mode === 'map3d') ? '' : 'none';
	document.getElementById('panelTabelView').style.display = (mode === 'tabel') ? '' : 'none';

	document.getElementById('tabBtnRumah').classList.toggle('active', mode === 'rumah');
	document.getElementById('tabBtnMap3d').classList.toggle('active', mode === 'map3d');
	document.getElementById('tabBtnTabel').classList.toggle('active', mode === 'tabel');

	if (mode === 'map3d') {
		initWargaMap3D();
	}
}

function setBlokFilter(blok, btn) {
	currentBlokFilter = blok;
	document.querySelectorAll('#blokFilterGroup .blok-chip-btn[data-blok]').forEach(function(b) {
		b.classList.remove('active');
	});
	if (btn) btn.classList.add('active');
	applyWargaFilters();
}

function toggleMultiKkFilter(btn) {
	onlyMultiKk = !onlyMultiKk;
	if (btn) btn.classList.toggle('multi-active', onlyMultiKk);
	applyWargaFilters();
}

function applyWargaFilters() {
	var q = (document.getElementById('wargaSearchInput').value || '').toLowerCase().trim();

	// Filter kartu rumah
	document.querySelectorAll('.rumah-card').forEach(function(card) {
		var blok = card.getAttribute('data-blok') || '';
		var kkCount = parseInt(card.getAttribute('data-kk') || '1', 10);
		var hay = card.getAttribute('data-search') || '';
		var okBlok = (currentBlokFilter === 'ALL' || blok === currentBlokFilter);
		var okKk = (!onlyMultiKk || kkCount > 1);
		var okQ = (!q || hay.indexOf(q) !== -1);
		card.style.display = (okBlok && okKk && okQ) ? '' : 'none';
	});

	// Filter baris tabel individu
	document.querySelectorAll('.warga-row-item').forEach(function(row) {
		var blok = row.getAttribute('data-blok') || '';
		var text = row.innerText.toLowerCase();
		var okBlok = (currentBlokFilter === 'ALL' || blok === currentBlokFilter);
		var okQ = (!q || text.indexOf(q) !== -1);
		row.style.display = (okBlok && okQ) ? '' : 'none';
	});
}

function focusHouseOn3D(houseKey) {
	switchWargaMode('map3d');
	setTimeout(function() {
		if (window.WargaMap3D && typeof window.WargaMap3D.selectByKey === 'function') {
			window.WargaMap3D.selectByKey(houseKey);
		}
	}, 260);
}

function fillLastRfidUid(btn) {
	var input = btn.closest('.input-group').querySelector('input[name="rfid_ktp"]');
	var originalText = btn.innerHTML;
	btn.disabled = true;
	btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
	fetch("{{ url('/api/rfid/status') }}")
		.then(function(r) { return r.json(); })
		.then(function(data) {
			if (data.last_rfid_uid) {
				input.value = data.last_rfid_uid;
			} else {
				alert('Belum ada tap kartu RFID/e-KTP dalam 30 detik terakhir. Silakan tempelkan kartu di alat ESP32.');
			}
		})
		.catch(function() { alert('Gagal mengambil UID terakhir dari server.'); })
		.finally(function() {
			btn.disabled = false;
			btn.innerHTML = originalText;
		});
}

/* =========================================================
   3D MINI-MAP KAWASAN RT (THREE.JS INTERACTIVE GAME VIEW)
   ========================================================= */
var map3dBooted = false;
function initWargaMap3D() {
	if (map3dBooted) {
		if (window.WargaMap3D && window.WargaMap3D.resize) window.WargaMap3D.resize();
		return;
	}
	map3dBooted = true;

	function loadThree(cb) {
		if (window.THREE) { cb(); return; }
		var s = document.createElement('script');
		s.src = 'https://cdn.jsdelivr.net/npm/three@0.149.0/build/three.min.js';
		s.onload = cb;
		s.onerror = function() {
			var s2 = document.createElement('script');
			s2.src = 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js';
			s2.onload = cb;
			document.head.appendChild(s2);
		};
		document.head.appendChild(s);
	}

	loadThree(function() {
		if (!window.THREE) return;
		var canvas = document.getElementById('warga3dCanvas');
		if (!canvas) return;

		var houses = [];
		try {
			houses = JSON.parse(document.getElementById('wargaMapHousesJson').textContent || '[]');
		} catch (e) { houses = []; }

		var renderer = new THREE.WebGLRenderer({ canvas: canvas, antialias: true, alpha: false });
		renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
		renderer.shadowMap.enabled = true;
		renderer.shadowMap.type = THREE.PCFSoftShadowMap;

		var scene = new THREE.Scene();
		scene.background = new THREE.Color(0x071022);
		scene.fog = new THREE.FogExp2(0x071022, 0.011);

		var camera = new THREE.PerspectiveCamera(45, 1.5, 0.1, 220);

		function resize() {
			var w = canvas.clientWidth || canvas.parentElement.clientWidth || 720;
			var h = canvas.clientHeight || 540;
			renderer.setSize(w, h, false);
			camera.aspect = w / h;
			camera.updateProjectionMatrix();
		}
		resize();
		window.addEventListener('resize', resize);

		// Pencahayaan Suasana Komplek RT Malam/Senja Cerah
		var hemi = new THREE.HemisphereLight(0x93c5fd, 0x0f172a, 0.85);
		scene.add(hemi);
		var sun = new THREE.DirectionalLight(0xffffff, 1.1);
		sun.position.set(22, 36, 18);
		sun.castShadow = true;
		sun.shadow.mapSize.width = 1024;
		sun.shadow.mapSize.height = 1024;
		sun.shadow.camera.near = 5;
		sun.shadow.camera.far = 90;
		var d = 30;
		sun.shadow.camera.left = -d; sun.shadow.camera.right = d;
		sun.shadow.camera.top = d; sun.shadow.camera.bottom = -d;
		scene.add(sun);

		// Tanah Rumput Kawasan RT
		var groundGeo = new THREE.PlaneGeometry(84, 84);
		var groundMat = new THREE.MeshStandardMaterial({ color: 0x132a24, roughness: 0.95 });
		var ground = new THREE.Mesh(groundGeo, groundMat);
		ground.rotation.x = -Math.PI / 2;
		ground.receiveShadow = true;
		scene.add(ground);

		// Jalan Utama (Vertikal & Horizontal membentuk 4 kuadran Blok A, B, C, D)
		var roadMat = new THREE.MeshStandardMaterial({ color: 0x1e293b, roughness: 0.85 });
		var roadNS = new THREE.Mesh(new THREE.BoxGeometry(5.2, 0.06, 68), roadMat);
		roadNS.position.set(0, 0.03, 0);
		roadNS.receiveShadow = true;
		scene.add(roadNS);

		var roadEW = new THREE.Mesh(new THREE.BoxGeometry(68, 0.06, 5.2), roadMat);
		roadEW.position.set(0, 0.03, 0);
		roadEW.receiveShadow = true;
		scene.add(roadEW);

		// Marka Jalan Putus-Putus
		var stripeMat = new THREE.MeshBasicMaterial({ color: 0xfacc15 });
		for (var i = -30; i <= 30; i += 4) {
			if (Math.abs(i) < 4) continue;
			var s1 = new THREE.Mesh(new THREE.BoxGeometry(0.22, 0.07, 1.8), stripeMat);
			s1.position.set(0, 0.04, i);
			scene.add(s1);
			var s2 = new THREE.Mesh(new THREE.BoxGeometry(1.8, 0.07, 0.22), stripeMat);
			s2.position.set(i, 0.04, 0);
			scene.add(s2);
		}

		// Pos Ronda / Balai RT di Persimpangan Tengah-Tepi
		var posGroup = new THREE.Group();
		var posBase = new THREE.Mesh(new THREE.BoxGeometry(2.6, 1.3, 2.6), new THREE.MeshStandardMaterial({ color: 0x334155 }));
		posBase.position.y = 0.65;
		var posRoof = new THREE.Mesh(new THREE.ConeGeometry(2.3, 1.1, 4), new THREE.MeshStandardMaterial({ color: 0x10b981 }));
		posRoof.position.y = 1.85;
		posRoof.rotation.y = Math.PI / 4;
		posGroup.add(posBase, posRoof);
		posGroup.position.set(3.8, 0, -3.8);
		scene.add(posGroup);

		// Pohon Dekoratif di sudut jalan
		function addTree(tx, tz) {
			var g = new THREE.Group();
			var trunk = new THREE.Mesh(new THREE.CylinderGeometry(0.18, 0.24, 1.1, 6), new THREE.MeshStandardMaterial({ color: 0x78350f }));
			trunk.position.y = 0.55;
			var crown = new THREE.Mesh(new THREE.DodecahedronGeometry(0.95, 0), new THREE.MeshStandardMaterial({ color: 0x15803d, flatShading: true }));
			crown.position.y = 1.65;
			crown.castShadow = true;
			g.add(trunk, crown);
			g.position.set(tx, 0, tz);
			scene.add(g);
		}
		[[-4,-4],[4,4],[-4,4],[-24,-4],[24,-4],[-24,4],[24,4]].forEach(function(p) { addTree(p[0], p[1]); });

		// Bangun Mesh Rumah untuk setiap data rumah dari DB
		var houseMeshes = [];
		var houseRecords = [];
		var blokCounters = { A: 0, B: 0, C: 0, D: 0, OTHER: 0 };

		houses.forEach(function(h) {
			var b = (h.blok && ['A','B','C','D'].indexOf(h.blok) !== -1) ? h.blok : 'OTHER';
			var idx = blokCounters[b]++;
			var col = idx % 4;
			var row = Math.floor(idx / 4);

			var hx = 0, hz = 0;
			if (b === 'A') { hx = -7 - col * 5.2; hz = -7 - row * 5.6; }
			else if (b === 'B') { hx = 7 + col * 5.2; hz = -7 - row * 5.6; }
			else if (b === 'C') { hx = -7 - col * 5.2; hz = 7 + row * 5.6; }
			else if (b === 'D') { hx = 7 + col * 5.2; hz = 7 + row * 5.6; }
			else { hx = -18 + col * 5.2; hz = 21 + row * 5.6; }

			var hg = new THREE.Group();
			hg.position.set(hx, 0, hz);

			// Halaman / Lot Rumah
			var lot = new THREE.Mesh(
				new THREE.BoxGeometry(4.1, 0.1, 4.1),
				new THREE.MeshStandardMaterial({ color: 0x1e293b, roughness: 0.9 })
			);
			lot.position.y = 0.05;
			lot.receiveShadow = true;
			hg.add(lot);

			// Badan Rumah (tinggi sedikit lebih besar untuk rumah Multi-KK)
			var wallH = h.total_kk > 1 ? 2.15 : 1.7;
			var wallMat = new THREE.MeshStandardMaterial({ color: 0xe2e8f0, roughness: 0.7 });
			var wall = new THREE.Mesh(new THREE.BoxGeometry(3.0, wallH, 2.7), wallMat);
			wall.position.y = wallH / 2 + 0.1;
			wall.castShadow = true;
			wall.receiveShadow = true;
			hg.add(wall);

			// Atap Rumah (Biru = 1 KK, Emas/Oranye = Multi-KK)
			var baseRoofColor = h.total_kk > 1 ? 0xf59e0b : 0x0ea5e9;
			var roofMat = new THREE.MeshStandardMaterial({ color: baseRoofColor, roughness: 0.45, metalness: 0.15 });
			var roof = new THREE.Mesh(new THREE.ConeGeometry(2.45, 1.35, 4), roofMat);
			roof.position.y = wallH + 0.75;
			roof.rotation.y = Math.PI / 4;
			roof.castShadow = true;
			hg.add(roof);

			// Jendela Bercahaya
			var winMat = new THREE.MeshBasicMaterial({ color: h.total_kk > 1 ? 0xfef08a : 0x7dd3fc });
			var win1 = new THREE.Mesh(new THREE.BoxGeometry(0.6, 0.5, 0.08), winMat);
			win1.position.set(-0.75, wallH * 0.55, 1.37);
			var win2 = new THREE.Mesh(new THREE.BoxGeometry(0.6, 0.5, 0.08), winMat);
			win2.position.set(0.75, wallH * 0.55, 1.37);
			var door = new THREE.Mesh(new THREE.BoxGeometry(0.65, 1.0, 0.09), new THREE.MeshStandardMaterial({ color: 0x475569 }));
			door.position.set(0, 0.6, 1.37);
			hg.add(win1, win2, door);

			// Pilar/Orb Indikator Jumlah KK di atas atap
			var orbMat = new THREE.MeshBasicMaterial({ color: h.total_kk > 1 ? 0xfbbf24 : 0x38bdf8 });
			var orb = new THREE.Mesh(new THREE.SphereGeometry(0.24, 12, 12), orbMat);
			orb.position.set(0, wallH + 1.85, 0);
			hg.add(orb);

			// Simpan metadata untuk raycasting
			[lot, wall, roof, orb].forEach(function(m) {
				m.userData.houseIndex = houseRecords.length;
				houseMeshes.push(m);
			});

			scene.add(hg);
			houseRecords.push({
				data: h,
				group: hg,
				roofMat: roofMat,
				baseRoofColor: baseRoofColor,
				orb: orb,
				x: hx,
				z: hz
			});
		});

		// Orbit Camera State
		var camTarget = new THREE.Vector3(0, 0, 0);
		var camGoalTarget = new THREE.Vector3(0, 0, 0);
		var yaw = 0.72;
		var pitch = 0.68;
		var dist = 36;
		var goalYaw = yaw, goalPitch = pitch, goalDist = dist;
		var selectedIdx = -1;

		function updateCamera() {
			yaw += (goalYaw - yaw) * 0.12;
			pitch += (goalPitch - pitch) * 0.12;
			dist += (goalDist - dist) * 0.12;
			camTarget.lerp(camGoalTarget, 0.12);

			camera.position.x = camTarget.x + dist * Math.cos(pitch) * Math.sin(yaw);
			camera.position.y = camTarget.y + dist * Math.sin(pitch);
			camera.position.z = camTarget.z + dist * Math.cos(pitch) * Math.cos(yaw);
			camera.lookAt(camTarget);
		}

		// Mouse & Touch Orbit + Click Raycasting
		var dragging = false, moved = false, lastX = 0, lastY = 0;
		var raycaster = new THREE.Raycaster();
		var pointer = new THREE.Vector2();

		canvas.addEventListener('pointerdown', function(e) {
			dragging = true;
			moved = false;
			lastX = e.clientX;
			lastY = e.clientY;
		});
		window.addEventListener('pointermove', function(e) {
			if (!dragging) return;
			var dx = e.clientX - lastX;
			var dy = e.clientY - lastY;
			if (Math.abs(dx) > 4 || Math.abs(dy) > 4) moved = true;
			goalYaw -= dx * 0.008;
			goalPitch = Math.max(0.28, Math.min(1.48, goalPitch + dy * 0.006));
			lastX = e.clientX;
			lastY = e.clientY;
		});
		window.addEventListener('pointerup', function(e) {
			if (dragging && !moved && e.target === canvas) {
				var rect = canvas.getBoundingClientRect();
				pointer.x = ((e.clientX - rect.left) / rect.width) * 2 - 1;
				pointer.y = -((e.clientY - rect.top) / rect.height) * 2 + 1;
				raycaster.setFromCamera(pointer, camera);
				var hits = raycaster.intersectObjects(houseMeshes, false);
				if (hits.length > 0) {
					selectHouse(hits[0].object.userData.houseIndex);
				}
			}
			dragging = false;
		});
		canvas.addEventListener('wheel', function(e) {
			e.preventDefault();
			goalDist = Math.max(14, Math.min(62, goalDist + e.deltaY * 0.025));
		}, { passive: false });

		function selectHouse(idx) {
			if (idx < 0 || idx >= houseRecords.length) return;
			if (selectedIdx !== -1 && houseRecords[selectedIdx]) {
				houseRecords[selectedIdx].roofMat.color.setHex(houseRecords[selectedIdx].baseRoofColor);
				houseRecords[selectedIdx].group.scale.set(1, 1, 1);
			}
			selectedIdx = idx;
			var rec = houseRecords[idx];
			rec.roofMat.color.setHex(0x10b981);
			rec.group.scale.set(1.08, 1.08, 1.08);
			camGoalTarget.set(rec.x, 0.5, rec.z);
			goalDist = Math.min(goalDist, 22);

			renderInspector(rec.data);
		}

		function renderInspector(h) {
			document.getElementById('inspTitle').textContent = 'Rumah ' + h.kode_rumah + ' (Blok ' + h.blok + ')';
			var badge = document.getElementById('inspBadgeKk');
			badge.textContent = h.total_kk + ' KK • ' + h.total_jiwa + ' Jiwa';
			badge.className = h.total_kk > 1 ? 'badge badge-warning text-dark px-3 py-2' : 'badge badge-primary px-3 py-2';

			var html = '<div class="mb-3 p-2 rounded" style="background: rgba(14,165,233,0.08); border: 1px solid rgba(14,165,233,0.2);">' +
				'<strong><i class="fas fa-map-marker-alt text-danger mr-1"></i> Alamat:</strong><br>' +
				'<span>' + escapeHtml(h.alamat) + '</span>' +
				'</div>';

			(h.kk_list || []).forEach(function(kk, i) {
				html += '<div class="mb-3 border rounded" style="overflow:hidden;">' +
					'<div class="px-3 py-2 font-weight-bold d-flex justify-content-between align-items-center" style="background:rgba(67,56,202,0.1); font-size:12px;">' +
						'<span><i class="fas fa-id-card mr-1"></i> KK #' + (i + 1) + ': ' + escapeHtml(kk.no_kk) + '</span>' +
						'<span class="badge badge-light">' + kk.anggota.length + ' Jiwa</span>' +
					'</div>' +
					'<div class="p-2">';
				kk.anggota.forEach(function(a) {
					html += '<div class="d-flex justify-content-between align-items-center py-1 px-2 border-bottom" style="font-size:12.5px;">' +
						'<div><strong>' + escapeHtml(a.nama) + '</strong> <span class="badge badge-secondary" style="font-size:10px;">' + escapeHtml(a.hubungan) + '</span>' +
						'<div style="font-size:11px; opacity:0.7; font-family:JetBrains Mono;">NIK: ' + escapeHtml(a.nik) + '</div></div>' +
						'</div>';
				});
				html += '</div></div>';
			});

			document.getElementById('map3dInspector').querySelector('#inspBody').innerHTML = html;
		}

		function escapeHtml(str) {
			return String(str || '').replace(/[&<>"']/g, function(m) {
				return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[m];
			});
		}

		window.WargaMap3D = {
			resize: resize,
			zoom: function(delta) {
				goalDist = Math.max(14, Math.min(62, goalDist + delta));
			},
			setView: function(mode, btn) {
				document.querySelectorAll('.map3d-controls .map3d-btn').forEach(function(b) { b.classList.remove('active'); });
				if (btn) btn.classList.add('active');
				if (mode === 'top') {
					goalPitch = 1.44;
					goalYaw = 0.0;
					goalDist = 42;
				} else {
					goalPitch = 0.68;
					goalYaw = 0.72;
					goalDist = 36;
				}
			},
			reset: function() {
				camGoalTarget.set(0, 0, 0);
				goalYaw = 0.72;
				goalPitch = 0.68;
				goalDist = 36;
			},
			selectByKey: function(key) {
				for (var i = 0; i < houseRecords.length; i++) {
					if (houseRecords[i].data.key === key) {
						selectHouse(i);
						break;
					}
				}
			}
		};

		// Pilih rumah pertama otomatis agar inspector langsung terisi
		if (houseRecords.length > 0) {
			renderInspector(houseRecords[0].data);
		}

		function animate(now) {
			requestAnimationFrame(animate);
			var t = now * 0.002;
			houseRecords.forEach(function(rec, i) {
				rec.orb.position.y = (rec.data.total_kk > 1 ? 4.0 : 3.55) + Math.sin(t + i * 0.5) * 0.14;
			});
			updateCamera();
			renderer.render(scene, camera);
		}
		requestAnimationFrame(animate);
	});
}
</script>
@endsection
