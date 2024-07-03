<?php

class Bills extends Controller {
	function Bills() {
		parent::Controller();
		session_start();
		
		if(isset($_SESSION['userid'])) {
			if($_SESSION['userid'] < 1) {
				redirect('main/verify','refresh');
			}	
		} else {
			redirect('main/verify','refresh');
		}

		
		$this->tinyMce = '
		<!-- TinyMCE -->
		<script type="text/javascript" src="'.base_url().'assets/js/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript">
		tinyMCE.init({
			// General options
			mode : "textareas",
			theme : "simple"
		});
		</script>
		<!-- /TinyMCE -->
		';
	}
	
	function index() {
		$data['title'] = "Manage Bills";
		$data['main'] = 'main_bills_home';
		$data['bills'] = $this->MBills->getActiveBills('active',$_SESSION['userid']);
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	function create() {
		if ($this->input->post('name')) {
			$this->MBills->addBill();
			$this->session->set_flashdata('message', 'Bill created');
			redirect('bills', 'refresh');
		} else {
			$data['title'] = "Create Bill";
			$data['main'] = 'main_bills_create';
			$this->load->vars($data);
			$this->load->view('template');
		}
	}
	
	function edit($id=0) {
		if ($this->input->post('name')) {
			$this->MBills->updateBill();
			$this->session->set_flashdata('message','Bill updated');
			redirect('bills', 'refresh');
		} else {
			$data['title'] = "Edit Bill";
			$data['main'] = 'main_bills_edit';
			$data['bill'] = $this->MBills->getBill($id);
			if (!count($data['bill'])) {
				redirect('dashboard/index','refresh');
			}
			$this->load->vars($data);
			$this->load->view('template');
		}
	}
	
	function delete($id) {
		$this->MBills->deleteBill($id);
		$this->session->set_flashdata('message','Bill deleted');
		redirect('bills', 'refresh');
	}
}