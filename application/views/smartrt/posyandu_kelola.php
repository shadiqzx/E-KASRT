<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap');

.posyandu-container {
	font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
	color: #0f172a;
	padding-top: 85px !important;
	padding-bottom: 50px;
}

/* Header & Unified Buttons */
.page-title {
	font-size: 24px;
	font-weight: 800;
	color: #0f172a;
	letter-spacing: -0.5px;
}
.btn-action-primary {
	background: #0284c7;
	color: #ffffff !important;
	border: 1px solid #0284c7;
	border-radius: 10px;
	font-weight: 700;
	font-size: 13px;
	padding: 8px 16px;
	transition: all 0.2s;
	display: inline-flex;
	align-items: center;
	gap: 6px;
	text-decoration: none !important;
}
.btn-action-primary:hover {
	background: #0369a1;
	box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25);
	transform: translateY(-1px);
}
.btn-action-light {
	background: #ffffff;
	color: #334155 !important;
	border: 1px solid #cbd5e1;
	border-radius: 10px;
	font-weight: 600;
	font-size: 13px;
	padding: 8px 14px;
	transition: all 0.2s;
	display: inline-flex;
	align-items: center;
	gap: 6px;
	text-decoration: none !important;
}
.btn-action-light:hover {
	background: #f8fafc;
	color: #0f172a !important;
	border-color: #94a3b8;
	transform: translateY(-1px);
}

/* IoT Hardware & Live Monitor Hub (Clean SaaS Card) */
.iot-hub-card {
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 18px;
	padding: 22px 24px;
	box-shadow: 0 4px 20px -3px rgba(15, 23, 42, 0.05);
	position: relative;
	overflow: hidden;
	margin-bottom: 22px;
}
.iot-hub-card::before {
	content: '';
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	height: 3px;
	background: linear-gradient(90deg, #0284c7, #06b6d4, #10b981);
}

.radar-pulse-green {
	width: 9px;
	height: 9px;
	background: #10b981;
	border-radius: 50%;
	display: inline-block;
	box-shadow: 0 0 0 rgba(16, 185, 129, 0.7);
	animation: pulse-ring-green 1.8s infinite;
}
@keyframes pulse-ring-green {
	0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
	70% { box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
	100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}

.iot-meta-chip {
	background: #f8fafc;
	border: 1px solid #e2e8f0;
	color: #475569;
	font-size: 11.5px;
	font-weight: 600;
	padding: 5px 11px;
	border-radius: 8px;
	display: inline-flex;
	align-items: center;
	gap: 6px;
}
.iot-meta-chip strong {
	color: #0f172a;
	font-family: 'JetBrains Mono', monospace;
}

/* Radar Tap Display Card */
.radar-display-card {
	background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
	border: 1px solid #bae6fd;
	border-radius: 14px;
	padding: 16px 18px;
	position: relative;
	transition: all 0.25s ease;
}
.radar-avatar-circle {
	width: 44px;
	height: 44px;
	border-radius: 12px;
	background: #ffffff;
	border: 1px solid #93c5fd;
	box-shadow: 0 2px 8px rgba(2, 132, 199, 0.12);
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 22px;
	flex-shrink: 0;
}

/* Compact Fintech KPI Cards */
.kpi-compact-card {
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 14px;
	padding: 16px 18px;
	box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03);
	display: flex;
	align-items: center;
	justify-content: space-between;
	position: relative;
	overflow: hidden;
	transition: all 0.2s ease;
	height: 100%;
}
.kpi-compact-card:hover {
	transform: translateY(-2px);
	box-shadow: 0 8px 20px -4px rgba(15, 23, 42, 0.08);
	border-color: #cbd5e1;
}
.kpi-compact-card::before {
	content: '';
	position: absolute;
	left: 0;
	top: 0;
	bottom: 0;
	width: 4px;
}
.kpi-compact-card.cyan::before { background: #06b6d4; }
.kpi-compact-card.emerald::before { background: #10b981; }
.kpi-compact-card.indigo::before { background: #6366f1; }
.kpi-compact-card.amber::before { background: #f59e0b; }

.kpi-val {
	font-size: 26px;
	font-weight: 800;
	line-height: 1;
	color: #0f172a;
	letter-spacing: -0.5px;
}
.kpi-tit {
	font-size: 11.5px;
	font-weight: 700;
	color: #64748b;
	text-transform: uppercase;
	letter-spacing: 0.5px;
	margin-top: 5px;
}
.kpi-ico {
	width: 42px;
	height: 42px;
	border-radius: 10px;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 20px;
}
.kpi-compact-card.cyan .kpi-ico { background: #ecfeff; color: #0891b2; }
.kpi-compact-card.emerald .kpi-ico { background: #ecfdf5; color: #059669; }
.kpi-compact-card.indigo .kpi-ico { background: #eef2ff; color: #4f46e5; }
.kpi-compact-card.amber .kpi-ico { background: #fffbeb; color: #d97706; }

/* Navigation Tabs */
.posyandu-nav-tabs {
	display: flex;
	gap: 8px;
	margin-bottom: 20px;
	border-bottom: 2px solid #e2e8f0;
	padding-bottom: 10px;
	flex-wrap: wrap;
}
.posyandu-nav-tabs .nav-link-item {
	padding: 9px 18px;
	border-radius: 10px;
	font-weight: 700;
	font-size: 13.5px;
	color: #64748b;
	background: #f8fafc;
	border: 1px solid #e2e8f0;
	cursor: pointer;
	text-decoration: none;
	display: inline-flex;
	align-items: center;
	gap: 7px;
	transition: all 0.2s ease;
}
.posyandu-nav-tabs .nav-link-item:hover {
	background: #f1f5f9;
	color: #0f172a;
}
.posyandu-nav-tabs .nav-link-item.active {
	background: #0284c7;
	color: #ffffff;
	border-color: #0284c7;
	box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25);
}
.posyandu-nav-tabs .nav-link-item.active .badge {
	background: #ffffff !important;
	color: #0284c7 !important;
}

/* Modern Tables */
.content-card {
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 16px;
	box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04);
	overflow: hidden;
}
.content-card-header {
	background: #ffffff;
	padding: 18px 24px;
	border-bottom: 1px solid #e2e8f0;
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	align-items: center;
	gap: 10px;
}
.table-modern {
	border-collapse: separate;
	border-spacing: 0;
	width: 100%;
}
.table-modern thead th {
	background: #f8fafc;
	color: #475569;
	font-size: 12px;
	font-weight: 700;
	text-transform: uppercase;
	letter-spacing: 0.6px;
	padding: 14px 18px;
	border-top: none;
	border-bottom: 2px solid #e2e8f0;
}
.table-modern tbody tr {
	transition: background 0.15s ease;
}
.table-modern tbody tr:hover {
	background: #f8fafc;
}
.table-modern tbody td {
	padding: 16px 18px;
	vertical-align: middle;
	border-bottom: 1px solid #f1f5f9;
	font-size: 13.5px;
}

/* Code Snippet Box */
.code-box {
	background: #090d16;
	color: #38bdf8;
	border-radius: 12px;
	padding: 20px;
	font-family: 'JetBrains Mono', monospace;
	font-size: 12px;
	line-height: 1.6;
	overflow-x: auto;
	border: 1px solid #1e293b;
	position: relative;
}
.copy-code-btn {
	position: absolute;
	top: 12px;
	right: 12px;
	background: #1e293b;
	color: #f8fafc;
	border: 1px solid #334155;
	padding: 6px 14px;
	border-radius: 8px;
	font-size: 12px;
	cursor: pointer;
	font-weight: 600;
}
.copy-code-btn:hover { background: #334155; }
</style>

<div class="posyandu-container p-4">
	<?= $this->session->flashdata('message'); ?>

	<!-- Header Posyandu Digital Modern -->
	<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 pb-3 border-bottom">
		<div>
			<div class="d-flex align-items-center gap-2 mb-1" style="gap: 8px;">
				<span class="badge" style="background: #e0f2fe; color: #0369a1; font-weight: 700; border-radius: 8px; padding: 5px 12px; font-size: 11.5px;">
					⚡ IoT Posyandu Digital v2.0
				</span>
				<span class="text-muted" style="font-size: 12.5px;">• NodeMCU ESP32 + MFRC522 RC522</span>
			</div>
			<h2 class="page-title mb-1">Posyandu Balita Digital</h2>
			<p class="text-muted mb-0" style="font-size: 13.5px;">
				Absensi kehadiran balita otomatis via tap <strong>e-KTP Ibu Balita</strong> & rekap tumbuh kembang KMS.
			</p>
		</div>
		<div class="mt-3 mt-md-0 d-flex flex-wrap" style="gap: 8px;">
			<a href="#modalTambahSesi" data-toggle="modal" class="btn btn-action-primary shadow-sm">
				<i class="fas fa-plus-circle"></i> Buat Sesi Baru
			</a>
			<?php if ($sesi_aktif): ?>
				<a href="#modalHadirManual" data-toggle="modal" class="btn btn-action-light">
					<i class="fas fa-pen-alt text-primary"></i> Absen Manual
				</a>
			<?php endif; ?>
			<a href="#modalPairKtp" data-toggle="modal" class="btn btn-action-light">
				<i class="fas fa-id-card text-info"></i> Hubungkan e-KTP
			</a>
			<button type="button" class="btn btn-action-light" onclick="switchTab('tabEsp32', document.querySelectorAll('.posyandu-nav-tabs .nav-link-item')[3]); document.getElementById('tabEsp32').scrollIntoView({behavior: 'smooth'});">
				<i class="fas fa-microchip text-warning"></i> Panduan Alat
			</button>
		</div>
	</div>

	<!-- IoT Hardware Hub & Live Radar Monitor -->
	<div class="iot-hub-card">
		<div class="row align-items-center">
			<!-- Sisi Kiri: Status Scanner & Koneksi Hardware -->
			<div class="col-lg-7 mb-3 mb-lg-0">
				<div class="d-flex flex-wrap align-items-center mb-2" style="gap: 8px;">
					<span class="badge" style="background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; border-radius: 20px; font-weight: 700; font-size: 11.5px; padding: 5px 12px; display: inline-flex; align-items: center; gap: 6px;">
						<span class="radar-pulse-green"></span>
						SCANNER ESP32 SIAP & LISTENING
					</span>
					<span class="badge badge-light text-muted border px-2 py-1" id="livePingBadge" style="font-size: 11px; border-radius: 6px;">
						Live Polling
					</span>
					<button id="toggleAudioBtn" class="btn btn-sm btn-outline-secondary py-0 px-2" style="font-size: 11px; border-radius: 6px; font-weight: 600;" title="Bunyikan Suara & Chime saat e-KTP di-tap">
						🔊 Audio: ON
					</button>
					<button type="button" class="btn btn-sm btn-outline-primary py-0 px-2" onclick="testSimulasiTap()" style="font-size: 11px; border-radius: 6px; font-weight: 600;">
						🧪 Test Simulasi Tap
					</button>
				</div>

				<h4 class="font-weight-bold text-dark mb-1" id="scannerStatusTitle" style="letter-spacing: -0.3px;">
					<?php if ($sesi_aktif): ?>
						Sesi Aktif: <?= htmlspecialchars($sesi_aktif->nama_sesi); ?>
					<?php else: ?>
						Belum Ada Sesi Posyandu yang Berstatus "Aktif"
					<?php endif; ?>
				</h4>
				<p class="text-muted mb-3" style="font-size: 13px;" id="scannerStatusDesc">
					<?php if ($sesi_aktif): ?>
						Ibu balita dapat langsung menempelkan e-KTP ke sensor RC522. Balita milik ibu akan otomatis tercatat hadir.
					<?php else: ?>
						Silakan aktifkan salah satu jadwal sesi posyandu di tab "Manajemen Sesi" agar mesin RFID dapat mulai menerima absensi.
					<?php endif; ?>
				</p>

				<!-- Chip Penghubung ESP32 -->
				<div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
					<div class="iot-meta-chip">
						<i class="fas fa-laptop text-primary"></i> IP: <strong>10.246.16.194</strong>
					</div>
					<div class="iot-meta-chip">
						<i class="fas fa-link text-info"></i> Endpoint: <strong><?= base_url('smartrt/posyandu_rfid_tap'); ?></strong>
					</div>
					<div class="iot-meta-chip">
						<i class="fas fa-key text-warning"></i> Key: <strong>kasrt2025</strong>
					</div>
				</div>
			</div>

			<!-- Sisi Kanan: Live Tap Radar Card -->
			<div class="col-lg-5">
				<div class="radar-display-card" id="lastTapBox">
					<div class="d-flex justify-content-between align-items-center mb-2">
						<span style="font-size: 11px; font-weight: 800; color: #0284c7; letter-spacing: 0.8px; text-transform: uppercase;">
							<i class="fas fa-satellite-dish mr-1"></i> Deteksi Tap Terakhir
						</span>
						<span class="badge badge-light border text-dark font-weight-bold" id="lastTapStatusBadge" style="font-size: 11px;">
							Standby
						</span>
					</div>

					<div class="d-flex align-items-center" style="gap: 12px;">
						<div class="radar-avatar-circle" id="lastTapIcon">
							💳
						</div>
						<div style="min-width: 0; flex: 1;">
							<h6 class="font-weight-bold text-dark mb-0 text-truncate" id="lastTapNama">
								Menunggu Tap Kartu...
							</h6>
							<small class="text-muted d-block text-truncate" id="lastTapDetail" style="font-size: 12px;">
								Tempelkan e-KTP di sensor RFID RC522
							</small>
						</div>
					</div>

					<div class="mt-2 pt-2 border-top d-flex justify-content-between align-items-center text-muted" style="font-size: 11.5px; border-color: rgba(186, 230, 253, 0.7) !important;">
						<span>UID: <strong class="text-dark font-monospace" id="lastTapUid">-</strong></span>
						<span id="lastTapTime" class="font-weight-bold">-</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 4 Compact Fintech KPI Cards -->
	<div class="row mb-4">
		<div class="col-lg-3 col-sm-6 mb-3">
			<div class="kpi-compact-card cyan">
				<div>
					<div class="kpi-val"><?= $total_balita; ?></div>
					<div class="kpi-tit">Total Balita</div>
				</div>
				<div class="kpi-ico">👶</div>
			</div>
		</div>
		<div class="col-lg-3 col-sm-6 mb-3">
			<div class="kpi-compact-card emerald">
				<div>
					<div class="kpi-val"><?= $total_ktp_ibu; ?></div>
					<div class="kpi-tit">e-KTP Terhubung</div>
				</div>
				<div class="kpi-ico">🪪</div>
			</div>
		</div>
		<div class="col-lg-3 col-sm-6 mb-3">
			<div class="kpi-compact-card indigo">
				<div>
					<div class="kpi-val" id="statHadirNum"><?= $total_hadir; ?></div>
					<div class="kpi-tit">Balita Hadir</div>
				</div>
				<div class="kpi-ico">✅</div>
			</div>
		</div>
		<div class="col-lg-3 col-sm-6 mb-3">
			<div class="kpi-compact-card amber">
				<div>
					<div class="kpi-val"><?= count($sesi_list); ?></div>
					<div class="kpi-tit">Total Sesi</div>
				</div>
				<div class="kpi-ico">📅</div>
			</div>
		</div>
	</div>

	<!-- Modern Navigation Tabs -->
	<div class="posyandu-nav-tabs">
		<a href="javascript:void(0)" class="nav-link-item active" onclick="switchTab('tabKehadiran', this)">
			<span>📋</span> Kehadiran & KMS
			<span class="badge badge-light text-dark ml-1" id="tabHadirBadge"><?= count($kehadiran_hari_ini); ?></span>
		</a>
		<a href="javascript:void(0)" class="nav-link-item" onclick="switchTab('tabBalita', this)">
			<span>👶</span> Data Balita & e-KTP Ibu
			<span class="badge badge-light text-dark ml-1"><?= count($balita_list); ?></span>
		</a>
		<a href="javascript:void(0)" class="nav-link-item" onclick="switchTab('tabSesi', this)">
			<span>📅</span> Manajemen Sesi Posyandu
		</a>
		<a href="javascript:void(0)" class="nav-link-item" onclick="switchTab('tabEsp32', this)">
			<span>⚡</span> Firmware & Wiring ESP32
		</a>
	</div>

	<!-- TAB 1: KEHADIRAN & PEMERIKSAAN SESI AKTIF -->
	<div id="tabKehadiran" class="tab-content-section">
		<div class="content-card">
			<div class="content-card-header">
				<div>
					<h5 class="font-weight-bold text-dark mb-0">
						Kehadiran Balita & Data Tumbuh Kembang
					</h5>
					<small class="text-muted">
						<?php if ($sesi_aktif): ?>
							Sesi Aktif: <strong class="text-primary"><?= htmlspecialchars($sesi_aktif->nama_sesi); ?></strong> (<?= date('d M Y', strtotime($sesi_aktif->tanggal)); ?>)
						<?php else: ?>
							<span class="text-danger font-weight-bold">Tidak ada sesi aktif saat ini</span>
						<?php endif; ?>
					</small>
				</div>
				<div class="d-flex" style="gap: 8px;">
					<button onclick="fetchLiveStream()" class="btn btn-action-light btn-sm">
						<i class="fas fa-sync-alt"></i> Refresh Data
					</button>
					<a href="#modalPairKtp" data-toggle="modal" class="btn btn-action-light btn-sm">
						<i class="fas fa-id-card text-info"></i> Hubungkan KTP
					</a>
				</div>
			</div>

			<div class="card-body p-0">
				<?php if (!$sesi_aktif): ?>
					<div class="text-center py-5">
						<div style="font-size: 48px; margin-bottom: 12px;">📅</div>
						<h5 class="font-weight-bold text-dark">Belum Ada Sesi Posyandu Aktif</h5>
						<p class="text-muted" style="max-width: 450px; margin: 0 auto 16px;">
							Buka tab <strong>Manajemen Sesi Posyandu</strong> lalu klik tombol <em>Jadikan Aktif</em> pada jadwal posyandu hari ini.
						</p>
					</div>
				<?php elseif (empty($kehadiran_hari_ini)): ?>
					<div class="text-center py-5">
						<div style="font-size: 48px; margin-bottom: 12px;">👶</div>
						<h5 class="font-weight-bold text-dark">Belum Ada Balita yang Hadir</h5>
						<p class="text-muted" style="max-width: 450px; margin: 0 auto 16px;">
							Minta ibu balita menempelkan e-KTP ke mesin RFID RC522 atau klik tombol <em>Absen Balita Manual</em>.
						</p>
					</div>
				<?php else: ?>
					<div class="table-responsive">
						<table class="table table-modern table-hover mb-0">
							<thead>
								<tr>
									<th>Balita & Orang Tua</th>
									<th>Waktu & Metode</th>
									<th>BB / TB</th>
									<th>LK / LiLA</th>
									<th>Status Gizi</th>
									<th>Imunisasi & Vit</th>
									<th class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody id="kehadiranTableBody">
								<?php foreach ($kehadiran_hari_ini as $k): ?>
									<tr>
										<td>
											<div class="d-flex align-items-center">
												<div style="width: 38px; height: 38px; border-radius: 10px; background: <?= $k->jenis_kelamin == 'L' ? '#e0f2fe' : '#fce7f3'; ?>; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-right: 12px; flex-shrink: 0;">
													<?= $k->jenis_kelamin == 'L' ? '👦' : '👧'; ?>
												</div>
												<div>
													<strong class="text-dark d-block" style="font-size: 14px;"><?= htmlspecialchars($k->nama_anak); ?></strong>
													<small class="text-muted">
														Ibu: <strong><?= htmlspecialchars($k->nama_ortu ?? '-'); ?></strong>
														<?php if (!empty($k->rfid_ktp_ibu)): ?>
															<span class="badge badge-success ml-1" style="font-size: 10px;">e-KTP Terdaftar</span>
														<?php endif; ?>
													</small>
												</div>
											</div>
										</td>
										<td>
											<span class="badge badge-light border text-dark font-weight-bold" style="font-size: 12px;">
												<?= date('H:i', strtotime($k->jam_datang)); ?> WIB
											</span>
											<br>
											<small class="text-muted font-weight-bold">
												<?= $k->metode_absen == 'RFID' ? '📶 Tap e-KTP' : '✍️ Input Manual'; ?>
											</small>
										</td>
										<td>
											<strong><?= $k->berat_badan ? $k->berat_badan . ' kg' : '<span class="text-muted">-</span>'; ?></strong>
											<br>
											<small class="text-muted"><?= $k->tinggi_badan ? $k->tinggi_badan . ' cm' : '-'; ?></small>
										</td>
										<td>
											<small class="d-block">LK: <strong><?= $k->lingkar_kepala ? $k->lingkar_kepala . ' cm' : '-'; ?></strong></small>
											<small class="d-block text-muted">LiLA: <?= $k->lila ? $k->lila . ' cm' : '-'; ?></small>
										</td>
										<td>
											<?php if ($k->status_gizi): ?>
												<?php
													$badge_cls = 'badge-success';
													if ($k->status_gizi == 'Kurang') $badge_cls = 'badge-warning text-dark';
													if ($k->status_gizi == 'Buruk')  $badge_cls = 'badge-danger';
													if ($k->status_gizi == 'Lebih')  $badge_cls = 'badge-info';
												?>
												<span class="badge <?= $badge_cls; ?> px-2 py-1" style="font-size: 11px;"><?= $k->status_gizi; ?></span>
											<?php else: ?>
												<span class="badge badge-light border text-muted px-2 py-1" style="font-size: 11px;">Belum Diukur</span>
											<?php endif; ?>
										</td>
										<td>
											<?= $k->imunisasi ? '<span class="badge badge-info px-2 py-1">' . htmlspecialchars($k->imunisasi) . '</span>' : '<span class="text-muted">-</span>'; ?>
											<?php if ($k->vitamin_a != 'Tidak'): ?>
												<br><small class="text-success font-weight-bold">Vit A: <?= $k->vitamin_a; ?></small>
											<?php endif; ?>
											<?php if ($k->obat_cacing == 'Ya'): ?>
												<br><small class="text-danger font-weight-bold">Obat Cacing: Ya</small>
											<?php endif; ?>
										</td>
										<td class="text-center">
											<div class="btn-group">
												<button type="button" class="btn btn-sm btn-action-primary py-1 px-2" onclick="openModalPemeriksaan(<?= htmlspecialchars(json_encode($k)); ?>)" title="Isi Pengukuran Timbangan">
													⚖️ Periksa
												</button>
												<a href="<?= base_url('smartrt/posyandu_cetak_kms/' . $k->balita_id); ?>" target="_blank" class="btn btn-sm btn-action-light py-1 px-2" title="Cetak KMS Balita">
													🖨️ KMS
												</a>
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- TAB 2: DATA BALITA & E-KTP IBU -->
	<div id="tabBalita" class="tab-content-section" style="display: none;">
		<div class="content-card">
			<div class="content-card-header">
				<div>
					<h5 class="font-weight-bold text-dark mb-0">Daftar Balita & Status e-KTP Ibu</h5>
					<small class="text-muted">Total terdaftar: <strong><?= count($balita_list); ?> balita</strong></small>
				</div>
				<button class="btn btn-action-primary btn-sm" data-toggle="modal" data-target="#modalTambahBalita">
					<i class="fas fa-plus-circle"></i> Daftarkan Balita Baru
				</button>
			</div>

			<div class="card-body p-0">
				<?php if (empty($balita_list)): ?>
					<div class="text-center py-5 text-muted">
						Belum ada data balita yang didaftarkan.
					</div>
				<?php else: ?>
					<div class="table-responsive">
						<table class="table table-modern table-hover mb-0">
							<thead>
								<tr>
									<th>Nama Balita</th>
									<th>Jenis Kelamin</th>
									<th>Tanggal Lahir & Usia</th>
									<th>Nama Ibu (Warga)</th>
									<th>Status e-KTP Ibu (RFID)</th>
									<th class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($balita_list as $b): ?>
									<?php
										$bday  = new DateTime($b->tanggal_lahir);
										$today = new DateTime();
										$diff  = $today->diff($bday);
										$usia  = ($diff->y > 0 ? $diff->y . ' thn ' : '') . $diff->m . ' bln';
									?>
									<tr>
										<td>
											<div class="d-flex align-items-center">
												<div style="width: 38px; height: 38px; border-radius: 10px; background: <?= $b->jenis_kelamin == 'L' ? '#e0f2fe' : '#fce7f3'; ?>; display: flex; align-items: center; justify-content: center; font-size: 16px; margin-right: 12px; flex-shrink: 0;">
													<?= $b->jenis_kelamin == 'L' ? '👦' : '👧'; ?>
												</div>
												<div>
													<strong class="text-dark"><?= htmlspecialchars($b->nama_anak); ?></strong>
													<?php if (!empty($b->rfid_uid)): ?>
														<br><small class="text-muted">Kartu Anak: <code class="text-primary"><?= $b->rfid_uid; ?></code></small>
													<?php endif; ?>
												</div>
											</div>
										</td>
										<td>
											<span class="badge <?= $b->jenis_kelamin == 'L' ? 'badge-primary' : 'badge-pink'; ?>" style="font-size: 11px;">
												<?= $b->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan'; ?>
											</span>
										</td>
										<td>
											<?= date('d/m/Y', strtotime($b->tanggal_lahir)); ?>
											<br><small class="font-weight-bold text-info"><?= $usia; ?></small>
										</td>
										<td>
											<strong><?= htmlspecialchars($b->nama_ortu ?? 'Belum Ditautkan'); ?></strong>
											<br><small class="text-muted">NIK: <?= htmlspecialchars($b->nik_ortu ?? '-'); ?></small>
										</td>
										<td>
											<?php if (!empty($b->rfid_ktp_ibu)): ?>
												<span class="badge badge-success px-2 py-1 font-weight-bold" style="font-size: 11px;">
													<i class="fas fa-check-circle mr-1"></i> KTP Terhubung
												</span>
												<br><small class="text-muted font-monospace"><?= htmlspecialchars($b->rfid_ktp_ibu); ?></small>
											<?php else: ?>
												<button class="btn btn-sm btn-outline-warning py-1 px-2" onclick="openPairModalWithWarga('<?= $b->warga_id; ?>', '<?= htmlspecialchars($b->nama_ortu); ?>')">
													⚠️ Belum Ada KTP (Pair)
												</button>
											<?php endif; ?>
										</td>
										<td class="text-center">
											<div class="btn-group">
												<a href="<?= base_url('smartrt/posyandu_cetak_kms/' . $b->id); ?>" target="_blank" class="btn btn-sm btn-action-light py-1 px-2" title="Cetak Riwayat KMS">
													🖨️ KMS
												</a>
												<a href="<?= base_url('smartrt/posyandu_balita_hapus/' . $b->id); ?>" onclick="return confirm('Hapus balita ini beserta riwayatnya?')" class="btn btn-sm btn-outline-danger py-1 px-2" title="Hapus Balita">
													🗑️
												</a>
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- TAB 3: MANAJEMEN SESI POSYANDU -->
	<div id="tabSesi" class="tab-content-section" style="display: none;">
		<div class="content-card">
			<div class="content-card-header">
				<h5 class="font-weight-bold text-dark mb-0">Jadwal & Sesi Posyandu RT</h5>
				<button class="btn btn-action-primary btn-sm" data-toggle="modal" data-target="#modalTambahSesi">
					<i class="fas fa-plus-circle"></i> Buat Jadwal Sesi Baru
				</button>
			</div>

			<div class="card-body p-0">
				<?php if (empty($sesi_list)): ?>
					<div class="text-center py-5 text-muted">
						Belum ada jadwal sesi posyandu.
					</div>
				<?php else: ?>
					<div class="table-responsive">
						<table class="table table-modern table-hover mb-0">
							<thead>
								<tr>
									<th>Nama Sesi</th>
									<th>Tanggal & Waktu</th>
									<th>Lokasi</th>
									<th>Petugas / Bidan</th>
									<th>Status</th>
									<th class="text-center">Ubah Status</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($sesi_list as $s): ?>
									<tr>
										<td>
											<strong class="text-dark" style="font-size: 14px;"><?= htmlspecialchars($s->nama_sesi); ?></strong>
											<?php if ($s->catatan): ?>
												<br><small class="text-muted"><?= htmlspecialchars($s->catatan); ?></small>
											<?php endif; ?>
										</td>
										<td>
											<strong><?= date('d M Y', strtotime($s->tanggal)); ?></strong>
											<br><small class="text-muted"><?= substr($s->waktu_mulai, 0, 5); ?> - <?= $s->waktu_selesai ? substr($s->waktu_selesai, 0, 5) : 'Selesai'; ?> WIB</small>
										</td>
										<td><?= htmlspecialchars($s->lokasi); ?></td>
										<td><?= htmlspecialchars($s->petugas ?? '-'); ?></td>
										<td>
											<?php if ($s->status == 'Aktif'): ?>
												<span class="badge badge-success px-3 py-1 font-weight-bold">🟢 SEDANG AKTIF</span>
											<?php elseif ($s->status == 'Dijadwalkan'): ?>
												<span class="badge badge-info px-3 py-1 font-weight-bold">📅 Dijadwalkan</span>
											<?php else: ?>
												<span class="badge badge-secondary px-3 py-1">Selesai</span>
											<?php endif; ?>
										</td>
										<td class="text-center">
											<?php if ($s->status != 'Aktif'): ?>
												<a href="<?= base_url('smartrt/posyandu_sesi_status/' . $s->id . '/Aktif'); ?>" class="btn btn-sm btn-success px-3 py-1 font-weight-bold" style="border-radius: 8px;" onclick="return confirm('Jadikan sesi ini sebagai Sesi Aktif saat ini?')">
													▶️ Aktifkan
												</a>
											<?php else: ?>
												<a href="<?= base_url('smartrt/posyandu_sesi_status/' . $s->id . '/Selesai'); ?>" class="btn btn-sm btn-secondary px-3 py-1 font-weight-bold" style="border-radius: 8px;" onclick="return confirm('Tandai sesi ini Selesai?')">
													⏹️ Selesaikan Sesi
												</a>
											<?php endif; ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- TAB 4: FIRMWARE & WIRING NODEMCU ESP32 + RC522 -->
	<div id="tabEsp32" class="tab-content-section" style="display: none;">
		<div class="content-card mb-4">
			<div class="content-card-header">
				<div>
					<h5 class="font-weight-bold text-dark mb-0">⚡ Skema Wiring Pin NodeMCU ESP32 ke RFID MFRC522 (RC522)</h5>
					<small class="text-muted">Gunakan modul RFID MFRC522 13.56 MHz (Mendukung pembacaan UID e-KTP dan kartu Mifare).</small>
				</div>
			</div>
			<div class="card-body p-4">
				<div class="row">
					<div class="col-md-6 mb-3">
						<div class="table-responsive">
							<table class="table table-bordered table-sm mb-0">
								<thead class="bg-light font-weight-bold">
									<tr>
										<th>Pin RC522 (RFID)</th>
										<th>Pin NodeMCU ESP32</th>
										<th>Catatan / Keterangan</th>
									</tr>
								</thead>
								<tbody>
									<tr class="table-warning">
										<td><strong>3.3V (VCC)</strong></td>
										<td><strong>3V3 (3.3V)</strong></td>
										<td><strong class="text-danger">⚠️ JANGAN KE 5V! Dapat merusak modul.</strong></td>
									</tr>
									<tr>
										<td><strong>RST (Reset)</strong></td>
										<td><strong>GPIO 22 (D22)</strong></td>
										<td>Reset Pin</td>
									</tr>
									<tr>
										<td><strong>GND</strong></td>
										<td><strong>GND</strong></td>
										<td>Ground</td>
									</tr>
									<tr>
										<td><strong>MISO</strong></td>
										<td><strong>GPIO 19 (D19)</strong></td>
										<td>SPI Master In Slave Out</td>
									</tr>
									<tr>
										<td><strong>MOSI</strong></td>
										<td><strong>GPIO 23 (D23)</strong></td>
										<td>SPI Master Out Slave In</td>
									</tr>
									<tr>
										<td><strong>SCK</strong></td>
										<td><strong>GPIO 18 (D18)</strong></td>
										<td>SPI Serial Clock</td>
									</tr>
									<tr>
										<td><strong>SDA / SS</strong></td>
										<td><strong>GPIO 5 (D5)</strong></td>
										<td>SPI Slave Select</td>
									</tr>
									<tr class="table-info">
										<td>Buzzer (+)</td>
										<td>GPIO 4</td>
										<td>Buzzer beeps nada sukses / gagal</td>
									</tr>
									<tr class="table-success">
										<td>LED Hijau (+)</td>
										<td>GPIO 15</td>
										<td>Indikator Tap Berhasil</td>
									</tr>
									<tr class="table-danger">
										<td>LED Merah (+)</td>
										<td>GPIO 13</td>
										<td>Indikator Belum Terdaftar / Error</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<div class="col-md-6">
						<div class="alert alert-info border-0 shadow-sm" style="border-radius: 12px; background: #f0f9ff; color: #0369a1;">
							<h6 class="font-weight-bold"><i class="fas fa-info-circle mr-1"></i> Endpoint API Server:</h6>
							<p class="mb-2" style="font-size: 13px;">ESP32 akan mengirimkan HTTP POST/GET ke:</p>
							<code style="font-size: 12px; font-weight: bold; color: #0284c7; background: #fff; padding: 8px 12px; border-radius: 6px; display: block; margin-bottom: 10px; border: 1px solid #bae6fd;">
								<?= base_url('smartrt/posyandu_rfid_tap'); ?>
							</code>
							<small class="d-block" style="color: #475569;">
								• <strong>API Key:</strong> <code>kasrt2025</code><br>
								• <strong>Parameter:</strong> <code>uid=[HEX_UID]&api_key=kasrt2025</code><br>
								• <strong>Metode:</strong> POST atau GET via WiFi HTTPClient
							</small>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Arduino IDE Sketch Code -->
		<div class="content-card">
			<div class="content-card-header">
				<h5 class="font-weight-bold text-dark mb-0">💻 Source Code Arduino IDE (NodeMCU ESP32 + MFRC522)</h5>
				<div class="d-flex flex-wrap" style="gap: 8px;">
					<a href="<?= base_url('smartrt/download_firmware_ino'); ?>" class="btn btn-sm btn-success font-weight-bold shadow-sm" style="border-radius: 8px;">
						<i class="fas fa-file-code mr-1"></i> Download .ino
					</a>
					<a href="<?= base_url('smartrt/download_firmware_zip'); ?>" class="btn btn-sm btn-primary font-weight-bold shadow-sm" style="border-radius: 8px;">
						<i class="fas fa-file-archive mr-1"></i> Download .ZIP (Arduino IDE Ready)
					</a>
					<button class="btn btn-sm btn-dark font-weight-bold" onclick="copyArduinoCode()" style="border-radius: 8px;">
						<i class="fas fa-copy mr-1"></i> Salin Kode
					</button>
				</div>
			</div>
			<div class="card-body p-0">
				<div class="code-box">
<pre id="arduinoCode" style="margin: 0; color: inherit; font-family: inherit;"><!--
-->/*
 * =========================================================================
 * POSYANDU DIGITAL — NODEMCU ESP32 + MFRC522 RC522 (e-KTP IBU BALITA)
 * E-KASRT Sistem Informasi RT
 * =========================================================================
 * Library yang dibutuhkan (Install via Arduino Library Manager):
 * 1. MFRC522 by GithubCommunity
 * 2. ArduinoJson by Benoit Blanchon (opsional, parsing respons)
 * =========================================================================
 */

#include &lt;WiFi.h&gt;
#include &lt;HTTPClient.h&gt;
#include &lt;SPI.h&gt;
#include &lt;MFRC522.h&gt;

// ── Konfigurasi WiFi ──────────────────────────────────────────
const char* ssid     = "NAMA_WIFI_ANDA";
const char* password = "PASSWORD_WIFI";

// ── Konfigurasi Server E-KASRT ───────────────────────────────
// Ganti dengan IP komputer lokal Anda (misal: 10.246.16.194) atau domain VPS
const char* serverUrl = "<?= base_url('smartrt/posyandu_rfid_tap'); ?>";
const char* apiKey    = "kasrt2025";

// ── Pinout SPI RC522 ke NodeMCU ESP32 ─────────────────────────
#define SS_PIN    5   // SDA / SS
#define RST_PIN   22  // RST
#define BUZZER_PIN 4  // Buzzer (opsional)
#define LED_GREEN 15  // LED Hijau Sukses
#define LED_RED   13  // LED Merah Gagal

MFRC522 rfc(SS_PIN, RST_PIN);
unsigned long lastTapTime = 0;
String lastUid = "";

void soundSuccess() {
  digitalWrite(LED_GREEN, HIGH);
  tone(BUZZER_PIN, 2000, 100);
  delay(120);
  tone(BUZZER_PIN, 2500, 200);
  delay(250);
  digitalWrite(LED_GREEN, LOW);
}

void soundWarning() {
  digitalWrite(LED_RED, HIGH);
  tone(BUZZER_PIN, 800, 300);
  delay(350);
  digitalWrite(LED_RED, LOW);
}

void setup() {
  Serial.begin(115200);
  delay(1000);
  Serial.println("\n[POSYANDU DIGITAL] Memulai NodeMCU ESP32...");

  pinMode(BUZZER_PIN, OUTPUT);
  pinMode(LED_GREEN, OUTPUT);
  pinMode(LED_RED, OUTPUT);

  // Inisialisasi SPI & RC522
  SPI.begin();
  rfc.PCD_Init();
  rfc.PCD_DumpVersionToSerial();
  Serial.println("[RC522] RFID Scanner Siap. Silakan tempelkan e-KTP.");

  // Konek WiFi
  WiFi.begin(ssid, password);
  Serial.print("[WiFi] Menghubungkan ke ");
  Serial.println(ssid);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\n[WiFi] Terhubung! IP ESP32: " + WiFi.localIP().toString());
  soundSuccess();
}

void loop() {
  // Cek jika ada kartu e-KTP / RFID baru yang ditempelkan
  if (!rfc.PICC_IsNewCardPresent() || !rfc.PICC_ReadCardSerial()) {
    delay(50);
    return;
  }

  // Ambil UID kartu dalam format HEX kapital
  String uid = "";
  for (byte i = 0; i &lt; rfc.uid.size; i++) {
    if (rfc.uid.uidByte[i] &lt; 0x10) uid += "0";
    uid += String(rfc.uid.uidByte[i], HEX);
  }
  uid.toUpperCase();

  // Debounce 3 detik untuk kartu yang sama
  if (uid == lastUid && (millis() - lastTapTime &lt; 3000)) {
    rfc.PICC_HaltA();
    rfc.PCD_StopCrypto1();
    return;
  }

  lastUid = uid;
  lastTapTime = millis();

  Serial.println("\n-------------------------------------------");
  Serial.print("[e-KTP DETEKSI] UID: ");
  Serial.println(uid);

  // Kirim HTTP POST ke Backend E-KASRT
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(serverUrl);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    String postData = "api_key=" + String(apiKey) + "&uid=" + uid;
    int httpResponseCode = http.POST(postData);

    if (httpResponseCode &gt; 0) {
      String response = http.getString();
      Serial.print("[HTTP Status]: ");
      Serial.println(httpResponseCode);
      Serial.println("[Server Response]: " + response);

      if (httpResponseCode == 200) {
        soundSuccess();
      } else {
        soundWarning();
      }
    } else {
      Serial.print("[HTTP Error]: ");
      Serial.println(http.errorToString(httpResponseCode));
      soundWarning();
    }
    http.end();
  } else {
    Serial.println("[WiFi Error] Tidak terhubung ke jaringan!");
    soundWarning();
  }

  rfc.PICC_HaltA();
  rfc.PCD_StopCrypto1();
}
</pre>
				</div>
			</div>
		</div>
	</div>

</div>

<!-- MODAL: INPUT PEMERIKSAAN / TIMBANGAN BALITA -->
<div class="modal fade" id="modalPemeriksaan" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden;">
			<div class="modal-header bg-primary text-white py-3">
				<h5 class="modal-title font-weight-bold" id="modalPemeriksaanTitle">⚖️ Catat Pemeriksaan Tumbuh Kembang</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<form id="formPemeriksaan" method="post" action="">
				<div class="modal-body p-4">
					<div class="alert alert-light border mb-4 d-flex align-items-center">
						<div style="font-size: 32px; margin-right: 14px;">👶</div>
						<div>
							<h6 class="mb-0 font-weight-bold" id="pemeriksaanNamaAnak">-</h6>
							<small class="text-muted" id="pemeriksaanInfoOrtu">-</small>
						</div>
					</div>

					<div class="row">
						<div class="col-md-3 col-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Berat Badan (kg)</label>
							<div class="input-group">
								<input type="number" step="0.01" class="form-control" name="berat_badan" id="inputBB" placeholder="Contoh: 12.5" required oninput="calcStatusGizi()">
								<div class="input-group-append"><span class="input-group-text">kg</span></div>
							</div>
						</div>
						<div class="col-md-3 col-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Tinggi Badan (cm)</label>
							<div class="input-group">
								<input type="number" step="0.1" class="form-control" name="tinggi_badan" id="inputTB" placeholder="Contoh: 85.0" oninput="calcStatusGizi()">
								<div class="input-group-append"><span class="input-group-text">cm</span></div>
							</div>
						</div>
						<div class="col-md-3 col-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Lingkar Kepala (cm)</label>
							<div class="input-group">
								<input type="number" step="0.1" class="form-control" name="lingkar_kepala" id="inputLK" placeholder="Contoh: 46.5">
								<div class="input-group-append"><span class="input-group-text">cm</span></div>
							</div>
						</div>
						<div class="col-md-3 col-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">LiLA / Lengan (cm)</label>
							<div class="input-group">
								<input type="number" step="0.1" class="form-control" name="lila" id="inputLiLA" placeholder="Contoh: 14.0">
								<div class="input-group-append"><span class="input-group-text">cm</span></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Status Gizi</label>
							<select name="status_gizi" id="inputStatusGizi" class="form-control" required>
								<option value="Normal">🟢 Normal (Gizi Baik)</option>
								<option value="Kurang">🟡 Kurang</option>
								<option value="Buruk">🔴 Buruk</option>
								<option value="Lebih">🔵 Berisiko Lebih</option>
							</select>
						</div>
						<div class="col-md-4 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Vitamin A</label>
							<select name="vitamin_a" id="inputVitA" class="form-control">
								<option value="Tidak">Tidak Diberikan</option>
								<option value="Kapsul Biru (6-11 bln)">Kapsul Biru (6-11 bln)</option>
								<option value="Kapsul Merah (12-59 bln)">Kapsul Merah (12-59 bln)</option>
							</select>
						</div>
						<div class="col-md-4 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Obat Cacing</label>
							<select name="obat_cacing" id="inputObatCacing" class="form-control">
								<option value="Tidak">Tidak</option>
								<option value="Ya">Ya (Diberikan)</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Imunisasi yang Diberikan Hari Ini</label>
							<input type="text" class="form-control" name="imunisasi" id="inputImunisasi" placeholder="Misal: DPT 3, Polio 4, Campak...">
						</div>
						<div class="col-md-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Catatan Kader / Petugas</label>
							<input type="text" class="form-control" name="catatan" id="inputCatatan" placeholder="Keluhan, perkembangan, atau saran bidan...">
						</div>
					</div>
				</div>
				<div class="modal-footer bg-light py-2">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary btn-sm font-weight-bold px-4">💾 Simpan Pemeriksaan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL: QUICK PAIRING E-KTP KE IBU -->
<div class="modal fade" id="modalPairKtp" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 16px; border: none;">
			<div class="modal-header bg-info text-white py-3">
				<h5 class="modal-title font-weight-bold">🪪 Hubungkan e-KTP Baru ke Ibu Warga</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<form method="post" action="<?= base_url('smartrt/posyandu_pair_ktp'); ?>">
				<div class="modal-body p-4">
					<p class="text-muted" style="font-size: 13px;">
						Setiap ibu balita memiliki nomor kartu e-KTP (UID RFID). Hubungkan kartu tersebut dengan memilih nama ibu warga di bawah ini.
					</p>

					<div class="form-group mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">Nomor UID e-KTP (HEX)</label>
						<div class="input-group">
							<input type="text" class="form-control font-monospace font-weight-bold" name="rfid_uid" id="pairRfidUid" placeholder="Contoh: A1B2C3D4" required>
							<div class="input-group-append">
								<button type="button" class="btn btn-outline-secondary btn-sm" onclick="pasteLastUid()" title="Gunakan UID dari tap terakhir">
									Gunakan Tap Terakhir
								</button>
							</div>
						</div>
						<small class="text-muted">UID otomatis terisi jika ada kartu KTP baru yang ditempelkan di sensor.</small>
					</div>

					<div class="form-group mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">Pilih Ibu Warga</label>
						<select name="warga_id" id="pairWargaId" class="form-control" required style="font-size: 13px;">
							<option value="">-- Pilih Nama Ibu Warga --</option>
							<?php foreach ($warga_list as $w): ?>
								<option value="<?= $w->idWarga; ?>">
									<?= htmlspecialchars($w->nama); ?> (NIK: <?= $w->nik; ?><?= $w->rfid_ktp ? ' | e-KTP: ' . $w->rfid_ktp : ''; ?>)
								</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="modal-footer bg-light py-2">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-info btn-sm font-weight-bold px-4">🔗 Simpan & Hubungkan KTP</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL: DAFTAR BALITA BARU -->
<div class="modal fade" id="modalTambahBalita" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 16px; border: none;">
			<div class="modal-header bg-success text-white py-3">
				<h5 class="modal-title font-weight-bold">👶 Daftarkan Balita Baru</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<form method="post" action="<?= base_url('smartrt/posyandu_balita_tambah'); ?>">
				<div class="modal-body p-4">
					<div class="form-group mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">Nama Lengkap Anak</label>
						<input type="text" class="form-control" name="nama_anak" placeholder="Nama lengkap balita..." required>
					</div>

					<div class="row">
						<div class="col-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Tanggal Lahir</label>
							<input type="date" class="form-control" name="tanggal_lahir" required>
						</div>
						<div class="col-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Jenis Kelamin</label>
							<select name="jenis_kelamin" class="form-control" required>
								<option value="L">👦 Laki-Laki</option>
								<option value="P">👧 Perempuan</option>
							</select>
						</div>
					</div>

					<div class="form-group mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">Nama Ibu (Warga RT)</label>
						<select name="warga_id" class="form-control" required style="font-size: 13px;">
							<option value="">-- Pilih Orang Tua / Ibu --</option>
							<?php foreach ($warga_list as $w): ?>
								<option value="<?= $w->idWarga; ?>">
									<?= htmlspecialchars($w->nama); ?> (NIK: <?= $w->nik; ?>)
								</option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group mb-0">
						<label class="font-weight-bold" style="font-size: 13px;">UID RFID Khusus Anak (Opsional)</label>
						<input type="text" class="form-control font-monospace" name="rfid_uid" placeholder="Kosongkan jika absen menggunakan KTP Ibu">
						<small class="text-muted">Jika diisi, balita bisa absen pakai kartu KIA/kartu sendiri selain KTP ibu.</small>
					</div>
				</div>
				<div class="modal-footer bg-light py-2">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-success btn-sm font-weight-bold px-4">➕ Daftarkan Balita</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL: BUAT SESI POSYANDU BARU -->
<div class="modal fade" id="modalTambahSesi" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 16px; border: none;">
			<div class="modal-header bg-primary text-white py-3">
				<h5 class="modal-title font-weight-bold">📅 Buat Jadwal Sesi Posyandu</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<form method="post" action="<?= base_url('smartrt/posyandu_sesi_tambah'); ?>">
				<div class="modal-body p-4">
					<div class="form-group mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">Nama Sesi</label>
						<input type="text" class="form-control" name="nama_sesi" placeholder="Contoh: Posyandu Balita November 2026" required value="Posyandu Balita <?= date('F Y'); ?>">
					</div>

					<div class="row">
						<div class="col-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Tanggal Pelaksanaan</label>
							<input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d'); ?>" required>
						</div>
						<div class="col-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Jam Mulai</label>
							<input type="time" class="form-control" name="waktu_mulai" value="08:00" required>
						</div>
					</div>

					<div class="row">
						<div class="col-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Lokasi</label>
							<input type="text" class="form-control" name="lokasi" value="Balai Warga RT" required>
						</div>
						<div class="col-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Bidan / Petugas</label>
							<input type="text" class="form-control" name="petugas" placeholder="Nama Bidan / Kader">
						</div>
					</div>

					<div class="form-group mb-0">
						<label class="font-weight-bold" style="font-size: 13px;">Catatan (Opsional)</label>
						<textarea class="form-control" name="catatan" rows="2" placeholder="Catatan kegiatan..."></textarea>
					</div>
				</div>
				<div class="modal-footer bg-light py-2">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary btn-sm font-weight-bold px-4">💾 Simpan Jadwal</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL: ABSEN MANUAL (JIKA TIDAK BAWA KTP) -->
<?php if ($sesi_aktif): ?>
<div class="modal fade" id="modalHadirManual" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 16px; border: none;">
			<div class="modal-header bg-dark text-white py-3">
				<h5 class="modal-title font-weight-bold">✍️ Absen Kehadiran Balita Manual</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<form method="post" action="<?= base_url('smartrt/posyandu_hadir_manual'); ?>">
				<input type="hidden" name="sesi_id" value="<?= $sesi_aktif->id; ?>">
				<div class="modal-body p-4">
					<div class="form-group mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">Pilih Balita</label>
						<select name="balita_id" class="form-control" required style="font-size: 13px;">
							<option value="">-- Pilih Balita --</option>
							<?php foreach ($balita_list as $b): ?>
								<option value="<?= $b->id; ?>">
									<?= htmlspecialchars($b->nama_anak); ?> (Ibu: <?= htmlspecialchars($b->nama_ortu ?? '-'); ?>)
								</option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="row">
						<div class="col-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Berat Badan (kg)</label>
							<input type="number" step="0.01" class="form-control" name="berat_badan" placeholder="BB awal...">
						</div>
						<div class="col-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Tinggi Badan (cm)</label>
							<input type="number" step="0.1" class="form-control" name="tinggi_badan" placeholder="TB awal...">
						</div>
					</div>
				</div>
				<div class="modal-footer bg-light py-2">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary btn-sm font-weight-bold px-4">Catat Hadir</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php endif; ?>

<script>
// ── Web Audio Chime Synth untuk Tap RFID ──────────────────────
let audioCtx = null;
let soundEnabled = true;

function unlockAudio() {
	try {
		if (!audioCtx) {
			audioCtx = new (window.AudioContext || window.webkitAudioContext)();
		}
		if (audioCtx && audioCtx.state === 'suspended') {
			audioCtx.resume();
		}
	} catch (e) { console.log(e); }
}
['click', 'keydown', 'touchstart'].forEach(evt => document.addEventListener(evt, unlockAudio, { once: false }));

function speakVoice(text) {
	if (!soundEnabled || !('speechSynthesis' in window)) return;
	try {
		window.speechSynthesis.cancel();
		const u = new SpeechSynthesisUtterance(text);
		u.lang = 'id-ID';
		u.rate = 1.05;
		u.pitch = 1.0;
		window.speechSynthesis.speak(u);
	} catch (e) {
		console.log(e);
	}
}

function playChime(success = true) {
	if (!soundEnabled) return;
	try {
		unlockAudio();
		if (!audioCtx) return;

		const now = audioCtx.currentTime;
		const osc = audioCtx.createOscillator();
		const gain = audioCtx.createGain();
		osc.connect(gain);
		gain.connect(audioCtx.destination);

		if (success) {
			// Nada gembira naik (chime dua nada ting-tong ceria)
			osc.type = 'sine';
			osc.frequency.setValueAtTime(659.25, now); // E5
			osc.frequency.setValueAtTime(987.77, now + 0.12); // B5
			gain.gain.setValueAtTime(0.4, now);
			gain.gain.exponentialRampToValueAtTime(0.001, now + 0.5);
			osc.start(now);
			osc.stop(now + 0.5);
		} else {
			// Nada peringatan (tut-tut)
			osc.type = 'triangle';
			osc.frequency.setValueAtTime(440.00, now); // A4
			osc.frequency.setValueAtTime(349.23, now + 0.14); // F4
			gain.gain.setValueAtTime(0.35, now);
			gain.gain.exponentialRampToValueAtTime(0.001, now + 0.4);
			osc.start(now);
			osc.stop(now + 0.4);
		}
	} catch (e) {
		console.log('Audio disabled or not allowed yet:', e);
	}
}

document.getElementById('toggleAudioBtn').addEventListener('click', function() {
	unlockAudio();
	soundEnabled = !soundEnabled;
	this.innerText = soundEnabled ? '🔊 Audio: ON' : '🔇 Audio: OFF';
	if (soundEnabled) {
		playChime(true);
		speakVoice("Suara audio aktif");
	}
});

// ── Tab Switcher ─────────────────────────────────────────────
function switchTab(tabId, el) {
	document.querySelectorAll('.tab-content-section').forEach(t => t.style.display = 'none');
	document.querySelectorAll('.posyandu-nav-tabs .nav-link-item').forEach(l => l.classList.remove('active'));
	document.getElementById(tabId).style.display = 'block';
	if (el) el.classList.add('active');
}

// ── Modal Pemeriksaan ────────────────────────────────────────
function openModalPemeriksaan(k) {
	document.getElementById('formPemeriksaan').action = '<?= base_url('smartrt/posyandu_update_pemeriksaan/'); ?>' + k.id;
	document.getElementById('pemeriksaanNamaAnak').innerText = k.nama_anak + ' (' + (k.jenis_kelamin == 'L' ? 'Laki-Laki 👦' : 'Perempuan 👧') + ')';
	document.getElementById('pemeriksaanInfoOrtu').innerText = 'Ibu: ' + (k.nama_ortu || '-') + ' | Hadir: ' + k.jam_datang.substring(11, 16) + ' WIB';

	document.getElementById('inputBB').value = k.berat_badan || '';
	document.getElementById('inputTB').value = k.tinggi_badan || '';
	document.getElementById('inputLK').value = k.lingkar_kepala || '';
	document.getElementById('inputLiLA').value = k.lila || '';
	document.getElementById('inputStatusGizi').value = k.status_gizi || 'Normal';
	document.getElementById('inputVitA').value = k.vitamin_a || 'Tidak';
	document.getElementById('inputObatCacing').value = k.obat_cacing || 'Tidak';
	document.getElementById('inputImunisasi').value = k.imunisasi || '';
	document.getElementById('inputCatatan').value = k.catatan || '';

	$('#modalPemeriksaan').modal('show');
}

function calcStatusGizi() {
	const bb = parseFloat(document.getElementById('inputBB').value);
	const tb = parseFloat(document.getElementById('inputTB').value);
	const sel = document.getElementById('inputStatusGizi');
	if (bb && tb) {
		const imt = bb / ((tb / 100) * (tb / 100));
		if (imt < 13.5) sel.value = 'Buruk';
		else if (imt < 15.0) sel.value = 'Kurang';
		else if (imt <= 18.5) sel.value = 'Normal';
		else sel.value = 'Lebih';
	}
}

// ── Quick Pairing Helpers ────────────────────────────────────
let currentLastUid = '';

function openPairModalWithWarga(wargaId, namaWarga, uid) {
	$('#modalPairKtp').modal('show');
	if (wargaId) document.getElementById('pairWargaId').value = wargaId;
	if (uid) document.getElementById('pairRfidUid').value = uid;
	else if (currentLastUid) document.getElementById('pairRfidUid').value = currentLastUid;
}

function pasteLastUid() {
	if (currentLastUid) {
		document.getElementById('pairRfidUid').value = currentLastUid;
	} else {
		alert('Belum ada kartu e-KTP baru yang di-tap.');
	}
}

function copyArduinoCode() {
	const code = document.getElementById('arduinoCode').innerText;
	navigator.clipboard.writeText(code).then(() => {
		alert('Kode program Arduino berhasil disalin ke clipboard!');
	});
}

// ── Realtime Tap Radar Polling ────────────────────────────────
let lastSeenTapId = 0;

function fetchLiveStream() {
	fetch('<?= base_url('smartrt/posyandu_live_stream'); ?>')
		.then(r => r.json())
		.then(data => {
			if (data.total_hadir !== undefined) {
				const badge = document.getElementById('tabHadirBadge');
				const stat = document.getElementById('statHadirNum');
				if (badge) badge.innerText = data.total_hadir;
				if (stat) stat.innerText = data.total_hadir;
			}

			if (data.logs && data.logs.length > 0) {
				const top = data.logs[0];
				currentLastUid = top.uid;

				// Jika ada tap baru yang belum pernah diproses
				if (top.id > lastSeenTapId) {
					if (lastSeenTapId !== 0) {
						// Bunyikan nada & Suara
						if (top.status === 'SUCCESS') {
							playChime(true);
							speakVoice("Selamat datang! " + (top.keterangan || "Kehadiran balita tercatat."));
							setTimeout(() => { window.location.reload(); }, 2000);
						} else if (top.status === 'ALREADY_CHECKED') {
							playChime(false);
							speakVoice(top.keterangan || "Kartu ini sudah tercatat hadir.");
						} else if (top.status === 'UNREGISTERED') {
							playChime(false);
							speakVoice("Kartu e-KTP baru terdeteksi dengan nomor " + top.uid + ". Silakan pilih nama warga pemilik kartu.");
							openPairModalWithWarga(null, null, top.uid);
						}
					}
					lastSeenTapId = top.id;
				}

				// Update Box Visual Kartu
				document.getElementById('lastTapUid').innerText = top.uid;
				document.getElementById('lastTapTime').innerText = top.created_at.substring(11, 16) + ' WIB';

				const statusBadge = document.getElementById('lastTapStatusBadge');
				const namaEl = document.getElementById('lastTapNama');
				const detailEl = document.getElementById('lastTapDetail');
				const iconEl = document.getElementById('lastTapIcon');

				if (top.status === 'SUCCESS') {
					statusBadge.className = 'badge badge-success font-weight-bold';
					statusBadge.innerText = '✅ Berhasil Hadir';
					iconEl.innerText = '🎉';
					namaEl.innerText = top.keterangan || 'Balita Hadir';
					detailEl.innerText = 'Absensi via e-KTP Ibu tercatat';
				} else if (top.status === 'ALREADY_CHECKED') {
					statusBadge.className = 'badge badge-warning font-weight-bold text-dark';
					statusBadge.innerText = '⚠️ Sudah Hadir';
					iconEl.innerText = 'ℹ️';
					namaEl.innerText = top.keterangan || 'Sudah Hadir';
					detailEl.innerText = 'Kartu sudah di-tap sebelumnya';
				} else if (top.status === 'UNREGISTERED') {
					statusBadge.className = 'badge badge-danger font-weight-bold';
					statusBadge.innerText = '🔔 KTP Baru (Belum Terdaftar)';
					iconEl.innerText = '🪪';
					namaEl.innerHTML = 'KTP Baru: <span class="font-monospace text-primary">' + top.uid + '</span>';
					detailEl.innerHTML = '<a href="javascript:void(0)" onclick="openPairModalWithWarga(null, null, \'' + top.uid + '\')" class="text-primary font-weight-bold"><u>Klik di sini untuk hubungkan ke data Ibu</u></a>';
				} else {
					statusBadge.className = 'badge badge-secondary';
					statusBadge.innerText = top.status;
					iconEl.innerText = '💳';
					namaEl.innerText = top.keterangan || 'Menunggu Sesi Aktif';
					detailEl.innerText = top.uid;
				}
			}
		})
		.catch(err => console.log('Polling error:', err));
}

function testSimulasiTap() {
	unlockAudio();
	var uid = prompt("🧪 TEST SIMULASI TAP e-KTP / RFID\n\nMasukkan nomor kartu UID yang ingin ditest:\n(Misal: 99AA88BB atau coba nomor baru acak seperti 11223344)", "99AA88BB");
	if (!uid) return;
	fetch("<?= base_url('smartrt/posyandu_rfid_tap'); ?>", {
		method: "POST",
		headers: { "Content-Type": "application/x-www-form-urlencoded" },
		body: "api_key=kasrt2025&uid=" + encodeURIComponent(uid.trim())
	})
	.then(r => r.json())
	.then(res => {
		unlockAudio();
		if (res.status === 'success') {
			playChime(true);
			speakVoice("Selamat datang! " + res.message);
		} else if (res.status === 'already_checked') {
			playChime(false);
			speakVoice(res.message);
		} else if (res.status === 'unregistered') {
			playChime(false);
			speakVoice("Kartu e-KTP baru belum terdaftar. Menampilkan jendela pendaftaran warga.");
			openPairModalWithWarga(null, null, uid.trim().toUpperCase());
		} else {
			playChime(false);
			speakVoice(res.message);
		}
		fetchLiveStream();
	})
	.catch(err => {
		alert("❌ Gagal mengirim: " + err);
	});
}

// Jalankan polling setiap 2.5 detik
setInterval(fetchLiveStream, 2500);
fetchLiveStream();
</script>
