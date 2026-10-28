<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

.warga-iuran-page {
	font-family: 'Plus Jakarta Sans', sans-serif;
	color: #0f172a;
}

.month-card {
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 14px;
	padding: 16px;
	text-align: center;
	position: relative;
	transition: all 0.2s ease;
	height: 100%;
	display: flex;
	flex-direction: column;
	justify-content: space-between;
}
.month-card:hover {
	transform: translateY(-2px);
	box-shadow: 0 8px 20px rgba(0,0,0,0.06);
}
.month-card.lunas {
	border-color: #86efac;
	background: #f0fdf4;
}
.month-card.pending {
	border-color: #fde047;
	background: #fefce8;
}
.month-card.nunggak {
	border-color: #fca5a5;
	background: #fff5f5;
}

.qris-card {
	background: linear-gradient(135deg, #064e3b 0%, #065f46 100%);
	border-radius: 18px;
	color: #fff;
	padding: 24px;
	box-shadow: 0 10px 25px rgba(6, 78, 59, 0.25);
}
</style>

<div class="page-content--bgf7 warga-iuran-page">
	<section class="p-t-30 p-b-50">
		<div class="container">
			<?= $this->session->flashdata('message'); ?>

			<!-- Header Banner Warga -->
			<div class="row mb-4">
				<div class="col-12">
					<div class="card text-white border-0" style="background: linear-gradient(135deg, #059669 0%, #0284c7 100%); border-radius: 16px; box-shadow: 0 8px 24px rgba(5,150,105,0.2);">
						<div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between">
							<div class="d-flex align-items-center">
								<div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 28px; margin-right: 18px;">
									🏡
								</div>
								<div>
									<span class="badge badge-light text-dark font-weight-bold mb-1 px-3 py-1" style="border-radius: 20px; font-size: 11px;">
										No. Rumah: <?= htmlspecialchars($warga['no_rumah'] ?: '-'); ?>
									</span>
									<h3 class="text-white font-weight-bold mb-0">Iuran Kas Warga RT</h3>
									<p class="mb-0 text-white-50" style="font-size: 14px;">
										Warga: <strong><?= htmlspecialchars($warga['nama'] ?? $user['user']); ?></strong> (Tahun <?= $tahun; ?>)
									</p>
								</div>
							</div>
							<div class="mt-3 mt-md-0 text-md-right">
								<a href="#modalBayarWarga" data-toggle="modal" class="btn btn-light text-success font-weight-bold px-4 py-2" style="border-radius: 10px; font-size: 14px;">
									💳 Bayar Iuran Sekarang
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- 3 Stat Ringkasan Pribadi -->
			<div class="row mb-4">
				<div class="col-md-4 mb-3">
					<div class="card border-0 shadow-sm p-3" style="border-radius: 14px; background: #fff;">
						<div class="d-flex align-items-center">
							<div style="width: 44px; height: 44px; border-radius: 10px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-right: 14px;">
								✅
							</div>
							<div>
								<small class="text-muted font-weight-bold text-uppercase" style="font-size: 11px;">Total Lunas (Tahun <?= $tahun; ?>)</small>
								<h4 class="font-weight-bold text-success mb-0">Rp <?= number_format($total_lunas, 0, ',', '.'); ?></h4>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4 mb-3">
					<div class="card border-0 shadow-sm p-3" style="border-radius: 14px; background: #fff;">
						<div class="d-flex align-items-center">
							<div style="width: 44px; height: 44px; border-radius: 10px; background: <?= $total_tunggakan > 0 ? '#fff1f2' : '#ecfdf5'; ?>; color: <?= $total_tunggakan > 0 ? '#e11d48' : '#059669'; ?>; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-right: 14px;">
								<?= $total_tunggakan > 0 ? '⚠️' : '🎉'; ?>
							</div>
							<div>
								<small class="text-muted font-weight-bold text-uppercase" style="font-size: 11px;">Tunggakan s/d Bulan Ini</small>
								<h4 class="font-weight-bold <?= $total_tunggakan > 0 ? 'text-danger' : 'text-success'; ?> mb-0">
									Rp <?= number_format($total_tunggakan, 0, ',', '.'); ?>
								</h4>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4 mb-3">
					<div class="card border-0 shadow-sm p-3" style="border-radius: 14px; background: #fff;">
						<div class="d-flex align-items-center">
							<div style="width: 44px; height: 44px; border-radius: 10px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-right: 14px;">
								🏷️
							</div>
							<div>
								<small class="text-muted font-weight-bold text-uppercase" style="font-size: 11px;">Tarif Kas RT</small>
								<h4 class="font-weight-bold text-primary mb-0">Rp 50.000 <small class="text-muted" style="font-size: 12px;">/ bulan</small></h4>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Grid 12 Bulan Status Iuran Rumah Saya -->
			<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
				<div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
					<h5 class="font-weight-bold text-dark mb-0">Status Pembayaran 12 Bulan (Tahun <?= $tahun; ?>)</h5>
					<span class="badge badge-light border px-2 py-1">Rp 50.000 / Bulan</span>
				</div>
				<div class="card-body p-4">
					<div class="row">
						<?php foreach ($bulan_list as $m_idx => $b): ?>
							<?php
								$st = $status_bulan[$b]['status'];
								$p  = $status_bulan[$b]['payment'];
								$month_num = $m_idx + 1;

								$card_class = 'future';
								$badge_text = 'Belum Dibayar';
								$badge_class = 'badge-secondary';

								if ($st == 'Disetujui') {
									$card_class = 'lunas';
									$badge_text = '✓ Lunas';
									$badge_class = 'badge-success';
								} elseif ($st == 'Pending') {
									$card_class = 'pending';
									$badge_text = '⏳ Menunggu Verifikasi';
									$badge_class = 'badge-warning text-dark';
								} elseif ($month_num <= $cur_month_idx && $tahun == date('Y')) {
									$card_class = 'nunggak';
									$badge_text = '⚠️ Nunggak';
									$badge_class = 'badge-danger';
								}
							?>
							<div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
								<div class="month-card <?= $card_class; ?>">
									<div>
										<h6 class="font-weight-bold mb-1 text-dark"><?= $b; ?></h6>
										<small class="text-muted d-block mb-2">Rp 50.000</small>
										<span class="badge <?= $badge_class; ?> px-2 py-1" style="font-size: 10px; border-radius: 6px;">
											<?= $badge_text; ?>
										</span>
									</div>
									<div class="mt-3 pt-2 border-top">
										<?php if ($st == 'Disetujui' && $p): ?>
											<a href="<?= base_url('smartrt/iuran_cetak_kwitansi/' . $p->id); ?>" target="_blank" class="btn btn-outline-success btn-sm btn-block py-0" style="font-size: 11px;">
												🖨️ Kwitansi
											</a>
										<?php elseif ($st == 'Pending'): ?>
											<small class="text-warning font-weight-bold" style="font-size: 11px;">Proses Verifikasi</small>
										<?php else: ?>
											<button class="btn btn-primary btn-sm btn-block py-0" style="font-size: 11px;" onclick="openBayarBulanSingle('<?= $b; ?>')">
												Bayar
											</button>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

			<!-- Riwayat Transaksi -->
			<div class="card border-0 shadow-sm" style="border-radius: 16px;">
				<div class="card-header bg-white py-3 border-bottom">
					<h5 class="font-weight-bold text-dark mb-0">Riwayat Pembayaran Iuran Rumah Saya</h5>
				</div>
				<div class="card-body p-0">
					<?php if (empty($payments)): ?>
						<div class="text-center py-4 text-muted">
							Belum ada riwayat pembayaran yang tercatat.
						</div>
					<?php else: ?>
						<div class="table-responsive">
							<table class="table table-hover mb-0" style="font-size: 13px;">
								<thead class="bg-light">
									<tr>
										<th>No. Transaksi</th>
										<th>Iuran Bulan</th>
										<th>Nominal</th>
										<th>Metode</th>
										<th>Status</th>
										<th>Tanggal Bayar</th>
										<th class="text-center">Kwitansi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($payments as $pay): ?>
										<tr>
											<td><code class="text-muted font-monospace">#<?= str_pad($pay->id, 5, '0', STR_PAD_LEFT); ?></code></td>
											<td><strong><?= $pay->bulan; ?> <?= $pay->tahun; ?></strong></td>
											<td class="font-weight-bold text-success">Rp <?= number_format($pay->jumlah, 0, ',', '.'); ?></td>
											<td>
												<span class="badge <?= $pay->metode == 'QR' ? 'badge-info' : 'badge-secondary'; ?>">
													<?= $pay->metode == 'QR' ? 'Scan QR / Transfer' : 'Tunai'; ?>
												</span>
											</td>
											<td>
												<?php if ($pay->status == 'Disetujui'): ?>
													<span class="badge badge-success">✓ Disetujui (Lunas)</span>
												<?php elseif ($pay->status == 'Pending'): ?>
													<span class="badge badge-warning text-dark">⏳ Menunggu Verifikasi</span>
												<?php else: ?>
													<span class="badge badge-danger">✕ Ditolak</span>
												<?php endif; ?>
											</td>
											<td><?= date('d M Y, H:i', strtotime($pay->tanggal_bayar)); ?></td>
											<td class="text-center">
												<?php if ($pay->status == 'Disetujui'): ?>
													<a href="<?= base_url('smartrt/iuran_cetak_kwitansi/' . $pay->id); ?>" target="_blank" class="btn btn-outline-secondary btn-sm py-0 px-2 font-weight-bold">
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
					<?php endif; ?>
				</div>
			</div>

		</div>
	</section>
</div>

<!-- MODAL: FORM BAYAR IURAN OLEH WARGA -->
<div class="modal fade" id="modalBayarWarga" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content" style="border-radius: 16px; border: none;">
			<div class="modal-header text-white py-3" style="background: linear-gradient(135deg, #059669, #0284c7);">
				<h5 class="modal-title font-weight-bold">💳 Pembayaran Iuran Kas Warga</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<form method="post" action="<?= base_url('smartrt/iuran_bayar'); ?>" enctype="multipart/form-data">
				<input type="hidden" name="warga_id" value="<?= $warga['idWarga']; ?>">
				<input type="hidden" name="tahun" value="<?= $tahun; ?>">
				<input type="hidden" name="jumlah" value="50000">

				<div class="modal-body p-4">
					<div class="row">
						<!-- Kolom Form Pilih Bulan & Metode -->
						<div class="col-md-7">
							<h6 class="font-weight-bold text-dark mb-2">1. Pilih Bulan Iuran:</h6>
							<p class="text-muted" style="font-size: 12px;">Anda dapat mencentang beberapa bulan sekaligus.</p>

							<div class="row mb-3">
								<?php foreach ($bulan_list as $b): ?>
									<?php $sudah_lunas = (isset($status_bulan[$b]) && $status_bulan[$b]['status'] == 'Disetujui'); ?>
									<div class="col-4 mb-2">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="bulan[]" value="<?= $b; ?>" class="custom-control-input warga-month-check" id="wcheck_<?= $b; ?>" <?= $sudah_lunas ? 'disabled' : ''; ?> onchange="recalcWargaTotal()">
											<label class="custom-control-label <?= $sudah_lunas ? 'text-muted' : 'font-weight-bold'; ?>" for="wcheck_<?= $b; ?>" style="font-size: 13px;">
												<?= $b; ?> <?= $sudah_lunas ? '✓' : ''; ?>
											</label>
										</div>
									</div>
								<?php endforeach; ?>
							</div>

							<h6 class="font-weight-bold text-dark mb-2">2. Pilih Metode Pembayaran:</h6>
							<div class="form-group mb-3">
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" id="metodeQR" name="metode" value="QR" class="custom-control-input" checked onchange="toggleMetodeUpload(this.value)">
									<label class="custom-control-label font-weight-bold" for="metodeQR">📱 QRIS / Transfer Bank</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" id="metodeTunai" name="metode" value="Tunai" class="custom-control-input" onchange="toggleMetodeUpload(this.value)">
									<label class="custom-control-label font-weight-bold" for="metodeTunai">💵 Bayar Tunai ke RT</label>
								</div>
							</div>

							<div id="uploadBuktiArea" class="form-group mb-3">
								<label class="font-weight-bold" style="font-size: 13px;">Upload Bukti Struk Transfer (Screenshot/Foto)</label>
								<input type="file" name="bukti_bayar" class="form-control-file" accept="image/*">
								<small class="text-muted">Format: JPG, PNG. Maksimal 3MB.</small>
							</div>

							<div class="alert alert-light border d-flex justify-content-between align-items-center mb-0" style="border-radius: 10px;">
								<span class="font-weight-bold">Total Pembayaran:</span>
								<h4 class="font-weight-bold text-success mb-0" id="wargaTotalText">Rp 0</h4>
							</div>
						</div>

						<!-- Kolom Panduan QRIS RT -->
						<div class="col-md-5 mt-3 mt-md-0">
							<div class="qris-card text-center">
								<h6 class="font-weight-bold text-white mb-1">SCAN QRIS KAS RT</h6>
								<small class="text-white-50 d-block mb-3">Mendukung Semua Bank & e-Wallet</small>
								
								<div class="bg-white p-3 rounded" style="display: inline-block; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
									<img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=KASRT-IURAN-WARGA-<?= $warga['idWarga']; ?>" alt="QRIS Iuran RT" width="160" height="160" style="display: block;">
								</div>

								<div class="mt-3 text-left" style="font-size: 12px; opacity: 0.9;">
									<p class="mb-1"><strong>Rekening Kas RT:</strong></p>
									<p class="mb-1">BCA: <code>123-456-7890</code></p>
									<p class="mb-0">a/n Kas Lingkungan RT 03</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer bg-light py-2">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-success btn-sm font-weight-bold px-4">Kirim Pembayaran</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
function openBayarBulanSingle(bulanName) {
	document.querySelectorAll('.warga-month-check').forEach(c => c.checked = false);
	const target = document.getElementById('wcheck_' + bulanName);
	if (target && !target.disabled) {
		target.checked = true;
	}
	recalcWargaTotal();
	$('#modalBayarWarga').modal('show');
}

function recalcWargaTotal() {
	const checked = document.querySelectorAll('.warga-month-check:checked').length;
	const total = checked * 50000;
	document.getElementById('wargaTotalText').innerText = 'Rp ' + total.toLocaleString('id-ID');
}

function toggleMetodeUpload(val) {
	const area = document.getElementById('uploadBuktiArea');
	if (val === 'Tunai') {
		area.style.display = 'none';
	} else {
		area.style.display = 'block';
	}
}
</script>
