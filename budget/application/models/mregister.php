<?php

class MRegister extends Model {
	function MRegister() {
		parent::Model();		
	}
	
	function getUser($key) {
		$data = array();
		$options = array('key' => $key);
		$Q = $this->db->getwhere('register', $options, 1);
		if ($Q->num_rows() > 0) {
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}
	
	function getAllUsers() {
		$data = array();
		$Q = $this->db->get('register');
		if ($Q->num_rows() > 0) {
			foreach ($Q->result_array() as $row) {
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}

	function addUser($key) {
		$data = array('username' => db_clean($_POST['username'],16),
			'email' => db_clean($_POST['email'],255),
			//@TODO DELETE 'password' => db_clean(dohash($_POST['password']),16),
			'key' => $key
		);
			$this->db->insert('register', $data);
	}
	
	function deleteUser($id) {
		$this->db->where('register_id', db_clean($id));
		$this->db->delete('register');
	}
}