<?php

class MItems extends Model {
	function MItems() {
		parent::Model();
	}
	
	function getItem($id) {
		$data = array();
		$this->db->where('id',id_clean($id));
		$this->db->limit(1);
		$Q = $this->db->get('items');
		if ($Q->num_rows() > 0) {
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}
	
	
	function getAllItems() {
		$data = array();
		$Q = $this->db->get('items');
		if ($Q->num_rows() > 0 ) {
			foreach ($Q->result_array() as $row) {
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}
	
	function addItem() {
		$data = array(
			'name' => db_clean($_POST['name']),
			'description' => db_clean($_POST['description']),
			'location' => db_clean($_POST['location']),
			'category' => db_clean($_POST['category']),
			'serial' => db_clean($_POST['serial']),
			'model' => db_clean($_POST['model']),
			'manufacturer' => db_clean($_POST['manufacturer']),
			'purchaseprice' => db_clean($_POST['purchaseprice']),
			'purchasedate' => db_clean($_POST['purchasedate']),
			'purchaselocation' => db_clean($_POST['purchaselocation']),
			'condition' => db_clean($_POST['condition']),
			'notes' => $_POST['notes'],
			'depreciation' => db_clean($_POST['depreciation']),
			'warrantylength' => db_clean($_POST['warrantylength']),
			'photo' => db_clean($_POST['photo']),
			'status' => db_clean($_POST['status']),
			'statusdate' => now()
		);
		
		$this->db->insert('items', $data);
	}
	
	function updateItem() {
		$data = array(
			'name' => db_clean($_POST['name']),
			'description' => db_clean($_POST['description']),
			'location' => db_clean($_POST['location']),
			'category' => db_clean($_POST['category']),
			'serial' => db_clean($_POST['serial']),
			'model' => db_clean($_POST['model']),
			'manufacturer' => db_clean($_POST['manufacturer']),
			'purchaseprice' => db_clean($_POST['purchaseprice']),
			'purchasedate' => db_clean($_POST['purchasedate']),
			'purchaselocation' => db_clean($_POST['purchaselocation']),
			'condition' => db_clean($_POST['condition']),
			'notes' => $_POST['notes'],
			'depreciation' => db_clean($_POST['depreciation']),
			'warrantylength' => db_clean($_POST['warrantylength']),
			'photo' => db_clean($_POST['photo']),
			'status' => db_clean($_POST['status']),
			'statusdate' => now()
		);
		
		$this->db->where('id', id_clean($_POST['id']));
		$this->db->update('items', $data);
	}
	
	function deleteItem($id) {
		$data = array('status' => 'inactive');
		$this->db->where('id', id_clean($id));
		$this->db->update('items', $data);
	}
}