<?php

class Income extends Controller {
	function Income() {
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
		$data['title'] = "Manage Income";
		$data['main'] = 'main_income_home';
		$data['income'] = $this->MIncome->getActiveIncome('active',$_SESSION['userid']);
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	function create() {
		if ($this->input->post('name')) {
			$this->MIncome->addIncome();
			$this->session->set_flashdata('message', 'Income created');
			redirect('income', 'refresh');
		} else {
			$data['title'] = "Create Income";
			$data['main'] = 'main_income_create';
			$this->load->vars($data);
			$this->load->view('template');
		}
	}
	
	function edit($id=0) {
		if ($this->input->post('name')) {
			$this->MIncome->updateIncome();
			$this->session->set_flashdata('message','Income updated');
			redirect('income', 'refresh');
		} else {
			$data['title'] = "Edit Income";
			$data['main'] = 'main_income_edit';
			$data['income'] = $this->MIncome->getIncome($id);
			if (!count($data['income'])) {
				redirect('dashboard/index','refresh');
			}
			$this->load->vars($data);
			$this->load->view('template');
		}
	}
	
	function delete($id) {
		$this->MIncome->deleteIncome($id);
		$this->session->set_flashdata('message','Income deleted');
		redirect('income', 'refresh');
	}
}