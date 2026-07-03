<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_log extends CI_Model
{
    /**
     * Rekam aktivitas user ke log_activity
     */
    public function addLog($action, $module = '', $detail = '')
    {
        $username = $this->session->userdata('username') ?: 'System';
        $role_id  = $this->session->userdata('role_id');

        // Ambil nama role
        $role_map = [1 => 'Superadmin', 2 => 'Ketua RT', 3 => 'Bendahara', 4 => 'Warga'];
        $role     = isset($role_map[$role_id]) ? $role_map[$role_id] : 'Guest';

        $data = [
            'username'   => $username,
            'role'       => $role,
            'action'     => $action,
            'module'     => $module,
            'detail'     => $detail,
            'ip_address' => $this->input->ip_address(),
            'is_read'    => 0,
        ];
        $this->db->insert('log_activity', $data);
    }

    /**
     * Ambil log terbaru
     */
    public function getLogs($limit = 20)
    {
        return $this->db->order_by('created_at', 'DESC')
                        ->limit($limit)
                        ->get('log_activity')
                        ->result();
    }

    /**
     * Jumlah log yang belum dibaca
     */
    public function getUnreadCount()
    {
        return $this->db->where('is_read', 0)->count_all_results('log_activity');
    }

    /**
     * Tandai semua log sebagai sudah dibaca
     */
    public function markAllRead()
    {
        $this->db->where('is_read', 0)->update('log_activity', ['is_read' => 1]);
    }

    /**
     * Hapus log lama (lebih dari N hari)
     */
    public function clearOldLogs($days = 30)
    {
        $this->db->where("created_at < DATE_SUB(NOW(), INTERVAL {$days} DAY)")
                 ->delete('log_activity');
    }
}
