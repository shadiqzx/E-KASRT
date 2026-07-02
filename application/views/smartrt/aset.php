<div class="page-content--bgf7">
	<section class="p-t-30">
		<div class="container">
			<?= $this->session->flashdata('message'); ?>
			<h3 class="title-5 mb-4">Inventaris Aset RT</h3>
			
			<div class="row">
				<?php if (!empty($aset_list)): ?>
					<?php foreach ($aset_list as $a): ?>
						<div class="col-md-6 col-lg-4 mb-4">
							<div class="card" style="border-radius: 14px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.06);">
								<div class="card-body text-center py-4">
									<div style="width: 60px; height: 60px; background: #E1F5FE; border-radius: 50%; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center;">
										<i class="fas fa-box fa-2x text-primary"></i>
									</div>
									<h5><?= $a->nama_barang; ?></h5>
									<p class="text-muted mb-1">Jumlah: <strong><?= $a->jumlah; ?> unit</strong></p>
									<p class="text-muted mb-2">Lokasi: <?= $a->lokasi; ?></p>
									<span class="badge <?= $a->kondisi == 'Baik' ? 'badge-success' : ($a->kondisi == 'Rusak Ringan' ? 'badge-warning' : 'badge-danger'); ?>">
										<?= $a->kondisi; ?>
									</span>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="col-12 text-center py-5 text-muted">
						<i class="fas fa-box-open fa-3x mb-3"></i>
						<p>Belum ada data aset RT yang terdaftar.</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
</div>
