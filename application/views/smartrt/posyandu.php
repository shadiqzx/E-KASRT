<div class="page-content--bgf7">
	<section class="p-t-30">
		<div class="container">
			<?= $this->session->flashdata('message'); ?>

			<!-- Header Banner -->
			<div class="row mb-4">
				<div class="col-md-12">
					<div class="card text-white" style="background: linear-gradient(135deg, #0d9488 0%, #0891b2 100%); border-radius: 14px; border: none; box-shadow: 0 8px 24px rgba(13,148,136,0.2);">
						<div class="card-body d-flex flex-wrap align-items-center justify-content-between p-4">
							<div class="d-flex align-items-center">
								<div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 18px; font-size: 28px;">
									👶
								</div>
								<div>
									<h3 class="text-white font-weight-bold mb-1">Posyandu Balita RT</h3>
									<p class="mb-0 text-white-50" style="font-size: 14px;">Layanan pemeriksaan tumbuh kembang balita dengan absensi otomatis RFID / KTP.</p>
								</div>
							</div>
							<div class="mt-3 mt-md-0 text-md-right">
								<span class="badge badge-light px-3 py-2 text-dark font-weight-bold" style="border-radius: 20px; font-size: 13px;">
									<i class="fas fa-id-card text-info mr-1"></i> Mendukung Tap KTP / Kartu RFID
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Status Sesi Aktif -->
			<?php if ($sesi_aktif): ?>
				<div class="alert alert-success d-flex align-items-center justify-content-between mb-4" style="border-radius: 12px; border: none; background: #ecfdf5; color: #065f46; box-shadow: 0 4px 12px rgba(16,185,129,0.1);">
					<div class="d-flex align-items-center">
						<span class="badge badge-success mr-3 px-3 py-2" style="font-size: 12px; border-radius: 8px;">
							<i class="fas fa-circle text-white mr-1" style="animation: pulse 1.5s infinite; font-size: 8px;"></i> SEDANG BERLANGSUNG
						</span>
						<div>
							<h5 class="mb-0 font-weight-bold text-success"><?= htmlspecialchars($sesi_aktif->nama_sesi); ?></h5>
							<small class="text-muted">
								<i class="fas fa-map-marker-alt mr-1"></i><?= htmlspecialchars($sesi_aktif->lokasi); ?> | 
								<i class="fas fa-user-md mr-1"></i>Petugas: <?= htmlspecialchars($sesi_aktif->petugas ?? 'Kader Posyandu'); ?> | 
								<i class="fas fa-clock mr-1"></i>Mulai: <?= substr($sesi_aktif->waktu_mulai, 0, 5); ?> WIB
							</small>
						</div>
					</div>
					<div>
						<span class="badge badge-info px-3 py-2" style="border-radius: 8px; font-size: 12px;">
							Silakan bawa balita & tap kartu di mesin!
						</span>
					</div>
				</div>
			<?php else: ?>
				<div class="alert alert-secondary d-flex align-items-center mb-4" style="border-radius: 12px; border: none; background: #f8fafc; color: #64748b;">
					<i class="fas fa-info-circle fa-2x mr-3 text-secondary"></i>
					<div>
						<h6 class="mb-0 font-weight-bold text-dark">Tidak Ada Sesi Posyandu Aktif Saat Ini</h6>
						<small class="text-muted">Jadwal sesi posyandu berikutnya akan diumumkan oleh kader / pengurus RT.</small>
					</div>
				</div>
			<?php endif; ?>

			<!-- Balita Terdaftar & Riwayat Pemeriksaan -->
			<div class="row">
				<!-- Kolom Balita Terdaftar -->
				<div class="col-lg-5 mb-4">
					<div class="card h-100" style="border-radius: 12px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
						<div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
							<h5 class="mb-0 font-weight-bold text-dark"><i class="fas fa-baby mr-2 text-primary"></i>Data Balita Terdaftar</h5>
							<span class="badge badge-primary px-2 py-1"><?= count($balita_list); ?> Anak</span>
						</div>
						<div class="card-body p-0">
							<?php if (empty($balita_list)): ?>
								<div class="text-center py-5 text-muted">
									<i class="fas fa-child fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
									<p class="mb-0">Belum ada data balita terdaftar.</p>
								</div>
							<?php else: ?>
								<ul class="list-group list-group-flush">
									<?php foreach ($balita_list as $b): ?>
										<?php
											$bday = new DateTime($b->tanggal_lahir);
											$today = new DateTime();
											$diff = $today->diff($bday);
											$usia = ($diff->y > 0 ? $diff->y . ' th ' : '') . $diff->m . ' bln';
										?>
										<li class="list-group-item d-flex align-items-center justify-content-between py-3">
											<div class="d-flex align-items-center">
												<div style="width: 42px; height: 42px; border-radius: 50%; background: <?= $b->jenis_kelamin == 'L' ? '#e0f2fe' : '#fce7f3'; ?>; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-right: 12px;">
													<?= $b->jenis_kelamin == 'L' ? '👦' : '👧'; ?>
												</div>
												<div>
													<h6 class="mb-0 font-weight-bold"><?= htmlspecialchars($b->nama_anak); ?></h6>
													<small class="text-muted">
														Orang Tua: <?= htmlspecialchars($b->nama_ortu ?? '-'); ?> | Usia: <strong><?= $usia; ?></strong>
													</small>
												</div>
											</div>
											<div class="d-flex align-items-center gap-2">
												<?php if (!empty($b->rfid_uid)): ?>
													<span class="badge badge-success px-2 py-1 mr-2" title="Kartu Terdaftar"><i class="fas fa-check-circle mr-1"></i>e-KTP Terhubung</span>
												<?php else: ?>
													<span class="badge badge-warning px-2 py-1 text-dark mr-2" title="Belum bind RFID"><i class="fas fa-clock mr-1"></i>Belum Ada KTP</span>
												<?php endif; ?>
												<a href="<?= base_url('smartrt/posyandu_cetak_kms/' . $b->id); ?>" target="_blank" class="btn btn-outline-primary btn-sm py-1 px-2 font-weight-bold" style="border-radius: 6px; font-size: 11px;">
													🖨️ KMS
												</a>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<!-- Kolom Kehadiran & Pemeriksaan Terkini -->
				<div class="col-lg-7 mb-4">
					<div class="card h-100" style="border-radius: 12px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
						<div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
							<h5 class="mb-0 font-weight-bold text-dark"><i class="fas fa-clipboard-check mr-2 text-success"></i>Pemeriksaan Sesi Ini</h5>
							<?php if ($sesi_aktif): ?>
								<span class="badge badge-success px-2 py-1"><?= count($kehadiran_hari_ini); ?> Hadir</span>
							<?php endif; ?>
						</div>
						<div class="card-body p-0">
							<?php if (empty($kehadiran_hari_ini)): ?>
								<div class="text-center py-5 text-muted">
									<i class="fas fa-notes-medical fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
									<p class="mb-0">Belum ada pemeriksaan pada sesi ini.</p>
								</div>
							<?php else: ?>
								<div class="table-responsive">
									<table class="table table-hover mb-0">
										<thead class="bg-light">
											<tr style="font-size: 13px;">
												<th>Balita</th>
												<th>Jam</th>
												<th>BB / TB</th>
												<th>Status Gizi</th>
												<th>Imunisasi</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($kehadiran_hari_ini as $k): ?>
												<tr style="font-size: 13px;">
													<td>
														<strong><?= htmlspecialchars($k->nama_anak); ?></strong>
														<br><small class="text-muted"><?= htmlspecialchars($k->nama_ortu ?? '-'); ?></small>
													</td>
													<td>
														<span class="badge badge-light"><?= substr($k->jam_datang, 11, 5); ?></span>
														<br><small class="text-muted"><?= $k->metode_absen == 'RFID' ? '📶 RFID' : '✍️ Manual'; ?></small>
													</td>
													<td>
														<?= $k->berat_badan ? $k->berat_badan . ' kg' : '-'; ?> / 
														<?= $k->tinggi_badan ? $k->tinggi_badan . ' cm' : '-'; ?>
													</td>
													<td>
														<?php if ($k->status_gizi): ?>
															<?php
																$badge_class = 'badge-success';
																if ($k->status_gizi == 'Kurang') $badge_class = 'badge-warning';
																if ($k->status_gizi == 'Buruk')  $badge_class = 'badge-danger';
																if ($k->status_gizi == 'Lebih')  $badge_class = 'badge-info';
															?>
															<span class="badge <?= $badge_class; ?>"><?= $k->status_gizi; ?></span>
														<?php else: ?>
															<span class="text-muted">Belum diukur</span>
														<?php endif; ?>
													</td>
													<td>
														<?= $k->imunisasi ? '<span class="badge badge-info">' . htmlspecialchars($k->imunisasi) . '</span>' : '<span class="text-muted">-</span>'; ?>
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
			</div>

			<!-- Card Info Panduan RFID untuk Warga -->
			<div class="card mb-4" style="border-radius: 12px; border: none; background: #f0fdf4; border-left: 4px solid #16a34a;">
				<div class="card-body p-4 d-flex align-items-center">
					<i class="fas fa-id-badge fa-3x text-success mr-4" style="opacity: 0.8;"></i>
					<div>
						<h5 class="font-weight-bold text-success mb-1">Cara Menggunakan Kartu RFID / KTP di Posyandu</h5>
						<p class="mb-0 text-dark" style="font-size: 14px;">
							Orang tua yang membawa balita cukup menempelkan e-KTP atau kartu RFID yang sudah didaftarkan ke mesin reader di meja Posyandu. 
							Nama balita dan waktu kedatangan akan langsung tercatat otomatis tanpa antre mencatat nama secara manual.
						</p>
					</div>
				</div>
			</div>

		</div>
	</section>
</div>
