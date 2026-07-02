<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SmartRT extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')) {
			redirect('auth');
		}
	}

	private function _getUser()
	{
		$username = $this->session->userdata('username');
		return $this->db->get_where('users', ['username' => $username])->row_array();
	}

	private function _loadView($view_name, $data)
	{
		$user = $this->_getUser();
		$data['user'] = $user;
		
		if ($user['role_id'] == 1 || $user['role_id'] == 2 || $user['role_id'] == 3) {
			$this->load->view('include/header', $data);
		} else {
			$this->load->view('include/header_warga', $data);
		}
		$this->load->view('smartrt/' . $view_name, $data);
		$this->load->view('include/footer');
	}

	// 1. UANG SAMPAH
	public function sampah()
	{
		$user = $this->_getUser();
		$data['judul'] = 'Iuran Sampah';
		$data['menu'] = 'sampah';

		if ($user['role_id'] == 4) {
			// Get or create warga entry from data_warga using username/email match if possible, otherwise first record
			$warga = $this->db->get_where('data_warga', ['nama' => $user['user']])->row_array();
			if (!$warga) {
				$warga = $this->db->get('data_warga')->row_array(); // Fallback
			}
			$data['warga'] = $warga;
			$data['payments'] = $this->db->order_by('id', 'DESC')->get_where('sampah_payment', ['warga_id' => $warga['idWarga']])->result();
			$this->_loadView('sampah', $data);
		} else {
			// Admin / RT / Bendahara
			$this->db->select('sampah_payment.*, data_warga.nama as nama_warga');
			$this->db->from('sampah_payment');
			$this->db->join('data_warga', 'data_warga.idWarga = sampah_payment.warga_id');
			$this->db->order_by('sampah_payment.id', 'DESC');
			$data['payments'] = $this->db->get()->result();
			$data['warga_list'] = $this->db->get('data_warga')->result();
			$this->_loadView('sampah_kelola', $data);
		}
	}

	public function sampah_bayar()
	{
		$warga_id = $this->input->post('warga_id');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$jumlah = $this->input->post('jumlah');
		$metode = $this->input->post('metode');

		$config['upload_path'] = './assets/profil/'; // Reuse existing folder for ease
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);

		$bukti = null;
		if ($metode == 'QR' && $this->upload->do_upload('bukti_bayar')) {
			$bukti = $this->upload->data('file_name');
		}

		$insert_data = [
			'warga_id' => $warga_id,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'jumlah' => $jumlah,
			'metode' => $metode,
			'bukti_bayar' => $bukti,
			'status' => ($metode == 'Tunai') ? 'Pending' : 'Pending'
		];

		$this->db->insert('sampah_payment', $insert_data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Pembayaran berhasil diajukan! Menunggu verifikasi RT.</div>');
		redirect('smartrt/sampah');
	}

	public function sampah_update_status($id, $status)
	{
		$this->db->where('id', $id)->update('sampah_payment', ['status' => $status]);
		
		// If approved, we can automatically record it to data_kas
		if ($status == 'Disetujui') {
			$payment = $this->db->get_where('sampah_payment', ['id' => $id])->row_array();
			$warga = $this->db->get_where('data_warga', ['idWarga' => $payment['warga_id']])->row_array();
			
			$kas_data = [
				'keterangan' => 'Uang Sampah ' . $payment['bulan'] . ' ' . $payment['tahun'] . ' - ' . $warga['nama'],
				'tanggal' => date('Y-m-d'),
				'jumlah' => $payment['jumlah'],
				'jenis' => 'masuk'
			];
			$this->db->insert('data_kas', $kas_data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success">Status pembayaran diperbarui!</div>');
		redirect('smartrt/sampah');
	}

	// 2. KOPERASI
	public function koperasi()
	{
		$user = $this->_getUser();
		$data['judul'] = 'Koperasi RT';
		$data['menu'] = 'koperasi';

		if ($user['role_id'] == 4) {
			$warga = $this->db->get_where('data_warga', ['nama' => $user['user']])->row_array();
			if (!$warga) {
				$warga = $this->db->get('data_warga')->row_array();
			}
			$data['warga'] = $warga;
			$data['transaksi'] = $this->db->order_by('id', 'DESC')->get_where('koperasi', ['warga_id' => $warga['idWarga']])->result();
			$this->_loadView('koperasi', $data);
		} else {
			$this->db->select('koperasi.*, data_warga.nama as nama_warga');
			$this->db->from('koperasi');
			$this->db->join('data_warga', 'data_warga.idWarga = koperasi.warga_id');
			$this->db->order_by('koperasi.id', 'DESC');
			$data['transaksi'] = $this->db->get()->result();
			$data['warga_list'] = $this->db->get('data_warga')->result();
			$this->_loadView('koperasi_kelola', $data);
		}
	}

	public function koperasi_tambah()
	{
		$insert_data = [
			'warga_id' => $this->input->post('warga_id'),
			'jenis_transaksi' => $this->input->post('jenis_transaksi'),
			'jumlah' => $this->input->post('jumlah'),
			'keterangan' => $this->input->post('keterangan'),
			'status' => $this->input->post('status') ?? 'Pending'
		];
		$this->db->insert('koperasi', $insert_data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Transaksi Koperasi berhasil disimpan!</div>');
		redirect('smartrt/koperasi');
	}

	public function koperasi_update_status($id, $status)
	{
		$this->db->where('id', $id)->update('koperasi', ['status' => $status]);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Status koperasi diperbarui!</div>');
		redirect('smartrt/koperasi');
	}

	// 3. BANK SAMPAH
	public function banksampah()
	{
		$user = $this->_getUser();
		$data['judul'] = 'Bank Sampah';
		$data['menu'] = 'banksampah';

		if ($user['role_id'] == 4) {
			$warga = $this->db->get_where('data_warga', ['nama' => $user['user']])->row_array();
			if (!$warga) {
				$warga = $this->db->get('data_warga')->row_array();
			}
			$data['warga'] = $warga;
			$data['setoran'] = $this->db->order_by('id', 'DESC')->get_where('bank_sampah', ['warga_id' => $warga['idWarga']])->result();
			
			// Total poin
			$this->db->select_sum('poin');
			$this->db->where('warga_id', $warga['idWarga']);
			$data['total_poin'] = $this->db->get('bank_sampah')->row()->poin ?? 0;

			$this->_loadView('banksampah', $data);
		} else {
			$this->db->select('bank_sampah.*, data_warga.nama as nama_warga');
			$this->db->from('bank_sampah');
			$this->db->join('data_warga', 'data_warga.idWarga = bank_sampah.warga_id');
			$this->db->order_by('bank_sampah.id', 'DESC');
			$data['setoran'] = $this->db->get()->result();
			$data['warga_list'] = $this->db->get('data_warga')->result();
			$this->_loadView('banksampah_kelola', $data);
		}
	}

	public function banksampah_tambah()
	{
		$berat = $this->input->post('berat');
		$jenis = $this->input->post('jenis_sampah');
		
		// 1 kg = 1000 poin
		$poin = intval($berat * 1000);

		$insert_data = [
			'warga_id' => $this->input->post('warga_id'),
			'jenis_sampah' => $jenis,
			'berat' => $berat,
			'poin' => $poin
		];
		$this->db->insert('bank_sampah', $insert_data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Setoran sampah berhasil dicatat!</div>');
		redirect('smartrt/banksampah');
	}

	// 4. UMKM
	public function umkm()
	{
		$user = $this->_getUser();
		$data['judul'] = 'UMKM Warga';
		$data['menu'] = 'umkm';

		$this->db->select('umkm.*, data_warga.nama as nama_pemilik');
		$this->db->from('umkm');
		$this->db->join('data_warga', 'data_warga.idWarga = umkm.warga_id');
		$this->db->order_by('umkm.id', 'DESC');
		$data['umkm_list'] = $this->db->get()->result();

		$warga = $this->db->get_where('data_warga', ['nama' => $user['user']])->row_array();
		if (!$warga) {
			$warga = $this->db->get('data_warga')->row_array();
		}
		$data['warga'] = $warga;

		if ($user['role_id'] == 4) {
			$this->_loadView('umkm', $data);
		} else {
			$this->_loadView('umkm_kelola', $data);
		}
	}

	public function umkm_tambah()
	{
		$config['upload_path'] = './assets/profil/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);

		$foto = 'umkm_default.png';
		if ($this->upload->do_upload('foto')) {
			$foto = $this->upload->data('file_name');
		}

		$insert_data = [
			'warga_id' => $this->input->post('warga_id'),
			'nama_usaha' => $this->input->post('nama_usaha'),
			'kategori' => $this->input->post('kategori'),
			'deskripsi' => $this->input->post('deskripsi'),
			'no_wa' => $this->input->post('no_wa'),
			'foto' => $foto
		];
		$this->db->insert('umkm', $insert_data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Usaha UMKM berhasil didaftarkan!</div>');
		redirect('smartrt/umkm');
	}

	public function umkm_hapus($id)
	{
		$this->db->delete('umkm', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success">UMKM berhasil dihapus!</div>');
		redirect('smartrt/umkm');
	}

	// 5. SURAT MENYURAT
	public function surat()
	{
		$user = $this->_getUser();
		$data['judul'] = 'Surat Menyurat';
		$data['menu'] = 'surat';

		if ($user['role_id'] == 4) {
			$warga = $this->db->get_where('data_warga', ['nama' => $user['user']])->row_array();
			if (!$warga) {
				$warga = $this->db->get('data_warga')->row_array();
			}
			$data['warga'] = $warga;
			$data['surat_list'] = $this->db->order_by('id', 'DESC')->get_where('surat', ['warga_id' => $warga['idWarga']])->result();
			$this->_loadView('surat', $data);
		} else {
			$this->db->select('surat.*, data_warga.nama as nama_warga, data_warga.nik');
			$this->db->from('surat');
			$this->db->join('data_warga', 'data_warga.idWarga = surat.warga_id');
			$this->db->order_by('surat.id', 'DESC');
			$data['surat_list'] = $this->db->get()->result();
			$this->_loadView('surat_kelola', $data);
		}
	}

	public function surat_ajukan()
	{
		$insert_data = [
			'warga_id' => $this->input->post('warga_id'),
			'jenis_surat' => $this->input->post('jenis_surat'),
			'keperluan' => $this->input->post('keperluan'),
			'status' => 'Pending'
		];
		$this->db->insert('surat', $insert_data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Pengajuan surat berhasil dikirim!</div>');
		redirect('smartrt/surat');
	}

	public function surat_update_status($id, $status)
	{
		$update_data = [
			'status' => $status,
			'keterangan_admin' => $this->input->post('keterangan_admin')
		];
		$this->db->where('id', $id)->update('surat', $update_data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Status pengajuan surat diperbarui!</div>');
		redirect('smartrt/surat');
	}

	// 6. POSYANDU
	public function posyandu()
	{
		$user = $this->_getUser();
		$data['judul'] = 'Posyandu';
		$data['menu'] = 'posyandu';

		$data['riwayat'] = $this->db->order_by('tanggal_periksa', 'DESC')->get('posyandu')->result();

		if ($user['role_id'] == 4) {
			$this->_loadView('posyandu', $data);
		} else {
			$this->_loadView('posyandu_kelola', $data);
		}
	}

	public function posyandu_tambah()
	{
		$insert_data = [
			'nama_anak' => $this->input->post('nama_anak'),
			'ibu_nama' => $this->input->post('ibu_nama'),
			'umur_bulan' => $this->input->post('umur_bulan'),
			'berat_badan' => $this->input->post('berat_badan'),
			'tinggi_badan' => $this->input->post('tinggi_badan'),
			'imunisasi' => $this->input->post('imunisasi'),
			'tanggal_periksa' => $this->input->post('tanggal_periksa'),
			'catatan' => $this->input->post('catatan')
		];
		$this->db->insert('posyandu', $insert_data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Data pemeriksaan Posyandu berhasil ditambahkan!</div>');
		redirect('smartrt/posyandu');
	}

	// 7. KEAMANAN / RONDA
	public function ronda()
	{
		$user = $this->_getUser();
		$data['judul'] = 'Jadwal Ronda';
		$data['menu'] = 'ronda';

		$data['ronda_list'] = $this->db->get('ronda')->result();

		if ($user['role_id'] == 4) {
			$this->_loadView('ronda', $data);
		} else {
			$this->_loadView('ronda_kelola', $data);
		}
	}

	public function ronda_tambah()
	{
		$insert_data = [
			'hari' => $this->input->post('hari'),
			'nama_petugas' => $this->input->post('nama_petugas'),
			'keterangan' => $this->input->post('keterangan')
		];
		$this->db->insert('ronda', $insert_data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Petugas ronda berhasil ditambahkan!</div>');
		redirect('smartrt/ronda');
	}

	public function ronda_hapus($id)
	{
		$this->db->delete('ronda', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Petugas ronda berhasil dihapus!</div>');
		redirect('smartrt/ronda');
	}

	// 8. KEGIATAN
	public function kegiatan()
	{
		$user = $this->_getUser();
		$data['judul'] = 'Agenda Kegiatan';
		$data['menu'] = 'kegiatan';

		$data['kegiatan_list'] = $this->db->order_by('tanggal', 'ASC')->get('kegiatan')->result();

		if ($user['role_id'] == 4) {
			$this->_loadView('kegiatan', $data);
		} else {
			$this->_loadView('kegiatan_kelola', $data);
		}
	}

	public function kegiatan_tambah()
	{
		$insert_data = [
			'nama_kegiatan' => $this->input->post('nama_kegiatan'),
			'tanggal' => $this->input->post('tanggal'),
			'waktu' => $this->input->post('waktu'),
			'lokasi' => $this->input->post('lokasi'),
			'keterangan' => $this->input->post('keterangan'),
			'status' => 'Mendatang'
		];
		$this->db->insert('kegiatan', $insert_data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Kegiatan RT berhasil dijadwalkan!</div>');
		redirect('smartrt/kegiatan');
	}

	public function kegiatan_update_status($id, $status)
	{
		$this->db->where('id', $id)->update('kegiatan', ['status' => $status]);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Status kegiatan diperbarui!</div>');
		redirect('smartrt/kegiatan');
	}

	// 9. RUKEM (RUKUN KEMATIAN)
	public function rukem()
	{
		$user = $this->_getUser();
		$data['judul'] = 'Rukun Kematian (Rukem)';
		$data['menu'] = 'rukem';

		$data['rukem_list'] = $this->db->order_by('id', 'DESC')->get('rukem')->result();

		if ($user['role_id'] == 4) {
			$this->_loadView('rukem', $data);
		} else {
			$this->_loadView('rukem_kelola', $data);
		}
	}

	public function rukem_tambah()
	{
		$santunan = $this->input->post('santunan');
		$insert_data = [
			'nama_almarhum' => $this->input->post('nama_almarhum'),
			'tanggal_meninggal' => $this->input->post('tanggal_meninggal'),
			'santunan' => $santunan,
			'status_rukem' => $this->input->post('status_rukem') ?? 'Dalam Proses Pemakaman'
		];
		$this->db->insert('rukem', $insert_data);

		// Deduct from data_kas automatically if santunan > 0
		if ($santunan > 0) {
			$kas_data = [
				'keterangan' => 'Santunan Kematian Alm. ' . $this->input->post('nama_almarhum'),
				'tanggal' => date('Y-m-d'),
				'jumlah' => $santunan,
				'jenis' => 'keluar'
			];
			$this->db->insert('data_kas', $kas_data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success">Data duka berhasil dicatat!</div>');
		redirect('smartrt/rukem');
	}

	// 10. ASPIRASI
	public function aspirasi()
	{
		$user = $this->_getUser();
		$data['judul'] = 'Kotak Aspirasi';
		$data['menu'] = 'aspirasi';

		$data['aspirasi_list'] = $this->db->order_by('id', 'DESC')->get('aspirasi')->result();

		if ($user['role_id'] == 4) {
			$this->_loadView('aspirasi', $data);
		} else {
			$this->_loadView('aspirasi_kelola', $data);
		}
	}

	public function aspirasi_kirim()
	{
		$anonim = $this->input->post('anonim');
		$user = $this->_getUser();
		
		$insert_data = [
			'nama_pengirim' => ($anonim == '1') ? 'Anonim' : $user['user'],
			'kategori' => $this->input->post('kategori'),
			'isi' => $this->input->post('isi')
		];
		$this->db->insert('aspirasi', $insert_data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Aspirasi berhasil dikirim! Terima kasih atas partisipasi Anda.</div>');
		redirect('smartrt/aspirasi');
	}

	// 11. ASET RT
	public function aset()
	{
		$user = $this->_getUser();
		$data['judul'] = 'Daftar Aset RT';
		$data['menu'] = 'aset';

		$data['aset_list'] = $this->db->get('aset')->result();

		if ($user['role_id'] == 4) {
			$this->_loadView('aset', $data);
		} else {
			$this->_loadView('aset_kelola', $data);
		}
	}

	public function aset_tambah()
	{
		$insert_data = [
			'nama_barang' => $this->input->post('nama_barang'),
			'jumlah' => $this->input->post('jumlah'),
			'kondisi' => $this->input->post('kondisi'),
			'lokasi' => $this->input->post('lokasi')
		];
		$this->db->insert('aset', $insert_data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Aset RT berhasil ditambahkan!</div>');
		redirect('smartrt/aset');
	}

	public function aset_hapus($id)
	{
		$this->db->delete('aset', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Aset RT berhasil dihapus!</div>');
		redirect('smartrt/aset');
	}

	// ===== BACKUP & GITHUB SYNC =====
	public function backup()
	{
		$user = $this->_getUser();
		if ($user['role_id'] == 4) {
			redirect('users/warga');
		}

		$data['menu']   = 'backup';
		$data['judul']  = 'Backup & Sinkronisasi Data';
		$data['user']   = $user;

		// Read saved token from config file
		$token_file = FCPATH . 'database/.gh_token';
		$github_token = file_exists($token_file) ? trim(file_get_contents($token_file)) : '';
		$data['github_token']      = $github_token;
		$data['github_configured'] = !empty($github_token);

		$this->_loadView('backup', $data);
	}

	public function backup_save_token()
	{
		$user = $this->_getUser();
		if ($user['role_id'] == 4) redirect('users/warga');

		$token = trim($this->input->post('github_token'));
		if (!empty($token)) {
			$token_dir = FCPATH . 'database/';
			if (!is_dir($token_dir)) mkdir($token_dir, 0777, true);
			file_put_contents($token_dir . '.gh_token', $token);
			$this->session->set_flashdata('message', '<div class="alert alert-success">Token GitHub berhasil disimpan!</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-warning">Token tidak boleh kosong.</div>');
		}
		redirect('smartrt/backup');
	}

	public function backup_db()
	{
		$user = $this->_getUser();
		if ($user['role_id'] == 4) redirect('users/warga');

		$backup_dir  = FCPATH . 'database/';
		if (!is_dir($backup_dir)) mkdir($backup_dir, 0777, true);
		$backup_file = $backup_dir . 'kasrt_backup.sql';

		$mysqldump = 'D:\\data app\\mysql\\bin\\mysqldump.exe';
		$cmd = "\"$mysqldump\" -u root --password=\"\" kasrt > \"$backup_file\" 2>&1";
		exec($cmd, $output, $return_var);

		if ($return_var !== 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal membuat backup database. Error: ' . implode('<br>', $output) . '</div>');
		} else {
			$size = round(filesize($backup_file) / 1024, 1);
			$this->session->set_flashdata('message', '<div class="alert alert-success">✅ Backup database berhasil! File <strong>kasrt_backup.sql</strong> (' . $size . ' KB) tersimpan di folder <code>database/</code>.</div>');
		}
		redirect('smartrt/backup');
	}

	public function backup_download()
	{
		$user = $this->_getUser();
		if ($user['role_id'] == 4) redirect('users/warga');

		$file = FCPATH . 'database/kasrt_backup.sql';
		if (!file_exists($file)) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning">File backup belum tersedia. Jalankan backup terlebih dahulu.</div>');
			redirect('smartrt/backup');
		}

		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="kasrt_backup_' . date('Ymd_His') . '.sql"');
		header('Content-Length: ' . filesize($file));
		readfile($file);
		exit;
	}

	public function backup_github()
	{
		$user = $this->_getUser();
		if ($user['role_id'] == 4) redirect('users/warga');

		$token_file = FCPATH . 'database/.gh_token';
		if (!file_exists($token_file)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Token GitHub belum dikonfigurasi. Simpan token terlebih dahulu.</div>');
			redirect('smartrt/backup');
		}
		$token = trim(file_get_contents($token_file));
		if (empty($token)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Token GitHub kosong. Simpan token yang valid.</div>');
			redirect('smartrt/backup');
		}

		$owner = 'shadiqzx';
		$repo  = 'E-KASRT';
		$branch = 'main';
		$api_base = "https://api.github.com/repos/$owner/$repo";

		// Collect all files to push (exclude sensitive folders)
		$exclude_dirs = ['.git', 'database', 'vendor', 'node_modules'];
		$project_root = FCPATH;
		$files_pushed = 0;
		$errors = [];

		$this->_github_push_dir($project_root, $project_root, $api_base, $token, $branch, $exclude_dirs, $files_pushed, $errors);

		// Also push the SQL backup file specifically
		$backup_sql = FCPATH . 'database/kasrt_backup.sql';
		if (file_exists($backup_sql)) {
			$this->_github_push_file($backup_sql, 'database/kasrt_backup.sql', $api_base, $token, $branch, $files_pushed, $errors);
		}

		if (empty($errors)) {
			$this->session->set_flashdata('message', '<div class="alert alert-success">✅ Berhasil push <strong>' . $files_pushed . ' file</strong> ke GitHub repository <strong>' . $owner . '/' . $repo . '</strong>!</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-warning">Push selesai dengan <strong>' . $files_pushed . ' file</strong> berhasil, namun ada ' . count($errors) . ' error: <br>' . implode('<br>', array_slice($errors, 0, 3)) . '</div>');
		}

		redirect('smartrt/backup');
	}

	private function _github_push_dir($dir, $root, $api_base, $token, $branch, $exclude_dirs, &$count, &$errors)
	{
		$items = scandir($dir);
		foreach ($items as $item) {
			if ($item === '.' || $item === '..') continue;
			$full_path = $dir . DIRECTORY_SEPARATOR . $item;
			$relative  = str_replace([$root, '\\'], ['', '/'], $full_path);
			$relative  = ltrim($relative, '/');

			if (is_dir($full_path)) {
				if (!in_array($item, $exclude_dirs)) {
					$this->_github_push_dir($full_path, $root, $api_base, $token, $branch, $exclude_dirs, $count, $errors);
				}
			} else {
				// Only push text-like files to keep it manageable
				$ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));
				$allowed = ['php', 'html', 'css', 'js', 'sql', 'md', 'json', 'txt', 'htaccess', 'xml', 'ini'];
				if (in_array($ext, $allowed) || $item === '.htaccess') {
					$this->_github_push_file($full_path, $relative, $api_base, $token, $branch, $count, $errors);
				}
			}
		}
	}

	private function _github_push_file($local_path, $github_path, $api_base, $token, $branch, &$count, &$errors)
	{
		$content = base64_encode(file_get_contents($local_path));
		$url = $api_base . '/contents/' . $github_path;

		// Get existing SHA if file exists (needed for update)
		$ch = curl_init($url . '?ref=' . $branch);
		curl_setopt_array($ch, [
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTPHEADER => [
				'Authorization: token ' . $token,
				'User-Agent: E-KASRT-App',
				'Accept: application/vnd.github.v3+json',
			],
		]);
		$response = json_decode(curl_exec($ch), true);
		curl_close($ch);

		$body = ['message' => 'Auto backup ' . date('Y-m-d H:i:s'), 'content' => $content, 'branch' => $branch];
		if (!empty($response['sha'])) {
			$body['sha'] = $response['sha'];
		}

		// Create or update file
		$ch = curl_init($url);
		curl_setopt_array($ch, [
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => 'PUT',
			CURLOPT_POSTFIELDS => json_encode($body),
			CURLOPT_HTTPHEADER => [
				'Authorization: token ' . $token,
				'User-Agent: E-KASRT-App',
				'Content-Type: application/json',
				'Accept: application/vnd.github.v3+json',
			],
		]);
		$result = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if ($http_code === 200 || $http_code === 201) {
			$count++;
		} else {
			$errors[] = "$github_path: HTTP $http_code";
		}
	}
}
