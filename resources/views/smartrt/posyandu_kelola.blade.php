@extends('layouts.app')

@section('title', 'Posyandu Balita Digital')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap');

:root {
	--posyandu-primary: #0284c7;
	--card-border: rgba(226, 232, 240, 0.9);
}

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

.hub-body {
	padding: 24px 26px;
}

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

/* VISIONVILLAGE STYLE SCANNER CARD */
.vv-scanner-card {
	background: #ffffff;
	border: 2px solid #10b981;
	border-radius: 20px;
	padding: 24px;
	box-shadow: 0 10px 30px -5px rgba(16, 185, 129, 0.08);
	margin-bottom: 24px;
	position: relative;
}
.vv-pulse-dot {
	width: 10px;
	height: 10px;
	background: #10b981;
	border-radius: 50%;
	display: inline-block;
	box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
	animation: vvPulse 1.8s infinite;
}
@keyframes vvPulse {
	0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
	70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
	100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}
.vv-badge-status {
	background: #0f172a;
	color: #cbd5e1;
	font-size: 11px;
	font-weight: 700;
	padding: 3px 10px;
	border-radius: 6px;
}
.vv-endpoint-code {
	color: #e11d48;
	font-family: 'JetBrains Mono', monospace;
	font-size: 11.5px;
	word-break: break-all;
}
.vv-btn-usb {
	background: #059669;
	color: #ffffff !important;
	border: none;
	padding: 9px 18px;
	border-radius: 10px;
	font-weight: 700;
	font-size: 13px;
	display: inline-flex;
	align-items: center;
	gap: 8px;
	transition: all 0.2s;
	text-decoration: none !important;
}
.vv-btn-usb:hover {
	background: #047857;
	box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
}
.vv-android-banner {
	background: #eff6ff;
	border: 1px solid #bfdbfe;
	border-radius: 16px;
	padding: 16px 20px;
	margin-top: 18px;
	margin-bottom: 20px;
}
.vv-btn-nfc {
	background: #2563eb;
	color: #ffffff !important;
	border: none;
	padding: 12px 20px;
	border-radius: 12px;
	font-weight: 700;
	font-size: 13.5px;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	gap: 8px;
	transition: all 0.2s;
	text-decoration: none !important;
	flex: 1;
}
.vv-btn-nfc:hover {
	background: #1d4ed8;
	box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
}
.vv-btn-camera {
	background: #06b6d4;
	color: #ffffff !important;
	border: none;
	padding: 12px 20px;
	border-radius: 12px;
	font-weight: 700;
	font-size: 13.5px;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	gap: 8px;
	transition: all 0.2s;
	text-decoration: none !important;
	flex: 1;
}
.vv-btn-camera:hover {
	background: #0891b2;
	box-shadow: 0 4px 14px rgba(6, 182, 212, 0.25);
}
.vv-pill-test {
	background: #ffffff;
	border: 1px solid #10b981;
	color: #065f46 !important;
	font-size: 12px;
	font-weight: 600;
	padding: 5px 12px;
	border-radius: 20px;
	display: inline-flex;
	align-items: center;
	gap: 6px;
	text-decoration: none !important;
	transition: all 0.15s;
	margin-bottom: 6px;
}
.vv-pill-test:hover {
	background: #ecfdf5;
	border-color: #059669;
}
.vv-pill-yellow {
	border-color: #f59e0b;
	color: #b45309 !important;
}
.vv-pill-yellow:hover {
	background: #fffbeb;
	border-color: #d97706;
}
.vv-center-standby {
	padding: 32px 20px;
	text-align: center;
	background: #f8fafc;
	border: 1px dashed #cbd5e1;
	border-radius: 16px;
	margin-top: 12px;
}
.vv-btn-header-green {
	background: #10b981;
	color: #ffffff !important;
	border: none;
	padding: 10px 22px;
	border-radius: 30px;
	font-weight: 700;
	font-size: 13.5px;
	display: inline-flex;
	align-items: center;
	gap: 8px;
	box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35);
	transition: all 0.2s;
	text-decoration: none !important;
}
.vv-btn-header-green:hover {
	background: #059669;
	box-shadow: 0 6px 18px rgba(16, 185, 129, 0.45);
}
.vv-btn-header-cyan {
	background: #ffffff;
	color: #0284c7 !important;
	border: 1.5px solid #38bdf8;
	padding: 9px 20px;
	border-radius: 30px;
	font-weight: 700;
	font-size: 13.5px;
	display: inline-flex;
	align-items: center;
	gap: 8px;
	transition: all 0.2s;
	text-decoration: none !important;
}
.vv-btn-header-cyan:hover {
	background: #f0f9ff;
	border-color: #0284c7;
}
</style>

<!-- 1. HEADER VISIONVILLAGE STYLE -->
<div class="mb-4">
	<div class="d-flex flex-wrap justify-content-between align-items-center">
		<div class="mb-3 mb-md-0">
			<div class="d-flex align-items-center gap-2 mb-1" style="gap: 12px;">
				<span style="font-size: 32px; color: #10b981;"><i class="fas fa-id-card"></i></span>
				<h2 class="font-weight-bold mb-0" style="color: #059669; font-size: 26px; letter-spacing: -0.5px;">
					Loket Posyandu Balita & Tap e-KTP (RFID RC522)
				</h2>
			</div>
			<p class="text-muted mb-0" style="font-size: 14px;">
				Tempelkan e-KTP warga pada alat <strong>ESP32 + RFID RC522</strong> untuk absensi otomatis & pemeriksaan KMS.
			</p>
		</div>

		<div class="d-flex flex-wrap gap-2" style="gap: 10px;">
			<a href="#modalSettingEsp32" data-toggle="modal" class="vv-btn-header-cyan">
				<i class="fas fa-microchip"></i> Panduan & Kode ESP32
			</a>
			@if($sesi_aktif)
				<a href="#modalHadirManual" data-toggle="modal" class="vv-btn-header-green">
					<i class="fas fa-plus"></i> Catat Kehadiran Manual
				</a>
			@else
				<a href="#modalTambahSesi" data-toggle="modal" class="vv-btn-header-green">
					<i class="fas fa-plus"></i> Buka Sesi Posyandu
				</a>
			@endif
		</div>
	</div>
</div>

<!-- 2. SCANNER RFID CARD (VISIONVILLAGE DESIGN) -->
<div class="vv-scanner-card">
	<!-- BARIS ATAS: STATUS & SAMBUNGAN USB -->
	<div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
		<!-- KIRI: SCANNER STATUS & ENDPOINT -->
		<div class="mb-3 mb-xl-0" style="max-width: 620px;">
			<div class="d-flex align-items-center gap-2 mb-1" style="gap: 8px;">
				<span class="vv-pulse-dot"></span>
				<span class="font-weight-bold text-dark" style="font-size: 14px;" id="scannerLiveStatusText">
					Scanner RFID Aktif — Menunggu Tap e-KTP...
				</span>
				<span class="vv-badge-status" id="badgeLastTapInfo">Belum ada tap</span>
			</div>
			<div style="font-size: 11.5px; color: #475569; line-height: 1.5;">
				Endpoint ESP32: <span class="vv-endpoint-code">POST {{ route('posyandu.rfid_tap') }} (atau GET {{ route('posyandu.rfid_tap') }}?uid=UID_KTP)</span>
			</div>
		</div>

		<!-- KANAN: HUBUNGKAN USB & MANUAL TAP GROUP -->
		<div class="d-flex flex-wrap align-items-center gap-2" style="gap: 8px;">
			<div class="input-group input-group-sm" style="width: auto;">
				<button type="button" class="vv-btn-usb" id="btnConnectUsb" onclick="toggleUsbSerial()">
					<i class="fas fa-link mr-1"></i> <span id="usbBtnLabel">Hubungkan USB ESP32 (PC/Laptop)</span>
				</button>
				<select class="custom-select custom-select-sm ml-1" id="baudRateSelect" style="width: 85px; border-radius: 10px; font-weight: 600;">
					<option value="115200" selected>115200</option>
					<option value="9600">9600</option>
				</select>
			</div>

			<div class="input-group input-group-sm ml-xl-2" style="width: auto;">
				<input type="text" class="form-control font-monospace font-weight-bold" id="quickManualUid" placeholder="💳 Ketik UID KTP" style="width: 140px; border-radius: 8px 0 0 8px; text-transform: uppercase;">
				<div class="input-group-append">
					<button class="btn btn-info font-weight-bold" type="button" onclick="submitQuickManualUid()" style="border-radius: 0 8px 8px 0;">
						<i class="fas fa-hand-pointer mr-1"></i> Tap Manual
					</button>
				</div>
			</div>

			<button id="toggleAudioBtn" class="btn btn-sm btn-outline-warning text-dark font-weight-bold px-2 py-1" style="border-radius: 8px; font-size: 11.5px;">
				🔊 Suara: ON
			</button>
			<button class="btn btn-sm btn-outline-secondary px-2 py-1" onclick="fetchLiveStream()" title="Refresh" style="border-radius: 8px;">
				<i class="fas fa-redo"></i>
			</button>
		</div>
	</div>

	<!-- BARIS TENGAH: BANNER MODE HP ANDROID (NFC / QR / NIRKABEL) -->
	<div class="vv-android-banner">
		<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
			<div class="d-flex align-items-center gap-2" style="gap: 8px;">
				<span class="badge badge-primary px-2 py-1 font-weight-bold" style="border-radius: 6px; font-size: 11px;">
					📱 Mode HP Android
				</span>
				<span class="font-weight-bold text-dark" style="font-size: 13px;">
					Pilihan Cara Tap e-KTP di HP:
				</span>
			</div>
			<div class="d-flex gap-2" style="gap: 6px;">
				<span class="badge badge-warning text-dark px-2 py-1 font-weight-bold" style="font-size: 11px; border-radius: 6px;">
					🔊 Suara & Beep Aktif
				</span>
				<span class="badge badge-success px-2 py-1 font-weight-bold" style="font-size: 11px; border-radius: 6px;">
					📡 Auto-Sync ESP32 Terhubung
				</span>
			</div>
		</div>

		<!-- DUA TOMBOL UTAMA HP -->
		<div class="d-flex flex-wrap gap-2 mb-3" style="gap: 12px;">
			<button type="button" class="vv-btn-nfc" onclick="startNfcScan()">
				<span style="font-size: 18px;">📱</span> Tap via Sensor NFC HP (Tempel e-KTP ke Punggung HP)
			</button>
			<button type="button" class="vv-btn-camera" onclick="startCameraQrScan()">
				<span style="font-size: 18px;">📷</span> Scan Barcode / QR KTP via Kamera HP
			</button>
		</div>

		<div class="mb-3" style="font-size: 12.5px; color: #1e3a8a;">
			<i class="fas fa-check-circle text-success mr-1"></i> <strong>Nirkabel Otomatis:</strong> Anda juga bisa menempelkan e-KTP langsung pada alat <strong>ESP32 + RC522</strong> di meja. Hasil tap akan <strong>otomatis langsung tampil di HP/Laptop ini tanpa kabel!</strong>
		</div>

		<!-- UJI CEPAT (FAST SIMULATION PILLS) -->
		<div class="d-flex flex-wrap align-items-center gap-2" style="gap: 6px;">
			<span class="font-weight-bold text-dark mr-1" style="font-size: 12px;">
				⚡ Uji Cepat:
			</span>
			@php
				$sample_balitas = $balita_list->whereNotNull('rfid_ktp_ibu')->take(4);
			@endphp
			@forelse($sample_balitas as $sb)
				<a href="javascript:void(0)" class="vv-pill-test" onclick="sendRfidTapToServer('{{ $sb->rfid_ktp_ibu }}')">
					<i class="fas fa-id-card text-success"></i> Tap KTP {{ $sb->nama_ibu ?: $sb->nama_anak }} ({{ substr($sb->rfid_ktp_ibu, 0, 10) }})
				</a>
			@empty
				<a href="javascript:void(0)" class="vv-pill-test" onclick="sendRfidTapToServer('04A67F90380')">
					<i class="fas fa-id-card text-success"></i> Tap KTP Agus Wijaya (04A67F90380)
				</a>
				<a href="javascript:void(0)" class="vv-pill-test" onclick="sendRfidTapToServer('04A77F91980')">
					<i class="fas fa-id-card text-success"></i> Tap KTP Siti Aminah (04A77F91980)
				</a>
				<a href="javascript:void(0)" class="vv-pill-test" onclick="sendRfidTapToServer('04A65F90180')">
					<i class="fas fa-id-card text-success"></i> Tap Kartu Balita Kenzo (04A65F90180)
				</a>
			@endforelse
			<a href="javascript:void(0)" class="vv-pill-test vv-pill-yellow" onclick="sendRfidTapToServer('04E99A11B280')">
				<i class="fas fa-question-circle text-warning"></i> Simulasi KTP Baru (04E99A11B280)
			</a>
		</div>
	</div>

	<!-- BARIS BAWAH: HERO WAITING / HASIL TAP BOX -->
	<div class="vv-center-standby" id="vvHeroStandbyBox">
		<div id="vvHeroStandbyContent">
			<div style="font-size: 64px; line-height: 1; margin-bottom: 12px; color: #10b981;">
				<i class="fas fa-id-card"></i>
			</div>
			<h4 class="font-weight-bold text-dark mb-2" id="heroTapTitle" style="font-size: 20px;">
				Silakan Tempelkan Kartu e-KTP Warga pada Reader RC522
			</h4>
			<p class="text-muted mb-0" id="heroTapDesc" style="max-width: 680px; margin: 0 auto; font-size: 13.5px; line-height: 1.6;">
				Begitu kartu e-KTP ditempelkan ke modul RFID RC522, halaman ini akan otomatis menampilkan identitas balita & ibu, status KMS, dan mencatat absensi kehadiran secara live.
			</p>
		</div>

		<!-- TAMPILAN KETIKA KARTU TERDETEKSI (AWALNYA HIDE) -->
		<div id="vvHeroDetectedContent" style="display: none;">
			<div class="d-inline-flex align-items-center justify-content-center p-3 mb-2" id="vvDetectedIconBox" style="width: 70px; height: 70px; border-radius: 50%; font-size: 32px; background: #d1fae5;">
				<span id="lastTapIcon">🎉</span>
			</div>
			<div class="mb-2">
				<span class="badge badge-success px-3 py-1 font-weight-bold" id="lastTapStatusBadge" style="font-size: 13px; border-radius: 20px;">
					✅ Absen Berhasil!
				</span>
			</div>
			<h3 class="font-weight-bold text-dark mb-1" id="lastTapNama">
				Nama Balita / Warga
			</h3>
			<p class="text-muted mb-3 font-monospace" style="font-size: 14px;">
				UID e-KTP: <strong class="text-primary font-weight-bold" id="lastTapUid">-</strong> • <span id="lastTapTime">- WIB</span>
			</p>
			<div id="lastTapDetail">
				<!-- Detail atau link aksi -->
			</div>
		</div>
	</div>
</div>

<!-- 3. BENTO FINTECH KPI CARDS -->
<div class="bento-kpi-grid">
	<div class="bento-kpi-card">
		<div class="bento-accent-line bento-accent-cyan"></div>
		<div>
			<div class="kpi-number">{{ $total_balita }}</div>
			<div class="kpi-title">Total Balita Terdaftar</div>
		</div>
		<div class="kpi-icon-pill icon-cyan">👶</div>
	</div>

	<div class="bento-kpi-card">
		<div class="bento-accent-line bento-accent-emerald"></div>
		<div>
			<div class="kpi-number">{{ $total_ktp_ibu }}</div>
			<div class="kpi-title">e-KTP Ibu Terhubung</div>
		</div>
		<div class="kpi-icon-pill icon-emerald">🪪</div>
	</div>

	<div class="bento-kpi-card">
		<div class="bento-accent-line bento-accent-indigo"></div>
		<div>
			<div class="kpi-number" id="statHadirNum">{{ $total_hadir }}</div>
			<div class="kpi-title">Balita Hadir (Sesi Ini)</div>
		</div>
		<div class="kpi-icon-pill icon-indigo">✅</div>
	</div>

	<div class="bento-kpi-card">
		<div class="bento-accent-line bento-accent-amber"></div>
		<div>
			<div class="kpi-number">{{ count($sesi_list) }}</div>
			<div class="kpi-title">Total Sesi Terjadwal</div>
		</div>
		<div class="kpi-icon-pill icon-amber">📅</div>
	</div>
</div>

<!-- 4. NAVIGATION TABS -->
<div class="posyandu-nav-tabs">
	<a href="javascript:void(0)" class="nav-link-item active" onclick="switchTab('tabKehadiran', this)">
		<span>📋</span> Kehadiran & KMS
		<span class="badge badge-light text-dark ml-1" id="tabHadirBadge">{{ count($kehadiran_hari_ini) }}</span>
	</a>
	<a href="javascript:void(0)" class="nav-link-item" onclick="switchTab('tabBalita', this)">
		<span>👶</span> Data Balita & e-KTP Ibu
		<span class="badge badge-light text-dark ml-1">{{ count($balita_list) }}</span>
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
				<h5 class="font-weight-bold text-dark mb-0">Kehadiran Balita & Data Tumbuh Kembang (KMS)</h5>
				<small class="text-muted">
					@if($sesi_aktif)
						Sesi Aktif: <strong class="text-primary">{{ $sesi_aktif->nama_sesi }}</strong> ({{ date('d M Y', strtotime($sesi_aktif->tanggal)) }})
					@else
						<span class="text-danger font-weight-bold">Tidak ada sesi posyandu yang sedang aktif</span>
					@endif
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
			@if(!$sesi_aktif)
				<div class="text-center py-5">
					<div style="font-size: 48px; margin-bottom: 12px;">📅</div>
					<h5 class="font-weight-bold text-dark">Belum Ada Sesi Posyandu Aktif</h5>
					<p class="text-muted" style="max-width: 450px; margin: 0 auto 16px;">
						Buka tab <strong>Manajemen Sesi Posyandu</strong> lalu klik tombol <em>Jadikan Aktif</em> pada jadwal posyandu hari ini.
					</p>
				</div>
			@elseif(empty($kehadiran_hari_ini) || count($kehadiran_hari_ini) == 0)
				<div class="text-center py-5">
					<div style="font-size: 48px; margin-bottom: 12px;">👶</div>
					<h5 class="font-weight-bold text-dark">Belum Ada Balita yang Hadir</h5>
					<p class="text-muted" style="max-width: 450px; margin: 0 auto 16px;">
						Minta ibu balita menempelkan e-KTP ke sensor RFID RC522 atau klik tombol <em>Absen Balita Manual</em>.
					</p>
				</div>
			@else
				<div class="table-responsive">
					<table class="table table-hover mb-0">
						<thead class="bg-light">
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
							@foreach($kehadiran_hari_ini as $k)
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<div style="width: 40px; height: 40px; border-radius: 12px; background: {{ $k->jenis_kelamin == 'L' ? '#e0f2fe' : '#fce7f3' }}; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-right: 12px;">
												{{ $k->jenis_kelamin == 'L' ? '👦' : '👧' }}
											</div>
											<div>
												<strong class="text-dark d-block">{{ $k->nama_anak }}</strong>
												<small class="text-muted">
													Ibu: <strong>{{ $k->nama_ortu ?? '-' }}</strong>
													@if(!empty($k->rfid_ktp_ibu))
														<span class="badge badge-success ml-1">e-KTP Terdaftar</span>
													@endif
												</small>
											</div>
										</div>
									</td>
									<td>
										<span class="badge badge-light border text-dark font-weight-bold">
											{{ date('H:i', strtotime($k->jam_datang)) }} WIB
										</span>
										<br>
										<small class="text-muted font-weight-bold">
											{{ $k->metode_absen == 'RFID' ? '📶 Tap e-KTP' : '✍️ Input Manual' }}
										</small>
									</td>
									<td>
										<strong>{{ $k->berat_badan ? $k->berat_badan . ' kg' : '-' }}</strong>
										<br><small class="text-muted">{{ $k->tinggi_badan ? $k->tinggi_badan . ' cm' : '-' }}</small>
									</td>
									<td>
										<small class="d-block">LK: <strong>{{ $k->lingkar_kepala ? $k->lingkar_kepala . ' cm' : '-' }}</strong></small>
										<small class="d-block text-muted">LiLA: {{ $k->lila ? $k->lila . ' cm' : '-' }}</small>
									</td>
									<td>
										@if($k->status_gizi)
											@php
												$bcls = 'badge-success';
												if ($k->status_gizi == 'Kurang') $bcls = 'badge-warning text-dark';
												if ($k->status_gizi == 'Buruk')  $bcls = 'badge-danger';
												if ($k->status_gizi == 'Lebih')  $bcls = 'badge-info';
											@endphp
											<span class="badge {{ $bcls }} px-2 py-1">{{ $k->status_gizi }}</span>
										@else
											<span class="badge badge-light border text-muted px-2 py-1">Belum Diukur</span>
										@endif
									</td>
									<td>
										{!! $k->imunisasi ? '<span class="badge badge-info px-2 py-1">' . htmlspecialchars($k->imunisasi) . '</span>' : '<span class="text-muted">-</span>' !!}
										@if($k->vitamin_a != 'Tidak')
											<br><small class="text-success font-weight-bold">Vit A: {{ $k->vitamin_a }}</small>
										@endif
										@if($k->obat_cacing == 'Ya')
											<br><small class="text-danger font-weight-bold">Obat Cacing: Ya</small>
										@endif
									</td>
									<td class="text-center">
										<div class="btn-group">
											<button type="button" class="btn btn-sm btn-primary py-1 px-3 font-weight-bold" onclick="openModalPemeriksaan({{ json_encode($k) }})">
												⚖️ Periksa
											</button>
											<a href="{{ route('posyandu.cetak_kms', $k->balita_id) }}" target="_blank" class="btn btn-sm btn-outline-secondary py-1 px-2">
												🖨️ KMS
											</a>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@endif
		</div>
	</div>
</div>

<!-- TAB 2: DATA BALITA & E-KTP IBU -->
<div id="tabBalita" class="tab-content-section" style="display: none;">
	<div class="content-card">
		<div class="content-card-header">
			<div>
				<h5 class="font-weight-bold text-dark mb-0">Daftar Balita & Status e-KTP Ibu</h5>
				<small class="text-muted">Total terdaftar: <strong>{{ count($balita_list) }} balita</strong></small>
			</div>
			<button class="btn btn-primary btn-sm font-weight-bold" data-toggle="modal" data-target="#modalTambahBalita">
				<i class="fas fa-plus-circle mr-1"></i> Daftarkan Balita Baru
			</button>
		</div>

		<div class="card-body p-0">
			<div class="table-responsive">
				<table class="table table-hover mb-0">
					<thead class="bg-light">
						<tr>
							<th>Nama Balita</th>
							<th>Jenis Kelamin</th>
							<th>Tanggal Lahir</th>
							<th>Nama Ibu (Warga)</th>
							<th>Status e-KTP Ibu (RFID)</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($balita_list as $b)
							<tr>
								<td>
									<div class="d-flex align-items-center">
										<div style="width: 38px; height: 38px; border-radius: 10px; background: {{ $b->jenis_kelamin == 'L' ? '#e0f2fe' : '#fce7f3' }}; display: flex; align-items: center; justify-content: center; font-size: 16px; margin-right: 12px;">
											{{ $b->jenis_kelamin == 'L' ? '👦' : '👧' }}
										</div>
										<div>
											<strong class="text-dark">{{ $b->nama_anak }}</strong>
											@if(!empty($b->rfid_uid))
												<br><small class="text-muted">Kartu Anak: <code class="text-primary">{{ $b->rfid_uid }}</code></small>
											@endif
										</div>
									</div>
								</td>
								<td>
									<span class="badge {{ $b->jenis_kelamin == 'L' ? 'badge-primary' : 'badge-pink' }}">
										{{ $b->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}
									</span>
								</td>
								<td>{{ date('d/m/Y', strtotime($b->tanggal_lahir)) }}</td>
								<td>
									<strong>{{ $b->nama_ortu ?? 'Belum Ditautkan' }}</strong>
									<br><small class="text-muted">NIK: {{ $b->nik_ortu ?? '-' }}</small>
								</td>
								<td>
									@if(!empty($b->rfid_ktp_ibu))
										<span class="badge badge-success px-2 py-1 font-weight-bold">
											<i class="fas fa-check-circle mr-1"></i> KTP Terhubung
										</span>
										<br><small class="text-muted font-monospace">{{ $b->rfid_ktp_ibu }}</small>
									@else
										<button class="btn btn-sm btn-outline-warning py-1 px-2" onclick="openPairModalWithWarga('{{ $b->warga_id }}', '{{ $b->nama_ortu }}')">
											⚠️ Belum Ada KTP (Pair)
										</button>
									@endif
								</td>
								<td class="text-center">
									<div class="btn-group">
										<a href="{{ route('posyandu.cetak_kms', $b->id) }}" target="_blank" class="btn btn-sm btn-outline-primary py-1 px-2">
											🖨️ KMS
										</a>
										<a href="{{ route('posyandu.balita_hapus', $b->id) }}" onclick="return confirm('Hapus balita ini?')" class="btn btn-sm btn-outline-danger py-1 px-2">
											🗑️
										</a>
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- TAB 3: MANAJEMEN SESI POSYANDU -->
<div id="tabSesi" class="tab-content-section" style="display: none;">
	<div class="content-card">
		<div class="content-card-header">
			<h5 class="font-weight-bold text-dark mb-0">Jadwal & Sesi Posyandu RT</h5>
			<button class="btn btn-primary btn-sm font-weight-bold" data-toggle="modal" data-target="#modalTambahSesi">
				<i class="fas fa-plus-circle mr-1"></i> Buat Jadwal Sesi Baru
			</button>
		</div>

		<div class="card-body p-0">
			<div class="table-responsive">
				<table class="table table-hover mb-0">
					<thead class="bg-light">
						<tr>
							<th>Nama Sesi</th>
							<th>Tanggal & Waktu</th>
							<th>Lokasi</th>
							<th>Petugas</th>
							<th>Status</th>
							<th class="text-center">Ubah Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach($sesi_list as $s)
							<tr>
								<td>
									<strong class="text-dark">{{ $s->nama_sesi }}</strong>
									@if($s->catatan)<br><small class="text-muted">{{ $s->catatan }}</small>@endif
								</td>
								<td>
									<strong>{{ date('d M Y', strtotime($s->tanggal)) }}</strong>
									<br><small class="text-muted">{{ substr($s->waktu_mulai, 0, 5) }} - {{ $s->waktu_selesai ? substr($s->waktu_selesai, 0, 5) : 'Selesai' }} WIB</small>
								</td>
								<td>{{ $s->lokasi }}</td>
								<td>{{ $s->petugas ?? '-' }}</td>
								<td>
									@if($s->status == 'Aktif')
										<span class="badge badge-success px-3 py-1 font-weight-bold">🟢 SEDANG AKTIF</span>
									@elseif($s->status == 'Dijadwalkan')
										<span class="badge badge-info px-3 py-1 font-weight-bold">📅 Dijadwalkan</span>
									@else
										<span class="badge badge-secondary px-3 py-1">Selesai</span>
									@endif
								</td>
								<td class="text-center">
									@if($s->status != 'Aktif')
										<a href="{{ route('posyandu.sesi_status', [$s->id, 'Aktif']) }}" class="btn btn-sm btn-success px-3 py-1 font-weight-bold" onclick="return confirm('Aktifkan sesi ini?')">
											▶️ Aktifkan
										</a>
									@else
										<a href="{{ route('posyandu.sesi_status', [$s->id, 'Selesai']) }}" class="btn btn-sm btn-secondary px-3 py-1 font-weight-bold" onclick="return confirm('Tandai sesi ini Selesai?')">
											⏹️ Selesaikan
										</a>
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- TAB 4: FIRMWARE & WIRING ESP32 -->
<div id="tabEsp32" class="tab-content-section" style="display: none;">
	<div class="content-card mb-4">
		<div class="content-card-header">
			<h5 class="font-weight-bold text-dark mb-0">⚡ Skema Wiring Pin NodeMCU ESP32 ke RFID MFRC522</h5>
		</div>
		<div class="card-body p-4">
			<div class="row">
				<div class="col-md-6 mb-3">
					<table class="table table-bordered table-sm">
						<thead class="bg-light font-weight-bold">
							<tr><th>Pin RC522</th><th>Pin ESP32</th><th>Keterangan</th></tr>
						</thead>
						<tbody>
							<tr class="table-warning"><td><strong>3.3V (VCC)</strong></td><td><strong>3V3</strong></td><td><strong class="text-danger">Wajib 3.3V</strong></td></tr>
							<tr><td>RST</td><td>GPIO 22</td><td>Reset Pin</td></tr>
							<tr><td>GND</td><td>GND</td><td>Ground</td></tr>
							<tr><td>MISO</td><td>GPIO 19</td><td>SPI MISO</td></tr>
							<tr><td>MOSI</td><td>GPIO 23</td><td>SPI MOSI</td></tr>
							<tr><td>SCK</td><td>GPIO 18</td><td>SPI SCK</td></tr>
							<tr><td>SDA / SS</td><td>GPIO 5</td><td>SPI SS</td></tr>
							<tr class="table-info"><td>Buzzer (+)</td><td>GPIO 4</td><td>Buzzer Beep</td></tr>
							<tr class="table-success"><td>LED Hijau (+)</td><td>GPIO 15</td><td>Indikator Sukses</td></tr>
							<tr class="table-danger"><td>LED Merah (+)</td><td>GPIO 13</td><td>Indikator Gagal</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<div class="alert alert-info border-0 shadow-sm" style="border-radius: 14px; background: #f0f9ff; color: #0369a1;">
						<h6 class="font-weight-bold"><i class="fas fa-info-circle mr-1"></i> Endpoint API Server:</h6>
						<code style="font-size: 12px; font-weight: bold; color: #0284c7; background: #fff; padding: 8px 12px; border-radius: 6px; display: block; margin-bottom: 10px;">
							{{ route('posyandu.rfid_tap') }}
						</code>
						<small style="color: #475569;">
							• <strong>API Key:</strong> <code>kasrt2025</code><br>
							• <strong>Metode:</strong> POST / GET (HTTPClient ESP32)
						</small>
					</div>
					<div class="d-flex flex-wrap gap-2 mt-3" style="gap: 8px;">
						<a href="{{ route('posyandu.download_ino') }}" class="btn btn-success btn-sm font-weight-bold">
							<i class="fas fa-file-code mr-1"></i> Download .ino
						</a>
						<a href="{{ route('posyandu.download_zip') }}" class="btn btn-primary btn-sm font-weight-bold">
							<i class="fas fa-file-archive mr-1"></i> Download .ZIP
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- MODAL: SETTING ESP32 -->
<div class="modal fade" id="modalSettingEsp32" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
			<div class="modal-header text-white py-3" style="background: linear-gradient(135deg, #0f172a, #0284c7);">
				<h5 class="modal-title font-weight-bold"><i class="fas fa-sliders-h mr-2"></i> Pengaturan ESP32 & IoT Posyandu</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body p-4">
				<div class="row">
					<div class="col-md-6 mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">Nama Wi-Fi (SSID)</label>
						<input type="text" class="form-control" id="cfgWifiSsid" value="WiFi_Posyandu">
					</div>
					<div class="col-md-6 mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">Password Wi-Fi</label>
						<input type="text" class="form-control" id="cfgWifiPass" value="kasrt123">
					</div>
				</div>
				<div class="row">
					<div class="col-md-8 mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">Host / IP Server</label>
						<input type="text" class="form-control font-monospace" id="cfgServerIp" value="10.246.16.194">
					</div>
					<div class="col-md-4 mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">API Key</label>
						<input type="text" class="form-control font-monospace font-weight-bold" id="cfgApiKey" value="kasrt2025" readonly>
					</div>
				</div>
			</div>
			<div class="modal-footer bg-light py-2">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-primary btn-sm font-weight-bold px-4" onclick="saveEsp32Config()">Terapkan Pengaturan</button>
			</div>
		</div>
	</div>
</div>

<!-- MODAL: PAIR KTP -->
<div class="modal fade" id="modalPairKtp" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 16px; border: none;">
			<div class="modal-header bg-info text-white py-3">
				<h5 class="modal-title font-weight-bold">🪪 Hubungkan e-KTP Baru ke Ibu Warga</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<form method="post" action="{{ route('posyandu.pair_ktp') }}">
				@csrf
				<div class="modal-body p-4">
					<div class="form-group mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">Nomor UID e-KTP (HEX)</label>
						<div class="input-group">
							<input type="text" class="form-control font-monospace font-weight-bold" name="rfid_uid" id="pairRfidUid" placeholder="Contoh: A1B2C3D4" required>
							<div class="input-group-append">
								<button type="button" class="btn btn-outline-secondary btn-sm" onclick="pasteLastUid()">Gunakan Tap Terakhir</button>
							</div>
						</div>
					</div>
					<div class="form-group mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">Pilih Ibu Warga</label>
						<select name="warga_id" id="pairWargaId" class="form-control" required style="font-size: 13px;">
							<option value="">-- Pilih Nama Ibu Warga --</option>
							@foreach($warga_list as $w)
								<option value="{{ $w->idWarga }}">{{ $w->nama }} (NIK: {{ $w->nik }})</option>
							@endforeach
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

<!-- MODAL: TAMBAH SESI -->
<div class="modal fade" id="modalTambahSesi" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 16px; border: none;">
			<div class="modal-header bg-primary text-white py-3">
				<h5 class="modal-title font-weight-bold">📅 Buat Jadwal Sesi Posyandu</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<form method="post" action="{{ route('posyandu.sesi_tambah') }}">
				@csrf
				<div class="modal-body p-4">
					<div class="form-group mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">Nama Sesi</label>
						<input type="text" class="form-control" name="nama_sesi" value="Posyandu Balita {{ date('F Y') }}" required>
					</div>
					<div class="row">
						<div class="col-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Tanggal</label>
							<input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}" required>
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
							<label class="font-weight-bold" style="font-size: 13px;">Petugas / Bidan</label>
							<input type="text" class="form-control" name="petugas" placeholder="Nama Bidan">
						</div>
					</div>
					<div class="form-group mb-0">
						<label class="font-weight-bold" style="font-size: 13px;">Catatan (Opsional)</label>
						<textarea class="form-control" name="catatan" rows="2"></textarea>
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

<!-- MODAL: ABSEN MANUAL -->
@if($sesi_aktif)
<div class="modal fade" id="modalHadirManual" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 16px; border: none;">
			<div class="modal-header bg-dark text-white py-3">
				<h5 class="modal-title font-weight-bold">✍️ Absen Kehadiran Balita Manual</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<form method="post" action="{{ route('posyandu.hadir_manual') }}">
				@csrf
				<input type="hidden" name="sesi_id" value="{{ $sesi_aktif->id }}">
				<div class="modal-body p-4">
					<div class="form-group mb-3">
						<label class="font-weight-bold" style="font-size: 13px;">Pilih Balita</label>
						<select name="balita_id" class="form-control" required style="font-size: 13px;">
							<option value="">-- Pilih Balita --</option>
							@foreach($balita_list as $b)
								<option value="{{ $b->id }}">{{ $b->nama_anak }} (Ibu: {{ $b->nama_ortu ?? '-' }})</option>
							@endforeach
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
@endif

<!-- MODAL: TAMBAH BALITA -->
<div class="modal fade" id="modalTambahBalita" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 16px; border: none;">
			<div class="modal-header bg-success text-white py-3">
				<h5 class="modal-title font-weight-bold">👶 Daftarkan Balita Baru</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<form method="post" action="{{ route('posyandu.balita_tambah') }}">
				@csrf
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
							@foreach($warga_list as $w)
								<option value="{{ $w->idWarga }}">{{ $w->nama }} (NIK: {{ $w->nik }})</option>
							@endforeach
						</select>
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

<!-- MODAL: PEMERIKSAAN -->
<div class="modal fade" id="modalPemeriksaan" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden;">
			<div class="modal-header bg-primary text-white py-3">
				<h5 class="modal-title font-weight-bold">⚖️ Catat Pemeriksaan Tumbuh Kembang</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<form id="formPemeriksaan" method="post" action="">
				@csrf
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
							<input type="number" step="0.01" class="form-control" name="berat_badan" id="inputBB" required oninput="calcStatusGizi()">
						</div>
						<div class="col-md-3 col-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Tinggi Badan (cm)</label>
							<input type="number" step="0.1" class="form-control" name="tinggi_badan" id="inputTB" oninput="calcStatusGizi()">
						</div>
						<div class="col-md-3 col-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Lingkar Kepala (cm)</label>
							<input type="number" step="0.1" class="form-control" name="lingkar_kepala" id="inputLK">
						</div>
						<div class="col-md-3 col-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">LiLA (cm)</label>
							<input type="number" step="0.1" class="form-control" name="lila" id="inputLiLA">
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Status Gizi</label>
							<select name="status_gizi" id="inputStatusGizi" class="form-control" required>
								<option value="Normal">🟢 Normal</option>
								<option value="Kurang">🟡 Kurang</option>
								<option value="Buruk">🔴 Buruk</option>
								<option value="Lebih">🔵 Lebih</option>
							</select>
						</div>
						<div class="col-md-4 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Vitamin A</label>
							<select name="vitamin_a" id="inputVitA" class="form-control">
								<option value="Tidak">Tidak</option>
								<option value="Kapsul Biru (6-11 bln)">Kapsul Biru (6-11 bln)</option>
								<option value="Kapsul Merah (12-59 bln)">Kapsul Merah (12-59 bln)</option>
							</select>
						</div>
						<div class="col-md-4 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Obat Cacing</label>
							<select name="obat_cacing" id="inputObatCacing" class="form-control">
								<option value="Tidak">Tidak</option>
								<option value="Ya">Ya</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Imunisasi</label>
							<input type="text" class="form-control" name="imunisasi" id="inputImunisasi">
						</div>
						<div class="col-md-6 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Catatan Petugas</label>
							<input type="text" class="form-control" name="catatan" id="inputCatatan">
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

@push('scripts')
<script>
let audioCtx = null;
let soundEnabled = true;

function unlockAudio() {
	try {
		if (!audioCtx) audioCtx = new (window.AudioContext || window.webkitAudioContext)();
		if (audioCtx && audioCtx.state === 'suspended') audioCtx.resume();
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
		window.speechSynthesis.speak(u);
	} catch (e) { console.log(e); }
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
			osc.type = 'sine';
			osc.frequency.setValueAtTime(659.25, now);
			osc.frequency.setValueAtTime(987.77, now + 0.12);
			gain.gain.setValueAtTime(0.4, now);
			gain.gain.exponentialRampToValueAtTime(0.001, now + 0.5);
			osc.start(now);
			osc.stop(now + 0.5);
		} else {
			osc.type = 'triangle';
			osc.frequency.setValueAtTime(440.00, now);
			osc.frequency.setValueAtTime(349.23, now + 0.14);
			gain.gain.setValueAtTime(0.35, now);
			gain.gain.exponentialRampToValueAtTime(0.001, now + 0.4);
			osc.start(now);
			osc.stop(now + 0.4);
		}
	} catch (e) { console.log(e); }
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

let usbPort = null;
let usbReader = null;
let keepReadingUsb = true;

async function toggleUsbSerial() {
	if (!("serial" in navigator)) {
		alert("Browser Anda belum mendukung Web Serial API. Gunakan Google Chrome atau Microsoft Edge di PC/Laptop.");
		return;
	}
	const btn = document.getElementById('btnConnectUsb');
	const label = document.getElementById('usbBtnLabel');
	if (usbPort) {
		keepReadingUsb = false;
		if (usbReader) { try { await usbReader.cancel(); } catch(e){} }
		try { await usbPort.close(); } catch(e){}
		usbPort = null;
		if (label) label.innerText = 'Hubungkan USB ESP32 (PC/Laptop)';
		if (btn) btn.style.background = '#059669';
		speakVoice("Sambungan serial USB terputus.");
		return;
	}
	try {
		const baud = parseInt(document.getElementById('baudRateSelect')?.value || '115200');
		usbPort = await navigator.serial.requestPort();
		await usbPort.open({ baudRate: baud });
		keepReadingUsb = true;
		if (label) label.innerText = '🟢 Putuskan USB (COM Aktif)';
		if (btn) btn.style.background = '#dc2626';
		playChime(true);
		speakVoice("ESP32 terhubung melalui kabel USB. Siap membaca tap.");
		readUsbSerialStream();
	} catch (err) {
		console.error("USB Serial Connection Error:", err);
		alert("Gagal menghubungkan USB: " + err.message);
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
				lineBuffer = lines.pop();
				for (const line of lines) {
					// Dukung format: "UID: 8A3C4D1E", "Card UID: 8A 3C 4D 1E", "UID Kartu : 8A3C4D1E", dll
					const match = line.match(/(?:UID|Card UID|KTP)\s*[:=-]?\s*([0-9A-Fa-f\s]{8,24})/i);
					if (match && match[1]) {
						const cleanUid = match[1].replace(/\s+/g, '').trim().toUpperCase();
						if (cleanUid.length >= 4) {
							sendRfidTapToServer(cleanUid);
						}
					}
				}
			}
		}
	} catch (err) { console.warn(err); }
}

function sendRfidTapToServer(uid) {
	unlockAudio();
	fetch("{{ route('posyandu.rfid_tap') }}", {
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
			speakVoice("Kartu e-KTP baru belum terdaftar. Menampilkan jendela pendaftaran.");
			openPairModalWithWarga(null, null, uid);
		} else {
			playChime(false);
			speakVoice(res.message);
		}
		fetchLiveStream();
	})
	.catch(err => console.error("Error tap:", err));
}

function switchTab(tabId, el) {
	document.querySelectorAll('.tab-content-section').forEach(t => t.style.display = 'none');
	document.querySelectorAll('.posyandu-nav-tabs .nav-link-item').forEach(l => l.classList.remove('active'));
	document.getElementById(tabId).style.display = 'block';
	if (el) el.classList.add('active');
}

function openModalPemeriksaan(k) {
	document.getElementById('formPemeriksaan').action = "{{ url('smartrt/posyandu_update_pemeriksaan') }}/" + k.id;
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

let currentLastUid = '';

function openPairModalWithWarga(wargaId, namaWarga, uid) {
	$('#modalPairKtp').modal('show');
	if (wargaId) document.getElementById('pairWargaId').value = wargaId;
	if (uid) document.getElementById('pairRfidUid').value = uid;
	else if (currentLastUid) document.getElementById('pairRfidUid').value = currentLastUid;
}

function pasteLastUid() {
	if (currentLastUid) document.getElementById('pairRfidUid').value = currentLastUid;
	else alert('Belum ada kartu e-KTP baru yang di-tap.');
}

let lastSeenTapId = 0;

function submitQuickManualUid() {
	const input = document.getElementById('quickManualUid');
	const val = input ? input.value.trim() : '';
	if (!val) {
		alert("Silakan ketik nomor UID e-KTP terlebih dahulu.");
		return;
	}
	sendRfidTapToServer(val.toUpperCase());
	if (input) input.value = '';
}

async function startNfcScan() {
	if (!("NDEFReader" in window)) {
		alert("ℹ️ Sensor NFC Web hanya aktif pada Google Chrome di HP Android dengan NFC menyala.\n\nTips: Anda juga bisa menempelkan e-KTP langsung pada alat ESP32 di meja!");
		return;
	}
	try {
		const ndef = new NDEFReader();
		await ndef.scan();
		playChime(true);
		speakVoice("Sensor NFC HP aktif. Tempelkan e-KTP ke belakang HP Anda.");
		alert("📱 Sensor NFC HP Siap!\nTempelkan e-KTP ke bagian belakang bodi HP Anda.");
		ndef.onreading = event => {
			const serialNumber = event.serialNumber ? event.serialNumber.replace(/:/g, '').toUpperCase() : '';
			if (serialNumber) {
				sendRfidTapToServer(serialNumber);
			}
		};
	} catch (error) {
		alert("Error NFC: " + error.message);
	}
}

function startCameraQrScan() {
	const code = prompt("📷 SIMULASI SCAN KAMERA HP\n\nMasukkan teks / nomor barcode / QR KTP:", "3201012345670001");
	if (code) {
		sendRfidTapToServer(code.trim().toUpperCase());
	}
}

function fetchLiveStream() {
	fetch("{{ route('posyandu.live_stream') }}")
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

				// Toggle center standby box to detected card
				const standbyBox = document.getElementById('vvHeroStandbyContent');
				const detectedBox = document.getElementById('vvHeroDetectedContent');
				if (standbyBox && detectedBox) {
					standbyBox.style.display = 'none';
					detectedBox.style.display = 'block';
				}

				const badgeLast = document.getElementById('badgeLastTapInfo');
				if (badgeLast) {
					badgeLast.innerText = 'Tap: ' + top.created_at.substring(11, 16) + ' WIB';
					badgeLast.className = 'vv-badge-status bg-success text-white';
				}

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
							speakVoice("Kartu e-KTP baru terdeteksi dengan nomor " + top.uid + ".");
							openPairModalWithWarga(null, null, top.uid);
						}
					}
					lastSeenTapId = top.id;
				}

				const elUid = document.getElementById('lastTapUid');
				const elTime = document.getElementById('lastTapTime');
				if (elUid) elUid.innerText = top.uid;
				if (elTime) elTime.innerText = top.created_at.substring(11, 16) + ' WIB';

				const statusBadge = document.getElementById('lastTapStatusBadge');
				const namaEl = document.getElementById('lastTapNama');
				const detailEl = document.getElementById('lastTapDetail');
				const iconEl = document.getElementById('lastTapIcon');

				if (top.status === 'SUCCESS') {
					if (statusBadge) {
						statusBadge.className = 'badge badge-success px-3 py-1 font-weight-bold';
						statusBadge.innerText = '✅ Berhasil Hadir';
					}
					if (iconEl) iconEl.innerText = '🎉';
					if (namaEl) namaEl.innerText = top.keterangan || 'Balita Hadir';
					if (detailEl) detailEl.innerHTML = '<span class="text-success font-weight-bold"><i class="fas fa-check-circle mr-1"></i> Kehadiran balita telah tercatat di sistem posyandu</span>';
				} else if (top.status === 'ALREADY_CHECKED') {
					if (statusBadge) {
						statusBadge.className = 'badge badge-warning px-3 py-1 font-weight-bold text-dark';
						statusBadge.innerText = '⚠️ Sudah Hadir';
					}
					if (iconEl) iconEl.innerText = 'ℹ️';
					if (namaEl) namaEl.innerText = top.keterangan || 'Sudah Hadir';
					if (detailEl) detailEl.innerHTML = '<span class="text-muted"><i class="fas fa-history mr-1"></i> Kartu sudah di-tap sebelumnya pada sesi hari ini</span>';
				} else if (top.status === 'UNREGISTERED') {
					if (statusBadge) {
						statusBadge.className = 'badge badge-danger px-3 py-1 font-weight-bold';
						statusBadge.innerText = '🔔 KTP Baru (Belum Terdaftar)';
					}
					if (iconEl) iconEl.innerText = '🪪';
					if (namaEl) namaEl.innerHTML = 'KTP Baru: <span class="font-monospace text-warning">' + top.uid + '</span>';
					if (detailEl) detailEl.innerHTML = '<a href="javascript:void(0)" onclick="openPairModalWithWarga(null, null, \'' + top.uid + '\')" class="btn btn-warning btn-sm font-weight-bold px-3 py-1"><i class="fas fa-link mr-1"></i> Hubungkan ke Data Balita/Ibu Sekarang</a>';
				} else {
					if (statusBadge) {
						statusBadge.className = 'badge badge-secondary px-3 py-1';
						statusBadge.innerText = top.status;
					}
					if (iconEl) iconEl.innerText = '💳';
					if (namaEl) namaEl.innerText = top.keterangan || 'Menunggu Sesi Aktif';
					if (detailEl) detailEl.innerText = top.uid;
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

setInterval(fetchLiveStream, 2500);
fetchLiveStream();
</script>
@endpush
@endsection

