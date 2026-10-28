<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap');

.iuran-wrapper {
	font-family: 'Plus Jakarta Sans', sans-serif;
	color: #0f172a;
}

/* Stat Cards */
.iuran-stat-card {
	background: #ffffff;
	border-radius: 16px;
	padding: 22px 24px;
	border: 1px solid #e2e8f0;
	box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05);
	position: relative;
	overflow: hidden;
	transition: all 0.25s ease;
}
.iuran-stat-card:hover {
	transform: translateY(-3px);
	box-shadow: 0 12px 28px -4px rgba(0, 0, 0, 0.09);
}
.iuran-stat-card .glow {
	position: absolute;
	top: -24px;
	right: -24px;
	width: 90px;
	height: 90px;
	border-radius: 50%;
	opacity: 0.12;
}
.iuran-stat-card.emerald .glow { background: #10b981; }
.iuran-stat-card.blue .glow { background: #3b82f6; }
.iuran-stat-card.rose .glow { background: #f43f5e; }
.iuran-stat-card.amber .glow { background: #f59e0b; }

.stat-icon {
	width: 48px;
	height: 48px;
	border-radius: 12px;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 22px;
	margin-bottom: 12px;
}
.iuran-stat-card.emerald .stat-icon { background: #ecfdf5; color: #059669; }
.iuran-stat-card.blue .stat-icon { background: #eff6ff; color: #2563eb; }
.iuran-stat-card.rose .stat-icon { background: #fff1f2; color: #e11d48; }
.iuran-stat-card.amber .stat-icon { background: #fffbeb; color: #d97706; }

.stat-val {
	font-size: 28px;
	font-weight: 800;
	letter-spacing: -0.5px;
	color: #0f172a;
	line-height: 1.1;
}
.stat-sub {
	font-size: 13px;
	font-weight: 600;
	color: #64748b;
	margin-top: 4px;
	text-transform: uppercase;
	letter-spacing: 0.5px;
}

/* Nav Tabs */
.iuran-tabs {
	display: flex;
	gap: 10px;
	border-bottom: 2px solid #e2e8f0;
	padding-bottom: 12px;
	margin-bottom: 24px;
	flex-wrap: wrap;
}
.iuran-tabs .tab-item {
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
.iuran-tabs .tab-item:hover {
	background: #e2e8f0;
	color: #0f172a;
}
.iuran-tabs .tab-item.active {
	background: #059669;
	color: #ffffff;
	border-color: #059669;
	box-shadow: 0 4px 14px rgba(5, 150, 105, 0.3);
}

/* Matriks 12 Bulan Grid */
.matrix-table {
	border-collapse: separate;
	border-spacing: 0;
	width: 100%;
	font-size: 12px;
}
.matrix-table thead th {
	background: #f8fafc;
	color: #475569;
	font-weight: 700;
	padding: 12px 8px;
	text-align: center;
	border-top: 1px solid #e2e8f0;
	border-bottom: 2px solid #e2e8f0;
	white-space: nowrap;
}
.matrix-table thead th.sticky-col {
	position: sticky;
	left: 0;
	background: #f8fafc;
	z-index: 2;
	text-align: left;
	padding-left: 14px;
}
.matrix-table tbody td {
	padding: 10px 6px;
	text-align: center;
	vertical-align: middle;
	border-bottom: 1px solid #f1f5f9;
}
.matrix-table tbody td.sticky-col {
	position: sticky;
	left: 0;
	background: #ffffff;
	z-index: 1;
	text-align: left;
	padding-left: 14px;
	font-weight: 600;
	border-right: 2px solid #e2e8f0;
}
.matrix-table tbody tr:hover td {
	background: #f8fafc;
}
.matrix-table tbody tr:hover td.sticky-col {
	background: #f1f5f9;
}

/* Status Cell Pills */
.cell-pill {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	width: 32px;
	height: 30px;
	border-radius: 8px;
	font-weight: 700;
	font-size: 12px;
	cursor: pointer;
	transition: all 0.15s ease;
	text-decoration: none !important;
}
.cell-pill:hover {
	transform: scale(1.15);
	box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}
.cell-pill.lunas { background: #dcfce7; color: #15803d; border: 1px solid #86efac; }
.cell-pill.pending { background: #fef3c7; color: #b45309; border: 1px solid #fcd34d; animation: pulse 1.5s infinite; }
.cell-pill.nunggak { background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; }
.cell-pill.future { background: #f1f5f9; color: #94a3b8; border: 1px solid #e2e8f0; }

.legend-badge {
	display: inline-flex;
	align-items: center;
	gap: 6px;
	font-size: 12px;
	font-weight: 600;
	padding: 4px 10px;
	border-radius: 20px;
}
</style>

<div class="iuran-wrapper p-4">
	<?= $this->session->flashdata('message'); ?>

	<!-- Header Posyandu / Iuran Warga -->
	<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 pb-2 border-bottom">
		<div>
			<div class="d-flex align-items-center gap-2 mb-1">
				<span class="badge badge-success px-3 py-1 font-weight-bold" style="border-radius: 20px; font-size: 12px;">
					SISTEM KEUANGAN RT
				</span>
				<span class="text-muted" style="font-size: 13px;">• Tarif Iuran Kas: <strong>Rp 50.000 / Bulan</strong></span>
			</div>
			<h2 class="font-weight-bold text-dark mb-0">Kelola Iuran Kas Warga</h2>
			<p class="text-muted mb-0" style="font-size: 14px;">
				Monitoring matriks 12 bulan pembayaran iuran warga, verifikasi transfer, dan pencatatan kas otomatis.
			</p>
		</div>
		<div class="mt-3 mt-md-0 d-flex gap-2">
			<!-- Filter Tahun -->
			<form method="get" action="<?= base_url('smartrt/iuran'); ?>" class="form-inline">
				<div class="input-group input-group-sm">
					<div class="input-group-prepend"><span class="input-group-text font-weight-bold bg-white">Tahun:</span></div>
					<select name="tahun" class="form-control font-weight-bold" onchange="this.form.submit()" style="border-radius: 0 8px 8px 0;">
						<?php for ($y = date('Y') + 1; $y >= 2024; $y--): ?>
							<option value="<?= $y; ?>" <?= ($tahun == $y) ? 'selected' : ''; ?>><?= $y; ?></option>
						<?php endfor; ?>
					</select>
				</div>
			</form>

			<a href="#modalQuickPay" data-toggle="modal" class="btn btn-success btn-sm px-3 py-2 font-weight-bold" style="border-radius: 10px;">
				💵 Input Bayar Tunai (Quick Pay)
			</a>
		</div>
	</div>

	<!-- 4 Stat Cards Modern -->
	<div class="row mb-4">
		<div class="col-md-3 col-sm-6 mb-3">
			<div class="iuran-stat-card emerald">
				<div class="glow"></div>
				<div class="stat-icon">💰</div>
				<div class="stat-val">Rp <?= number_format($total_kas_tahun, 0, ',', '.'); ?></div>
				<div class="stat-sub">Kas Terkumpul (Tahun <?= $tahun; ?>)</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 mb-3">
			<div class="iuran-stat-card blue">
				<div class="glow"></div>
				<div class="stat-icon">🏡</div>
				<div class="stat-val"><?= $total_lunas_bulan_ini; ?> <span style="font-size: 16px; font-weight: 500; color: #64748b;">/ <?= count($warga_list); ?></span></div>
				<div class="stat-sub">Lunas Bulan Ini (<?= $bulan_ini_nama; ?>)</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 mb-3">
			<div class="iuran-stat-card rose">
				<div class="glow"></div>
				<div class="stat-icon">⚠️</div>
				<div class="stat-val"><?= count($warga_list) - $total_lunas_bulan_ini; ?> Rumah</div>
				<div class="stat-sub">Belum Lunas (<?= $bulan_ini_nama; ?>)</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 mb-3">
			<div class="iuran-stat-card amber">
				<div class="glow"></div>
				<div class="stat-icon">⏳</div>
				<div class="stat-val"><?= count($pending_list); ?></div>
				<div class="stat-sub">Pending Verifikasi Bendahara</div>
			</div>
		</div>
	</div>

	<!-- Navigation Tabs -->
	<div class="iuran-tabs">
		<a href="javascript:void(0)" class="tab-item active" onclick="switchIuranTab('tabMatriks', this)">
			<span>📊</span> Matriks Iuran 12 Bulan (Tahun <?= $tahun; ?>)
		</a>
		<a href="javascript:void(0)" class="tab-item" onclick="switchIuranTab('tabPending', this)">
			<span>⏳</span> Pengajuan Pending
			<?php if (count($pending_list) > 0): ?>
				<span class="badge badge-danger ml-1"><?= count($pending_list); ?> Butuh Tindakan</span>
			<?php endif; ?>
		</a>
		<a href="javascript:void(0)" class="tab-item" onclick="switchIuranTab('tabRiwayat', this)">
			<span>📜</span> Riwayat Transaksi Terbaru
		</a>
	</div>

	<!-- TAB 1: MATRIKS 12 BULAN WARGA -->
	<div id="tabMatriks" class="tab-section">
		<div class="card border-0 shadow-sm" style="border-radius: 16px;">
			<div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center">
				<div class="d-flex flex-wrap align-items-center gap-3">
					<h5 class="font-weight-bold text-dark mb-0">Tabel Matriks Pembayaran Seluruh Rumah (Tahun <?= $tahun; ?>)</h5>
					<div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
						<span class="legend-badge" style="background: #dcfce7; color: #15803d;">✔ Lunas</span>
						<span class="legend-badge" style="background: #fef3c7; color: #b45309;">⏳ Pending</span>
						<span class="legend-badge" style="background: #fee2e2; color: #b91c1c;">✖ Nunggak</span>
						<span class="legend-badge" style="background: #f1f5f9; color: #64748b;">○ Depan</span>
					</div>
				</div>
				<div class="mt-2 mt-md-0 text-muted" style="font-size: 13px;">
					<em>*Klik tanda pada tabel untuk bayar tunai / cetak kwitansi</em>
				</div>
			</div>

			<div class="card-body p-0">
				<div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
					<table class="table matrix-table mb-0">
						<thead>
							<tr>
								<th class="sticky-col" style="min-width: 220px;">No. Rumah & Nama Warga</th>
								<?php foreach ($bulan_list as $idx => $b): ?>
									<th style="width: 55px; <?= ($idx + 1 == $cur_month_idx && $tahun == date('Y')) ? 'background: #e0f2fe; color: #0284c7;' : ''; ?>">
										<?= substr($b, 0, 3); ?>
										<?php if ($idx + 1 == $cur_month_idx && $tahun == date('Y')): ?>
											<br><span class="badge badge-info" style="font-size: 9px;">Kini</span>
										<?php endif; ?>
									</th>
								<?php endforeach; ?>
								<th style="min-width: 100px;">Total Lunas</th>
								<th style="min-width: 90px;">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($warga_list as $w): ?>
								<?php
									$warga_id = $w->idWarga;
									$lunas_count = 0;
								?>
								<tr>
									<td class="sticky-col">
										<div class="d-flex align-items-center">
											<span class="badge badge-dark mr-2" style="font-size: 11px; padding: 4px 6px;">
												<?= htmlspecialchars($w->no_rumah ?: '-'); ?>
											</span>
											<div>
												<strong class="text-dark d-block"><?= htmlspecialchars($w->nama); ?></strong>
												<small class="text-muted">NIK: <?= $w->nik; ?></small>
											</div>
										</div>
									</td>

									<!-- 12 Bulan Kolom -->
									<?php foreach ($bulan_list as $m_idx => $b_name): ?>
										<?php
											$p = isset($matrix[$warga_id][$b_name]) ? $matrix[$warga_id][$b_name] : null;
											$month_num = $m_idx + 1;
										?>
										<td>
											<?php if ($p && $p->status == 'Disetujui'): ?>
												<?php $lunas_count++; ?>
												<a href="<?= base_url('smartrt/iuran_cetak_kwitansi/' . $p->id); ?>" target="_blank" class="cell-pill lunas" title="Lunas pada <?= date('d/m/Y', strtotime($p->tanggal_bayar)); ?> (Klik untuk Kwitansi)">
													✓
												</a>
											<?php elseif ($p && $p->status == 'Pending'): ?>
												<a href="javascript:void(0)" onclick="openVerifyModal(<?= htmlspecialchars(json_encode($p)); ?>, '<?= htmlspecialchars($w->nama); ?>')" class="cell-pill pending" title="Menunggu Verifikasi Bukti Transfer">
													⏳
												</a>
											<?php elseif ($tahun < date('Y') || ($tahun == date('Y') && $month_num <= $cur_month_idx)): ?>
												<a href="javascript:void(0)" onclick="openQuickPayModal('<?= $warga_id; ?>', '<?= htmlspecialchars($w->nama); ?>', '<?= $b_name; ?>')" class="cell-pill nunggak" title="Belum Bayar (Klik untuk Input Bayar Tunai)">
													✖
												</a>
											<?php else: ?>
												<a href="javascript:void(0)" onclick="openQuickPayModal('<?= $warga_id; ?>', '<?= htmlspecialchars($w->nama); ?>', '<?= $b_name; ?>')" class="cell-pill future" title="Bulan Mendatang (Bisa Bayar Dimuka)">
													○
												</a>
											<?php endif; ?>
										</td>
									<?php endforeach; ?>

									<td>
										<strong class="text-success" style="font-size: 13px;">Rp <?= number_format($lunas_count * 50000, 0, ',', '.'); ?></strong>
										<br><small class="text-muted"><?= $lunas_count; ?> / 12 bln</small>
									</td>
									<td>
										<button class="btn btn-sm btn-outline-primary py-1 px-2" style="font-size: 11px; border-radius: 6px;" onclick="openQuickPayModal('<?= $warga_id; ?>', '<?= htmlspecialchars($w->nama); ?>', '')">
											💵 Bayar
										</button>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- TAB 2: PENGAJUAN PENDING (VERIFIKASI BENDAHARA) -->
	<div id="tabPending" class="tab-section" style="display: none;">
		<div class="card border-0 shadow-sm" style="border-radius: 16px;">
			<div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
				<h5 class="font-weight-bold text-dark mb-0">Pengajuan Pembayaran Iuran Menunggu Verifikasi</h5>
				<span class="badge badge-warning px-3 py-1 font-weight-bold" style="font-size: 12px;">
					<?= count($pending_list); ?> Pengajuan
				</span>
			</div>

			<div class="card-body p-0">
				<?php if (empty($pending_list)): ?>
					<div class="text-center py-5 text-muted">
						<div style="font-size: 40px; margin-bottom: 8px;">🎉</div>
						<h6 class="font-weight-bold text-dark">Tidak Ada Pembayaran Pending</h6>
						<p class="mb-0" style="font-size: 13px;">Semua bukti pembayaran iuran warga sudah diverifikasi.</p>
					</div>
				<?php else: ?>
					<div class="table-responsive">
						<table class="table table-hover mb-0" style="font-size: 13px;">
							<thead class="bg-light">
								<tr>
									<th>Warga & Rumah</th>
									<th>Bulan & Tahun</th>
									<th>Nominal</th>
									<th>Metode</th>
									<th>Bukti Pembayaran</th>
									<th>Tanggal Pengajuan</th>
									<th class="text-center">Aksi Verifikasi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($pending_list as $pen): ?>
									<tr>
										<td>
											<strong><?= htmlspecialchars($pen->nama_warga); ?></strong>
											<br><small class="text-muted">Rumah No. <?= htmlspecialchars($pen->no_rumah ?: '-'); ?></small>
										</td>
										<td>
											<span class="badge badge-primary px-2 py-1 font-weight-bold" style="font-size: 12px;">
												<?= $pen->bulan; ?> <?= $pen->tahun; ?>
											</span>
										</td>
										<td class="font-weight-bold text-success">
											Rp <?= number_format($pen->jumlah, 0, ',', '.'); ?>
										</td>
										<td>
											<span class="badge <?= $pen->metode == 'QR' ? 'badge-info' : 'badge-secondary'; ?>">
												<?= $pen->metode == 'QR' ? '📱 Scan QR / Transfer' : '💵 Tunai'; ?>
											</span>
										</td>
										<td>
											<?php if ($pen->bukti_bayar): ?>
												<a href="<?= base_url('assets/profil/' . $pen->bukti_bayar); ?>" target="_blank" class="btn btn-sm btn-outline-info py-0 px-2 font-weight-bold">
													🔍 Lihat Bukti Struk
												</a>
											<?php else: ?>
												<span class="text-muted">-</span>
											<?php endif; ?>
										</td>
										<td>
											<?= date('d M Y, H:i', strtotime($pen->tanggal_bayar)); ?> WIB
										</td>
										<td class="text-center">
											<div class="btn-group">
												<a href="<?= base_url('smartrt/iuran_update_status/' . $pen->id . '/Disetujui'); ?>" class="btn btn-sm btn-success font-weight-bold px-3" onclick="return confirm('Setujui pembayaran ini? Nominal Rp <?= number_format($pen->jumlah, 0, ',', '.'); ?> akan otomatis dicatat masuk ke Kas RT.')">
													✓ Setujui
												</a>
												<a href="<?= base_url('smartrt/iuran_update_status/' . $pen->id . '/Ditolak'); ?>" class="btn btn-sm btn-danger px-2" onclick="return confirm('Tolak pembayaran ini?')">
													✕ Tolak
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

	<!-- TAB 3: RIWAYAT TRANSAKSI TERBARU -->
	<div id="tabRiwayat" class="tab-section" style="display: none;">
		<div class="card border-0 shadow-sm" style="border-radius: 16px;">
			<div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
				<h5 class="font-weight-bold text-dark mb-0">Riwayat Pembayaran Iuran (50 Terakhir)</h5>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table table-hover mb-0" style="font-size: 13px;">
						<thead class="bg-light">
							<tr>
								<th>ID</th>
								<th>Warga / Rumah</th>
								<th>Iuran Periode</th>
								<th>Nominal</th>
								<th>Metode</th>
								<th>Status</th>
								<th>Tanggal Bayar</th>
								<th class="text-center">Kwitansi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($recent_payments as $rp): ?>
								<tr>
									<td><code class="text-muted font-monospace">#<?= str_pad($rp->id, 5, '0', STR_PAD_LEFT); ?></code></td>
									<td>
										<strong><?= htmlspecialchars($rp->nama_warga); ?></strong>
										<br><small class="text-muted">No. Rumah: <?= htmlspecialchars($rp->no_rumah ?: '-'); ?></small>
									</td>
									<td><strong><?= $rp->bulan; ?> <?= $rp->tahun; ?></strong></td>
									<td class="font-weight-bold text-success">Rp <?= number_format($rp->jumlah, 0, ',', '.'); ?></td>
									<td>
										<span class="badge <?= $rp->metode == 'QR' ? 'badge-info' : 'badge-secondary'; ?>">
											<?= $rp->metode; ?>
										</span>
									</td>
									<td>
										<?php if ($rp->status == 'Disetujui'): ?>
											<span class="badge badge-success">Disetujui (Lunas)</span>
										<?php elseif ($rp->status == 'Pending'): ?>
											<span class="badge badge-warning text-dark">Pending</span>
										<?php else: ?>
											<span class="badge badge-danger">Ditolak</span>
										<?php endif; ?>
									</td>
									<td><?= date('d M Y, H:i', strtotime($rp->tanggal_bayar)); ?></td>
									<td class="text-center">
										<?php if ($rp->status == 'Disetujui'): ?>
											<a href="<?= base_url('smartrt/iuran_cetak_kwitansi/' . $rp->id); ?>" target="_blank" class="btn btn-sm btn-outline-secondary py-1 px-2 font-weight-bold">
												🖨️ Cetak
											</a>
										<?php else: ?>
											-
										<?php endif; ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>

<!-- MODAL: QUICK PAY (BAYAR TUNAI DI BALAI RT) -->
<div class="modal fade" id="modalQuickPay" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content" style="border-radius: 16px; border: none;">
			<div class="modal-header bg-success text-white py-3">
				<h5 class="modal-title font-weight-bold">💵 Input Pembayaran Tunai Iuran Warga</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<form method="post" action="<?= base_url('smartrt/iuran_quick_pay'); ?>">
				<div class="modal-body p-4">
					<p class="text-muted" style="font-size: 13px;">
						Gunakan form ini saat warga menyerahkan uang tunai langsung ke Bendahara / Pak RT. Status otomatis <strong>Disetujui</strong> dan nominal langsung masuk ke buku kas.
					</p>

					<div class="row">
						<div class="col-md-7 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Pilih Warga / Rumah</label>
							<select name="warga_id" id="quickPayWargaId" class="form-control" required style="font-size: 13px;">
								<option value="">-- Pilih Warga --</option>
								<?php foreach ($warga_list as $w): ?>
									<option value="<?= $w->idWarga; ?>">
										[Rumah <?= htmlspecialchars($w->no_rumah ?: '-'); ?>] <?= htmlspecialchars($w->nama); ?> (NIK: <?= $w->nik; ?>)
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-md-5 mb-3">
							<label class="font-weight-bold" style="font-size: 13px;">Tahun Iuran</label>
							<select name="tahun" class="form-control" required>
								<?php for ($y = date('Y') + 1; $y >= 2024; $y--): ?>
									<option value="<?= $y; ?>" <?= ($tahun == $y) ? 'selected' : ''; ?>><?= $y; ?></option>
								<?php endfor; ?>
							</select>
						</div>
					</div>

					<div class="form-group mb-3">
						<label class="font-weight-bold d-block" style="font-size: 13px;">
							Pilih Bulan yang Dibayarkan (Bisa pilih sekaligus banyak)
						</label>
						<div class="row" id="bulanCheckboxes">
							<?php foreach ($bulan_list as $b): ?>
								<div class="col-md-3 col-4 mb-2">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="bulan[]" value="<?= $b; ?>" class="custom-control-input month-check" id="check_<?= $b; ?>" onchange="recalcTotalQuickPay()">
										<label class="custom-control-label" for="check_<?= $b; ?>" style="font-size: 13px;">
											<?= $b; ?>
										</label>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>

					<div class="alert alert-light border d-flex justify-content-between align-items-center mb-0" style="border-radius: 12px; background: #f8fafc;">
						<div>
							<small class="text-muted d-block">Tarif per Bulan: Rp 50.000</small>
							<span style="font-size: 14px; font-weight: 700;">Total Tagihan yang Diterima:</span>
						</div>
						<h4 class="font-weight-bold text-success mb-0" id="quickPayTotalText">Rp 0</h4>
						<input type="hidden" name="jumlah" value="50000">
					</div>
				</div>
				<div class="modal-footer bg-light py-2">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-success btn-sm font-weight-bold px-4">✓ Catat Lunas & Simpan ke Kas</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
function switchIuranTab(tabId, el) {
	document.querySelectorAll('.tab-section').forEach(t => t.style.display = 'none');
	document.querySelectorAll('.iuran-tabs .tab-item').forEach(l => l.classList.remove('active'));
	document.getElementById(tabId).style.display = 'block';
	el.classList.add('active');
}

function openQuickPayModal(wargaId, namaWarga, bulanName) {
	if (wargaId) {
		document.getElementById('quickPayWargaId').value = wargaId;
	}
	// Reset all checks
	document.querySelectorAll('.month-check').forEach(c => c.checked = false);

	if (bulanName) {
		const target = document.getElementById('check_' + bulanName);
		if (target) target.checked = true;
	}
	recalcTotalQuickPay();
	$('#modalQuickPay').modal('show');
}

function recalcTotalQuickPay() {
	const checked = document.querySelectorAll('.month-check:checked').length;
	const total = checked * 50000;
	document.getElementById('quickPayTotalText').innerText = 'Rp ' + total.toLocaleString('id-ID');
}
</script>
