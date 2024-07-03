<?php

class Items extends Controller {
	function Items() {
		parent::Controller();
		session_start();
		
		if($_SESSION['userid'] < 1) {
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
		$data['title'] = "Manage Items";
		$data['main'] = 'main/main_items_home';
		$data['items'] = $this->MItems->getAllItems();
		$this->load->vars($data);
		$this->load->view('main/template');
	}
	
	function create() {
		if ($this->input->post('name')) {
			$this->MItems->addItem();
			$this->session->set_flashdata('message', 'Item created');
			redirect('dashboard/index', 'refresh');
		} else {
			$data['title'] = "Create Item";
			$data['main'] = 'main/main_items_create';
			$this->load->vars($data);
			$this->load->view('main/template');
		}
	}
	
	function edit($id=0) {
		if ($this->input->post('name')) {
			$this->MItems->updateItem();
			$this->session->set_flashdata('message','Item updated');
			redirect('dashboard/index', 'refresh');
		} else {
			$data['title'] = "Edit Item";
			$data['main'] = 'main/main_items_edit';
			$data['item'] = $this->MItems->getItem($id);
			if (!count($data['item'])) {
				redirect('dashboard/index','refresh');
			}
			$this->load->vars($data);
			$this->load->view('main/template');
		}
	}
	
	function delete($id) {
		$this->MItems->deleteItem($id);
		$this->session->set_flashdata('message','Item deleted');
		redirect('dashboard/index', 'refresh');
	}
}