<div class="page-content--bgf7">
	<section class="p-t-30">
		<div class="container">
			<?= $this->session->flashdata('message'); ?>
			
			<div class="row mb-4">
				<div class="col-md-12">
					<div class="card bg-warning text-white" style="border-radius: 12px; border: none;">
						<div class="card-body d-flex align-items-center">
							<i class="fas fa-bullhorn fa-3x mr-4" style="opacity: 0.7;"></i>
							<div>
								<h4 class="text-white">Kotak Aspirasi Warga</h4>
								<p class="mb-0" style="opacity: 0.85;">Sampaikan keluhan, saran, atau apresiasi Anda untuk kemajuan RT kita. Bisa disampaikan secara anonim.</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card mb-4" style="border-radius: 12px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
				<div class="card-header bg-light"><h4>Kirim Aspirasi Anda</h4></div>
				<div class="card-body">
					<form action="<?= base_url('smartrt/aspirasi_kirim'); ?>" method="post">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Kategori</label>
									<select name="kategori" class="form-control" required>
										<option value="Keluhan">Keluhan</option>
										<option value="Saran">Saran</option>
										<option value="Apresiasi">Apresiasi</option>
										<option value="Lainnya">Lainnya</option>
									</select>
								</div>
								<div class="form-group">
									<div class="custom-control custom-switch mt-2">
										<input type="checkbox" class="custom-control-input" id="anonim" name="anonim" value="1">
										<label class="custom-control-label" for="anonim">Kirim sebagai Anonim</label>
									</div>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<label>Isi Aspirasi</label>
									<textarea name="isi" class="form-control" rows="5" placeholder="Tuliskan pesan Anda untuk pengurus RT..." required></textarea>
								</div>
								<button type="submit" class="btn btn-warning text-white" style="border-radius: 8px;">
									<i class="fas fa-paper-plane mr-2"></i>Kirim Aspirasi
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
