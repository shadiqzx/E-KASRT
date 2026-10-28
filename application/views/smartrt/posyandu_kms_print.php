<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>KMS Digital — <?= htmlspecialchars($balita->nama_anak); ?></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #fff; color: #1e293b; padding: 24px; font-size: 13px; }
		.kms-card { border: 2px solid #0284c7; border-radius: 12px; padding: 24px; max-width: 900px; margin: 0 auto; box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
		.kms-header { border-bottom: 2px solid #0284c7; padding-bottom: 16px; margin-bottom: 20px; }
		.table thead th { background: #e0f2fe; color: #0369a1; border-color: #bae6fd; font-size: 12px; }
		.table td, .table th { vertical-align: middle; }
		.badge-gizi { padding: 4px 8px; border-radius: 6px; font-weight: 600; font-size: 11px; }
		@media print {
			.no-print { display: none !important; }
			body { padding: 0; }
			.kms-card { border: none; box-shadow: none; max-width: 100%; }
		}
	</style>
</head>
<body>
	<div class="kms-card">
		<div class="no-print d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
			<a href="<?= base_url('smartrt/posyandu'); ?>" class="btn btn-outline-secondary btn-sm">
				&larr; Kembali ke Posyandu
			</a>
			<div>
				<button onclick="window.print()" class="btn btn-primary btn-sm font-weight-bold">
					🖨️ Cetak / Simpan PDF
				</button>
			</div>
		</div>

		<div class="kms-header d-flex align-items-center justify-content-between">
			<div class="d-flex align-items-center">
				<div style="width: 50px; height: 50px; background: #0284c7; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 26px; color: #fff; margin-right: 14px;">
					👶
				</div>
				<div>
					<h4 class="mb-0 font-weight-bold text-primary">KARTU MENUJU SEHAT (KMS) DIGITAL</h4>
					<p class="mb-0 text-muted" style="font-size: 12px;">Posyandu Balita — Sistem Administrasi Warga E-KASRT</p>
				</div>
			</div>
			<div class="text-right">
				<span class="badge badge-info px-3 py-2" style="font-size: 12px;">Data Terverifikasi Digital</span>
			</div>
		</div>

		<!-- Identitas Balita & Ibu -->
		<div class="card mb-4" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px;">
			<div class="card-body py-3">
				<div class="row">
					<div class="col-6">
						<table class="table table-sm table-borderless mb-0" style="font-size: 12px;">
							<tr>
								<td class="text-muted" style="width: 120px;">Nama Balita</td>
								<td>: <strong><?= htmlspecialchars($balita->nama_anak); ?></strong></td>
							</tr>
							<tr>
								<td class="text-muted">Tanggal Lahir</td>
								<td>: <?= date('d M Y', strtotime($balita->tanggal_lahir)); ?></td>
							</tr>
							<tr>
								<td class="text-muted">Jenis Kelamin</td>
								<td>: <?= $balita->jenis_kelamin == 'L' ? 'Laki-Laki (👦)' : 'Perempuan (👧)'; ?></td>
							</tr>
						</table>
					</div>
					<div class="col-6">
						<table class="table table-sm table-borderless mb-0" style="font-size: 12px;">
							<tr>
								<td class="text-muted" style="width: 120px;">Nama Ibu / Ortu</td>
								<td>: <strong><?= htmlspecialchars($balita->nama_ortu ?? '-'); ?></strong></td>
							</tr>
							<tr>
								<td class="text-muted">NIK Ibu</td>
								<td>: <?= htmlspecialchars($balita->nik_ortu ?? '-'); ?></td>
							</tr>
							<tr>
								<td class="text-muted">Alamat / No Rumah</td>
								<td>: <?= htmlspecialchars($balita->alamat ?? '-'); ?> No. <?= htmlspecialchars($balita->no_rumah ?? '-'); ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>

		<!-- Riwayat Penimbangan & Pemeriksaan -->
		<h6 class="font-weight-bold mb-3 text-secondary">RIWAYAT PENIMBANGAN & PERTUMBUHAN</h6>
		<?php if (empty($riwayat)): ?>
			<div class="alert alert-light text-center py-4 border text-muted">
				Belum ada riwayat penimbangan / pemeriksaan tercatat.
			</div>
		<?php else: ?>
			<div class="table-responsive mb-4">
				<table class="table table-bordered table-sm text-center" style="font-size: 12px;">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Sesi</th>
							<th>Sesi Posyandu</th>
							<th>BB (kg)</th>
							<th>TB (cm)</th>
							<th>LK (cm)</th>
							<th>LiLA (cm)</th>
							<th>Status Gizi</th>
							<th>Imunisasi / Vitamin</th>
							<th>Metode Absen</th>
							<th>Petugas</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; foreach ($riwayat as $r): ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= date('d/m/Y', strtotime($r->tanggal)); ?></td>
								<td class="text-left font-weight-bold"><?= htmlspecialchars($r->nama_sesi); ?></td>
								<td class="font-weight-bold text-primary"><?= $r->berat_badan ? $r->berat_badan : '-'; ?></td>
								<td><?= $r->tinggi_badan ? $r->tinggi_badan : '-'; ?></td>
								<td><?= $r->lingkar_kepala ? $r->lingkar_kepala : '-'; ?></td>
								<td><?= $r->lila ? $r->lila : '-'; ?></td>
								<td>
									<?php if ($r->status_gizi): ?>
										<span class="badge <?= $r->status_gizi == 'Normal' ? 'badge-success' : ($r->status_gizi == 'Kurang' ? 'badge-warning' : 'badge-danger'); ?>">
											<?= $r->status_gizi; ?>
										</span>
									<?php else: ?>
										-
									<?php endif; ?>
								</td>
								<td>
									<?= $r->imunisasi ? '<span class="badge badge-info">' . htmlspecialchars($r->imunisasi) . '</span>' : ''; ?>
									<?= $r->vitamin_a != 'Tidak' ? '<br><small class="text-success font-weight-bold">Vit A: ' . $r->vitamin_a . '</small>' : ''; ?>
									<?= $r->obat_cacing == 'Ya' ? '<br><small class="text-danger font-weight-bold">Obat Cacing: Ya</small>' : ''; ?>
								</td>
								<td>
									<span class="badge <?= $r->metode_absen == 'RFID' ? 'badge-primary' : 'badge-light'; ?>">
										<?= $r->metode_absen == 'RFID' ? '📶 e-KTP RFID' : '✍️ Manual'; ?>
									</span>
								</td>
								<td><small><?= htmlspecialchars($r->petugas ?? 'Kader'); ?></small></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>

		<!-- Tanda Tangan -->
		<div class="row mt-5 pt-4">
			<div class="col-6 text-center">
				<p class="mb-5 text-muted">Orang Tua / Ibu Balita,</p>
				<p class="font-weight-bold mb-0"><u><?= htmlspecialchars($balita->nama_ortu ?? 'Ibu Balita'); ?></u></p>
			</div>
			<div class="col-6 text-center">
				<p class="mb-5 text-muted">Kader / Bidan Posyandu RT,</p>
				<p class="font-weight-bold mb-0"><u>( ......................................... )</u></p>
			</div>
		</div>
	</div>
</body>
</html>
