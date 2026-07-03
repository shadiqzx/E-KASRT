<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warga extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_kas');
		if (!$this->session->userdata('username')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		if ($username == '') {
			redirect('auth');
		} else {
			$data['menu'] = 'warga';
			$data['judul'] = 'Data Warga';
			$data['user'] = $user;
			$data['warga'] = $this->m_kas->getWarga();

			if ($user['role_id'] == 1 || $user['role_id'] == 2 || $user['role_id'] == 3) {
				$this->load->view('include/header', $data);
				if ($user['role_id'] == 1) {
					$this->load->view('admin/warga', $data);
				} else if ($user['role_id'] == 3) {
					$this->load->view('bendahara/warga', $data);
				} else {
					$this->load->view('rt/warga', $data);
				}
			} else {
				$this->load->view('include/header_warga', $data);
				$this->load->view('warga/warga', $data);
			}
			$this->load->view('include/footer');
		}
	}

	public function addWarga()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		if (!$user || ($user['role_id'] != 1 && $user['role_id'] != 2)) {
			if ($user['role_id'] == 3) {
				redirect('users/bendahara');
			} else {
				redirect('users/warga');
			}
		}

		$data = [
			'nik' => $this->input->post('nik'),
			'no_kk' => $this->input->post('no_kk'),
			'nama' => $this->input->post('nama'),
			'jekel' => $this->input->post('jekel'),
			'hubungan_keluarga' => $this->input->post('hubungan_keluarga'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'alamat' => $this->input->post('alamat'),
			'no_rumah' => $this->input->post('no_rumah'),
		];
		$this->m_kas->saveWarga($data);
		$this->m_log->addLog('Tambah data warga: ' . $data['nama'], 'Data Warga', 'NIK: ' . $data['nik'] . ' | Rumah: ' . $data['no_rumah']);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
		redirect('warga');
	}

	public function editWarga()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		if (!$user || ($user['role_id'] != 1 && $user['role_id'] != 2)) {
			if ($user['role_id'] == 3) {
				redirect('users/bendahara');
			} else {
				redirect('users/warga');
			}
		}

		$idWarga = $this->input->post('idWarga');
		$data = [
			'nik' => $this->input->post('nik'),
			'no_kk' => $this->input->post('no_kk'),
			'nama' => $this->input->post('nama'),
			'jekel' => $this->input->post('jekel'),
			'hubungan_keluarga' => $this->input->post('hubungan_keluarga'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'alamat' => $this->input->post('alamat'),
			'no_rumah' => $this->input->post('no_rumah'),
		];
		$this->m_kas->updateWarga($data, $idWarga);
		$this->m_log->addLog('Edit data warga: ' . $data['nama'], 'Data Warga', 'ID: ' . $idWarga . ' | Rumah: ' . $data['no_rumah']);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>');
		redirect('warga');
	}

	public function delWarga($idWarga)
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		if (!$user || ($user['role_id'] != 1 && $user['role_id'] != 2)) {
			if ($user['role_id'] == 3) {
				redirect('users/bendahara');
			} else {
				redirect('users/warga');
			}
		}

		$this->m_kas->delWarga($idWarga);
		$this->m_log->addLog('Hapus data warga ID: ' . $idWarga, 'Data Warga', 'ID dihapus: ' . $idWarga);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
		redirect('warga');
	}

	public function lapWarga()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		if (!$user || $user['role_id'] == 4) {
			redirect('users/warga');
		}

		$data['judul'] = 'Laporan Data Warga';
		$data['query'] = $this->m_kas->getWarga();
		$data['konten'] = 'lap_warga';
		$this->load->view('laporan/lap_warga', $data);
	}
}

/* End of file Controllername.php */
