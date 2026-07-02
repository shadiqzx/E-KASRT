<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warga extends CI_Controller
{

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
		if (!$user || $user['role_id'] == 4) {
			redirect('users/warga');
		}

		$data = [
			'nik' => $this->input->post('nik'),
			'nama' => $this->input->post('nama'),
			'jekel' => $this->input->post('jekel'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'alamat' => $this->input->post('alamat'),
		];
		$this->m_kas->saveWarga($data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
		redirect('warga');
	}

	public function editWarga()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		if (!$user || $user['role_id'] == 4) {
			redirect('users/warga');
		}

		$idWarga = $this->input->post('idWarga');
		$data = [
			'nik' => $this->input->post('nik'),
			'nama' => $this->input->post('nama'),
			'jekel' => $this->input->post('jekel'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'alamat' => $this->input->post('alamat'),
		];
		$this->m_kas->updateWarga($data, $idWarga);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
		redirect('warga');
	}

	public function delWarga($idWarga)
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		if (!$user || $user['role_id'] == 4) {
			redirect('users/warga');
		}

		$this->m_kas->delWarga($idWarga);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
		redirect('warga');
	}

	public function lapWarga()
	{
		$data['judul'] = 'Laporan Data Warga';
		$data['query'] = $this->m_kas->getWarga();
		$data['konten'] = 'lap_warga';
		$this->load->view('laporan/lap_warga', $data);
	}
}

/* End of file Controllername.php */
