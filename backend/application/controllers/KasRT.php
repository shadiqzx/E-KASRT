<?php

defined('BASEPATH') or exit('No direct script access allowed');

class KasRT extends CI_Controller
{
	public function __construct() {
        parent::__construct();
        // Load model m_kas di dalam konstruktor
        $this->load->model('m_kas');
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
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
			$data['masuk'] = $this->m_kas->getKasMasuk();
			$data['menu'] = 'Kas Masuk';
			$data['judul'] = 'Kas Masuk';

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
			$data['keluar'] = $this->m_kas->getKasKeluar();
			$data['menu'] = 'Kas Keluar';
			$data['judul'] = 'Kas Keluar';

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
		$data = [
			'idKas' => $this->input->post('id_kas'),
			'keterangan' => $this->input->post('keterangan'),
			'tanggal' => $this->input->post('tanggal'),
			'jumlah' => $this->input->post('jumlah'),
			'jenis' => $this->input->post('jenis'),
		];
		$this->m_kas->saveKas($data);
		if ($this->input->post('jenis') == 'masuk') {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
			redirect('kasrt');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
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
		$data = [
			'keterangan' => $this->input->post('keterangan'),
			'tanggal' => $this->input->post('tanggal'),
			'jumlah' => $this->input->post('jumlah'),
			'jenis' => $this->input->post('jenis'),
		];
		$this->m_kas->updateKas($data, $idKas);
		if ($this->input->post('jenis') == 'masuk') {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
			redirect('kasrt');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
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

		$this->m_kas->delKas($idKas);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
		redirect('kasrt');
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
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		if ($user['role_id'] == 4) {
			redirect('users/warga');
		}
        $data['judul'] = 'Laporan Data Kas RT002';
        $data['kas'] = $this->m_kas->getKas();
        $data['kredit'] = $this->m_kas->kredit(); 
        $data['masuk'] = $this->m_kas->TotalMasuk();
        $data['keluar'] = $this->m_kas->TotalKeluar();
        $data['konten'] = 'lap_kas';
        $this->load->view('laporan/lap_kas', $data);
    }
}

/* End of file Controllername.php */
