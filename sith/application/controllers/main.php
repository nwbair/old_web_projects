<?php

class Main extends Controller {

	function Main()
	{
		parent::Controller();
		session_start();
	}
	
	function index()
	{
		$data['main'] = 'main/welcome_message';
		$data['title'] = 'Inventory That';
		$this->load->vars($data);
		$this->load->view('main/template',$data);
	}
	
	function verify() {
		if ($this->input->post('username')) {
			$u = $this->input->post('username');
			$pw = $this->input->post('password');
			$this->MUsers->verifyUser($u,$pw);
			if ($_SESSION['userid'] > 0) {
				redirect('dashboard','refresh');
			}
		}
		$data['main'] = 'main/login';
		//$data['title'] = "Admin Panel | Control Panel";
		$data['title'] = "Login";
		$this->load->vars($data);
		$this->load->view('main/template',$data);
		//$this->load->view('main/login', $data);
	}
	
	function pages($path) {
		$page = $this->MPages->getPagePath($path);
		$data['main'] = 'main/page';
		$data['title'] = $page['name'];
		$data['page'] = $page;
		$this->load->vars($data);
		$this->load->view('main/template');
	}
	
	function contact() {
		if ($this->input->post('name')) {
			$from = $this->input->post('email');
			$msg = $this->input->post('message');
			$this->email->clear();
			$this->email->from($from);
			$this->email->to('support@almostlabs.com');
			$this->email->subject('Contact Form Generated');
			$this->email->message($msg);
			$this->email->send();
			$this->session->set_flashdata('message', "Thank you for contacting AlmostLabs.");
			redirect('main','refresh');
		} else {
			$data['title'] = "Inventory That | Contact";
			$data['main'] = "main/main_contact";
			$this->load->vars($data);
			$this->load->view('main/template');
		}
	}
	
	function register() {
		if ($this->input->post('username')) {
			$this->MUsers->addUser();
			$this->session->set_flashdata('message', 'Registration complete');
			redirect('main', 'refresh');
		} else {
			$data['title'] = "Inventory That | Getting Started!";
			$data['main'] = "main/main_register";
			$this->load->vars($data);
			$this->load->view('main/template');
		}
	}
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */