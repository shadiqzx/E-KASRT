<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

	public function getUser($id = '')
	{
		$this->db->select('a.*, b.role')
				->from('users a')
				->join('user_role b', 'b.id = a.role_id', 'inner');
		if ($id) {
			$this->db->where('a.user_id', $id);
			return $this->db->get()->row_array();
		} else {
			return $this->db->get()->result();
		}
	}

	public function save($data)
	{
		return $this->db->insert('users', $data);
	}

	public function update($data, $id)
	{
		return $this->db->update('users', $data, ['user_id' => $id]);
	}

	public function delete($id)
	{
		return $this->db->delete('users', ['user_id' => $id]);
	}

}

/* End of file M_auth.php */
