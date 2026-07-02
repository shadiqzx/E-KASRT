<div class="page-content--bgf7">
	<section class="p-t-30">
		<div class="container">
			<?= $this->session->flashdata('message'); ?>
			
			<div class="row mb-4">
				<div class="col-md-4">
					<div class="card bg-success text-white" style="border-radius: 12px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
						<div class="card-body text-center py-4">
							<i class="fas fa-star fa-2x mb-2"></i>
							<h5>Total Poin Saya</h5>
							<h2 class="text-white mt-1"><?= number_format($total_poin ?? 0); ?> Poin</h2>
							<p class="mb-0" style="font-size: 12px;">1 kg = 1.000 Poin</p>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card" style="border-radius: 12px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); height: 100%;">
						<div class="card-body d-flex align-items-center">
							<div>
								<h5><i class="fas fa-info-circle text-info mr-2"></i>Cara Kerja Bank Sampah</h5>
								<ul class="text-muted mt-2" style="font-size: 14px; padding-left: 20px;">
									<li>Kumpulkan sampah yang dapat didaur ulang (plastik, kertas, logam, kaca).</li>
									<li>Setor sampah Anda setiap hari Minggu pukul 08.00-10.00 di Posko RT.</li>
									<li>Poin yang terkumpul dapat ditukar dengan hadiah atau dikreditkan ke iuran warga.</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card" style="border-radius: 12px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
				<div class="card-header bg-light">
					<h4>Riwayat Setoran Sampah Saya</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-borderless table-data3">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>Jenis Sampah</th>
									<th>Berat (kg)</th>
									<th>Poin Diperoleh</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($setoran)): ?>
									<?php foreach ($setoran as $s): ?>
										<tr>
											<td><?= date('d-m-Y', strtotime($s->tanggal)); ?></td>
											<td><?= ucfirst($s->jenis_sampah); ?></td>
											<td><?= $s->berat; ?> kg</td>
											<td><span class="badge badge-success"><?= number_format($s->poin); ?> Poin</span></td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr><td colspan="4" class="text-center text-muted">Belum ada riwayat setoran sampah.</td></tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
