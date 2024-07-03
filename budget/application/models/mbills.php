<?php

class MBills extends Model {
	function MBills() {
		parent::Model();
	}
	
	
	function getBill($id) {
		$data = array();
		$this->db->where('bills_id',id_clean($id));
		$this->db->limit(1);
		$Q = $this->db->get('budget_bills');
		if ($Q->num_rows() > 0) {
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}
	
	function getActiveBills($status,$user) {
		$data = array();
		$this->db->where('status', $status);
		$this->db->where('user_id', id_clean($user));
		$Q = $this->db->get('budget_bills');
		if ($Q->num_rows() > 0 ) {
			foreach ($Q->result_array() as $row) {
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	
	function getAllBills() {
		$data = array();
		$Q = $this->db->get('budget_bills');
		if ($Q->num_rows() > 0 ) {
			foreach ($Q->result_array() as $row) {
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	
	function addBill() {
		$data = array(
			'user_id' => $_SESSION['userid'],
			'name' => db_clean($_POST['name']),
			'description' => db_clean($_POST['description']),
			'amount' => db_clean($_POST['amount']),
			'date' => $_POST['date']
		);
		
		$this->db->insert('budget_bills', $data);
	}
	
	function updateBill() {
		$data = array(
			'name' => db_clean($_POST['name']),
			'description' => db_clean($_POST['description']),
			'amount' => db_clean($_POST['amount']),
			'date' => $_POST['date']
		);
		
		$this->db->where('bills_id', id_clean($_POST['id']));
		$this->db->update('budget_bills', $data);
	}
	
	function deleteBill($id) {
		$data = array('status' => 'inactive');
		$this->db->where('bills_id', id_clean($id));
		$this->db->update('budget_bills', $data);
	}
}