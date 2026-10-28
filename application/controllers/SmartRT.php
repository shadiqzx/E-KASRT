<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SmartRT extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// API endpoint untuk IoT / ESP32, live stream radar, cetak KMS, dan cetak Kwitansi
		$method = $this->router->fetch_method();
		if ($method !== 'posyandu_rfid_tap' && $method !== 'posyandu_live_stream' && $method !== 'posyandu_cetak_kms' && $method !== 'iuran_cetak_kwitansi') {
			if (!$this->session->userdata('username')) {
				redirect('auth');
			}
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

	// 1.5. IURAN KAS WARGA (Bulanan RT)
	public function iuran()
	{
		$user = $this->_getUser();
		$data['judul'] = 'Iuran Warga';
		$data['menu']  = 'iuran';

		$tahun = $this->input->get('tahun') ?: date('Y');
		$data['tahun'] = $tahun;

		// Daftar 12 Bulan
		$bulan_list = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		$data['bulan_list'] = $bulan_list;

		// Bulan saat ini (1-indexed)
		$cur_month_idx = (int)date('n');
		$data['cur_month_idx'] = $cur_month_idx;

		if ($user['role_id'] == 4) {
			// Warga View
			$warga = $this->db->get_where('data_warga', ['nama' => $user['user']])->row_array();
			if (!$warga) {
				$warga = $this->db->get('data_warga')->row_array(); // Fallback
			}
			$data['warga'] = $warga;

			// Ambil semua pembayaran warga di tahun ini
			$payments = $this->db->order_by('id', 'DESC')->get_where('iuran_payment', [
				'warga_id' => $warga['idWarga'],
				'tahun'    => $tahun
			])->result();
			$data['payments'] = $payments;

			// Petakan status per bulan
			$status_bulan = [];
			foreach ($bulan_list as $idx => $b) {
				$status_bulan[$b] = [
					'status'  => 'Belum',
					'payment' => null
				];
			}
			foreach ($payments as $p) {
				if (isset($status_bulan[$p->bulan])) {
					$status_bulan[$p->bulan] = [
						'status'  => $p->status,
						'payment' => $p
					];
				}
			}
			$data['status_bulan'] = $status_bulan;

			// Ringkasan nominal
			$total_lunas = 0;
			$total_tunggakan = 0;
			foreach ($bulan_list as $idx => $b) {
				$month_num = $idx + 1;
				if ($status_bulan[$b]['status'] == 'Disetujui') {
					$total_lunas += 50000;
				} else if ($month_num <= $cur_month_idx && $status_bulan[$b]['status'] != 'Pending') {
					$total_tunggakan += 50000;
				}
			}
			$data['total_lunas']     = $total_lunas;
			$data['total_tunggakan'] = $total_tunggakan;

			$this->_loadView('iuran', $data);
		} else {
			// Pengurus / Admin / Bendahara View
			// 1. Ambil seluruh data warga
			$warga_list = $this->db->order_by('no_rumah', 'ASC')->order_by('nama', 'ASC')->get('data_warga')->result();
			$data['warga_list'] = $warga_list;

			// 2. Ambil seluruh pembayaran di tahun ini
			$all_payments = $this->db->get_where('iuran_payment', ['tahun' => $tahun])->result();

			// 3. Susun matriks [warga_id][bulan]
			$matrix = [];
			$total_kas_tahun = 0;
			$total_lunas_bulan_ini = 0;
			$bulan_ini_nama = $bulan_list[$cur_month_idx - 1];

			foreach ($all_payments as $p) {
				$matrix[$p->warga_id][$p->bulan] = $p;
				if ($p->status == 'Disetujui') {
					$total_kas_tahun += $p->jumlah;
					if ($p->bulan == $bulan_ini_nama) {
						$total_lunas_bulan_ini++;
					}
				}
			}
			$data['matrix']                = $matrix;
			$data['total_kas_tahun']       = $total_kas_tahun;
			$data['total_lunas_bulan_ini'] = $total_lunas_bulan_ini;
			$data['bulan_ini_nama']        = $bulan_ini_nama;

			// 4. Pembayaran Pending yang butuh verifikasi bendahara
			$this->db->select('iuran_payment.*, data_warga.nama as nama_warga, data_warga.no_rumah, data_warga.nik');
			$this->db->from('iuran_payment');
			$this->db->join('data_warga', 'data_warga.idWarga = iuran_payment.warga_id');
			$this->db->where('iuran_payment.status', 'Pending');
			$this->db->order_by('iuran_payment.id', 'DESC');
			$data['pending_list'] = $this->db->get()->result();

			// 5. Riwayat transaksi terbaru
			$this->db->select('iuran_payment.*, data_warga.nama as nama_warga, data_warga.no_rumah');
			$this->db->from('iuran_payment');
			$this->db->join('data_warga', 'data_warga.idWarga = iuran_payment.warga_id');
			$this->db->order_by('iuran_payment.id', 'DESC');
			$this->db->limit(60);
			$data['recent_payments'] = $this->db->get()->result();

			$this->_loadView('iuran_kelola', $data);
		}
	}

	public function iuran_bayar()
	{
		$warga_id         = $this->input->post('warga_id');
		$bulan_post       = $this->input->post('bulan');
		$tahun            = $this->input->post('tahun') ?: date('Y');
		$jumlah_per_bulan = $this->input->post('jumlah') ?: 50000;
		$metode           = $this->input->post('metode');

		if (!is_array($bulan_post)) {
			$bulan_arr = [$bulan_post];
		} else {
			$bulan_arr = $bulan_post;
		}

		$config['upload_path']   = './assets/profil/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = 3072;
		$this->load->library('upload', $config);

		$bukti = null;
		if ($metode == 'QR' && $this->upload->do_upload('bukti_bayar')) {
			$bukti = $this->upload->data('file_name');
		}

		$inserted = 0;
		foreach ($bulan_arr as $b) {
			if (empty($b)) continue;

			$exists = $this->db->get_where('iuran_payment', [
				'warga_id' => $warga_id,
				'bulan'    => $b,
				'tahun'    => $tahun
			])->row();

			if ($exists) {
				$this->db->where('id', $exists->id)->update('iuran_payment', [
					'jumlah'        => $jumlah_per_bulan,
					'metode'        => $metode,
					'bukti_bayar'   => $bukti ?: $exists->bukti_bayar,
					'status'        => 'Pending',
					'tanggal_bayar' => date('Y-m-d H:i:s')
				]);
			} else {
				$this->db->insert('iuran_payment', [
					'warga_id'      => $warga_id,
					'bulan'         => $b,
					'tahun'         => $tahun,
					'jumlah'        => $jumlah_per_bulan,
					'metode'        => $metode,
					'bukti_bayar'   => $bukti,
					'status'        => 'Pending',
					'tanggal_bayar' => date('Y-m-d H:i:s')
				]);
			}
			$inserted++;
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success">Pembayaran iuran (' . $inserted . ' bulan) berhasil diajukan! Menunggu konfirmasi bendahara.</div>');
		redirect('smartrt/iuran');
	}

	public function iuran_update_status($id, $status)
	{
		$this->db->where('id', $id)->update('iuran_payment', ['status' => $status]);

		if ($status == 'Disetujui') {
			$payment = $this->db->get_where('iuran_payment', ['id' => $id])->row_array();
			$warga   = $this->db->get_where('data_warga', ['idWarga' => $payment['warga_id']])->row_array();

			$kas_data = [
				'keterangan' => 'Iuran Warga ' . $payment['bulan'] . ' ' . $payment['tahun'] . ' - ' . ($warga ? $warga['nama'] . ' (' . $warga['no_rumah'] . ')' : 'Warga'),
				'tanggal'    => date('Y-m-d'),
				'jumlah'     => $payment['jumlah'],
				'jenis'      => 'masuk'
			];
			$this->db->insert('data_kas', $kas_data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success">Status iuran berhasil diubah menjadi: <strong>' . $status . '</strong>!</div>');
		redirect('smartrt/iuran');
	}

	public function iuran_quick_pay()
	{
		$warga_id   = $this->input->post('warga_id');
		$bulan_post = $this->input->post('bulan');
		$tahun      = $this->input->post('tahun') ?: date('Y');
		$jumlah     = $this->input->post('jumlah') ?: 50000;

		if (!is_array($bulan_post)) {
			$bulan_arr = [$bulan_post];
		} else {
			$bulan_arr = $bulan_post;
		}

		$warga = $this->db->get_where('data_warga', ['idWarga' => $warga_id])->row_array();
		$warga_nama = $warga ? $warga['nama'] : 'Warga';

		foreach ($bulan_arr as $b) {
			if (empty($b)) continue;

			$exists = $this->db->get_where('iuran_payment', [
				'warga_id' => $warga_id,
				'bulan'    => $b,
				'tahun'    => $tahun
			])->row();

			if ($exists) {
				$this->db->where('id', $exists->id)->update('iuran_payment', [
					'jumlah'        => $jumlah,
					'metode'        => 'Tunai',
					'status'        => 'Disetujui',
					'tanggal_bayar' => date('Y-m-d H:i:s')
				]);
			} else {
				$this->db->insert('iuran_payment', [
					'warga_id'      => $warga_id,
					'bulan'         => $b,
					'tahun'         => $tahun,
					'jumlah'        => $jumlah,
					'metode'        => 'Tunai',
					'status'        => 'Disetujui',
					'tanggal_bayar' => date('Y-m-d H:i:s')
				]);
			}

			// Masuk buku kas
			$this->db->insert('data_kas', [
				'keterangan' => 'Iuran Warga ' . $b . ' ' . $tahun . ' - ' . $warga_nama . ' (Tunai)',
				'tanggal'    => date('Y-m-d'),
				'jumlah'     => $jumlah,
				'jenis'      => 'masuk'
			]);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success">Pembayaran tunai <strong>' . htmlspecialchars($warga_nama) . '</strong> berhasil dicatat lunas & masuk kas RT!</div>');
		redirect('smartrt/iuran');
	}

	public function iuran_cetak_kwitansi($id)
	{
		$this->db->select('iuran_payment.*, data_warga.nama as nama_warga, data_warga.no_rumah, data_warga.nik, data_warga.alamat');
		$this->db->from('iuran_payment');
		$this->db->join('data_warga', 'data_warga.idWarga = iuran_payment.warga_id');
		$this->db->where('iuran_payment.id', $id);
		$data['kwitansi'] = $this->db->get()->row();

		if (!$data['kwitansi']) {
			redirect('smartrt/iuran');
		}

		$this->load->view('smartrt/iuran_kwitansi_print', $data);
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

	// 6. POSYANDU — Modern e-KTP Ibu + RFID RC522 & NodeMCU ESP32 Integration
	public function posyandu()
	{
		$user = $this->_getUser();
		$data['judul'] = 'Posyandu Digital';
		$data['menu']  = 'posyandu';

		// Semua sesi
		$data['sesi_list'] = $this->db
			->order_by('tanggal', 'DESC')
			->order_by('id', 'DESC')
			->get('posyandu_sesi')
			->result();

		// Sesi aktif saat ini
		$data['sesi_aktif'] = $this->db
			->get_where('posyandu_sesi', ['status' => 'Aktif'])
			->row();

		// Daftar balita terdaftar beserta info Ibu (data_warga)
		$this->db->select('posyandu_balita.*, data_warga.nama AS nama_ortu, data_warga.nik AS nik_ortu, data_warga.rfid_ktp AS rfid_ktp_ibu, data_warga.alamat, data_warga.no_rumah');
		$this->db->from('posyandu_balita');
		$this->db->join('data_warga', 'data_warga.idWarga = posyandu_balita.warga_id', 'left');
		$this->db->order_by('posyandu_balita.nama_anak', 'ASC');
		$data['balita_list'] = $this->db->get()->result();

		// Kehadiran sesi aktif
		$data['kehadiran_hari_ini'] = [];
		if ($data['sesi_aktif']) {
			$this->db->select('posyandu_kehadiran.*, posyandu_balita.nama_anak, posyandu_balita.tanggal_lahir, posyandu_balita.jenis_kelamin, data_warga.nama AS nama_ortu, data_warga.rfid_ktp AS rfid_ktp_ibu');
			$this->db->from('posyandu_kehadiran');
			$this->db->join('posyandu_balita', 'posyandu_balita.id = posyandu_kehadiran.balita_id');
			$this->db->join('data_warga', 'data_warga.idWarga = posyandu_balita.warga_id', 'left');
			$this->db->where('posyandu_kehadiran.sesi_id', $data['sesi_aktif']->id);
			$this->db->order_by('posyandu_kehadiran.jam_datang', 'DESC');
			$data['kehadiran_hari_ini'] = $this->db->get()->result();
		}

		// Daftar warga lengkap untuk opsi Ibu Balita & Pairing KTP
		$data['warga_list'] = $this->db
			->order_by('nama', 'ASC')
			->get('data_warga')
			->result();

		// Log tap RFID terbaru (10 tap terakhir untuk live radar)
		$data['recent_taps'] = $this->db
			->order_by('id', 'DESC')
			->limit(10)
			->get('posyandu_tap_log')
			->result();

		// Statistik ringkasan
		$data['total_balita']   = $this->db->count_all('posyandu_balita');
		$data['total_ktp_ibu']  = $this->db->where('rfid_ktp IS NOT NULL AND rfid_ktp != ""', null, false)->count_all_results('data_warga');
		$data['total_hadir']    = $data['sesi_aktif']
			? $this->db->where('sesi_id', $data['sesi_aktif']->id)->count_all_results('posyandu_kehadiran')
			: 0;

		if ($user['role_id'] == 4) {
			$this->_loadView('posyandu', $data);
		} else {
			$this->_loadView('posyandu_kelola', $data);
		}
	}

	// ── Endpoint AJAX: Live Stream Tap Radar ─────────────────
	public function posyandu_live_stream()
	{
		header('Content-Type: application/json');
		$sesi_aktif = $this->db->get_where('posyandu_sesi', ['status' => 'Aktif'])->row();

		$recent = $this->db
			->order_by('id', 'DESC')
			->limit(5)
			->get('posyandu_tap_log')
			->result();

		$total_hadir = $sesi_aktif
			? $this->db->where('sesi_id', $sesi_aktif->id)->count_all_results('posyandu_kehadiran')
			: 0;

		// Kehadiran terbaru
		$latest_hadir = null;
		if ($sesi_aktif) {
			$this->db->select('posyandu_kehadiran.*, posyandu_balita.nama_anak, data_warga.nama AS nama_ortu');
			$this->db->from('posyandu_kehadiran');
			$this->db->join('posyandu_balita', 'posyandu_balita.id = posyandu_kehadiran.balita_id');
			$this->db->join('data_warga', 'data_warga.idWarga = posyandu_balita.warga_id', 'left');
			$this->db->where('posyandu_kehadiran.sesi_id', $sesi_aktif->id);
			$this->db->order_by('posyandu_kehadiran.jam_datang', 'DESC');
			$latest_hadir = $this->db->limit(1)->get()->row();
		}

		echo json_encode([
			'has_session'  => !empty($sesi_aktif),
			'sesi_nama'    => $sesi_aktif ? $sesi_aktif->nama_sesi : null,
			'total_hadir'  => $total_hadir,
			'latest_hadir' => $latest_hadir,
			'logs'         => $recent
		]);
		exit;
	}

	// ── Quick Pairing: Hubungkan UID KTP ke Ibu Warga ────────
	public function posyandu_pair_ktp()
	{
		$user = $this->_getUser();
		if ($user['role_id'] == 4) redirect('users/warga');

		$warga_id = $this->input->post('warga_id');
		$uid      = strtoupper(trim($this->input->post('rfid_uid')));

		if (empty($warga_id) || empty($uid)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Pilih warga dan masukkan UID KTP!</div>');
			redirect('smartrt/posyandu');
		}

		// Update di data_warga
		$this->db->where('idWarga', $warga_id)->update('data_warga', ['rfid_ktp' => $uid]);

		// Update status tap log jika ada
		$this->db->where('uid', $uid)->update('posyandu_tap_log', [
			'status'   => 'SUCCESS',
			'warga_id' => $warga_id,
			'keterangan' => 'KTP berhasil dihubungkan ke warga'
		]);

		$warga = $this->db->get_where('data_warga', ['idWarga' => $warga_id])->row();
		$nama_warga = $warga ? $warga->nama : 'Warga';

		$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Berhasil!</strong> e-KTP (' . $uid . ') berhasil dihubungkan dengan <strong>' . htmlspecialchars($nama_warga) . '</strong>.</div>');
		redirect('smartrt/posyandu');
	}

	// ── Manajemen Balita ─────────────────────────────────────

	public function posyandu_balita_tambah()
	{
		$user = $this->_getUser();
		if ($user['role_id'] == 4) redirect('users/warga');

		$insert_data = [
			'warga_id'      => $this->input->post('warga_id'),
			'nama_anak'     => $this->input->post('nama_anak'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'rfid_uid'      => $this->input->post('rfid_uid') ?: null,
		];
		$this->db->insert('posyandu_balita', $insert_data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Balita <strong>' . htmlspecialchars($insert_data['nama_anak']) . '</strong> berhasil didaftarkan!</div>');
		redirect('smartrt/posyandu');
	}

	public function posyandu_balita_bind_rfid($id)
	{
		$user = $this->_getUser();
		if ($user['role_id'] == 4) redirect('users/warga');

		$uid = strtoupper(trim($this->input->post('rfid_uid')));
		$bind_to_ibu = $this->input->post('bind_to_ibu'); // jika checkbox 'Hubungkan juga sebagai KTP Ibu' dicentang

		$balita = $this->db->get_where('posyandu_balita', ['id' => $id])->row();
		if (!$balita) {
			redirect('smartrt/posyandu');
		}

		if (!empty($uid)) {
			$this->db->where('id', $id)->update('posyandu_balita', ['rfid_uid' => $uid]);
			if ($bind_to_ibu && $balita->warga_id) {
				$this->db->where('idWarga', $balita->warga_id)->update('data_warga', ['rfid_ktp' => $uid]);
			}
		} else {
			$this->db->where('id', $id)->update('posyandu_balita', ['rfid_uid' => null]);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success">RFID Balita / KTP Ibu berhasil diperbarui!</div>');
		redirect('smartrt/posyandu');
	}

	public function posyandu_balita_hapus($id)
	{
		$user = $this->_getUser();
		if ($user['role_id'] == 4) redirect('users/warga');

		$this->db->delete('posyandu_kehadiran', ['balita_id' => $id]);
		$this->db->delete('posyandu_balita', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Data balita & riwayat pemeriksaan berhasil dihapus.</div>');
		redirect('smartrt/posyandu');
	}

	// ── Manajemen Sesi ───────────────────────────────────────

	public function posyandu_sesi_tambah()
	{
		$user = $this->_getUser();
		if ($user['role_id'] == 4) redirect('users/warga');

		$insert_data = [
			'nama_sesi'     => $this->input->post('nama_sesi'),
			'tanggal'       => $this->input->post('tanggal'),
			'waktu_mulai'   => $this->input->post('waktu_mulai'),
			'lokasi'        => $this->input->post('lokasi') ?: 'Balai RT',
			'petugas'       => $this->input->post('petugas'),
			'status'        => 'Dijadwalkan',
			'catatan'       => $this->input->post('catatan'),
		];
		$this->db->insert('posyandu_sesi', $insert_data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Sesi Posyandu berhasil dibuat!</div>');
		redirect('smartrt/posyandu');
	}

	public function posyandu_sesi_status($id, $status)
	{
		$user = $this->_getUser();
		if ($user['role_id'] == 4) redirect('users/warga');

		if ($status === 'Aktif') {
			$this->db->where('status', 'Aktif')->update('posyandu_sesi', ['status' => 'Dijadwalkan']);
		}
		$update = ['status' => $status];
		if ($status === 'Selesai') {
			$update['waktu_selesai'] = date('H:i:s');
		}
		$this->db->where('id', $id)->update('posyandu_sesi', $update);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Status sesi berhasil diubah menjadi: <strong>' . $status . '</strong>!</div>');
		redirect('smartrt/posyandu');
	}

	// ── Kehadiran & Pemeriksaan ──────────────────────────────

	public function posyandu_hadir_manual()
	{
		$user = $this->_getUser();
		if ($user['role_id'] == 4) redirect('users/warga');

		$sesi_id   = $this->input->post('sesi_id');
		$balita_id = $this->input->post('balita_id');

		$sudah = $this->db->get_where('posyandu_kehadiran', [
			'sesi_id'   => $sesi_id,
			'balita_id' => $balita_id,
		])->row();

		if ($sudah) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning">Balita ini sudah tercatat hadir di sesi ini.</div>');
			redirect('smartrt/posyandu');
		}

		$insert_data = [
			'sesi_id'        => $sesi_id,
			'balita_id'      => $balita_id,
			'jam_datang'     => date('Y-m-d H:i:s'),
			'berat_badan'    => $this->input->post('berat_badan') ?: null,
			'tinggi_badan'   => $this->input->post('tinggi_badan') ?: null,
			'lingkar_kepala' => $this->input->post('lingkar_kepala') ?: null,
			'lila'           => $this->input->post('lila') ?: null,
			'imunisasi'      => $this->input->post('imunisasi'),
			'vitamin_a'      => $this->input->post('vitamin_a') ?: 'Tidak',
			'obat_cacing'    => $this->input->post('obat_cacing') ?: 'Tidak',
			'status_gizi'    => $this->input->post('status_gizi'),
			'catatan'        => $this->input->post('catatan'),
			'metode_absen'   => 'Manual',
		];
		$this->db->insert('posyandu_kehadiran', $insert_data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Kehadiran & pemeriksaan berhasil dicatat!</div>');
		redirect('smartrt/posyandu');
	}

	public function posyandu_update_pemeriksaan($id)
	{
		$user = $this->_getUser();
		if ($user['role_id'] == 4) redirect('users/warga');

		$update_data = [
			'berat_badan'    => $this->input->post('berat_badan') ?: null,
			'tinggi_badan'   => $this->input->post('tinggi_badan') ?: null,
			'lingkar_kepala' => $this->input->post('lingkar_kepala') ?: null,
			'lila'           => $this->input->post('lila') ?: null,
			'imunisasi'      => $this->input->post('imunisasi'),
			'vitamin_a'      => $this->input->post('vitamin_a') ?: 'Tidak',
			'obat_cacing'    => $this->input->post('obat_cacing') ?: 'Tidak',
			'status_gizi'    => $this->input->post('status_gizi'),
			'catatan'        => $this->input->post('catatan'),
		];
		$this->db->where('id', $id)->update('posyandu_kehadiran', $update_data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Data pemeriksaan tumbuh kembang berhasil disimpan!</div>');
		redirect('smartrt/posyandu');
	}

	// ── Cetak KMS Digital Balita ─────────────────────────────
	public function posyandu_cetak_kms($balita_id)
	{
		$this->db->select('posyandu_balita.*, data_warga.nama AS nama_ortu, data_warga.nik AS nik_ortu, data_warga.alamat, data_warga.no_rumah');
		$this->db->from('posyandu_balita');
		$this->db->join('data_warga', 'data_warga.idWarga = posyandu_balita.warga_id', 'left');
		$this->db->where('posyandu_balita.id', $balita_id);
		$data['balita'] = $this->db->get()->row();

		if (!$data['balita']) {
			redirect('smartrt/posyandu');
		}

		$this->db->select('posyandu_kehadiran.*, posyandu_sesi.nama_sesi, posyandu_sesi.tanggal, posyandu_sesi.petugas');
		$this->db->from('posyandu_kehadiran');
		$this->db->join('posyandu_sesi', 'posyandu_sesi.id = posyandu_kehadiran.sesi_id');
		$this->db->where('posyandu_kehadiran.balita_id', $balita_id);
		$this->db->order_by('posyandu_sesi.tanggal', 'ASC');
		$data['riwayat'] = $this->db->get()->result();

		$this->load->view('smartrt/posyandu_kms_print', $data);
	}

	// ── RFID / e-KTP API Endpoint untuk NodeMCU ESP32 + RC522 ─
	// Mendukung method GET & POST
	// URL: http://IP_SERVER/kasrt/smartrt/posyandu_rfid_tap?api_key=kasrt2025&uid=A1B2C3D4
	public function posyandu_rfid_tap()
	{
		header('Content-Type: application/json');

		$api_key = $this->input->post('api_key') ?: $this->input->get('api_key');
		if ($api_key !== 'kasrt2025') {
			http_response_code(403);
			echo json_encode(['status' => 'error', 'message' => 'API key tidak valid']);
			exit;
		}

		$uid = strtoupper(trim($this->input->post('uid') ?: $this->input->get('uid')));
		if (empty($uid)) {
			http_response_code(400);
			echo json_encode(['status' => 'error', 'message' => 'UID KTP tidak boleh kosong']);
			exit;
		}

		// 1. Cek sesi posyandu yang sedang aktif
		$sesi = $this->db->get_where('posyandu_sesi', ['status' => 'Aktif'])->row();
		if (!$sesi) {
			$this->db->insert('posyandu_tap_log', [
				'uid'        => $uid,
				'status'     => 'NO_ACTIVE_SESSION',
				'keterangan' => 'Tap saat tidak ada sesi posyandu yang aktif'
			]);

			http_response_code(409);
			echo json_encode([
				'status'  => 'no_session',
				'message' => 'Tidak ada sesi posyandu yang sedang aktif.',
				'uid'     => $uid
			]);
			exit;
		}

		// 2. Pencarian Kartu KTP:
		// Prioritas A: Cocokkan ke KTP Ibu Warga (data_warga.rfid_ktp = UID atau NIK = UID)
		$ibu = $this->db->where('rfid_ktp', $uid)->or_where('nik', $uid)->get('data_warga')->row();

		// Prioritas B: Cocokkan ke kartu RFID langsung di posyandu_balita
		$balita_direct = null;
		if (!$ibu) {
			$balita_direct = $this->db->get_where('posyandu_balita', ['rfid_uid' => $uid])->row();
			if ($balita_direct) {
				$ibu = $this->db->get_where('data_warga', ['idWarga' => $balita_direct->warga_id])->row();
			}
		}

		// 3. Jika KTP Belum Terdaftar Sama Sekali
		if (!$ibu && !$balita_direct) {
			$this->db->insert('posyandu_tap_log', [
				'uid'        => $uid,
				'status'     => 'UNREGISTERED',
				'keterangan' => 'KTP belum terhubung ke data warga'
			]);

			http_response_code(404);
			echo json_encode([
				'status'  => 'unregistered',
				'message' => 'KTP belum terdaftar. Silakan hubungkan kartu di dashboard posyandu.',
				'uid'     => $uid
			]);
			exit;
		}

		// 4. Dapatkan daftar balita yang terhubung dengan Ibu ini
		$balita_list = [];
		if ($balita_direct) {
			$balita_list = [$balita_direct];
		} else {
			$balita_list = $this->db->get_where('posyandu_balita', ['warga_id' => $ibu->idWarga])->result();
		}

		// Jika ibu belum punya balita terdaftar di Posyandu
		if (empty($balita_list)) {
			$this->db->insert('posyandu_tap_log', [
				'uid'        => $uid,
				'status'     => 'UNREGISTERED',
				'warga_id'   => $ibu ? $ibu->idWarga : null,
				'keterangan' => 'KTP Ibu ' . ($ibu ? $ibu->nama : '') . ' terdeteksi, tapi belum ada balita terdaftar'
			]);

			echo json_encode([
				'status'   => 'no_child',
				'message'  => 'KTP Ibu ' . ($ibu ? $ibu->nama : '') . ' terdeteksi, namun balita belum didaftarkan di Posyandu.',
				'nama_ibu' => $ibu ? $ibu->nama : '-',
				'uid'      => $uid
			]);
			exit;
		}

		// 5. Proses Absensi Semua Balita Milik Ibu
		$checked_names = [];
		$already_names = [];
		$now = date('Y-m-d H:i:s');

		foreach ($balita_list as $b) {
			$sudah = $this->db->get_where('posyandu_kehadiran', [
				'sesi_id'   => $sesi->id,
				'balita_id' => $b->id,
			])->row();

			if ($sudah) {
				$already_names[] = $b->nama_anak;
			} else {
				$this->db->insert('posyandu_kehadiran', [
					'sesi_id'      => $sesi->id,
					'balita_id'    => $b->id,
					'jam_datang'   => $now,
					'metode_absen' => 'RFID',
					'rfid_uid'     => $uid,
				]);
				$checked_names[] = $b->nama_anak;
			}
		}

		$nama_ibu = $ibu ? $ibu->nama : 'Orang Tua';

		// Jika semua sudah hadir sebelumnya
		if (empty($checked_names)) {
			$this->db->insert('posyandu_tap_log', [
				'uid'        => $uid,
				'status'     => 'ALREADY_CHECKED',
				'warga_id'   => $ibu ? $ibu->idWarga : null,
				'keterangan' => 'Ibu ' . $nama_ibu . ' (' . implode(', ', $already_names) . ') sudah absen sebelumnya'
			]);

			echo json_encode([
				'status'     => 'already_checked',
				'message'    => 'Ibu ' . $nama_ibu . ' dan balita (' . implode(', ', $already_names) . ') sudah tercatat hadir.',
				'nama_ibu'   => $nama_ibu,
				'balita'     => implode(', ', $already_names),
				'sesi'       => $sesi->nama_sesi
			]);
			exit;
		}

		// Berhasil hadir baru
		$this->db->insert('posyandu_tap_log', [
			'uid'        => $uid,
			'status'     => 'SUCCESS',
			'warga_id'   => $ibu ? $ibu->idWarga : null,
			'keterangan' => 'Ibu ' . $nama_ibu . ' tap KTP -> Balita: ' . implode(', ', $checked_names) . ' hadir'
		]);

		echo json_encode([
			'status'     => 'success',
			'message'    => 'Selamat datang Ibu ' . $nama_ibu . '! Kehadiran balita: ' . implode(', ', $checked_names) . ' berhasil dicatat.',
			'nama_ibu'   => $nama_ibu,
			'balita'     => implode(', ', $checked_names),
			'jam_datang' => date('H:i', strtotime($now)),
			'sesi'       => $sesi->nama_sesi
		]);
		exit;
	}

	// Legacy fallback
	public function posyandu_tambah()
	{
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

		$data['menu'] = 'backup';
		$data['judul'] = 'Backup & Sinkronisasi Data';
		$data['user'] = $user;

		// Read saved token from config file
		$token_file = FCPATH . 'database/.gh_token';
		$github_token = file_exists($token_file) ? trim(file_get_contents($token_file)) : '';
		$data['github_token'] = $github_token;
		$data['github_configured'] = !empty($github_token);

		$this->_loadView('backup', $data);
	}

	public function backup_save_token()
	{
		$user = $this->_getUser();
		if ($user['role_id'] == 4)
			redirect('users/warga');

		$token = trim($this->input->post('github_token'));
		if (!empty($token)) {
			$token_dir = FCPATH . 'database/';
			if (!is_dir($token_dir))
				mkdir($token_dir, 0777, true);
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
		if ($user['role_id'] == 4)
			redirect('users/warga');

		$backup_dir = FCPATH . 'database/';
		if (!is_dir($backup_dir))
			mkdir($backup_dir, 0777, true);
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
		if ($user['role_id'] == 4)
			redirect('users/warga');

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
		if ($user['role_id'] == 4)
			redirect('users/warga');

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
		$repo = 'E-KASRT';
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
			if ($item === '.' || $item === '..')
				continue;
			$full_path = $dir . DIRECTORY_SEPARATOR . $item;
			$relative = str_replace([$root, '\\'], ['', '/'], $full_path);
			$relative = ltrim($relative, '/');

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
