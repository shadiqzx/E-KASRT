<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap');

:root {
	--posyandu-primary: #0284c7;
	--posyandu-dark: #0c4a6e;
	--posyandu-cyan: #06b6d4;
	--posyandu-indigo: #4f46e5;
	--posyandu-emerald: #10b981;
	--card-border: rgba(226, 232, 240, 0.9);
}

.posyandu-container {
	font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
	color: #0f172a;
	padding-top: 85px !important;
	padding-bottom: 60px;
	background: #f8fafc;
}

/* ====================================================================
   1. HERO MESH GRADIENT HEADER (Ultra-Modern SaaS / Fintech Aesthetic)
   ==================================================================== */
.posyandu-hero-mesh {
	background: linear-gradient(135deg, #061325 0%, #0c2b4e 35%, #0284c7 75%, #0ea5e9 100%);
	border-radius: 24px;
	padding: 32px 36px;
	color: #ffffff;
	box-shadow: 0 20px 45px -12px rgba(2, 132, 199, 0.45);
	position: relative;
	overflow: hidden;
	margin-bottom: 24px;
	border: 1px solid rgba(255, 255, 255, 0.15);
}
.posyandu-hero-mesh::before {
	content: '';
	position: absolute;
	width: 360px;
	height: 360px;
	background: radial-gradient(circle, rgba(14, 165, 233, 0.4) 0%, rgba(6, 182, 212, 0) 70%);
	top: -90px;
	right: 12%;
	border-radius: 50%;
	filter: blur(45px);
	pointer-events: none;
}
.posyandu-hero-mesh::after {
	content: '';
	position: absolute;
	width: 280px;
	height: 280px;
	background: radial-gradient(circle, rgba(79, 70, 229, 0.35) 0%, rgba(79, 70, 229, 0) 70%);
	bottom: -80px;
	left: -40px;
	border-radius: 50%;
	filter: blur(40px);
	pointer-events: none;
}

.hero-glass-badge {
	background: rgba(255, 255, 255, 0.16);
	backdrop-filter: blur(12px);
	-webkit-backdrop-filter: blur(12px);
	border: 1px solid rgba(255, 255, 255, 0.28);
	color: #bae6fd;
	font-size: 11.5px;
	font-weight: 800;
	letter-spacing: 0.8px;
	padding: 6px 14px;
	border-radius: 30px;
	display: inline-flex;
	align-items: center;
	gap: 8px;
	margin-bottom: 12px;
	text-transform: uppercase;
}
.hero-pulsing-dot {
	width: 9px;
	height: 9px;
	background: #34d399;
	border-radius: 50%;
	box-shadow: 0 0 0 0 rgba(52, 211, 153, 0.8);
	animation: pulseMesh 2s infinite;
}
@keyframes pulseMesh {
	0% { box-shadow: 0 0 0 0 rgba(52, 211, 153, 0.8); }
	70% { box-shadow: 0 0 0 10px rgba(52, 211, 153, 0); }
	100% { box-shadow: 0 0 0 0 rgba(52, 211, 153, 0); }
}

.hero-title {
	font-size: 28px;
	font-weight: 800;
	letter-spacing: -0.6px;
	line-height: 1.15;
	margin-bottom: 8px;
	color: #ffffff;
}
.hero-subtitle {
	font-size: 13.5px;
	color: rgba(255, 255, 255, 0.82);
	max-width: 640px;
	margin-bottom: 0;
	line-height: 1.5;
}

/* Glass Header Buttons */
.hero-btn-white {
	background: #ffffff;
	color: #0369a1 !important;
	border: none;
	padding: 10px 18px;
	border-radius: 12px;
	font-weight: 700;
	font-size: 13px;
	box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
	transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
	display: inline-flex;
	align-items: center;
	gap: 7px;
	text-decoration: none !important;
}
.hero-btn-white:hover {
	transform: translateY(-2px);
	box-shadow: 0 8px 20px rgba(0, 0, 0, 0.22);
	background: #f0f9ff;
}
.hero-btn-glass {
	background: rgba(255, 255, 255, 0.14);
	color: #ffffff !important;
	border: 1px solid rgba(255, 255, 255, 0.28);
	backdrop-filter: blur(8px);
	padding: 10px 16px;
	border-radius: 12px;
	font-weight: 600;
	font-size: 13px;
	transition: all 0.25s;
	display: inline-flex;
	align-items: center;
	gap: 7px;
	text-decoration: none !important;
}
.hero-btn-glass:hover {
	background: rgba(255, 255, 255, 0.24);
	transform: translateY(-2px);
}

/* ====================================================================
   2. HARDWARE CONNECTION HUB & PILIHAN SAMBUNGAN ESP32
   ==================================================================== */
.hardware-hub-card {
	background: #ffffff;
	border-radius: 20px;
	border: 1px solid var(--card-border);
	box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.06);
	overflow: hidden;
	margin-bottom: 24px;
	position: relative;
}

.hub-nav-bar {
	background: #f8fafc;
	border-bottom: 1px solid #e2e8f0;
	padding: 12px 24px;
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	align-items: center;
	gap: 12px;
}

/* Segmented Connection Mode Switcher */
.connection-mode-pills {
	background: #e2e8f0;
	padding: 4px;
	border-radius: 14px;
	display: inline-flex;
	gap: 4px;
}
.conn-pill-btn {
	padding: 7px 16px;
	border-radius: 10px;
	font-size: 12.5px;
	font-weight: 700;
	border: none;
	background: transparent;
	color: #475569;
	cursor: pointer;
	transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
	display: inline-flex;
	align-items: center;
	gap: 6px;
}
.conn-pill-btn.active {
	background: #ffffff;
	color: #0284c7;
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}
.conn-pill-btn:hover:not(.active) {
	color: #0f172a;
}

.hub-body {
	padding: 24px 26px;
}

/* Hardware Meta Chips */
.hw-chip {
	background: #f1f5f9;
	border: 1px solid #e2e8f0;
	border-radius: 10px;
	padding: 6px 12px;
	font-size: 12px;
	font-weight: 600;
	color: #334155;
	display: inline-flex;
	align-items: center;
	gap: 6px;
}
.hw-chip code {
	background: #ffffff;
	padding: 2px 6px;
	border-radius: 6px;
	border: 1px solid #cbd5e1;
	font-family: 'JetBrains Mono', monospace;
	font-size: 11px;
	color: #0284c7;
	font-weight: 700;
}

/* Live Radar Tap Card (Futuristic Hologram Look) */
.live-radar-hologram {
	background: linear-gradient(135deg, #091a30 0%, #122b49 100%);
	border-radius: 16px;
	padding: 20px;
	color: #ffffff;
	position: relative;
	overflow: hidden;
	border: 1px solid rgba(14, 165, 233, 0.3);
	box-shadow: 0 10px 25px -5px rgba(2, 132, 199, 0.3);
}
.live-radar-hologram::before {
	content: '';
	position: absolute;
	top: -50px;
	right: -50px;
	width: 140px;
	height: 140px;
	background: radial-gradient(circle, rgba(14, 165, 233, 0.35) 0%, transparent 70%);
	border-radius: 50%;
	pointer-events: none;
}
.radar-sweep-anim {
	width: 12px;
	height: 12px;
	background: #10b981;
	border-radius: 50%;
	box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
	animation: pulseGreen 1.8s infinite;
}
@keyframes pulseGreen {
	0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.8); }
	70% { box-shadow: 0 0 0 12px rgba(16, 185, 129, 0); }
	100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}

.radar-avatar-box {
	width: 50px;
	height: 50px;
	border-radius: 14px;
	background: rgba(255, 255, 255, 0.1);
	border: 1px solid rgba(255, 255, 255, 0.2);
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 26px;
	flex-shrink: 0;
}

/* ====================================================================
   3. BENTO FINTECH KPI CARDS
   ==================================================================== */
.bento-kpi-grid {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
	gap: 16px;
	margin-bottom: 24px;
}
.bento-kpi-card {
	background: #ffffff;
	border-radius: 16px;
	padding: 18px 22px;
	border: 1px solid var(--card-border);
	box-shadow: 0 4px 18px -3px rgba(15, 23, 42, 0.04);
	position: relative;
	overflow: hidden;
	display: flex;
	align-items: center;
	justify-content: space-between;
	transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}
.bento-kpi-card:hover {
	transform: translateY(-3px);
	box-shadow: 0 10px 24px -4px rgba(15, 23, 42, 0.08);
	border-color: #cbd5e1;
}
.bento-accent-line {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	height: 4px;
}
.bento-accent-cyan { background: linear-gradient(90deg, #0284c7, #38bdf8); }
.bento-accent-emerald { background: linear-gradient(90deg, #059669, #34d399); }
.bento-accent-indigo { background: linear-gradient(90deg, #4f46e5, #818cf8); }
.bento-accent-amber { background: linear-gradient(90deg, #d97706, #fbbf24); }

.kpi-number {
	font-size: 28px;
	font-weight: 800;
	color: #0f172a;
	line-height: 1;
	letter-spacing: -0.5px;
}
.kpi-title {
	font-size: 11.5px;
	font-weight: 700;
	color: #64748b;
	text-transform: uppercase;
	letter-spacing: 0.6px;
	margin-top: 6px;
}
.kpi-icon-pill {
	width: 44px;
	height: 44px;
	border-radius: 12px;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 22px;
}
.icon-cyan { background: #ecfeff; color: #0891b2; }
.icon-emerald { background: #ecfdf5; color: #059669; }
.icon-indigo { background: #eef2ff; color: #4f46e5; }
.icon-amber { background: #fffbeb; color: #d97706; }

/* ====================================================================
   4. TABS & MODERN CONTENT CARDS
   ==================================================================== */
.posyandu-nav-tabs {
	display: flex;
	gap: 8px;
	margin-bottom: 22px;
	border-bottom: 2px solid #e2e8f0;
	padding-bottom: 12px;
	flex-wrap: wrap;
}
.posyandu-nav-tabs .nav-link-item {
	padding: 9px 18px;
	border-radius: 12px;
	font-weight: 700;
	font-size: 13.5px;
	color: #64748b;
	background: #f1f5f9;
	border: 1px solid transparent;
	cursor: pointer;
	text-decoration: none;
	display: inline-flex;
	align-items: center;
	gap: 8px;
	transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}
.posyandu-nav-tabs .nav-link-item:hover {
	background: #e2e8f0;
	color: #0f172a;
}
.posyandu-nav-tabs .nav-link-item.active {
	background: #0284c7;
	color: #ffffff;
	border-color: #0284c7;
	box-shadow: 0 4px 14px rgba(2, 132, 199, 0.3);
}
.posyandu-nav-tabs .nav-link-item.active .badge {
	background: #ffffff !important;
	color: #0284c7 !important;
}

.content-card {
	background: #ffffff;
	border: 1px solid var(--card-border);
	border-radius: 18px;
	box-shadow: 0 4px 20px -3px rgba(15, 23, 42, 0.05);
	overflow: hidden;
}
.content-card-header {
	background: #ffffff;
	padding: 20px 26px;
	border-bottom: 1px solid #e2e8f0;
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	align-items: center;
	gap: 12px;
}

/* Modern Tables */
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
	padding: 15px 18px;
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
	border-radius: 14px;
	padding: 22px;
	font-family: 'JetBrains Mono', monospace;
	font-size: 12px;
	line-height: 1.6;
	overflow-x: auto;
	border: 1px solid #1e293b;
	position: relative;
}
.copy-code-btn {
	position: absolute;
	top: 14px;
	right: 14px;
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

<div class="posyandu-container p-3 p-md-4">
	<?= $this->session->flashdata('message'); ?>

	<!-- ============================================================== -->
	<!-- 1. HERO MESH GRADIENT HEADER                                   -->
	<!-- ============================================================== -->
	<div class="posyandu-hero-mesh">
		<div class="d-flex flex-wrap justify-content-between align-items-center">
			<div class="mb-3 mb-lg-0">
				<div class="hero-glass-badge">
					<span class="hero-pulsing-dot"></span>
					IoT SMART RT v2.4 • ESP32 + MFRC522 RC522
				</div>
				<h1 class="hero-title">Posyandu Balita Digital</h1>
				<p class="hero-subtitle">
					Otomatisasi absensi balita berbasis tap <strong>e-KTP Ibu Balita</strong>, pemantauan status gizi KMS, dan integrasi hardware NodeMCU ESP32.
				</p>
			</div>

			<!-- Quick Actions in Header -->
			<div class="d-flex flex-wrap gap-2" style="gap: 10px;">
				<a href="#modalTambahSesi" data-toggle="modal" class="hero-btn-white">
					<i class="fas fa-plus-circle"></i> Buat Sesi Baru
				</a>
				<?php if ($sesi_aktif): ?>
					<a href="#modalHadirManual" data-toggle="modal" class="hero-btn-glass">
						<i class="fas fa-pen-alt text-info"></i> Absen Manual
					</a>
				<?php endif; ?>
				<a href="#modalPairKtp" data-toggle="modal" class="hero-btn-glass">
					<i class="fas fa-id-card text-warning"></i> Hubungkan e-KTP
				</a>
				<button type="button" class="hero-btn-glass" data-toggle="modal" data-target="#modalSettingEsp32">
					<i class="fas fa-cog text-light"></i> Setting ESP32 & IoT
				</button>
			</div>
		</div>
	</div>

	<!-- ============================================================== -->
	<!-- 2. HARDWARE HUB & PILIHAN SAMBUNGAN ESP32                      -->
	<!-- ============================================================== -->
	<div class="hardware-hub-card">
		<!-- Sub Navigation Bar: Pilihan Sambungan ESP32 -->
		<div class="hub-nav-bar">
			<div class="d-flex align-items-center flex-wrap gap-2" style="gap: 10px;">
				<span class="font-weight-bold text-dark" style="font-size: 13px;">
					<i class="fas fa-microchip text-primary mr-1"></i> Mode Sambungan:
				</span>
				<!-- Switcher Tab Sambungan -->
				<div class="connection-mode-pills">
					<button type="button" class="conn-pill-btn active" id="btnModeWifi" onclick="selectConnMode('wifi')">
						<i class="fas fa-wifi text-success"></i> 📡 Wi-Fi HTTP (Default)
					</button>
					<button type="button" class="conn-pill-btn" id="btnModeUsb" onclick="selectConnMode('usb')">
						<i class="fas fa-plug text-info"></i> 🔌 USB Serial COM
					</button>
					<button type="button" class="conn-pill-btn" id="btnModeMqtt" onclick="selectConnMode('config')">
						<i class="fas fa-sliders-h text-warning"></i> ⚙️ Parameter IoT
					</button>
				</div>
			</div>

			<!-- Status Indikator Kanan -->
			<div class="d-flex align-items-center flex-wrap gap-2" style="gap: 8px;">
				<span class="badge badge-light border text-muted px-2 py-1 font-weight-bold" id="livePingBadge" style="font-size: 11px; border-radius: 6px;">
					Live Polling: Aktif
				</span>
				<button id="toggleAudioBtn" class="btn btn-sm btn-outline-secondary py-1 px-2" style="font-size: 11px; border-radius: 8px; font-weight: 600;" title="Bunyikan Nada Beep & Suara TTS">
					🔊 Audio: ON
				</button>
				<button type="button" class="btn btn-sm btn-outline-primary py-1 px-2" onclick="testSimulasiTap()" style="font-size: 11px; border-radius: 8px; font-weight: 600;">
					🧪 Test Tap KTP
				</button>
			</div>
		</div>

		<!-- Body Hardware Hub -->
		<div class="hub-body">
			<div class="row align-items-center">
				<!-- Sisi Kiri: Detail Mode Sambungan Terpilih -->
				<div class="col-lg-7 mb-4 mb-lg-0">
					<!-- MODE 1: WI-FI REST API -->
					<div id="connModeWifiView">
						<div class="d-flex align-items-center mb-2" style="gap: 8px;">
							<span class="badge badge-success px-3 py-1 font-weight-bold d-inline-flex align-items-center gap-2" style="border-radius: 20px; font-size: 12px; gap: 6px;">
								<span class="radar-sweep-anim"></span>
								SENSOR ESP32 SIAP & LISTENING
							</span>
							<span class="text-muted" style="font-size: 12px;">• NodeMCU ESP32-WROOM-32D</span>
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
								Ibu balita dapat langsung menempelkan e-KTP ke sensor RC522. Kehadiran balita akan tercatat otomatis.
							<?php else: ?>
								Aktifkan salah satu jadwal sesi posyandu di tab <em>Manajemen Sesi</em> agar reader RFID dapat mencatat absensi.
							<?php endif; ?>
						</p>

						<!-- Parameter Chips Wi-Fi -->
						<div class="d-flex flex-wrap align-items-center gap-2" style="gap: 8px;">
							<div class="hw-chip">
								<i class="fas fa-network-wired text-primary"></i> IP Server: <code id="dispIpServer">10.246.16.194</code>
							</div>
							<div class="hw-chip">
								<i class="fas fa-link text-info"></i> Endpoint: <code><?= base_url('smartrt/posyandu_rfid_tap'); ?></code>
							</div>
							<div class="hw-chip">
								<i class="fas fa-key text-warning"></i> Key: <code>kasrt2025</code>
							</div>
						</div>
					</div>

					<!-- MODE 2: USB SERIAL COM PORT (Direct Browser Access) -->
					<div id="connModeUsbView" style="display: none;">
						<div class="d-flex align-items-center mb-2" style="gap: 8px;">
							<span class="badge badge-info px-3 py-1 font-weight-bold" style="border-radius: 20px; font-size: 12px;">
								<i class="fas fa-plug mr-1"></i> MODE USB SERIAL COM (Web Serial API)
							</span>
							<span class="text-muted" style="font-size: 12px;" id="usbStatusText">
								🟡 Belum Terhubung
							</span>
						</div>
						<h5 class="font-weight-bold text-dark mb-1">Sambungkan ESP32 langsung via Kabel USB</h5>
						<p class="text-muted mb-3" style="font-size: 13px;">
							Hubungkan NodeMCU ESP32 ke port USB laptop Anda. Browser Google Chrome/Edge akan membaca tap kartu e-KTP secara langsung tanpa memerlukan koneksi Wi-Fi.
						</p>
						<div class="d-flex flex-wrap align-items-center gap-2" style="gap: 10px;">
							<button type="button" class="btn btn-primary btn-sm font-weight-bold px-3 py-2" id="btnConnectUsb" onclick="toggleUsbSerial()" style="border-radius: 10px;">
								<i class="fas fa-usb mr-1"></i> Hubungkan Port Serial USB (COM)
							</button>
							<span class="hw-chip">
								Baudrate: <code>115200 bps</code>
							</span>
						</div>
					</div>

					<!-- MODE 3: PARAMETER IOT QUICK VIEW -->
					<div id="connModeConfigView" style="display: none;">
						<div class="d-flex align-items-center mb-2" style="gap: 8px;">
							<span class="badge badge-warning px-3 py-1 font-weight-bold text-dark" style="border-radius: 20px; font-size: 12px;">
								<i class="fas fa-sliders-h mr-1"></i> PARAMETER SENSOR & HARDWARE
							</span>
						</div>
						<h5 class="font-weight-bold text-dark mb-1">Konfigurasi Pengaturan IoT Posyandu</h5>
						<p class="text-muted mb-3" style="font-size: 13px;">
							Sesuaikan nama Wi-Fi, Password, Gain Antena RC522 (daya tembus KTP), dan Debounce time.
						</p>
						<button type="button" class="btn btn-outline-primary btn-sm font-weight-bold px-3 py-2" data-toggle="modal" data-target="#modalSettingEsp32" style="border-radius: 10px;">
							<i class="fas fa-cog mr-1"></i> Buka Pengaturan Lengkap ESP32
						</button>
					</div>
				</div>

				<!-- Sisi Kanan: Live Tap Radar Hologram Card -->
				<div class="col-lg-5">
					<div class="live-radar-hologram" id="lastTapBox">
						<div class="d-flex justify-content-between align-items-center mb-3">
							<span style="font-size: 11px; font-weight: 800; color: #38bdf8; letter-spacing: 1px; text-transform: uppercase;">
								<i class="fas fa-satellite-dish mr-1"></i> RADAR TAP e-KTP TERAKHIR
							</span>
							<span class="badge badge-light border text-dark font-weight-bold" id="lastTapStatusBadge" style="font-size: 11px;">
								Standby
							</span>
						</div>

						<div class="d-flex align-items-center" style="gap: 14px;">
							<div class="radar-avatar-box" id="lastTapIcon">
								💳
							</div>
							<div style="min-width: 0; flex: 1;">
								<h6 class="font-weight-bold text-white mb-0 text-truncate" id="lastTapNama">
									Menunggu Tap Kartu...
								</h6>
								<small class="text-white-50 d-block text-truncate" id="lastTapDetail" style="font-size: 12px;">
									Tempelkan e-KTP Ibu di sensor RC522
								</small>
							</div>
						</div>

						<div class="mt-3 pt-2 d-flex justify-content-between align-items-center" style="border-top: 1px solid rgba(255, 255, 255, 0.12); font-size: 11.5px; color: rgba(255, 255, 255, 0.75);">
							<span>UID: <strong class="text-white font-monospace" id="lastTapUid">-</strong></span>
							<span id="lastTapTime" class="font-weight-bold">-</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ============================================================== -->
	<!-- 3. BENTO FINTECH KPI CARDS                                     -->
	<!-- ============================================================== -->
	<div class="bento-kpi-grid">
		<div class="bento-kpi-card">
			<div class="bento-accent-line bento-accent-cyan"></div>
			<div>
				<div class="kpi-number"><?= $total_balita; ?></div>
				<div class="kpi-title">Total Balita Terdaftar</div>
			</div>
			<div class="kpi-icon-pill icon-cyan">👶</div>
		</div>

		<div class="bento-kpi-card">
			<div class="bento-accent-line bento-accent-emerald"></div>
			<div>
				<div class="kpi-number"><?= $total_ktp_ibu; ?></div>
				<div class="kpi-title">e-KTP Ibu Terhubung</div>
			</div>
			<div class="kpi-icon-pill icon-emerald">🪪</div>
		</div>

		<div class="bento-kpi-card">
			<div class="bento-accent-line bento-accent-indigo"></div>
			<div>
				<div class="kpi-number" id="statHadirNum"><?= $total_hadir; ?></div>
				<div class="kpi-title">Balita Hadir (Sesi Ini)</div>
			</div>
			<div class="kpi-icon-pill icon-indigo">✅</div>
		</div>

		<div class="bento-kpi-card">
			<div class="bento-accent-line bento-accent-amber"></div>
			<div>
				<div class="kpi-number"><?= count($sesi_list); ?></div>
				<div class="kpi-title">Total Sesi Terjadwal</div>
			</div>
			<div class="kpi-icon-pill icon-amber">📅</div>
		</div>
	</div>

	<!-- ============================================================== -->
	<!-- 4. NAVIGATION TABS                                             -->
	<!-- ============================================================== -->
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
						Kehadiran Balita & Data Tumbuh Kembang (KMS)
					</h5>
					<small class="text-muted">
						<?php if ($sesi_aktif): ?>
							Sesi Aktif: <strong class="text-primary"><?= htmlspecialchars($sesi_aktif->nama_sesi); ?></strong> (<?= date('d M Y', strtotime($sesi_aktif->tanggal)); ?>)
						<?php else: ?>
							<span class="text-danger font-weight-bold">Tidak ada sesi posyandu yang sedang aktif</span>
						<?php endif; ?>
					</small>
				</div>
				<div class="d-flex" style="gap: 8px;">
					<button onclick="fetchLiveStream()" class="btn btn-outline-secondary btn-sm font-weight-bold" style="border-radius: 8px;">
						<i class="fas fa-sync-alt mr-1"></i> Refresh Data
					</button>
					<a href="#modalPairKtp" data-toggle="modal" class="btn btn-outline-primary btn-sm font-weight-bold" style="border-radius: 8px;">
						<i class="fas fa-id-card mr-1"></i> Hubungkan KTP Baru
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
							Minta ibu balita menempelkan e-KTP ke sensor RFID RC522 atau klik tombol <em>Absen Balita Manual</em>.
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
												<div style="width: 40px; height: 40px; border-radius: 12px; background: <?= $k->jenis_kelamin == 'L' ? '#e0f2fe' : '#fce7f3'; ?>; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-right: 12px; flex-shrink: 0;">
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
												<button type="button" class="btn btn-sm btn-primary py-1 px-3 font-weight-bold" onclick="openModalPemeriksaan(<?= htmlspecialchars(json_encode($k)); ?>)" title="Isi Pengukuran Timbangan" style="border-radius: 6px;">
													⚖️ Periksa
												</button>
												<a href="<?= base_url('smartrt/posyandu_cetak_kms/' . $k->balita_id); ?>" target="_blank" class="btn btn-sm btn-outline-secondary py-1 px-2" title="Cetak KMS Balita" style="border-radius: 6px;">
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
				<button class="btn btn-primary btn-sm font-weight-bold" data-toggle="modal" data-target="#modalTambahBalita" style="border-radius: 8px;">
					<i class="fas fa-plus-circle mr-1"></i> Daftarkan Balita Baru
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
												<a href="<?= base_url('smartrt/posyandu_cetak_kms/' . $b->id); ?>" target="_blank" class="btn btn-sm btn-outline-primary py-1 px-2" title="Cetak Riwayat KMS">
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
				<button class="btn btn-primary btn-sm font-weight-bold" data-toggle="modal" data-target="#modalTambahSesi" style="border-radius: 8px;">
					<i class="fas fa-plus-circle mr-1"></i> Buat Jadwal Sesi Baru
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
						<div class="alert alert-info border-0 shadow-sm" style="border-radius: 14px; background: #f0f9ff; color: #0369a1;">
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
  // Set Gain Antena Maksimal agar e-KTP terbaca lebih sensitif
  rfc.PCD_SetAntennaGain(MFRC522::PCD_RxGain::RxGain_max);
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

<!-- ============================================================== -->
<!-- 5. MODAL SETTING ESP32 & IOT CONFIG (Fitur Baru Permintaan User) -->
<!-- ============================================================== -->
<div class="modal fade" id="modalSettingEsp32" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
			<div class="modal-header text-white py-3" style="background: linear-gradient(135deg, #0f172a, #0284c7);">
				<h5 class="modal-title font-weight-bold">
					<i class="fas fa-sliders-h mr-2"></i> Pengaturan ESP32 & IoT Posyandu
				</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body p-4">
				<p class="text-muted" style="font-size: 13px;">
					Sesuaikan parameter koneksi hardware NodeMCU ESP32 dan modul RFID RC522. Pengaturan ini akan memperbarui skrip Arduino IDE secara otomatis.
				</p>

				<div class="row">
					<div class="col-md-6 mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">
							<i class="fas fa-wifi text-primary mr-1"></i> Nama Wi-Fi (SSID)
						</label>
						<input type="text" class="form-control" id="cfgWifiSsid" placeholder="Contoh: Posyandu_RW05" value="WiFi_Posyandu">
					</div>
					<div class="col-md-6 mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">
							<i class="fas fa-key text-warning mr-1"></i> Password Wi-Fi
						</label>
						<input type="text" class="form-control" id="cfgWifiPass" placeholder="Password Wi-Fi..." value="kasrt123">
					</div>
				</div>

				<div class="row">
					<div class="col-md-8 mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">
							<i class="fas fa-laptop-code text-info mr-1"></i> Host / IP Server E-KASRT
						</label>
						<input type="text" class="form-control font-monospace" id="cfgServerIp" value="10.246.16.194" placeholder="Contoh: 10.246.16.194 atau domain.com">
						<small class="text-muted">IP laptop tempat Laragon / Web Apache berjalan.</small>
					</div>
					<div class="col-md-4 mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">
							<i class="fas fa-lock text-success mr-1"></i> API Key
						</label>
						<input type="text" class="form-control font-monospace font-weight-bold" id="cfgApiKey" value="kasrt2025" readonly>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">
							<i class="fas fa-broadcast-tower text-danger mr-1"></i> Antenna Gain RC522 (Daya Tembus e-KTP)
						</label>
						<select class="form-control" id="cfgAntennaGain">
							<option value="max" selected>🔥 48 dB (Maksimal - Rekomendasi KTP Tebal)</option>
							<option value="38">⚡ 38 dB (Tinggi)</option>
							<option value="33">📶 33 dB (Standar)</option>
						</select>
					</div>
					<div class="col-md-6 mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">
							<i class="fas fa-stopwatch text-secondary mr-1"></i> Debounce Waktu Tap Ulang (ms)
						</label>
						<input type="number" class="form-control" id="cfgDebounce" value="3000" placeholder="3000 ms">
						<small class="text-muted">Mencegah kartu terabsen 2 kali jika tidak segera diangkat.</small>
					</div>
				</div>

				<div class="alert alert-light border d-flex align-items-center mt-2 mb-0" style="border-radius: 12px;">
					<div style="font-size: 24px; margin-right: 12px;">💡</div>
					<div style="font-size: 12.5px;" class="text-muted">
						Perubahan pengaturan ini disimpan di memori peramban (*browser*) dan langsung memperbarui variabel di source code Arduino pada tab <em>Firmware & Wiring ESP32</em>.
					</div>
				</div>
			</div>
			<div class="modal-footer bg-light py-2">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-primary btn-sm font-weight-bold px-4" onclick="saveEsp32Config()">
					<i class="fas fa-check mr-1"></i> Terapkan Pengaturan
				</button>
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
// ==============================================================
// 1. WEB AUDIO SYNTH & INDONESIAN TEXT-TO-SPEECH
// ==============================================================
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
			// Melodi gembira dua nada (ting-tong)
			osc.type = 'sine';
			osc.frequency.setValueAtTime(659.25, now); // E5
			osc.frequency.setValueAtTime(987.77, now + 0.12); // B5
			gain.gain.setValueAtTime(0.4, now);
			gain.gain.exponentialRampToValueAtTime(0.001, now + 0.5);
			osc.start(now);
			osc.stop(now + 0.5);
		} else {
			// Melodi peringatan (tut-tut)
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
		speakVoice("Suara notifikasi aktif");
	}
});

// ==============================================================
// 2. PILIHAN MODE SAMBUNGAN ESP32 (Wi-Fi vs USB Serial vs Param)
// ==============================================================
function selectConnMode(mode) {
	['btnModeWifi', 'btnModeUsb', 'btnModeMqtt'].forEach(id => document.getElementById(id).classList.remove('active'));
	document.getElementById('connModeWifiView').style.display = 'none';
	document.getElementById('connModeUsbView').style.display = 'none';
	document.getElementById('connModeConfigView').style.display = 'none';

	if (mode === 'wifi') {
		document.getElementById('btnModeWifi').classList.add('active');
		document.getElementById('connModeWifiView').style.display = 'block';
	} else if (mode === 'usb') {
		document.getElementById('btnModeUsb').classList.add('active');
		document.getElementById('connModeUsbView').style.display = 'block';
	} else if (mode === 'config') {
		document.getElementById('btnModeMqtt').classList.add('active');
		document.getElementById('connModeConfigView').style.display = 'block';
	}
}

// ── Web Serial API Controller (Koneksi Kabel USB) ────────────
let usbPort = null;
let usbReader = null;
let keepReadingUsb = true;

async function toggleUsbSerial() {
	if (!("serial" in navigator)) {
		alert("Browser Anda belum mendukung Web Serial API.\nGunakan Google Chrome, Microsoft Edge, atau Opera versi terbaru untuk menghubungkan langsung melalui kabel USB.");
		return;
	}

	if (usbPort) {
		// Putuskan sambungan
		keepReadingUsb = false;
		if (usbReader) {
			try { await usbReader.cancel(); } catch(e){}
		}
		try { await usbPort.close(); } catch(e){}
		usbPort = null;
		document.getElementById('usbStatusText').innerHTML = '🟡 Belum Terhubung';
		document.getElementById('btnConnectUsb').innerHTML = '<i class="fas fa-usb mr-1"></i> Hubungkan Port Serial USB (COM)';
		document.getElementById('btnConnectUsb').className = 'btn btn-primary btn-sm font-weight-bold px-3 py-2';
		speakVoice("Sambungan serial USB terputus.");
		return;
	}

	try {
		usbPort = await navigator.serial.requestPort();
		await usbPort.open({ baudRate: 115200 });

		keepReadingUsb = true;
		document.getElementById('usbStatusText').innerHTML = '<span class="text-success font-weight-bold">🟢 Port Serial Terhubung!</span>';
		document.getElementById('btnConnectUsb').innerHTML = '<i class="fas fa-times-circle mr-1"></i> Putuskan USB Serial';
		document.getElementById('btnConnectUsb').className = 'btn btn-danger btn-sm font-weight-bold px-3 py-2';

		playChime(true);
		speakVoice("ESP32 terhubung melalui port serial USB. Silakan tempelkan e-KTP.");
		readUsbSerialStream();
	} catch (err) {
		console.error("USB Serial Connection Error:", err);
		alert("Gagal menghubungkan ke port serial: " + err.message);
	}
}

async function readUsbSerialStream() {
	const textDecoder = new TextDecoderStream();
	const readableStreamClosed = usbPort.readable.pipeTo(textDecoder.writable);
	usbReader = textDecoder.readable.getReader();
	let lineBuffer = '';

	try {
		while (keepReadingUsb) {
			const { value, done } = await usbReader.read();
			if (done) break;
			if (value) {
				lineBuffer += value;
				const lines = lineBuffer.split('\n');
				lineBuffer = lines.pop(); // buffer sisa
				for (const line of lines) {
					console.log("[ESP32 SERIAL]:", line.trim());
					// Cari pola "UID: XXXXXXXX"
					const match = line.match(/UID:\s*([0-9A-Fa-f]+)/i);
					if (match && match[1]) {
						const detectedUid = match[1].trim().toUpperCase();
						console.log("🔥 [UID DETEKSI SERIAL]:", detectedUid);
						sendRfidTapToServer(detectedUid);
					}
				}
			}
		}
	} catch (err) {
		console.warn("Serial loop terminated:", err);
	}
}

function sendRfidTapToServer(uid) {
	unlockAudio();
	fetch("<?= base_url('smartrt/posyandu_rfid_tap'); ?>", {
		method: "POST",
		headers: { "Content-Type": "application/x-www-form-urlencoded" },
		body: "api_key=kasrt2025&uid=" + encodeURIComponent(uid)
	})
	.then(r => r.json())
	.then(res => {
		if (res.status === 'success') {
			playChime(true);
			speakVoice("Selamat datang! " + res.message);
		} else if (res.status === 'already_checked') {
			playChime(false);
			speakVoice(res.message);
		} else if (res.status === 'unregistered') {
			playChime(false);
			speakVoice("Kartu e-KTP baru terdeteksi. Silakan pasangkan dengan nama ibu.");
			openPairModalWithWarga(null, null, uid);
		} else {
			playChime(false);
			speakVoice(res.message);
		}
		fetchLiveStream();
	})
	.catch(err => console.error("Error tap:", err));
}

// ==============================================================
// 3. PENGATURAN ESP32 & IOT CONFIGURATION
// ==============================================================
function loadEsp32Config() {
	const savedIp = localStorage.getItem('cfg_posyandu_ip') || '10.246.16.194';
	const savedSsid = localStorage.getItem('cfg_posyandu_ssid') || 'WiFi_Posyandu';
	const savedPass = localStorage.getItem('cfg_posyandu_pass') || 'kasrt123';
	const savedGain = localStorage.getItem('cfg_posyandu_gain') || 'max';

	document.getElementById('cfgServerIp').value = savedIp;
	document.getElementById('cfgWifiSsid').value = savedSsid;
	document.getElementById('cfgWifiPass').value = savedPass;
	document.getElementById('cfgAntennaGain').value = savedGain;

	const disp = document.getElementById('dispIpServer');
	if (disp) disp.innerText = savedIp;
}

function saveEsp32Config() {
	const ip = document.getElementById('cfgServerIp').value.trim();
	const ssid = document.getElementById('cfgWifiSsid').value.trim();
	const pass = document.getElementById('cfgWifiPass').value.trim();
	const gain = document.getElementById('cfgAntennaGain').value;

	localStorage.setItem('cfg_posyandu_ip', ip);
	localStorage.setItem('cfg_posyandu_ssid', ssid);
	localStorage.setItem('cfg_posyandu_pass', pass);
	localStorage.setItem('cfg_posyandu_gain', gain);

	const disp = document.getElementById('dispIpServer');
	if (disp) disp.innerText = ip;

	// Perbarui kode sketch Arduino IDE
	updateArduinoCodeDisplay(ip, ssid, pass, gain);

	$('#modalSettingEsp32').modal('hide');
	playChime(true);
	speakVoice("Pengaturan ESP32 berhasil disimpan dan diterapkan.");
}

function updateArduinoCodeDisplay(ip, ssid, pass, gain) {
	const el = document.getElementById('arduinoCode');
	if (!el) return;

	let gainCode = "rfc.PCD_SetAntennaGain(MFRC522::PCD_RxGain::RxGain_max);";
	if (gain === '38') gainCode = "rfc.PCD_SetAntennaGain(MFRC522::PCD_RxGain::RxGain_38dB);";
	if (gain === '33') gainCode = "rfc.PCD_SetAntennaGain(MFRC522::PCD_RxGain::RxGain_33dB);";

	let code = el.innerText;
	code = code.replace(/const char\* ssid\s*=\s*".*?";/, 'const char* ssid     = "' + ssid + '";');
	code = code.replace(/const char\* password\s*=\s*".*?";/, 'const char* password = "' + pass + '";');
	code = code.replace(/http:\/\/.*?\/kasrt\/smartrt\/posyandu_rfid_tap/, 'http://' + ip + '/kasrt/smartrt/posyandu_rfid_tap');
	el.innerText = code;
}

// ==============================================================
// 4. TAB NAVIGATION & MODALS
// ==============================================================
function switchTab(tabId, el) {
	document.querySelectorAll('.tab-content-section').forEach(t => t.style.display = 'none');
	document.querySelectorAll('.posyandu-nav-tabs .nav-link-item').forEach(l => l.classList.remove('active'));
	document.getElementById(tabId).style.display = 'block';
	if (el) el.classList.add('active');
}

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

// ==============================================================
// 5. REALTIME RADAR POLLING & STREAM
// ==============================================================
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

				// Jika ada tap baru
				if (top.id > lastSeenTapId) {
					if (lastSeenTapId !== 0) {
						if (top.status === 'SUCCESS') {
							playChime(true);
							speakVoice("Selamat datang! " + (top.keterangan || "Kehadiran balita tercatat."));
							setTimeout(() => { window.location.reload(); }, 2000);
						} else if (top.status === 'ALREADY_CHECKED') {
							playChime(false);
							speakVoice(top.keterangan || "Kartu ini sudah tercatat hadir.");
						} else if (top.status === 'UNREGISTERED') {
							playChime(false);
							speakVoice("Kartu e-KTP baru terdeteksi dengan nomor " + top.uid + ". Silakan pilih nama ibu warga.");
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
					namaEl.innerHTML = 'KTP Baru: <span class="font-monospace text-warning">' + top.uid + '</span>';
					detailEl.innerHTML = '<a href="javascript:void(0)" onclick="openPairModalWithWarga(null, null, \'' + top.uid + '\')" class="text-info font-weight-bold"><u>Klik di sini untuk tautkan ke data Ibu</u></a>';
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
	sendRfidTapToServer(uid.trim().toUpperCase());
}

// Inisialisasi awal
document.addEventListener('DOMContentLoaded', () => {
	loadEsp32Config();
});

setInterval(fetchLiveStream, 2500);
fetchLiveStream();
</script>
