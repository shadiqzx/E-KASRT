<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap');

.transfer-page-wrapper {
	font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
	color: #0f172a;
	padding-bottom: 50px;
}

/* Hero Banner */
.transfer-hero-banner {
	background: linear-gradient(135deg, #1e1b4b 0%, #4338ca 45%, #0284c7 100%);
	border-radius: 20px;
	padding: 28px 32px;
	color: #ffffff;
	box-shadow: 0 12px 30px -8px rgba(67, 56, 202, 0.35);
	position: relative;
	overflow: hidden;
	margin-bottom: 26px;
}
.transfer-hero-banner::after {
	content: '';
	position: absolute;
	right: -40px;
	bottom: -50px;
	width: 220px;
	height: 220px;
	background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
	border-radius: 50%;
	pointer-events: none;
}
.hero-icon-box--transfer {
	width: 64px;
	height: 64px;
	background: rgba(255, 255, 255, 0.18);
	backdrop-filter: blur(8px);
	border-radius: 16px;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 28px;
	color: #ffffff;
	flex-shrink: 0;
	margin-right: 20px;
	border: 1px solid rgba(255,255,255,0.25);
}

/* Quick Nav Switcher */
.kas-nav-switcher {
	display: inline-flex;
	background: rgba(255, 255, 255, 0.15);
	padding: 4px;
	border-radius: 12px;
	backdrop-filter: blur(4px);
}
.kas-nav-switcher a {
	padding: 8px 16px;
	border-radius: 9px;
	font-size: 13px;
	font-weight: 700;
	color: #ffffff;
	text-decoration: none;
	transition: all 0.2s ease;
	display: inline-flex;
	align-items: center;
	gap: 6px;
}
.kas-nav-switcher a.active {
	background: #ffffff;
	color: #4338ca;
	box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.kas-nav-switcher a:hover:not(.active) {
	background: rgba(255,255,255,0.2);
	color: #fff;
}

/* Visual Transfer Flow Card */
.transfer-flow-card {
	background: #ffffff;
	border-radius: 18px;
	border: 1px solid #e2e8f0;
	padding: 24px 28px;
	box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.05);
	margin-bottom: 26px;
}
.flow-account-box {
	background: #f8fafc;
	border: 1.5px solid #e2e8f0;
	border-radius: 14px;
	padding: 16px 20px;
	text-align: center;
	flex: 1;
	min-width: 200px;
	transition: all 0.2s;
}
.flow-account-box:hover {
	border-color: #4f46e5;
	background: #fdfdfd;
}
.flow-arrow-animation {
	display: flex;
	align-items: center;
	justify-content: center;
	padding: 0 20px;
	color: #4f46e5;
	font-size: 26px;
	flex-direction: column;
}
.flow-arrow-animation small {
	font-size: 11px;
	font-weight: 700;
	color: #64748b;
	text-transform: uppercase;
	letter-spacing: 0.5px;
	margin-top: 4px;
}

/* Stat KPI Cards */
.transfer-stat-grid {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
	gap: 16px;
	margin-bottom: 26px;
}
.transfer-stat-card {
	background: #ffffff;
	border-radius: 16px;
	padding: 20px;
	border: 1px solid #e2e8f0;
	box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04);
	transition: all 0.25s ease;
}
.transfer-stat-card:hover {
	transform: translateY(-3px);
	box-shadow: 0 10px 24px -4px rgba(15, 23, 42, 0.08);
}
.transfer-card-val {
	font-size: 24px;
	font-weight: 800;
	color: #0f172a;
	line-height: 1.2;
	margin-bottom: 4px;
	font-family: 'Plus Jakarta Sans', sans-serif;
}

/* Table styling */
.transfer-table-card {
	background: #ffffff;
	border-radius: 18px;
	border: 1px solid #e2e8f0;
	box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.05);
	overflow: hidden;
}
.table-modern-transfer {
	width: 100%;
	margin-bottom: 0;
	border-collapse: separate;
	border-spacing: 0;
}
.table-modern-transfer thead th {
	background: #f8fafc;
	color: #475569;
	font-size: 11px;
	font-weight: 800;
	text-transform: uppercase;
	letter-spacing: 0.6px;
	padding: 14px 18px;
	border-top: none;
	border-bottom: 1px solid #e2e8f0;
}
.table-modern-transfer tbody td {
	padding: 16px 18px;
	vertical-align: middle;
	border-top: 1px solid #f1f5f9;
	font-size: 13.5px;
	color: #1e293b;
}
.transfer-badge-sumber {
	background: #fff1f2;
	color: #be123c;
	border: 1px solid #fecdd3;
	font-weight: 700;
	font-size: 11.5px;
	padding: 4px 9px;
	border-radius: 7px;
	display: inline-block;
}
.transfer-badge-tujuan {
	background: #ecfdf5;
	color: #047857;
	border: 1px solid #a7f3d0;
	font-weight: 700;
	font-size: 11.5px;
	padding: 4px 9px;
	border-radius: 7px;
	display: inline-block;
}

/* Modal styling */
.modal-header-indigo {
	background: linear-gradient(135deg, #1e1b4b 0%, #4338ca 100%);
	color: #fff;
	padding: 20px 24px;
	border-bottom: none;
}
.modal-modern-content {
	border: none;
	border-radius: 20px;
	overflow: hidden;
	box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}
</style>

<div class="page-content--bgf7 transfer-page-wrapper">
	<div class="container-fluid" style="max-width: 1340px; margin: 0 auto; padding-top: 30px;">

		<!-- Flash Message Alert -->
		<?php if ($this->session->flashdata('message')): ?>
			<div class="mb-4">
				<?= $this->session->flashdata('message'); ?>
			</div>
		<?php endif; ?>

		<!-- Hero Banner -->
		<div class="transfer-hero-banner">
			<div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 18px;">
				<div class="d-flex align-items-center">
					<div class="hero-icon-box--transfer">
						<i class="fas fa-exchange-alt"></i>
					</div>
					<div>
						<span class="badge badge-light text-primary font-weight-bold mb-2 px-3 py-1" style="border-radius: 20px; font-size: 11px;">
							<i class="fas fa-random mr-1"></i> MODUL TRANSAKSI &bull; MUTASI INTERNAL
						</span>
						<h2 class="font-weight-bold mb-1 text-white">Transfer Kas RT</h2>
						<p class="mb-0 text-white-50" style="font-size: 14px;">
							Pindah buku & mutasi saldo antar kas tunai bendahara, rekening bank RT, dompet QRIS, dan alokasi dana khusus.
						</p>
					</div>
				</div>

				<div class="d-flex flex-wrap align-items-center" style="gap: 12px;">
					<!-- Quick Switcher -->
					<div class="kas-nav-switcher">
						<a href="<?= base_url('kasRT'); ?>">
							<i class="fas fa-arrow-down text-success"></i> Kas Masuk
						</a>
						<a href="<?= base_url('kasRT/kasKeluar'); ?>">
							<i class="fas fa-arrow-up text-danger"></i> Kas Keluar
						</a>
						<a href="<?= base_url('kasRT/transfer'); ?>" class="active">
							<i class="fas fa-exchange-alt text-primary"></i> Transfer
						</a>
					</div>

					<button class="btn btn-light font-weight-bold px-3 py-2 text-primary shadow-sm" data-toggle="modal" data-target="#modalAddTransfer" style="border-radius: 10px; font-size: 13.5px;">
						<i class="fas fa-plus-circle mr-1"></i> Buat Transfer Baru
					</button>
				</div>
			</div>
		</div>

		<!-- 3 Stat KPI Cards -->
		<div class="transfer-stat-grid">
			<!-- Saldo Kas RT -->
			<div class="transfer-stat-card">
				<div class="d-flex align-items-center justify-content-between mb-2">
					<small class="text-muted font-weight-bold text-uppercase" style="font-size: 11px;">Total Saldo Kas RT</small>
					<div style="width: 36px; height: 36px; background: #eff6ff; color: #2563eb; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px;">
						<i class="fas fa-wallet"></i>
					</div>
				</div>
				<div class="transfer-card-val text-primary">Rp <?= rupiah($saldo_kas ?? 0); ?></div>
				<p class="mb-0 text-muted" style="font-size: 12px;">Saldo gabungan seluruh rekening & kas tunai</p>
			</div>

			<!-- Kas Masuk Akumulasi -->
			<div class="transfer-stat-card">
				<div class="d-flex align-items-center justify-content-between mb-2">
					<small class="text-muted font-weight-bold text-uppercase" style="font-size: 11px;">Akumulasi Pemasukan</small>
					<div style="width: 36px; height: 36px; background: #ecfdf5; color: #059669; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px;">
						<i class="fas fa-arrow-down"></i>
					</div>
				</div>
				<div class="transfer-card-val text-success">Rp <?= rupiah($total_masuk ?? 0); ?></div>
				<p class="mb-0 text-muted" style="font-size: 12px;">Penerimaan total sebelum mutasi</p>
			</div>

			<!-- Kas Keluar Akumulasi -->
			<div class="transfer-stat-card">
				<div class="d-flex align-items-center justify-content-between mb-2">
					<small class="text-muted font-weight-bold text-uppercase" style="font-size: 11px;">Akumulasi Pengeluaran</small>
					<div style="width: 36px; height: 36px; background: #fff1f2; color: #dc2626; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px;">
						<i class="fas fa-arrow-up"></i>
					</div>
				</div>
				<div class="transfer-card-val text-danger">Rp <?= rupiah($total_keluar ?? 0); ?></div>
				<p class="mb-0 text-muted" style="font-size: 12px;">Belanja total lingkungan RT</p>
			</div>
		</div>

		<!-- Visual Transfer Pipeline Explanation Card -->
		<div class="transfer-flow-card">
			<div class="d-flex align-items-center justify-content-between mb-3 flex-wrap" style="gap: 10px;">
				<div>
					<h5 class="font-weight-bold mb-1">Mekanisme Transfer Antar Kas RT</h5>
					<p class="text-muted mb-0" style="font-size: 13px;">Sistem otomatis mencatat arus keluar & arus masuk berpasangan sehingga saldo kas tetap seimbang dan transparan.</p>
				</div>
				<button class="btn btn-outline-primary btn-sm font-weight-bold px-3 py-2" data-toggle="modal" data-target="#modalAddTransfer" style="border-radius: 8px;">
					<i class="fas fa-random mr-1"></i> Eksekusi Transfer
				</button>
			</div>

			<div class="d-flex flex-wrap align-items-center justify-content-between pt-2" style="gap: 14px;">
				<div class="flow-account-box">
					<div style="font-size: 24px; margin-bottom: 6px;">💵</div>
					<h6 class="font-weight-bold mb-0">Kas Tunai Bendahara</h6>
					<small class="text-muted">Uang cash fisik di brankas RT</small>
				</div>

				<div class="flow-arrow-animation">
					<i class="fas fa-arrows-alt-h"></i>
					<small>Mutasi Saldo</small>
				</div>

				<div class="flow-account-box">
					<div style="font-size: 24px; margin-bottom: 6px;">🏦</div>
					<h6 class="font-weight-bold mb-0">Rekening Bank RT</h6>
					<small class="text-muted">BCA / BRI / Mandiri RT</small>
				</div>

				<div class="flow-arrow-animation">
					<i class="fas fa-arrows-alt-h"></i>
					<small>Alokasi Khusus</small>
				</div>

				<div class="flow-account-box">
					<div style="font-size: 24px; margin-bottom: 6px;">🎯</div>
					<h6 class="font-weight-bold mb-0">Kas Khusus / Posyandu</h6>
					<small class="text-muted">Dana darurat & kegiatan warga</small>
				</div>
			</div>
		</div>

		<!-- History Table Card -->
		<div class="transfer-table-card">
			<div class="p-3 border-bottom d-flex justify-content-between align-items-center flex-wrap" style="gap: 10px;">
				<h5 class="font-weight-bold mb-0" style="color: #0f172a;">
					<i class="fas fa-history text-primary mr-1"></i> Log Mutasi Transfer Kas
				</h5>
				<span class="badge badge-light border text-muted px-3 py-2" style="border-radius: 8px; font-size: 12px;">
					Total <?= count($transfers ?? []); ?> catatan transfer
				</span>
			</div>

			<div class="table-responsive">
				<table class="table table-modern-transfer">
					<thead>
						<tr>
							<th style="width: 130px;">No. Mutasi</th>
							<th style="width: 140px;">Tanggal</th>
							<th>Keterangan / Rincian Transfer</th>
							<th style="width: 140px;" class="text-center">Jenis Arus</th>
							<th style="width: 180px;" class="text-right">Nominal (Rp)</th>
							<th style="width: 100px;" class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($transfers)): ?>
							<?php foreach ($transfers as $tr): ?>
							<tr>
								<td>
									<span class="font-weight-bold" style="font-family: 'JetBrains Mono', monospace; background: #f1f5f9; padding: 4px 8px; border-radius: 6px; font-size: 12px;">
										#<?= $tr->idKas; ?>
									</span>
								</td>
								<td>
									<strong style="font-size: 13px;"><?= date('d M Y', strtotime($tr->tanggal)); ?></strong>
								</td>
								<td>
									<div class="font-weight-bold text-dark" style="font-size: 13.5px;">
										<?= htmlspecialchars($tr->keterangan); ?>
									</div>
								</td>
								<td class="text-center">
									<?php if ($tr->jenis == 'keluar'): ?>
										<span class="transfer-badge-sumber">
											<i class="fas fa-arrow-up mr-1"></i> Dana Keluar
										</span>
									<?php else: ?>
										<span class="transfer-badge-tujuan">
											<i class="fas fa-arrow-down mr-1"></i> Dana Masuk
										</span>
									<?php endif; ?>
								</td>
								<td class="text-right">
									<strong style="font-family: 'JetBrains Mono', monospace; font-size: 14px; color: <?= $tr->jenis == 'masuk' ? '#059669' : '#dc2626'; ?>;">
										<?= $tr->jenis == 'masuk' ? '+' : '-'; ?> Rp <?= rupiah($tr->jumlah); ?>
									</strong>
								</td>
								<td class="text-center">
									<a href="<?= base_url('kasRT/kwitansiKas/' . $tr->idKas); ?>" target="_blank" class="btn btn-sm btn-outline-primary" style="border-radius: 6px;" title="Cetak Bukti Transfer">
										<i class="fas fa-print"></i>
									</a>
								</td>
							</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan="6" class="text-center py-5 text-muted">
									<i class="fas fa-exchange-alt fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
									<h6>Belum Ada Riwayat Transfer Kas</h6>
									<p style="font-size: 13px;">Gunakan tombol "Buat Transfer Baru" untuk memindahkan saldo antar akun kas atau rekening RT.</p>
								</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>

<!-- Modal Buat Transfer Baru -->
<div class="modal fade" id="modalAddTransfer" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content modal-modern-content">
			<div class="modal-header modal-header-indigo">
				<div class="d-flex align-items-center">
					<div style="width: 38px; height: 38px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 12px; font-size: 18px;">
						<i class="fas fa-exchange-alt"></i>
					</div>
					<div>
						<h5 class="modal-title font-weight-bold text-white mb-0">Catat Transfer Kas Internal</h5>
						<small class="text-white-50">Pindah saldo antar akun / rekening kas RT</small>
					</div>
				</div>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body p-4">
				<form action="<?= base_url('kasRT/addTransfer'); ?>" method="post">
					<!-- Akun Sumber & Tujuan -->
					<div class="row">
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Sumber Dana (Keluar Dari)</label>
							<select name="sumber" class="form-control" required style="border-radius: 9px; font-weight: 600;">
								<option value="Kas Tunai Bendahara">💵 Kas Tunai Bendahara</option>
								<option value="Rekening Bank BCA RT">🏦 Rekening Bank BCA RT</option>
								<option value="Rekening Bank BRI RT">🏦 Rekening Bank BRI RT</option>
								<option value="Rekening Bank Mandiri RT">🏦 Rekening Mandiri RT</option>
								<option value="Dompet Digital / QRIS RT">📱 Saldo QRIS Warga</option>
								<option value="Kas Sampah Lingkungan">🗑️ Kas Sampah Lingkungan</option>
							</select>
						</div>
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Tujuan Transfer (Masuk Ke)</label>
							<select name="tujuan" class="form-control" required style="border-radius: 9px; font-weight: 600;">
								<option value="Rekening Bank BCA RT">🏦 Rekening Bank BCA RT</option>
								<option value="Kas Tunai Bendahara">💵 Kas Tunai Bendahara</option>
								<option value="Rekening Bank BRI RT">🏦 Rekening Bank BRI RT</option>
								<option value="Rekening Bank Mandiri RT">🏦 Rekening Mandiri RT</option>
								<option value="Kas Posyandu Balita">👶 Kas Khusus Posyandu</option>
								<option value="Kas Dana Darurat RT">🚨 Kas Dana Darurat</option>
							</select>
						</div>
					</div>

					<!-- Tanggal -->
					<div class="form-group mb-3">
						<label class="font-weight-bold text-dark" style="font-size: 13px;">Tanggal Transfer</label>
						<input type="date" name="tanggal" value="<?= date('Y-m-d'); ?>" class="form-control" required style="border-radius: 9px;">
					</div>

					<!-- Nominal -->
					<div class="form-group mb-3">
						<label class="font-weight-bold text-dark" style="font-size: 13px;">Nominal Transfer (Rp)</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text font-weight-bold" style="border-radius: 9px 0 0 9px; background: #eef2ff; color: #4338ca;">Rp</span>
							</div>
							<input type="number" name="jumlah" class="form-control" placeholder="0" required style="border-radius: 0 9px 9px 0; font-weight: 700; font-size: 16px;">
						</div>
					</div>

					<!-- Keterangan -->
					<div class="form-group mb-4">
						<label class="font-weight-bold text-dark" style="font-size: 13px;">Keterangan / Keperluan Pindah Dana</label>
						<textarea name="keterangan" rows="2" class="form-control" placeholder="Contoh: Setor uang iuran tunai ke rekening bank RT, penarikan operasional posyandu, dll." required style="border-radius: 9px;"></textarea>
					</div>

					<div class="d-flex justify-content-end" style="gap: 8px;">
						<button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
						<button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px; background: #4338ca; border-color: #4338ca;">
							<i class="fas fa-check-circle mr-1"></i> Proses Transfer
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
