<div class="page-content--bgf7">
	<section class="p-t-30">
		<div class="container">
			<?= $this->session->flashdata('message'); ?>
			
			<div class="table-data__tool">
				<div class="table-data__tool-left">
					<h3 class="title-5">Kotak Masuk Aspirasi Warga</h3>
				</div>
			</div>
			
			<div class="row">
				<?php if (!empty($aspirasi_list)): ?>
					<?php foreach ($aspirasi_list as $a): ?>
						<div class="col-md-6 mb-4">
							<div class="card" style="border-radius: 14px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.06); border-left: 4px solid <?= $a->kategori == 'Keluhan' ? '#F44336' : ($a->kategori == 'Saran' ? '#2196F3' : ($a->kategori == 'Apresiasi' ? '#4CAF50' : '#FF9800')); ?>;">
								<div class="card-body">
									<div class="d-flex justify-content-between align-items-center mb-2">
										<span class="badge <?= $a->kategori == 'Keluhan' ? 'badge-danger' : ($a->kategori == 'Saran' ? 'badge-primary' : ($a->kategori == 'Apresiasi' ? 'badge-success' : 'badge-warning')); ?>">
											<?= $a->kategori; ?>
										</span>
										<small class="text-muted"><?= date('d-m-Y H:i', strtotime($a->tanggal_kirim)); ?></small>
									</div>
									<p class="card-text"><?= $a->isi; ?></p>
									<small class="text-muted"><i class="fas fa-user mr-1"></i><?= $a->nama_pengirim; ?></small>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="col-12 text-center py-5 text-muted">
						<i class="fas fa-inbox fa-3x mb-3"></i>
						<p>Belum ada aspirasi yang masuk dari warga.</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
</div>
