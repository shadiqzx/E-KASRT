@extends('layouts.app')

@section('title', 'Data Warga')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap');

.warga-page-wrapper {
	font-family: 'Plus Jakarta Sans', sans-serif;
	color: #0f172a;
	padding-bottom: 60px;
}
.warga-hero-mesh {
	background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4338ca 80%, #6366f1 100%);
	border-radius: 24px;
	padding: 34px 38px;
	color: #ffffff;
	box-shadow: 0 20px 40px -15px rgba(67, 56, 202, 0.45);
	position: relative;
	overflow: hidden;
	margin-bottom: 28px;
	border: 1px solid rgba(255, 255, 255, 0.12);
}
.hero-glass-pill--purple {
	background: rgba(255, 255, 255, 0.15);
	backdrop-filter: blur(12px);
	border: 1px solid rgba(255, 255, 255, 0.25);
	color: #c7d2fe;
	font-size: 11.5px;
	font-weight: 800;
	letter-spacing: 0.8px;
	padding: 5px 14px;
	border-radius: 30px;
	display: inline-flex;
	align-items: center;
	gap: 6px;
	margin-bottom: 12px;
	text-transform: uppercase;
}
.table-container-card {
	background: #ffffff;
	border-radius: 20px;
	border: 1px solid rgba(226, 232, 240, 0.85);
	box-shadow: 0 8px 26px -4px rgba(15, 23, 42, 0.05);
	overflow: hidden;
}
.table-custom-warga {
	width: 100%;
	border-collapse: separate;
	border-spacing: 0;
}
.table-custom-warga thead th {
	background: #f8fafc;
	color: #475569;
	font-size: 11px;
	font-weight: 800;
	text-transform: uppercase;
	letter-spacing: 0.7px;
	padding: 16px 20px;
	border-top: none;
	border-bottom: 1.5px solid #e2e8f0;
}
.table-custom-warga tbody td {
	padding: 16px 20px;
	vertical-align: middle;
	border-top: 1px solid #f1f5f9;
	font-size: 13.5px;
}
.badge-nik {
	font-family: 'JetBrains Mono', monospace;
	font-size: 12.5px;
	font-weight: 700;
	background: #f1f5f9;
	color: #1e293b;
	padding: 4px 10px;
	border-radius: 8px;
	border: 1px solid #e2e8f0;
}
.btn-action-circle {
	width: 34px;
	height: 34px;
	border-radius: 10px;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	font-size: 13.5px;
	border: 1px solid transparent;
	transition: all 0.2s;
	background: #f8fafc;
	color: #475569;
	cursor: pointer;
}
.btn-action-circle.btn-edit {
	background: #e0e7ff;
	color: #4338ca;
	border-color: #c7d2fe;
}
.btn-action-circle.btn-del {
	background: #fff1f2;
	color: #e11d48;
	border-color: #ffe4e6;
}
</style>

<div class="warga-page-wrapper">
	<!-- Hero Mesh Gradient Header -->
	<div class="warga-hero-mesh">
		<div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 20px;">
			<div>
				<div class="hero-glass-pill--purple">
					<i class="fas fa-users mr-1"></i> MASTER DATA WARGA RT
				</div>
				<h1 class="font-weight-bold text-white mb-2" style="font-size: 28px; letter-spacing: -0.6px;">
					Data Warga & Kependudukan RT
				</h1>
				<p class="mb-0 text-white-50" style="font-size: 14px; max-width: 580px;">
					Kelola data kependudukan warga RT, integrasi RFID e-KTP untuk layanan Smart RT & Posyandu balita digital.
				</p>
			</div>

			<div class="d-flex flex-wrap align-items-center" style="gap: 12px;">
				<button class="btn btn-light font-weight-bold px-4 py-2 text-primary shadow" data-toggle="modal" data-target="#addWargaModal" style="border-radius: 12px; font-size: 14px;">
					<i class="fas fa-user-plus mr-1"></i> + Tambah Data Warga
				</button>
			</div>
		</div>
	</div>

	<!-- Main Table Section -->
	<div class="table-container-card">
		<div class="p-3 border-bottom d-flex align-items-center justify-content-between flex-wrap" style="gap: 12px; background: #ffffff;">
			<div class="d-flex align-items-center flex-wrap" style="gap: 10px; flex: 1;">
				<div style="position: relative; min-width: 280px;">
					<i class="fas fa-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px;"></i>
					<input type="text" id="wargaSearchInput" class="form-control form-control-sm" placeholder="Cari nama, NIK, atau alamat warga..." style="padding-left: 38px; border-radius: 10px; border: 1.5px solid #e2e8f0; font-size: 13px;" onkeyup="searchWargaTable()">
				</div>
			</div>
			<div style="font-size: 13px; color: #64748b;">
				Total <strong class="text-dark">{{ count($warga) }}</strong> Warga Terdaftar
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-custom-warga" id="wargaMainTable">
				<thead>
					<tr>
						<th style="width: 50px;">No</th>
						<th style="width: 170px;">NIK</th>
						<th>Nama Lengkap</th>
						<th style="width: 120px;">Gender</th>
						<th style="width: 200px;">Tempat, Tgl Lahir</th>
						<th>Alamat / No. Rumah</th>
						<th style="width: 140px;">Smart RFID</th>
						<th style="width: 110px;" class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody id="wargaTableBody">
					@forelse($warga as $idx => $w)
					<tr class="warga-row-item">
						<td class="text-muted font-weight-bold">{{ $idx + 1 }}</td>
						<td><span class="badge-nik">{{ $w->nik }}</span></td>
						<td>
							<strong class="text-dark" style="font-size: 14px;">{{ $w->nama }}</strong>
							@if(!empty($w->hubungan_keluarga))
								<small class="d-block text-muted">{{ $w->hubungan_keluarga }}</small>
							@endif
						</td>
						<td>
							@if(strtolower($w->jekel) === 'laki-laki' || strtolower($w->jekel) === 'l')
								<span class="badge badge-primary px-2 py-1 font-weight-bold">Laki-laki</span>
							@else
								<span class="badge badge-info px-2 py-1 font-weight-bold">Perempuan</span>
							@endif
						</td>
						<td>
							<div class="text-dark">{{ $w->tempat_lahir }}</div>
							<small class="text-muted">{{ !empty($w->tanggal_lahir) ? date('d-m-Y', strtotime($w->tanggal_lahir)) : '-' }}</small>
						</td>
						<td>
							<div class="text-dark">{{ $w->alamat }}</div>
							@if(!empty($w->no_rumah))
								<small class="text-muted">No. {{ $w->no_rumah }}</small>
							@endif
						</td>
						<td>
							@if(!empty($w->rfid_ktp))
								<span class="badge badge-success px-2 py-1 font-weight-bold" style="font-family: 'JetBrains Mono';">
									<i class="fas fa-check-circle mr-1"></i>{{ $w->rfid_ktp }}
								</span>
							@else
								<span class="badge badge-light border text-muted px-2 py-1">Belum Terhubung</span>
							@endif
						</td>
						<td class="text-center">
							<div class="d-inline-flex" style="gap: 6px;">
								<button type="button" class="btn-action-circle btn-edit" title="Edit Data Warga" data-toggle="modal" data-target="#editWargaModal{{ $w->idWarga }}">
									<i class="fas fa-pen"></i>
								</button>
								<a href="{{ route('warga.destroy', $w->idWarga) }}" class="btn-action-circle btn-del" title="Hapus Data Warga" onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')">
									<i class="fas fa-trash-alt"></i>
								</a>
							</div>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="8" class="text-center py-5 text-muted">
							<i class="fas fa-users fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
							<h5>Belum Ada Data Warga</h5>
							<p style="font-size: 13px;">Klik "+ Tambah Data Warga" untuk mendaftarkan warga pertama.</p>
						</td>
					</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal Tambah Warga -->
<div class="modal fade" id="addWargaModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
			<div class="modal-header text-white" style="background: linear-gradient(135deg, #312e81, #4338ca); padding: 22px 26px;">
				<h5 class="modal-title font-weight-bold text-white mb-0"><i class="fas fa-user-plus mr-2"></i>Tambah Data Warga Baru</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body p-4">
				<form action="{{ route('warga.store') }}" method="POST">
					@csrf
					<div class="form-group mb-3">
						<label class="font-weight-bold text-dark" style="font-size: 13px;">Nomor Induk Kependudukan (NIK)</label>
						<input class="form-control" type="text" name="nik" placeholder="16 digit NIK" required style="border-radius: 9px;">
					</div>

					<div class="form-group mb-3">
						<label class="font-weight-bold text-dark" style="font-size: 13px;">Nama Lengkap</label>
						<input class="form-control" type="text" name="nama" placeholder="Nama warga" required style="border-radius: 9px;">
					</div>

					<div class="row">
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Jenis Kelamin</label>
							<select class="form-control" name="jekel" style="border-radius: 9px;">
								<option value="Laki-laki">Laki-laki</option>
								<option value="Perempuan">Perempuan</option>
							</select>
						</div>
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">UID e-KTP (Opsional)</label>
							<input class="form-control" type="text" name="rfid_ktp" placeholder="Contoh: 99AA88BB" style="border-radius: 9px; font-family: 'JetBrains Mono';">
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Tempat Lahir</label>
							<input class="form-control" type="text" name="tempat_lahir" placeholder="Kota lahir" style="border-radius: 9px;">
						</div>
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Tanggal Lahir</label>
							<input class="form-control" type="date" name="tanggal_lahir" style="border-radius: 9px;">
						</div>
					</div>

					<div class="row">
						<div class="col-md-8 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Alamat</label>
							<input class="form-control" type="text" name="alamat" placeholder="Jalan / Gang / Blok" style="border-radius: 9px;">
						</div>
						<div class="col-md-4 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">No. Rumah</label>
							<input class="form-control" type="text" name="no_rumah" placeholder="No." style="border-radius: 9px;">
						</div>
					</div>

					<div class="d-flex justify-content-end" style="gap: 8px;">
						<button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
						<button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px;">
							<i class="fas fa-check-circle mr-1"></i> Simpan Warga
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modals Edit Warga -->
@foreach($warga as $w)
<div class="modal fade" id="editWargaModal{{ $w->idWarga }}" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
			<div class="modal-header text-white" style="background: linear-gradient(135deg, #312e81, #4338ca); padding: 22px 26px;">
				<h5 class="modal-title font-weight-bold text-white mb-0"><i class="fas fa-user-edit mr-2"></i>Edit Data Warga: {{ $w->nama }}</h5>
				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body p-4">
				<form action="{{ route('warga.update', $w->idWarga) }}" method="POST">
					@csrf
					<div class="form-group mb-3">
						<label class="font-weight-bold text-dark" style="font-size: 13px;">Nomor Induk Kependudukan (NIK)</label>
						<input class="form-control" type="text" name="nik" value="{{ $w->nik }}" required style="border-radius: 9px;">
					</div>

					<div class="form-group mb-3">
						<label class="font-weight-bold text-dark" style="font-size: 13px;">Nama Lengkap</label>
						<input class="form-control" type="text" name="nama" value="{{ $w->nama }}" required style="border-radius: 9px;">
					</div>

					<div class="row">
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Jenis Kelamin</label>
							<select class="form-control" name="jekel" style="border-radius: 9px;">
								<option value="Laki-laki" {{ strtolower($w->jekel) === 'laki-laki' || strtolower($w->jekel) === 'l' ? 'selected' : '' }}>Laki-laki</option>
								<option value="Perempuan" {{ strtolower($w->jekel) === 'perempuan' || strtolower($w->jekel) === 'p' ? 'selected' : '' }}>Perempuan</option>
							</select>
						</div>
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">UID e-KTP (Opsional)</label>
							<input class="form-control" type="text" name="rfid_ktp" value="{{ $w->rfid_ktp }}" placeholder="Contoh: 99AA88BB" style="border-radius: 9px; font-family: 'JetBrains Mono';">
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Tempat Lahir</label>
							<input class="form-control" type="text" name="tempat_lahir" value="{{ $w->tempat_lahir }}" style="border-radius: 9px;">
						</div>
						<div class="col-md-6 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Tanggal Lahir</label>
							<input class="form-control" type="date" name="tanggal_lahir" value="{{ $w->tanggal_lahir }}" style="border-radius: 9px;">
						</div>
					</div>

					<div class="row">
						<div class="col-md-8 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">Alamat</label>
							<input class="form-control" type="text" name="alamat" value="{{ $w->alamat }}" style="border-radius: 9px;">
						</div>
						<div class="col-md-4 form-group mb-3">
							<label class="font-weight-bold text-dark" style="font-size: 13px;">No. Rumah</label>
							<input class="form-control" type="text" name="no_rumah" value="{{ $w->no_rumah }}" style="border-radius: 9px;">
						</div>
					</div>

					<div class="d-flex justify-content-end" style="gap: 8px;">
						<button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
						<button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px;">
							<i class="fas fa-save mr-1"></i> Simpan Perubahan
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endforeach

<script>
function searchWargaTable() {
	let input = document.getElementById('wargaSearchInput').value.toLowerCase();
	let rows = document.querySelectorAll('.warga-row-item');
	rows.forEach(r => {
		let text = r.innerText.toLowerCase();
		r.style.display = text.includes(input) ? '' : 'none';
	});
}
</script>
@endsection

