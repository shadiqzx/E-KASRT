<div class="page-content--bgf7">
	<section class="p-t-30">
		<div class="container">
			<?= $this->session->flashdata('message'); ?>
			
			<div class="table-data__tool">
				<div class="table-data__tool-left">
					<h3 class="title-5">Kelola Inventaris Aset RT</h3>
				</div>
				<div class="table-data__tool-right">
					<button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#addAsetModal">
						<i class="zmdi zmdi-plus"></i>Tambah Aset</button>
				</div>
			</div>
			
			<div class="card" style="border-radius: 12px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-borderless table-data3">
							<thead>
								<tr>
									<th>Nama Barang</th>
									<th>Jumlah</th>
									<th>Kondisi</th>
									<th>Lokasi</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($aset_list)): ?>
									<?php foreach ($aset_list as $a): ?>
										<tr>
											<td><?= $a->nama_barang; ?></td>
											<td><?= $a->jumlah; ?> unit</td>
											<td>
												<span class="badge <?= $a->kondisi == 'Baik' ? 'badge-success' : ($a->kondisi == 'Rusak Ringan' ? 'badge-warning' : 'badge-danger'); ?>">
													<?= $a->kondisi; ?>
												</span>
											</td>
											<td><?= $a->lokasi; ?></td>
											<td>
												<a href="<?= base_url('smartrt/aset_hapus/' . $a->id); ?>" onclick="return confirm('Hapus aset ini?')" class="btn btn-sm btn-danger text-white">
													<i class="zmdi zmdi-delete"></i>
												</a>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr><td colspan="5" class="text-center text-muted">Belum ada aset RT.</td></tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="addAsetModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 12px;">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Aset RT</h4>
				<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
			</div>
			<form action="<?= base_url('smartrt/aset_tambah'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label>Nama Barang</label>
						<input type="text" name="nama_barang" class="form-control" placeholder="Contoh: Tenda Besi 4x6" required>
					</div>
					<div class="form-group">
						<label>Jumlah</label>
						<input type="number" name="jumlah" class="form-control" min="1" value="1" required>
					</div>
					<div class="form-group">
						<label>Kondisi</label>
						<select name="kondisi" class="form-control" required>
							<option value="Baik">Baik</option>
							<option value="Rusak Ringan">Rusak Ringan</option>
							<option value="Rusak Berat">Rusak Berat</option>
						</select>
					</div>
					<div class="form-group">
						<label>Lokasi Penyimpanan</label>
						<input type="text" name="lokasi" class="form-control" placeholder="Contoh: Gudang RT" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-success">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
