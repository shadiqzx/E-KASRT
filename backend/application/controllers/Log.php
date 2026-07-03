<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_log');
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
    }

    /**
     * JSON endpoint: ambil log terbaru + jumlah unread
     * GET /log/getNotif
     */
    public function getNotif()
    {
        $logs  = $this->m_log->getLogs(15);
        $count = $this->m_log->getUnreadCount();

        $items = [];
        foreach ($logs as $log) {
            $items[] = [
                'id'         => $log->id,
                'username'   => $log->username,
                'role'       => $log->role,
                'action'     => $log->action,
                'module'     => $log->module,
                'detail'     => $log->detail,
                'ip_address' => $log->ip_address,
                'created_at' => $log->created_at,
                'is_read'    => $log->is_read,
                'time_ago'   => $this->_timeAgo($log->created_at),
            ];
        }

        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode(['unread' => $count, 'logs' => $items]));
    }

    /**
     * Tandai semua notifikasi sebagai sudah dibaca
     * POST /log/markRead
     */
    public function markRead()
    {
        $role_id = $this->session->userdata('role_id');
        if ($role_id == 1 || $role_id == 2) {
            $this->m_log->markAllRead();
        }
        $this->output->set_content_type('application/json')
                     ->set_output(json_encode(['status' => 'ok']));
    }

    /**
     * Halaman penuh log activity (admin only)
     * GET /log/all
     */
    public function all()
    {
        $role_id = $this->session->userdata('role_id');
        if ($role_id != 1 && $role_id != 2) {
            if ($role_id == 3) {
                redirect('users/bendahara');
            } else {
                redirect('users/warga');
            }
        }
        $this->load->model('m_kas');
        $user  = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $logs  = $this->m_log->getLogs(200);
        $data  = [
            'judul' => 'Log Aktivitas',
            'menu'  => 'log',
            'user'  => $user,
            'logs'  => $logs,
        ];
        $this->load->view('include/header', $data);
        $this->load->view('admin/log_activity', $data);
        $this->load->view('include/footer');
    }

    /**
     * Helper: konversi waktu ke "X menit lalu"
     */
    private function _timeAgo($datetime)
    {
        $now   = new DateTime();
        $ago   = new DateTime($datetime);
        $diff  = $now->getTimestamp() - $ago->getTimestamp();

        if ($diff < 60)             return $diff . ' detik lalu';
        if ($diff < 3600)           return floor($diff / 60) . ' menit lalu';
        if ($diff < 86400)          return floor($diff / 3600) . ' jam lalu';
        if ($diff < 604800)         return floor($diff / 86400) . ' hari lalu';
        return date('d M Y H:i', strtotime($datetime));
    }
}
