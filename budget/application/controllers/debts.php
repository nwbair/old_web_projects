<?php

class Debts extends Controller {
	function Debts() {
		parent::Controller();
		session_start();
		
		if(isset($_SESSION['userid'])) {
			if($_SESSION['userid'] < 1) {
				redirect('main/verify','refresh');
			}	
		} else {
			redirect('main/verify','refresh');
		}
	}
	
	function index() {
		$data['title'] = "Manage Debts";
		$data['main'] = 'main_debts_home';
		$data['debts'] = $this->MDebts->getActiveDebts('active',$_SESSION['userid']);
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	function create() {
		if ($this->input->post('name')) {
			$this->MDebts->addDebt();
			$this->session->set_flashdata('message', 'Debt created');
			redirect('debts', 'refresh');
		} else {
			$data['title'] = "Create Debt";
			$data['main'] = 'main_debts_create';
			$this->load->vars($data);
			$this->load->view('template');
		}
	}
	
	function edit($id=0) {
		if ($this->input->post('name')) {
			$this->MDebts->updateDebt();
			$this->session->set_flashdata('message','Debt updated');
			redirect('debts', 'refresh');
		} else {
			$data['title'] = "Edit Debt";
			$data['main'] = 'main_debts_edit';
			$data['debt'] = $this->MDebts->getDebt($id);
			if (!count($data['debt'])) {
				redirect('dashboard/index','refresh');
			}
			$this->load->vars($data);
			$this->load->view('template');
		}
	}
	
	function delete($id) {
		$this->MDebts->deleteDebt($id);
		$this->session->set_flashdata('message','Debt deleted');
		redirect('debts', 'refresh');
	}
}