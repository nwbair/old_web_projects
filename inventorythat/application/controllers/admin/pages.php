<?php

class Pages extends Controller {
	function Pages() {
		parent::Controller();
		session_start();
		
		if($_SESSION['userlevel'] != 777) {
			if($_SESSION['userid'] < 1) {
				redirect('main/verify','refresh');
			} else {
				redirect('dashboard','refresh');
			}
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
		$data['title'] = "Manage Pages";
		$data['main'] = 'admin/admin_pages_home';
		$data['pages'] = $this->MPages->getAllPages();
		$this->load->vars($data);
		$this->load->view('admin/dashboard_template');
	}
	
	function create() {
		if ($this->input->post('name')) {
			$this->MPages->addPage();
			$this->session->set_flashdata('message', 'Page created');
			redirect('admin/pages/index', 'refresh');
		} else {
			$data['title'] = "Create Pages";
			$data['main'] = 'admin/admin_pages_create';
			$this->load->vars($data);
			$this->load->view('admin/dashboard_template');
		}
	}
	
	function edit($id=0) {
		if ($this->input->post('name')) {
			$this->MPages->updatePage();
			$this->session->set_flashdata('message','Page updated');
			redirect('admin/pages/index', 'refresh');
		} else {
			$data['title'] = "Edit Page";
			$data['main'] = 'admin/admin_pages_edit';
			$data['page'] = $this->MPages->getPage($id);
			if (!count($data['page'])) {
				redirect('admin/pages/index','refresh');
			}
			$this->load->vars($data);
			$this->load->view('admin/dashboard_template');
		}
	}
	
	function delete($id) {
		$this->MPages->deletePage($id);
		$this->session->set_flashdata('message','Page deleted');
		redirect('admin/pages/index', 'refresh');
	}
}