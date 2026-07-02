<div class="page-content--bgf7">
	<section class="p-t-30">
		<div class="container">
			<?= $this->session->flashdata('message'); ?>
			
			<div class="table-data__tool">
				<div class="table-data__tool-left">
					<h3 class="title-5">Kelola Bank Sampah RT</h3>
				</div>
				<div class="table-data__tool-right">
					<button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#addSetoranModal">
						<i class="zmdi zmdi-plus"></i>Catat Setoran</button>
				</div>
			</div>
			
			<div class="card" style="border-radius: 12px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-borderless table-data3">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>Nama Warga</th>
									<th>Jenis Sampah</th>
									<th>Berat (kg)</th>
									<th>Poin</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($setoran)): ?>
									<?php foreach ($setoran as $s): ?>
										<tr>
											<td><?= date('d-m-Y', strtotime($s->tanggal)); ?></td>
											<td><?= $s->nama_warga; ?></td>
											<td><?= ucfirst($s->jenis_sampah); ?></td>
											<td><?= $s->berat; ?> kg</td>
											<td><span class="badge badge-success"><?= number_format($s->poin); ?></span></td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr><td colspan="5" class="text-center text-muted">Belum ada data setoran sampah.</td></tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="addSetoranModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 12px;">
			<div class="modal-header">
				<h4 class="modal-title">Catat Setoran Sampah</h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="<?= base_url('smartrt/banksampah_tambah'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label>Pilih Warga</label>
						<select name="warga_id" class="form-control" required>
							<?php foreach ($warga_list as $w): ?>
								<option value="<?= $w->idWarga; ?>"><?= $w->nama; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label>Jenis Sampah</label>
						<select name="jenis_sampah" class="form-control" required>
							<option value="plastik">Plastik</option>
							<option value="kertas">Kertas</option>
							<option value="logam">Logam / Besi</option>
							<option value="kaca">Kaca / Botol</option>
							<option value="organik">Organik</option>
						</select>
					</div>
					<div class="form-group">
						<label>Berat (kg)</label>
						<input type="number" name="berat" step="0.01" class="form-control" placeholder="Contoh: 2.5" required>
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
