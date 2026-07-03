<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * RtController — Mengelola data Pengurus RT dan Profil/Info RT
 * Akses: Superadmin (1) dan Ketua RT (2) untuk edit/hapus
 *        Bendahara (3) hanya bisa lihat
 *        Warga (4) hanya bisa lihat (view publik)
 */
class RtController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_log');
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
    }

    private function _getUser()
    {
        $username = $this->session->userdata('username');
        return $this->db->get_where('users', ['username' => $username])->row_array();
    }

    private function _loadView($view, $data)
    {
        $user = $this->_getUser();
        $data['user'] = $user;
        if ($user['role_id'] == 4) {
            $this->load->view('include/header_warga', $data);
        } else {
            $this->load->view('include/header', $data);
        }
        $this->load->view($view, $data);
        $this->load->view('include/footer');
    }

    // ===== PENGURUS RT =====

    public function pengurus()
    {
        $user = $this->_getUser();
        $data['judul']   = 'Pengurus RT';
        $data['menu']    = 'pengurus';
        $data['pengurus_list'] = $this->db->order_by('id', 'ASC')->get('pengurus_rt')->result();
        $this->_loadView('rt/pengurus_rt', $data);
    }

    public function pengurus_tambah()
    {
        $user = $this->_getUser();
        if (!in_array($user['role_id'], [1, 2])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Anda tidak memiliki hak akses.</div>');
            redirect('rtcontroller/pengurus');
            return;
        }

        $config['upload_path']   = './frontend/assets/profil/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 2048;
        $this->load->library('upload', $config);

        $foto = 'avatar.png';
        if (isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != '') {
            if ($this->upload->do_upload('foto')) {
                $foto = $this->upload->data('file_name');
            }
        }

        $data = [
            'nama'             => $this->input->post('nama'),
            'jabatan'          => $this->input->post('jabatan'),
            'no_hp'            => $this->input->post('no_hp'),
            'email'            => $this->input->post('email'),
            'alamat'           => $this->input->post('alamat'),
            'periode_mulai'    => $this->input->post('periode_mulai'),
            'periode_selesai'  => $this->input->post('periode_selesai'),
            'status_aktif'     => $this->input->post('status_aktif'),
            'foto'             => $foto,
        ];
        $this->db->insert('pengurus_rt', $data);
        $this->m_log->addLog('Tambah Pengurus RT', 'Pengurus', 'Jabatan: ' . $data['jabatan'] . ' | Nama: ' . $data['nama']);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Pengurus RT berhasil ditambahkan!</div>');
        redirect('rtcontroller/pengurus');
    }

    public function pengurus_edit()
    {
        $user = $this->_getUser();
        if (!in_array($user['role_id'], [1, 2])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Anda tidak memiliki hak akses.</div>');
            redirect('rtcontroller/pengurus');
            return;
        }

        $id = $this->input->post('id');
        $existing = $this->db->get_where('pengurus_rt', ['id' => $id])->row_array();

        $config['upload_path']   = './frontend/assets/profil/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 2048;
        $this->load->library('upload', $config);

        $foto = $existing['foto'];
        if (isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != '') {
            if ($this->upload->do_upload('foto')) {
                $foto = $this->upload->data('file_name');
            }
        }

        $data = [
            'nama'            => $this->input->post('nama'),
            'jabatan'         => $this->input->post('jabatan'),
            'no_hp'           => $this->input->post('no_hp'),
            'email'           => $this->input->post('email'),
            'alamat'          => $this->input->post('alamat'),
            'periode_mulai'   => $this->input->post('periode_mulai'),
            'periode_selesai' => $this->input->post('periode_selesai'),
            'status_aktif'    => $this->input->post('status_aktif'),
            'foto'            => $foto,
        ];
        $this->db->where('id', $id)->update('pengurus_rt', $data);
        $this->m_log->addLog('Edit Pengurus RT', 'Pengurus', 'ID: ' . $id . ' | Jabatan: ' . $data['jabatan']);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data pengurus berhasil diperbarui!</div>');
        redirect('rtcontroller/pengurus');
    }

    public function pengurus_hapus($id)
    {
        $user = $this->_getUser();
        if (!in_array($user['role_id'], [1, 2])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Anda tidak memiliki hak akses.</div>');
            redirect('rtcontroller/pengurus');
            return;
        }
        $p = $this->db->get_where('pengurus_rt', ['id' => $id])->row_array();
        $this->db->delete('pengurus_rt', ['id' => $id]);
        $this->m_log->addLog('Hapus Pengurus RT', 'Pengurus', 'Nama: ' . ($p ? $p['nama'] : 'Unknown'));
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data pengurus berhasil dihapus!</div>');
        redirect('rtcontroller/pengurus');
    }

    // ===== DATA RT =====

    public function datart()
    {
        $data['judul'] = 'Profil & Data RT';
        $data['menu']  = 'datart';
        $data['rt_info'] = $this->db->get('data_rt')->row_array();
        if (!$data['rt_info']) {
            // Create default record if not exists
            $this->db->insert('data_rt', ['rt_number' => '01', 'rw_number' => '05']);
            $data['rt_info'] = $this->db->get('data_rt')->row_array();
        }
        $data['total_warga']    = $this->db->count_all('data_warga');
        $data['total_pengurus'] = $this->db->count_all('pengurus_rt');

        // Count unique KK using a single clean query
        $kk_row = $this->db->query("SELECT COUNT(DISTINCT no_kk) as total_kk FROM data_warga")->row();
        $data['total_kk'] = $kk_row ? (int)$kk_row->total_kk : 0;

        $this->_loadView('rt/data_rt', $data);
    }


    public function datart_update()
    {
        $user = $this->_getUser();
        if (!in_array($user['role_id'], [1, 2])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Anda tidak memiliki hak akses untuk mengubah data RT.</div>');
            redirect('rtcontroller/datart');
            return;
        }

        $rt_info = $this->db->get('data_rt')->row_array();
        $data = [
            'rt_number'    => $this->input->post('rt_number'),
            'rw_number'    => $this->input->post('rw_number'),
            'kelurahan'    => $this->input->post('kelurahan'),
            'kecamatan'    => $this->input->post('kecamatan'),
            'kota'         => $this->input->post('kota'),
            'provinsi'     => $this->input->post('provinsi'),
            'kode_pos'     => $this->input->post('kode_pos'),
            'luas_wilayah' => $this->input->post('luas_wilayah'),
            'jumlah_kk'    => $this->input->post('jumlah_kk'),
            'visi'         => $this->input->post('visi'),
            'misi'         => $this->input->post('misi'),
            'sejarah'      => $this->input->post('sejarah'),
        ];

        if ($rt_info) {
            $this->db->where('id', $rt_info['id'])->update('data_rt', $data);
        } else {
            $this->db->insert('data_rt', $data);
        }

        $this->m_log->addLog('Update Profil RT', 'Data RT', 'RT ' . $data['rt_number'] . ' RW ' . $data['rw_number']);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Profil RT berhasil diperbarui!</div>');
        redirect('rtcontroller/datart');
    }
}
