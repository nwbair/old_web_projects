<?php

class MIncome extends Model {
	function MIncome() {
		parent::Model();
	}
	
	
	function getIncome($id) {
		$data = array();
		$this->db->where('income_id',id_clean($id));
		$this->db->limit(1);
		$Q = $this->db->get('budget_income');
		if ($Q->num_rows() > 0) {
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}
	
	function getActiveIncome($status,$user) {
		$data = array();
		$this->db->where('status', $status);
		$this->db->where('user_id', id_clean($user));
		$Q = $this->db->get('budget_income');
		if ($Q->num_rows() > 0 ) {
			foreach ($Q->result_array() as $row) {
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	
	function getAllIncome() {
		$data = array();
		$Q = $this->db->get('budget_income');
		if ($Q->num_rows() > 0 ) {
			foreach ($Q->result_array() as $row) {
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	
	function addIncome() {
		$data = array(
			'user_id' => $_SESSION['userid'],
			'name' => db_clean($_POST['name']),
			'description' => db_clean($_POST['description']),
			'amount' => db_clean($_POST['amount']),
			'date' => $_POST['date']
		);
		
		$this->db->insert('budget_income', $data);
	}
	
	function updateIncome() {
		$data = array(
			'name' => db_clean($_POST['name']),
			'description' => db_clean($_POST['description']),
			'amount' => db_clean($_POST['amount']),
			'date' => $_POST['date']
		);
		
		$this->db->where('income_id', id_clean($_POST['id']));
		$this->db->update('budget_income', $data);
	}
	
	function deleteIncome($id) {
		$data = array('status' => 'inactive');
		$this->db->where('income_id', id_clean($id));
		$this->db->update('budget_income', $data);
	}
}