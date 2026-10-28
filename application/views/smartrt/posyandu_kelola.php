<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap');

.posyandu-container {
	font-family: 'Plus Jakarta Sans', sans-serif;
	color: #0f172a;
}

/* Stat Cards Modern */
.stat-box {
	background: #ffffff;
	border-radius: 16px;
	padding: 22px 24px;
	border: 1px solid #e2e8f0;
	box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05);
	position: relative;
	overflow: hidden;
	transition: all 0.25s ease;
}
.stat-box:hover {
	transform: translateY(-3px);
	box-shadow: 0 12px 28px -4px rgba(0, 0, 0, 0.09);
}
.stat-box .glow-dot {
	position: absolute;
	top: -24px;
	right: -24px;
	width: 90px;
	height: 90px;
	border-radius: 50%;
	opacity: 0.12;
}
.stat-box.cyan .glow-dot { background: #06b6d4; }
.stat-box.emerald .glow-dot { background: #10b981; }
.stat-box.indigo .glow-dot { background: #6366f1; }
.stat-box.amber .glow-dot { background: #f59e0b; }

.stat-icon-wrap {
	width: 48px;
	height: 48px;
	border-radius: 12px;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 22px;
	margin-bottom: 14px;
}
.stat-box.cyan .stat-icon-wrap { background: #ecfeff; color: #0891b2; }
.stat-box.emerald .stat-icon-wrap { background: #ecfdf5; color: #059669; }
.stat-box.indigo .stat-icon-wrap { background: #eef2ff; color: #4f46e5; }
.stat-box.amber .stat-icon-wrap { background: #fffbeb; color: #d97706; }

.stat-num {
	font-size: 30px;
	font-weight: 800;
	line-height: 1.1;
	letter-spacing: -0.5px;
	color: #0f172a;
}
.stat-label {
	font-size: 13px;
	font-weight: 600;
	color: #64748b;
	margin-top: 4px;
	text-transform: uppercase;
	letter-spacing: 0.5px;
}

/* Live Scanner Monitor Widget */
.scanner-banner {
	background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
	border-radius: 18px;
	padding: 24px 28px;
	color: #ffffff;
	border: 1px solid rgba(255, 255, 255, 0.1);
	box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.4);
	margin-bottom: 28px;
}

.radar-pulse {
	width: 14px;
	height: 14px;
	background: #22c55e;
	border-radius: 50%;
	display: inline-block;
	box-shadow: 0 0 0 rgba(34, 197, 94, 0.7);
	animation: pulse-ring 1.8s infinite;
}
@keyframes pulse-ring {
	0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
	70% { box-shadow: 0 0 0 12px rgba(34, 197, 94, 0); }
	100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
}

.ktp-card-visual {
	background: linear-gradient(135deg, #1e3a8a 0%, #0284c7 100%);
	border-radius: 12px;
	padding: 16px 20px;
	color: #fff;
	box-shadow: 0 8px 24px rgba(2, 132, 199, 0.3);
	border: 1px solid rgba(255,255,255,0.2);
	position: relative;
	overflow: hidden;
}
.ktp-card-visual::after {
	content: 'REPUBLIK INDONESIA';
	position: absolute;
	right: -10px;
	bottom: -8px;
	font-size: 18px;
	font-weight: 900;
	color: rgba(255,255,255,0.06);
	letter-spacing: 2px;
	pointer-events: none;
}

/* Nav Tabs Modern */
.modern-tab-nav {
	display: flex;
	gap: 10px;
	margin-bottom: 24px;
	border-bottom: 2px solid #e2e8f0;
	padding-bottom: 12px;
	flex-wrap: wrap;
}
.modern-tab-nav .nav-link-item {
	padding: 10px 22px;
	border-radius: 10px;
	font-weight: 700;
	font-size: 14px;
	color: #64748b;
	background: #f1f5f9;
	border: 1px solid transparent;
	cursor: pointer;
	text-decoration: none;
	display: inline-flex;
	align-items: center;
	gap: 8px;
	transition: all 0.2s ease;
}
.modern-tab-nav .nav-link-item:hover {
	background: #e2e8f0;
	color: #0f172a;
}
.modern-tab-nav .nav-link-item.active {
	background: #0284c7;
	color: #ffffff;
	border-color: #0284c7;
	box-shadow: 0 4px 14px rgba(2, 132, 199, 0.3);
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
	padding: 14px 16px;
	border-top: 1px solid #e2e8f0;
	border-bottom: 2px solid #e2e8f0;
}
.table-modern tbody tr {
	transition: background 0.15s ease;
}
.table-modern tbody tr:hover {
	background: #f8fafc;
}
.table-modern tbody td {
	padding: 16px;
	vertical-align: middle;
	border-bottom: 1px solid #f1f5f9;
	font-size: 13px;
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

	<!-- Header Posyandu Digital -->
	<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 pb-2 border-bottom">
		<div>
			<div class="d-flex align-items-center gap-2 mb-1">
				<span class="badge badge-primary px-3 py-1 font-weight-bold" style="border-radius: 20px; font-size: 12px;">
					IoT SMART RT v2.0
				</span>
				<span class="text-muted" style="font-size: 13px;">• NodeMCU ESP32 + MFRC522 RC522</span>
			</div>
			<h2 class="font-weight-bold text-dark mb-0">Posyandu Balita Digital</h2>
			<p class="text-muted mb-0" style="font-size: 14px;">
				Absensi kehadiran balita otomatis dengan tap <strong>e-KTP Ibu Balita</strong> via scanner RFID.
			</p>
		</div>
		<div class="mt-3 mt-md-0 d-flex gap-2">
			<?php if ($sesi_aktif): ?>
				<a href="#modalHadirManual" data-toggle="modal" class="btn btn-outline-primary btn-sm px-3 py-2 font-weight-bold" style="border-radius: 10px;">
					✍️ Absen Balita Manual
				</a>
			<?php endif; ?>
			<a href="#modalTambahSesi" data-toggle="modal" class="btn btn-primary btn-sm px-3 py-2 font-weight-bold" style="border-radius: 10px;">
				➕ Buat Sesi Posyandu
			</a>
		</div>
	</div>

	<!-- Live Scanner Monitor Widget (ESP32 Live Radar) -->
	<div class="scanner-banner">
		<div class="row align-items-center">
			<div class="col-lg-7 mb-3 mb-lg-0">
				<div class="d-flex align-items-center mb-2">
					<span class="radar-pulse mr-2"></span>
					<span class="text-success font-weight-bold text-uppercase" style="font-size: 12px; letter-spacing: 1px;">
						Scanner NodeMCU ESP32 Active & Listening
					</span>
					<span class="badge badge-dark ml-2 text-white-50" id="livePingBadge">Live Polling</span>
					<button id="toggleAudioBtn" class="btn btn-sm btn-outline-light ml-3 py-0 px-2" style="font-size: 11px; border-radius: 6px;" title="Aktifkan Bunyi Beep saat KTP di-tap">
						🔊 Audio: ON
					</button>
				</div>
				<h4 class="font-weight-bold text-white mb-2" id="scannerStatusTitle">
					<?php if ($sesi_aktif): ?>
						Sesi: <?= htmlspecialchars($sesi_aktif->nama_sesi); ?>
					<?php else: ?>
						Belum Ada Sesi Posyandu yang Berstatus "Aktif"
					<?php endif; ?>
				</h4>
				<p class="text-white-50 mb-0" style="font-size: 13px;" id="scannerStatusDesc">
					<?php if ($sesi_aktif): ?>
						Ibu balita dapat langsung menempelkan e-KTP ke sensor RC522. Balita milik ibu akan otomatis tercatat hadir.
					<?php else: ?>
						Silakan aktifkan salah satu jadwal sesi posyandu di tab "Manajemen Sesi" agar mesin RFID dapat mulai menerima absensi.
					<?php endif; ?>
				</p>
			</div>

			<div class="col-lg-5">
				<div class="ktp-card-visual" id="lastTapBox">
					<div class="d-flex justify-content-between align-items-start mb-2">
						<span style="font-size: 11px; font-weight: 700; opacity: 0.8; letter-spacing: 1px;">
							RADAR TAP e-KTP IBU TERAKHIR
						</span>
						<span class="badge badge-light text-dark font-weight-bold" id="lastTapStatusBadge" style="font-size: 11px;">
							Standby
						</span>
					</div>
					<div class="d-flex align-items-center gap-3">
						<div style="font-size: 32px;" id="lastTapIcon">💳</div>
						<div>
							<h5 class="font-weight-bold text-white mb-0" id="lastTapNama">
								Menunggu Tap Kartu...
							</h5>
							<small class="text-white-50" id="lastTapDetail">
								Tempelkan e-KTP di alat reader
							</small>
						</div>
					</div>
					<div class="mt-2 pt-2 border-top border-white-50 d-flex justify-content-between align-items-center" style="font-size: 11px; opacity: 0.85;">
						<span>UID Kartu: <strong class="font-monospace" id="lastTapUid">-</strong></span>
						<span id="lastTapTime">-</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 4 Stat Cards Modern -->
	<div class="row mb-4">
		<div class="col-md-3 col-sm-6 mb-3">
			<div class="stat-box cyan">
				<div class="glow-dot"></div>
				<div class="stat-icon-wrap">👶</div>
				<div class="stat-num"><?= $total_balita; ?></div>
				<div class="stat-label">Total Balita Terdaftar</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 mb-3">
			<div class="stat-box emerald">
				<div class="glow-dot"></div>
				<div class="stat-icon-wrap">🪪</div>
				<div class="stat-num"><?= $total_ktp_ibu; ?></div>
				<div class="stat-label">e-KTP Ibu Terhubung</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 mb-3">
			<div class="stat-box indigo">
				<div class="glow-dot"></div>
				<div class="stat-icon-wrap">✅</div>
				<div class="stat-num" id="statHadirNum"><?= $total_hadir; ?></div>
				<div class="stat-label">Balita Hadir (Sesi Ini)</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 mb-3">
			<div class="stat-box amber">
				<div class="glow-dot"></div>
				<div class="stat-icon-wrap">📅</div>
				<div class="stat-num"><?= count($sesi_list); ?></div>
				<div class="stat-label">Total Sesi Terjadwal</div>
			</div>
		</div>
	</div>

	<!-- Navigation Tabs -->
	<div class="modern-tab-nav">
		<a href="javascript:void(0)" class="nav-link-item active" onclick="switchTab('tabKehadiran', this)">
			<span>📋</span> Kehadiran & Pemeriksaan
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
			<span>⚡</span> Firmware & Wiring NodeMCU ESP32
		</a>
	</div>

	<!-- TAB 1: KEHADIRAN & PEMERIKSAAN SESI AKTIF -->
	<div id="tabKehadiran" class="tab-content-section">
		<div class="card border-0 shadow-sm" style="border-radius: 16px;">
			<div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center">
				<div>
					<h5 class="font-weight-bold text-dark mb-0">
						Kehadiran Balita & Data Tumbuh Kembang
					</h5>
					<small class="text-muted">
						<?php if ($sesi_aktif): ?>
							Sesi Aktif: <strong><?= htmlspecialchars($sesi_aktif->nama_sesi); ?></strong> (<?= date('d M Y', strtotime($sesi_aktif->tanggal)); ?>)
						<?php else: ?>
							<span class="text-danger">Tidak ada sesi aktif saat ini</span>
						<?php endif; ?>
					</small>
				</div>
				<div class="mt-2 mt-md-0 d-flex gap-2">
					<button onclick="fetchLiveStream()" class="btn btn-outline-secondary btn-sm" style="border-radius: 8px;">
						🔄 Refresh Data
					</button>
					<a href="#modalPairKtp" data-toggle="modal" class="btn btn-outline-info btn-sm font-weight-bold" style="border-radius: 8px;">
						🪪 Hubungkan KTP Baru
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
												<div style="width: 40px; height: 40px; border-radius: 10px; background: <?= $k->jenis_kelamin == 'L' ? '#e0f2fe' : '#fce7f3'; ?>; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-right: 12px;">
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
											<span class="badge badge-light text-dark font-weight-bold" style="font-size: 12px;">
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
													if ($k->status_gizi == 'Kurang') $badge_cls = 'badge-warning';
													if ($k->status_gizi == 'Buruk')  $badge_cls = 'badge-danger';
													if ($k->status_gizi == 'Lebih')  $badge_cls = 'badge-info';
												?>
												<span class="badge <?= $badge_cls; ?> px-2 py-1" style="font-size: 11px;"><?= $k->status_gizi; ?></span>
											<?php else: ?>
												<span class="badge badge-secondary px-2 py-1" style="font-size: 11px;">Belum Diukur</span>
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
												<button type="button" class="btn btn-sm btn-primary" onclick="openModalPemeriksaan(<?= htmlspecialchars(json_encode($k)); ?>)" title="Isi Pengukuran Timbangan">
													⚖️ Periksa
												</button>
												<a href="<?= base_url('smartrt/posyandu_cetak_kms/' . $k->balita_id); ?>" target="_blank" class="btn btn-sm btn-outline-secondary" title="Cetak KMS Balita">
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
		<div class="card border-0 shadow-sm" style="border-radius: 16px;">
			<div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
				<div>
					<h5 class="font-weight-bold text-dark mb-0">Daftar Balita & Status e-KTP Ibu</h5>
					<small class="text-muted">Total terdaftar: <strong><?= count($balita_list); ?> balita</strong></small>
				</div>
				<button class="btn btn-success btn-sm font-weight-bold px-3 py-2" data-toggle="modal" data-target="#modalTambahBalita" style="border-radius: 8px;">
					➕ Daftarkan Balita Baru
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
												<div style="width: 38px; height: 38px; border-radius: 10px; background: <?= $b->jenis_kelamin == 'L' ? '#e0f2fe' : '#fce7f3'; ?>; display: flex; align-items: center; justify-content: center; font-size: 16px; margin-right: 12px;">
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
												<button class="btn btn-sm btn-outline-warning py-0 px-2" onclick="openPairModalWithWarga('<?= $b->warga_id; ?>', '<?= htmlspecialchars($b->nama_ortu); ?>')">
													⚠️ Belum Ada KTP (Pair)
												</button>
											<?php endif; ?>
										</td>
										<td class="text-center">
											<div class="btn-group">
												<a href="<?= base_url('smartrt/posyandu_cetak_kms/' . $b->id); ?>" target="_blank" class="btn btn-sm btn-outline-primary" title="Cetak Riwayat KMS">
													🖨️ KMS
												</a>
												<a href="<?= base_url('smartrt/posyandu_balita_hapus/' . $b->id); ?>" onclick="return confirm('Hapus balita ini beserta riwayatnya?')" class="btn btn-sm btn-outline-danger" title="Hapus Balita">
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
		<div class="card border-0 shadow-sm" style="border-radius: 16px;">
			<div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
				<h5 class="font-weight-bold text-dark mb-0">Jadwal & Sesi Posyandu RT</h5>
				<button class="btn btn-primary btn-sm font-weight-bold px-3 py-2" data-toggle="modal" data-target="#modalTambahSesi" style="border-radius: 8px;">
					➕ Buat Jadwal Sesi Baru
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
		<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
			<div class="card-header bg-white py-3 border-bottom">
				<h5 class="font-weight-bold text-dark mb-0">⚡ Skema Wiring Pin NodeMCU ESP32 ke RFID MFRC522 (RC522)</h5>
				<small class="text-muted">Gunakan modul RFID MFRC522 13.56 MHz (Mendukung pembacaan UID e-KTP dan kartu Mifare).</small>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6 mb-3">
						<div class="table-responsive">
							<table class="table table-bordered table-sm">
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
						<div class="alert alert-info" style="border-radius: 12px;">
							<h6 class="font-weight-bold"><i class="fas fa-info-circle mr-1"></i> Endpoint API Server:</h6>
							<p class="mb-2" style="font-size: 13px;">ESP32 akan mengirimkan HTTP POST/GET ke:</p>
							<code style="font-size: 13px; font-weight: bold; color: #0284c7; background: #fff; padding: 6px 10px; border-radius: 6px; display: block; margin-bottom: 10px;">
								<?= base_url('smartrt/posyandu_rfid_tap'); ?>
							</code>
							<small class="text-muted d-block">
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
		<div class="card border-0 shadow-sm" style="border-radius: 16px;">
			<div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
				<h5 class="font-weight-bold text-dark mb-0">💻 Source Code Arduino IDE (NodeMCU ESP32 + MFRC522)</h5>
				<button class="btn btn-sm btn-dark" onclick="copyArduinoCode()">📋 Salin Seluruh Kode</button>
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
// Ganti dengan IP komputer lokal Anda (misal: 192.168.1.50) atau domain VPS
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

function playChime(success = true) {
	if (!soundEnabled) return;
	try {
		if (!audioCtx) {
			audioCtx = new (window.AudioContext || window.webkitAudioContext)();
		}
		if (audioCtx.state === 'suspended') {
			audioCtx.resume();
		}

		const now = audioCtx.currentTime;
		const osc = audioCtx.createOscillator();
		const gain = audioCtx.createGain();
		osc.connect(gain);
		gain.connect(audioCtx.destination);

		if (success) {
			// Nada gembira naik (chime dua nada)
			osc.type = 'sine';
			osc.frequency.setValueAtTime(587.33, now); // D5
			osc.frequency.setValueAtTime(880.00, now + 0.12); // A5
			gain.gain.setValueAtTime(0.3, now);
			gain.gain.exponentialRampToValueAtTime(0.001, now + 0.4);
			osc.start(now);
			osc.stop(now + 0.4);
		} else {
			// Nada warning
			osc.type = 'triangle';
			osc.frequency.setValueAtTime(329.63, now); // E4
			osc.frequency.setValueAtTime(261.63, now + 0.15); // C4
			gain.gain.setValueAtTime(0.25, now);
			gain.gain.exponentialRampToValueAtTime(0.001, now + 0.35);
			osc.start(now);
			osc.stop(now + 0.35);
		}
	} catch (e) {
		console.log('Audio disabled or not allowed yet:', e);
	}
}

document.getElementById('toggleAudioBtn').addEventListener('click', function() {
	soundEnabled = !soundEnabled;
	this.innerText = soundEnabled ? '🔊 Audio: ON' : '🔇 Audio: OFF';
	if (soundEnabled) playChime(true);
});

// ── Tab Switcher ─────────────────────────────────────────────
function switchTab(tabId, el) {
	document.querySelectorAll('.tab-content-section').forEach(t => t.style.display = 'none');
	document.querySelectorAll('.modern-tab-nav .nav-link-item').forEach(l => l.classList.remove('active'));
	document.getElementById(tabId).style.display = 'block';
	el.classList.add('active');
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

function openPairModalWithWarga(wargaId, namaWarga) {
	$('#modalPairKtp').modal('show');
	if (wargaId) document.getElementById('pairWargaId').value = wargaId;
	if (currentLastUid) document.getElementById('pairRfidUid').value = currentLastUid;
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
						// Bunyikan nada
						if (top.status === 'SUCCESS') playChime(true);
						else playChime(false);

						// Auto-reload tabel kehadiran jika ada kehadiran baru
						if (top.status === 'SUCCESS') {
							setTimeout(() => { window.location.reload(); }, 1200);
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
					statusBadge.innerText = '🔔 KTP Baru (Belum Terhubung)';
					iconEl.innerText = '🪪';
					namaEl.innerHTML = 'KTP Baru: <span class="font-monospace">' + top.uid + '</span>';
					detailEl.innerHTML = '<a href="javascript:void(0)" onclick="openPairModalWithWarga()" class="text-warning font-weight-bold"><u>Klik di sini untuk hubungkan ke data Ibu</u></a>';
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

// Jalankan polling setiap 2.5 detik
setInterval(fetchLiveStream, 2500);
fetchLiveStream();
</script>
