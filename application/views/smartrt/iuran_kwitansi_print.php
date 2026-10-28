<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kwitansi Pembayaran Iuran #<?= str_pad($kwitansi->id, 5, '0', STR_PAD_LEFT); ?> — <?= htmlspecialchars($kwitansi->nama_warga); ?></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		body {
			font-family: 'Courier New', Courier, monospace;
			background: #f1f5f9;
			color: #0f172a;
			padding: 40px 15px;
		}
		.receipt-container {
			background: #ffffff;
			max-width: 680px;
			margin: 0 auto;
			padding: 36px 40px;
			border: 2px dashed #94a3b8;
			border-radius: 8px;
			box-shadow: 0 4px 20px rgba(0,0,0,0.06);
			position: relative;
		}
		.receipt-header {
			border-bottom: 2px solid #0f172a;
			padding-bottom: 14px;
			margin-bottom: 22px;
		}
		.stamp-lunas {
			border: 3px solid #16a34a;
			color: #16a34a;
			font-size: 20px;
			font-weight: 900;
			text-transform: uppercase;
			letter-spacing: 3px;
			padding: 6px 16px;
			display: inline-block;
			transform: rotate(-8deg);
			border-radius: 8px;
			opacity: 0.85;
		}
		@media print {
			body { background: #fff; padding: 0; }
			.receipt-container { border: 1px solid #000; box-shadow: none; max-width: 100%; }
			.no-print { display: none !important; }
		}
	</style>
</head>
<body>

	<div class="receipt-container">
		<div class="no-print d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
			<a href="<?= base_url('smartrt/iuran'); ?>" class="btn btn-outline-secondary btn-sm">
				&larr; Kembali
			</a>
			<button onclick="window.print()" class="btn btn-primary btn-sm font-weight-bold">
				🖨️ Cetak Kwitansi
			</button>
		</div>

		<!-- Header Kwitansi -->
		<div class="receipt-header d-flex justify-content-between align-items-center">
			<div>
				<h4 class="font-weight-bold mb-0" style="letter-spacing: 1px;">KAS RT — RUKUN TETANGGA</h4>
				<small class="text-muted">Sistem Elektronik Administrasi & Keuangan Warga</small>
			</div>
			<div class="text-right">
				<div class="stamp-lunas">L U N A S</div>
			</div>
		</div>

		<div class="d-flex justify-content-between mb-4" style="font-size: 13px;">
			<span>No. Bukti: <strong>KW/IUR/<?= $kwitansi->tahun; ?>/<?= str_pad($kwitansi->id, 5, '0', STR_PAD_LEFT); ?></strong></span>
			<span>Tanggal: <strong><?= date('d/m/Y H:i', strtotime($kwitansi->tanggal_bayar)); ?> WIB</strong></span>
		</div>

		<!-- Detail Pembayaran -->
		<table class="table table-sm table-borderless mb-4" style="font-size: 14px;">
			<tr>
				<td style="width: 180px;">Telah Diterima Dari</td>
				<td>: <strong><?= htmlspecialchars($kwitansi->nama_warga); ?></strong></td>
			</tr>
			<tr>
				<td>No. Rumah / Alamat</td>
				<td>: Rumah No. <strong><?= htmlspecialchars($kwitansi->no_rumah ?: '-'); ?></strong> (<?= htmlspecialchars($kwitansi->alamat ?: 'Lingkungan RT'); ?>)</td>
			</tr>
			<tr>
				<td>NIK Warga</td>
				<td>: <?= htmlspecialchars($kwitansi->nik ?: '-'); ?></td>
			</tr>
			<tr>
				<td>Untuk Pembayaran</td>
				<td>: <strong>Iuran Wajib Kas RT Bulan <?= htmlspecialchars($kwitansi->bulan); ?> <?= $kwitansi->tahun; ?></strong></td>
			</tr>
			<tr>
				<td>Metode Bayar</td>
				<td>: <?= $kwitansi->metode == 'QR' ? 'Scan QRIS / Transfer Bank' : 'Tunai Langsung'; ?></td>
			</tr>
			<tr>
				<td>Jumlah Pembayaran</td>
				<td>: <h5 class="d-inline font-weight-bold text-success">Rp <?= number_format($kwitansi->jumlah, 0, ',', '.'); ?></h5></td>
			</tr>
			<tr>
				<td>Terbilang</td>
				<td>: <em>( Lima Puluh Ribu Rupiah )</em></td>
			</tr>
		</table>

		<!-- Tanda Tangan -->
		<div class="row mt-5 pt-3">
			<div class="col-6 text-center" style="font-size: 13px;">
				<p class="mb-5 text-muted">Penyetor (Warga),</p>
				<p class="font-weight-bold mb-0"><u><?= htmlspecialchars($kwitansi->nama_warga); ?></u></p>
			</div>
			<div class="col-6 text-center" style="font-size: 13px;">
				<p class="mb-5 text-muted">Penerima (Bendahara RT),</p>
				<p class="font-weight-bold mb-0"><u>( Bendahara RT )</u></p>
			</div>
		</div>

		<div class="mt-4 pt-2 border-top text-center text-muted" style="font-size: 11px;">
			Bukti pembayaran ini sah dan dikeluarkan secara elektronik oleh Sistem Informasi E-KASRT.
		</div>
	</div>

</body>
</html>
