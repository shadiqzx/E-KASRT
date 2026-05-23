<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // Load model yang diperlukan
        $this->load->model('m_kas');
        $this->load->model('m_auth');
        
        // Cek login secara global di constructor agar lebih aman
        if (!$this->session->userdata('username')) {
            // redirect('auth');
            $this->session->set_userdata('username', 'admin');
        }
    }

    public function index()
    {
        $username = $this->session->userdata('username');
        $user = $this->db->get_where('users', ['username' => $username])->row_array();

        if ($user['role_id'] == 1) {
            $data['menu'] = 'home';
            $data['judul'] = 'Admin Panel';
            $data['user'] = $user;
            $data['masuk'] = $this->m_kas->TotalMasuk();
            $data['keluar'] = $this->m_kas->TotalKeluar();
            $data['total_warga'] = $this->m_kas->TotalWarga();
            $data['recent_kas'] = $this->m_kas->getRecentKas(5);
            $this->load->view('include/header', $data);
            $this->load->view('index', $data);
            $this->load->view('include/footer');
        } else if ($user['role_id'] == 3) {
            redirect('users/bendahara');
        } else if ($user['role_id'] == 2) {
            redirect('users');
        } else {
            redirect('users/warga');
        }
    }

    public function user()
    {
        $username = $this->session->userdata('username');
        $user = $this->db->get_where('users', ['username' => $username])->row_array();

        if ($user['role_id'] == 1) {
            $data['menu'] = 'akses';
            $data['judul'] = 'Hak Akses';
            $data['user'] = $user;
            $data['auth'] = $this->m_auth->getUser();
            $data['role'] = $this->db->get('user_role')->result();
            $this->load->view('include/header', $data);
            $this->load->view('admin/user', $data);
            $this->load->view('include/footer');
        } else if ($user['role_id'] == 3) {
            redirect('users/bendahara');
        } else if ($user['role_id'] == 2) {
            redirect('users');
        } else {
            redirect('users/warga');
        }
    }

    public function import_csv()
    {
        if (isset($_FILES["file_csv"]["name"]) && $_FILES["file_csv"]["name"] != "") {
            $path = $_FILES["file_csv"]["tmp_name"];
            $handle = fopen($path, "r");

            // Deteksi separator (; atau ,)
            $firstLine = fgets($handle);
            $separator = (strpos($firstLine, ';') !== false) ? ';' : ',';
            rewind($handle);

            // Lewati baris header
            fgetcsv($handle, 1000, $separator);

            $data_import = [];
            while (($row = fgetcsv($handle, 1000, $separator)) !== FALSE) {
                // Pastikan kolom NIK, Nama, dan Jekel ada
                if (isset($row[0]) && isset($row[1]) && isset($row[2])) {
                    $data_import[] = [
                        'nik'           => $row[0],
                        'nama'          => $row[1],
                        'jekel'         => $row[2],
                        'tempat_lahir'  => $row[3],
                        'tanggal_lahir' => $row[4],
                        'alamat'        => $row[5]
                    ];
                }
            }
            fclose($handle);

            if (!empty($data_import)) {
                // Memanggil fungsi di m_kas.php yang mengarah ke tabel data_warga
                $this->m_kas->insert_batch_warga($data_import);
                $this->session->set_flashdata('success', 'Data berhasil diimport!');
            } else {
                $this->session->set_flashdata('error', 'File CSV kosong atau format salah.');
            }
        }
        redirect('admin/user');
    }
}