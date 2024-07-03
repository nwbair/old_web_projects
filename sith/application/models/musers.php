<?php

class MUsers extends Model {
	function MUsers() {
		parent::Model();		
	}


	function verifyUser($u,$pw) {
		$this->db->select('id,username,userlevel');
		$this->db->where('username', db_clean($u,16));
		$this->db->where('password', db_clean(dohash($pw),16));
		$this->db->where('status', 'active');
		$this->db->limit(1);
		$Q = $this->db->get('users');
		if ($Q->num_rows() > 0) {
			$row = $Q->row_array();
			$_SESSION['userid'] = $row['id'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['userlevel'] = $row['userlevel'];
			$_SESSION['loginkey'] = md5($row['id'] . $row['username'] . $row['userlevel']); 
		} else {
			$this->session->set_flashdata('error', 'Sorry, your username or password
				is incorrect!');
		}
	}
	
	function getUser($id) {
		$data = array();
		$options = array('id' => id_clean($id));
		$Q = $this->db->getwhere('users', $options, 1);
		if ($Q->num_rows() > 0) {
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}
	
	function getAllUsers() {
		$data = array();
		$Q = $this->db->get('users');
		if ($Q->num_rows() > 0) {
			foreach ($Q->result_array() as $row) {
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}

	function addUser() {
		$data = array('username' => db_clean($_POST['username'],16),
			'email' => db_clean($_POST['email'],255),
			'status' => db_clean($_POST['status'],8),
			'password' => db_clean(dohash($_POST['password']),16)
		);
			$this->db->insert('users', $data);
	}
		
	function updateUser() {
		$data = array('username' => db_clean($_POST['username'],16),
			'email' => db_clean($_POST['email'],255),
			'status' => db_clean($_POST['status'],8),
			'password' => db_clean(dohash($_POST['password']),16)
		);
			$this->db->where('id',id_clean($_POST['id']));
			$this->db->update('users', $data);
	}
	
	function deleteUser($id) {
		$data = array('status' => 'inactive');
		$this->db->where('id', id_clean($id));
		$this->db->update('users', $data);
	}
}