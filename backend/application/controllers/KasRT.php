<?php

defined('BASEPATH') or exit('No direct script access allowed');

class KasRT extends CI_Controller
{
	public function __construct() {
        parent::__construct();
        // Load model M_kas di dalam konstruktor
        $this->load->model('M_kas');
    }
    
	public function index()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		$cekId = $this->m_kas->cekNomor();
		$getId = substr($cekId, 4, 4);
		$idNow = $getId + 1;
		$data = array('idKas' => $idNow);

		if ($username == '') {
			redirect('auth');
		} else {
			if ($user['role_id'] == 4) {
				redirect('users/warga');
			}
			$data['user'] = $user;
			$data['ttl'] = $this->m_kas->TotalMasuk();
			$data['ttl_keluar'] = $this->m_kas->TotalKeluar();
			$data['masuk'] = $this->m_kas->getKasMasuk();
			$data['menu'] = 'Kas Masuk';
			$data['judul'] = 'Kas Masuk';

			// Hitung total akumulasi
			$sum_masuk = 0;
			if (!empty($data['ttl'])) {
				foreach ($data['ttl'] as $t) { $sum_masuk += (float)$t->total; }
			}
			$sum_keluar = 0;
			if (!empty($data['ttl_keluar'])) {
				foreach ($data['ttl_keluar'] as $tk) { $sum_keluar += (float)$tk->total; }
			}
			$data['total_masuk'] = $sum_masuk;
			$data['total_keluar'] = $sum_keluar;
			$data['saldo_kas'] = $sum_masuk - $sum_keluar;

			// Pemasukan bulan ini
			$current_ym = date('Y-m');
			$masuk_bulan_ini = 0;
			$count_bulan_ini = 0;
			if (!empty($data['masuk'])) {
				foreach ($data['masuk'] as $m) {
					if (substr($m->tanggal, 0, 7) == $current_ym) {
						$masuk_bulan_ini += (float)$m->jumlah;
						$count_bulan_ini++;
					}
				}
			}
			$data['masuk_bulan_ini'] = $masuk_bulan_ini;
			$data['count_bulan_ini'] = $count_bulan_ini;
			$data['count_total'] = count($data['masuk']);
			$data['rata_rata'] = $data['count_total'] > 0 ? round($sum_masuk / $data['count_total']) : 0;

			// Visual Analytics Data
			$analytics = $this->_getChartAndCategoryData('masuk');
			$data['chart_labels'] = $analytics['chart_labels'];
			$data['chart_masuk']  = $analytics['chart_masuk'];
			$data['chart_keluar'] = $analytics['chart_keluar'];
			$data['cat_labels']   = $analytics['cat_labels'];
			$data['cat_values']   = $analytics['cat_values'];

			$this->load->view('include/header', $data);
			if ($user['role_id'] == 1) {
				$this->load->view('admin/kasMasuk', $data);
			} else if ($user['role_id'] == 3) {
				$this->load->view('bendahara/kasMasuk', $data);
			} else {
				$this->load->view('rt/kasMasuk', $data);
			}
			$this->load->view('include/footer');
		}
	}

	public function kasKeluar()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		$cekId = $this->m_kas->cekNomor();
		$getId = substr($cekId, 4, 4);
		$idNow = $getId + 1;
		$data = array('idKas' => $idNow);

		if ($username == '') {
			redirect('auth');
		} else {
			if ($user['role_id'] == 4) {
				redirect('users/warga');
			}
			$data['user'] = $user;
			$data['ttl'] = $this->m_kas->TotalKeluar();
			$data['ttl_masuk'] = $this->m_kas->TotalMasuk();
			$data['keluar'] = $this->m_kas->getKasKeluar();
			$data['menu'] = 'Kas Keluar';
			$data['judul'] = 'Kas Keluar';

			// Hitung total akumulasi
			$sum_keluar = 0;
			if (!empty($data['ttl'])) {
				foreach ($data['ttl'] as $t) { $sum_keluar += (float)$t->total; }
			}
			$sum_masuk = 0;
			if (!empty($data['ttl_masuk'])) {
				foreach ($data['ttl_masuk'] as $tm) { $sum_masuk += (float)$tm->total; }
			}
			$data['total_keluar'] = $sum_keluar;
			$data['total_masuk'] = $sum_masuk;
			$data['saldo_kas'] = $sum_masuk - $sum_keluar;

			// Pengeluaran bulan ini
			$current_ym = date('Y-m');
			$keluar_bulan_ini = 0;
			$count_bulan_ini = 0;
			if (!empty($data['keluar'])) {
				foreach ($data['keluar'] as $k) {
					if (substr($k->tanggal, 0, 7) == $current_ym) {
						$keluar_bulan_ini += (float)$k->jumlah;
						$count_bulan_ini++;
					}
				}
			}
			$data['keluar_bulan_ini'] = $keluar_bulan_ini;
			$data['count_bulan_ini'] = $count_bulan_ini;
			$data['count_total'] = count($data['keluar']);
			$data['rata_rata'] = $data['count_total'] > 0 ? round($sum_keluar / $data['count_total']) : 0;

			// Visual Analytics Data
			$analytics = $this->_getChartAndCategoryData('keluar');
			$data['chart_labels'] = $analytics['chart_labels'];
			$data['chart_masuk']  = $analytics['chart_masuk'];
			$data['chart_keluar'] = $analytics['chart_keluar'];
			$data['cat_labels']   = $analytics['cat_labels'];
			$data['cat_values']   = $analytics['cat_values'];

			$this->load->view('include/header', $data);
			if ($user['role_id'] == 1) {
				$this->load->view('admin/kasKeluar', $data);
			} else if ($user['role_id'] == 3) {
				$this->load->view('bendahara/kasKeluar', $data);
			} else {
				$this->load->view('rt/kasKeluar', $data);
			}
			$this->load->view('include/footer');
		}
	}

	public function addKas()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		if (!$user || $user['role_id'] == 4) {
			redirect('users/warga');
		}

		$this->m_kas->cekNomor();
		$jumlah = preg_replace('/[^0-9]/', '', (string)$this->input->post('jumlah'));
		$data = [
			'idKas' => $this->input->post('id_kas'),
			'keterangan' => trim($this->input->post('keterangan')),
			'tanggal' => $this->input->post('tanggal'),
			'jumlah' => $jumlah,
			'jenis' => $this->input->post('jenis'),
		];
		$this->m_kas->saveKas($data);
		if ($this->input->post('jenis') == 'masuk') {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle mr-2"></i>Data kas masuk berhasil ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('kasrt');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle mr-2"></i>Data kas keluar berhasil ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('kasrt/kasKeluar');
		}
	}

	public function editKas()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		if (!$user || $user['role_id'] == 4) {
			redirect('users/warga');
		}

		$idKas = $this->input->post('idKas');
		$jumlah = preg_replace('/[^0-9]/', '', (string)$this->input->post('jumlah'));
		$data = [
			'keterangan' => trim($this->input->post('keterangan')),
			'tanggal' => $this->input->post('tanggal'),
			'jumlah' => $jumlah,
			'jenis' => $this->input->post('jenis'),
		];
		$this->m_kas->updateKas($data, $idKas);
		if ($this->input->post('jenis') == 'masuk') {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle mr-2"></i>Data kas masuk berhasil diupdate!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('kasrt');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle mr-2"></i>Data kas keluar berhasil diupdate!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('kasrt/kasKeluar');
		}
	}

	public function delKas($idKas)
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		if (!$user || $user['role_id'] == 4) {
			redirect('users/warga');
		}

		$kas = $this->db->get_where('data_kas', ['idKas' => $idKas])->row_array();
		$this->m_kas->delKas($idKas);
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle mr-2"></i>Data kas berhasil dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		if ($kas && $kas['jenis'] == 'keluar') {
			redirect('kasrt/kasKeluar');
		} else {
			redirect('kasrt');
		}
	}

	public function kwitansiKas($idKas)
	{
		$username = $this->session->userdata('username');
		if (!$username) {
			redirect('auth');
		}
		$data['user'] = $this->db->get_where('users', ['username' => $username])->row_array();
		$data['kas'] = $this->db->get_where('data_kas', ['idKas' => $idKas])->row_array();
		if (!$data['kas']) {
			show_404();
		}
		$data['judul'] = 'Kwitansi Kas RT #' . $idKas;
		$this->load->view('kas/kwitansi_print', $data);
	}

	public function transfer()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		if ($username == '') {
			redirect('auth');
		}
		if ($user['role_id'] == 4) {
			redirect('users/warga');
		}

		$data['user'] = $user;
		$data['menu'] = 'Transfer';
		$data['judul'] = 'Transfer Kas RT';

		// Data saldo kas
		$data['ttl_masuk'] = $this->m_kas->TotalMasuk();
		$data['ttl_keluar'] = $this->m_kas->TotalKeluar();
		$sum_masuk = 0;
		if (!empty($data['ttl_masuk'])) {
			foreach ($data['ttl_masuk'] as $tm) { $sum_masuk += (float)$tm->total; }
		}
		$sum_keluar = 0;
		if (!empty($data['ttl_keluar'])) {
			foreach ($data['ttl_keluar'] as $tk) { $sum_keluar += (float)$tk->total; }
		}
		$data['total_masuk'] = $sum_masuk;
		$data['total_keluar'] = $sum_keluar;
		$data['saldo_kas'] = $sum_masuk - $sum_keluar;

		// Ambil riwayat transfer kas
		$this->db->like('keterangan', 'Transfer');
		$this->db->order_by('tanggal', 'DESC');
		$this->db->order_by('idKas', 'DESC');
		$data['transfers'] = $this->db->get('data_kas')->result();

		$this->load->view('include/header', $data);
		$this->load->view('kas/transfer', $data);
		$this->load->view('include/footer');
	}

	public function addTransfer()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		if (!$user || $user['role_id'] == 4) {
			redirect('users/warga');
		}

		$sumber = $this->input->post('sumber');
		$tujuan = $this->input->post('tujuan');
		$tanggal = $this->input->post('tanggal') ?: date('Y-m-d');
		$jumlah = preg_replace('/[^0-9]/', '', (string)$this->input->post('jumlah'));
		$keterangan = trim($this->input->post('keterangan'));

		if ($sumber == $tujuan) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show"><i class="fas fa-exclamation-triangle mr-2"></i>Sumber dana dan tujuan transfer tidak boleh sama!<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
			redirect('kasRT/transfer');
			return;
		}

		if ($jumlah <= 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show"><i class="fas fa-exclamation-triangle mr-2"></i>Nominal transfer harus lebih besar dari 0!<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
			redirect('kasRT/transfer');
			return;
		}

		// 1. Catat kas keluar dari akun asal
		$cekId = $this->db->query('SELECT MAX(idKas) AS id_kas FROM data_kas')->row();
		$getId = substr($cekId ? $cekId->id_kas : '30000000', 4, 4);
		$nextId1 = '3000' . sprintf("%04s", (int)$getId + 1);

		$this->db->insert('data_kas', [
			'idKas' => $nextId1,
			'keterangan' => 'Transfer Keluar: [' . $sumber . ' ➔ ' . $tujuan . '] ' . ($keterangan ? '- ' . $keterangan : ''),
			'tanggal' => $tanggal,
			'jumlah' => $jumlah,
			'jenis' => 'keluar'
		]);

		// 2. Catat kas masuk ke akun tujuan
		$nextId2 = '3000' . sprintf("%04s", (int)$getId + 2);
		$this->db->insert('data_kas', [
			'idKas' => $nextId2,
			'keterangan' => 'Transfer Masuk: [' . $tujuan . ' 🠔 ' . $sumber . '] ' . ($keterangan ? '- ' . $keterangan : ''),
			'tanggal' => $tanggal,
			'jumlah' => $jumlah,
			'jenis' => 'masuk'
		]);

		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle mr-2"></i>Transfer dana internal sebesar <strong>Rp ' . number_format($jumlah, 0, ',', '.') . '</strong> berhasil dicatat dan diverifikasi!<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
		redirect('kasRT/transfer');
	}

	private function _getChartAndCategoryData($active_type = 'masuk')
	{
		$months_data = [];
		for ($i = 5; $i >= 0; $i--) {
			$m_ym = date('Y-m', strtotime("-$i months"));
			$m_label = date('M', strtotime("-$i months"));
			$months_data[$m_ym] = [
				'label'  => $m_label,
				'masuk'  => 0,
				'keluar' => 0
			];
		}

		$all_kas = $this->db->get('data_kas')->result();
		$categories = [
			'Iuran Warga'  => 0,
			'Donasi'       => 0,
			'Kas Sampah'   => 0,
			'Perbaikan'    => 0,
			'Keamanan'     => 0,
			'Kebersihan'   => 0,
			'Operasional'  => 0,
			'Lainnya'      => 0
		];

		foreach ($all_kas as $k) {
			$ym = substr($k->tanggal, 0, 7);
			$jml = (float)$k->jumlah;

			if (isset($months_data[$ym])) {
				if ($k->jenis == 'masuk') {
					$months_data[$ym]['masuk'] += $jml;
				} else {
					$months_data[$ym]['keluar'] += $jml;
				}
			}

			if ($k->jenis == $active_type) {
				$ket = strtolower($k->keterangan);
				if (strpos($ket, 'iuran') !== false) {
					$categories['Iuran Warga'] += $jml;
				} else if (strpos($ket, 'donasi') !== false || strpos($ket, 'sumbangan') !== false) {
					$categories['Donasi'] += $jml;
				} else if (strpos($ket, 'sampah') !== false) {
					$categories['Kas Sampah'] += $jml;
				} else if (strpos($ket, 'lampu') !== false || strpos($ket, 'jalan') !== false || strpos($ket, 'perbaikan') !== false) {
					$categories['Perbaikan'] += $jml;
				} else if (strpos($ket, 'hansip') !== false || strpos($ket, 'aman') !== false || strpos($ket, 'ronda') !== false) {
					$categories['Keamanan'] += $jml;
				} else if (strpos($ket, 'bersih') !== false) {
					$categories['Kebersihan'] += $jml;
				} else if (strpos($ket, 'atk') !== false || strpos($ket, 'konsumsi') !== false || strpos($ket, 'printer') !== false) {
					$categories['Operasional'] += $jml;
				} else {
					$categories['Lainnya'] += $jml;
				}
			}
		}

		$active_cat = array_filter($categories, function($v) { return $v > 0; });
		if (empty($active_cat)) {
			$active_cat = ['Umum' => 1];
		}

		return [
			'chart_labels' => array_column(array_values($months_data), 'label'),
			'chart_masuk'  => array_column(array_values($months_data), 'masuk'),
			'chart_keluar' => array_column(array_values($months_data), 'keluar'),
			'cat_labels'   => array_keys($active_cat),
			'cat_values'   => array_values($active_cat)
		];
	}

	public function laporan()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		if ($username == '') {
			redirect('auth');
		} else {
			$data['menu'] = 'Laporan';
			$data['judul'] = 'Laporan Kas RT';
			$data['user'] = $user;
			$data['kas'] = $this->m_kas->getKas();
			$data['masuk'] = $this->m_kas->TotalMasuk();
			$data['keluar'] = $this->m_kas->TotalKeluar();

			if ($user['role_id'] == 1 || $user['role_id'] == 2 || $user['role_id'] == 3) {
				$data['debit'] = $this->m_kas->getKasMasuk();
				$data['kredit'] = $this->m_kas->getKasKeluar();
				$this->load->view('include/header', $data);
				if ($user['role_id'] == 1) {
					$this->load->view('admin/laporan', $data);
				} else if ($user['role_id'] == 3) {
					$this->load->view('bendahara/laporan', $data);
				} else {
					$this->load->view('rt/laporan', $data);
				}
			} else {
				$this->load->view('include/header_warga', $data);
				$this->load->view('warga/laporan', $data);
			}
			$this->load->view('include/footer');
		}
	}

	public function lapKas() {
        $data['judul'] = 'Laporan Data Kas RT002';
        $data['kas'] = $this->M_kas->getKas();
        $data['kredit'] = $this->M_kas->kredit(); 
        $data['masuk'] = $this->M_kas->TotalMasuk();
        $data['keluar'] = $this->M_kas->TotalKeluar();
        $data['konten'] = 'lap_kas';
        $this->load->view('laporan/lap_kas', $data);
    }
}

/* End of file Controllername.php */
