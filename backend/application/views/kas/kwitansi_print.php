<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= htmlspecialchars($judul); ?> — Kas RT</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: 'Plus Jakarta Sans', sans-serif;
			background: #f8fafc;
			color: #0f172a;
			padding: 40px 15px;
		}
		.receipt-container {
			background: #ffffff;
			max-width: 680px;
			margin: 0 auto;
			padding: 36px 40px;
			border: 2px dashed #cbd5e1;
			border-radius: 16px;
			box-shadow: 0 10px 25px -5px rgba(0,0,0,0.06);
			position: relative;
		}
		.receipt-header {
			border-bottom: 2px solid #0f172a;
			padding-bottom: 16px;
			margin-bottom: 22px;
		}
		.stamp-voucher {
			border: 3px solid <?= $kas['jenis'] == 'masuk' ? '#16a34a' : '#dc2626'; ?>;
			color: <?= $kas['jenis'] == 'masuk' ? '#16a34a' : '#dc2626'; ?>;
			font-size: 16px;
			font-weight: 900;
			text-transform: uppercase;
			letter-spacing: 2px;
			padding: 6px 14px;
			display: inline-block;
			transform: rotate(-5deg);
			border-radius: 8px;
			opacity: 0.9;
		}
		.nominal-box {
			background: <?= $kas['jenis'] == 'masuk' ? '#ecfdf5' : '#fff1f2'; ?>;
			border: 1px solid <?= $kas['jenis'] == 'masuk' ? '#a7f3d0' : '#fecdd3'; ?>;
			border-radius: 12px;
			padding: 16px 20px;
			margin: 20px 0;
		}
		.mono-text {
			font-family: 'JetBrains Mono', monospace;
		}
		@media print {
			body { background: #fff; padding: 0; }
			.receipt-container { border: 1px solid #333; box-shadow: none; max-width: 100%; border-radius: 0; }
			.no-print { display: none !important; }
		}
	</style>
</head>
<body>

	<div class="receipt-container">
		<div class="no-print d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
			<a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm">
				&larr; Kembali
			</a>
			<button onclick="window.print()" class="btn btn-primary btn-sm font-weight-bold">
				🖨️ Cetak Kwitansi
			</button>
		</div>

		<!-- Header Kwitansi -->
		<div class="receipt-header d-flex justify-content-between align-items-center">
			<div>
				<h4 class="font-weight-bold mb-0" style="letter-spacing: 0.5px;">PENGURUS RUKUN TETANGGA (RT)</h4>
				<small class="text-muted">Sistem Elektronik Administrasi & Keuangan E-KASRT</small>
			</div>
			<div class="text-right">
				<div class="stamp-voucher">
					<?= $kas['jenis'] == 'masuk' ? 'KAS MASUK' : 'KAS KELUAR'; ?>
				</div>
			</div>
		</div>

		<div class="d-flex justify-content-between mb-4" style="font-size: 13px;">
			<span>No. Bukti: <strong class="mono-text">#<?= htmlspecialchars($kas['idKas']); ?></strong></span>
			<span>Tanggal: <strong><?= date('d-m-Y', strtotime($kas['tanggal'])); ?></strong></span>
		</div>

		<!-- Detail Kwitansi -->
		<table class="table table-sm table-borderless mb-2" style="font-size: 14px;">
			<tr>
				<td style="width: 180px; color: #64748b;">Jenis Transaksi</td>
				<td>: <strong class="text-capitalize"><?= $kas['jenis'] == 'masuk' ? 'Penerimaan / Kas Masuk' : 'Pengeluaran / Kas Keluar'; ?></strong></td>
			</tr>
			<tr>
				<td style="color: #64748b;">Perihal / Keterangan</td>
				<td>: <strong><?= htmlspecialchars($kas['keterangan']); ?></strong></td>
			</tr>
			<tr>
				<td style="color: #64748b;">Tanggal Pencatatan</td>
				<td>: <?= date('d F Y', strtotime($kas['tanggal'])); ?></td>
			</tr>
			<tr>
				<td style="color: #64748b;">Dicatat Oleh</td>
				<td>: <?= htmlspecialchars($user['user'] ?? $user['username'] ?? 'Bendahara RT'); ?></td>
			</tr>
		</table>

		<!-- Nominal Box -->
		<div class="nominal-box d-flex justify-content-between align-items-center">
			<div>
				<small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 11px;">Jumlah Nominal Transaksi</small>
				<h3 class="mb-0 font-weight-bold mono-text <?= $kas['jenis'] == 'masuk' ? 'text-success' : 'text-danger'; ?>">
					<?= $kas['jenis'] == 'masuk' ? '+ ' : '- '; ?>Rp <?= rupiah($kas['jumlah']); ?>
				</h3>
			</div>
			<div class="text-right">
				<span class="badge <?= $kas['jenis'] == 'masuk' ? 'badge-success' : 'badge-danger'; ?> px-3 py-2" style="border-radius: 8px; font-size: 12px;">
					<?= $kas['jenis'] == 'masuk' ? 'TERVALIDASI MASUK' : 'TERVALIDASI KELUAR'; ?>
				</span>
			</div>
		</div>

		<div class="p-3 mb-4" style="background: #f1f5f9; border-radius: 10px; font-size: 13px;">
			<span class="text-muted">Terbilang:</span><br>
			<strong><em>"<?= function_exists('terbilang') ? terbilang($kas['jumlah']) : ''; ?> Rupiah"</em></strong>
		</div>

		<!-- Tanda Tangan -->
		<div class="row pt-3 text-center" style="font-size: 13px;">
			<div class="col-6">
				<p class="mb-5 text-muted">Mengetahui,<br><strong>Ketua RT</strong></p>
				<p class="font-weight-bold mb-0">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</p>
			</div>
			<div class="col-6">
				<p class="mb-5 text-muted">Petugas Keuangan,<br><strong>Bendahara RT</strong></p>
				<p class="font-weight-bold mb-0"><?= htmlspecialchars($user['user'] ?? $user['username'] ?? 'Bendahara'); ?></p>
			</div>
		</div>

		<div class="mt-4 pt-3 border-top text-center text-muted" style="font-size: 11px;">
			Bukti kwitansi kas ini dicetak secara sah dan otomatis dari Sistem Informasi E-KASRT pada <?= date('d/m/Y H:i'); ?> WIB.
		</div>
	</div>

</body>
</html>

