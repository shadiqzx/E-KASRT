<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
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

		if ($user['role_id'] != 2 && $user['role_id'] != 1) {
			if ($user['role_id'] == 3) {
				redirect('users/bendahara');
			} else {
				redirect('users/warga');
			}
		}

		$data['menu'] = 'Akses';
		$data['judul'] = 'RT Panel';
		$data['user'] = $user;
		$data['masuk'] = $this->m_kas->TotalMasuk();
		$data['keluar'] = $this->m_kas->TotalKeluar();
		$data['total_warga'] = $this->m_kas->TotalWarga();
		$data['recent_kas'] = $this->m_kas->getRecentKas(5);
		$this->load->view('include/header', $data);
		$this->load->view('index', $data);
		$this->load->view('include/footer');
	}

	public function bendahara()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		if ($user['role_id'] != 3 && $user['role_id'] != 1) {
			if ($user['role_id'] == 2) {
				redirect('users');
			} else {
				redirect('users/warga');
			}
		}

		$data['menu'] = 'Akses';
		$data['judul'] = 'Bendahara Panel';
		$data['user'] = $user;
		$data['masuk'] = $this->m_kas->TotalMasuk();
		$data['keluar'] = $this->m_kas->TotalKeluar();
		$data['total_warga'] = $this->m_kas->TotalWarga();
		$data['recent_kas'] = $this->m_kas->getRecentKas(5);
		$this->load->view('include/header', $data);
		$this->load->view('index', $data);
		$this->load->view('include/footer');
	}

	public function warga()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		if ($user['role_id'] != 4 && $user['role_id'] != 1) {
			if ($user['role_id'] == 2) {
				redirect('users');
			} else {
				redirect('users/bendahara');
			}
		}

		$data['menu'] = 'Akses';
		$data['judul'] = 'Warga Panel';
		$data['user'] = $user;
		$data['masuk'] = $this->m_kas->TotalMasuk();
		$data['keluar'] = $this->m_kas->TotalKeluar();
		$data['total_warga'] = $this->m_kas->TotalWarga();
		$data['recent_kas'] = $this->m_kas->getRecentKas(5);
		$this->load->view('include/header_warga', $data);
		$this->load->view('index', $data);
		$this->load->view('include/footer');
	}
}

/* End of file Controllername.php */
