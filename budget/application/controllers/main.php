<?php

class Main extends Controller {

	function Main()
	{
		parent::Controller();
		session_start();
	}
	
	function index()
	{
		$data['main'] = 'welcome_message';
		$data['title'] = 'Budget';
		$this->load->vars($data);
		$this->load->view('template',$data);
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
		$data['main'] = 'login';
		$data['title'] = "Login";
		$this->load->vars($data);
		$this->load->view('template',$data);
	}
	
	function pages($path) {
		$page = $this->MPages->getPagePath($path);
		$data['main'] = 'page';
		$data['title'] = $page['name'];
		$data['page'] = $page;
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	function contact() {
		if ($this->input->post('name')) {
			$from = $this->input->post('email');
			$msg = $this->input->post('message');
			$this->email->clear();
			$this->email->from($from);
			$this->email->to($this->input->post('email'));
			$this->email->subject('Contact Form Generated');
			$this->email->message($msg);
			$this->email->send();
			$this->session->set_flashdata('message', "Thank you for contacting AlmostLabs.");
			redirect('main','refresh');
		} else {
			$data['title'] = "Inventory That | Contact";
			$data['main'] = "main_contact";
			$this->load->vars($data);
			$this->load->view('template');
		}
	}
	
	function register() {
		if ($this->input->post('username')) {
			$key = md5(date("F j, Y, g:i a") . db_clean($_POST['email'],255) . db_clean($_POST['password'],16));
			$this->MRegister->addUser($key);
			$to = db_clean($_POST['email'],255);		
			$from = 'no-reply@inventorythat.com';
			$msg = "Thank you for registering at InventoryThat.com. Click on the following link to ";
			$msg .= "complete your registration. \r\n";
			$msg .= base_url() . 'main/confirmation/' . $key;
			$this->email->clear();
			$this->email->from($from);
			$this->email->to($to);
			$this->email->subject('InventoryThat.com registration');
			$this->email->message($msg);
			$this->email->send();
			//echo '<pre>';print_r($this->email);
			$this->session->set_flashdata('message', "Registration complete");
			redirect('main', 'refresh');
		} else {
			$data['title'] = "Inventory That | Getting Started!";
			$data['main'] = "main_register";
			$this->load->vars($data);
			$this->load->view('template');
		}
	}
	
	function confirmation() {
		$key = $this->uri->segment(3);
		$dbkey = $this->MRegister->getUser($key);
		if (isset($dbkey['key']) && $key == $dbkey['key']) {
			$_POST['username'] = $dbkey['username'];
			$_POST['email'] = $dbkey['email'];
			$_POST['status'] = "active";
			$_POST['password'] = $dbkey['password'];
			$this->MUsers->addUser();
			$this->MRegister->deleteUser($dbkey['id']);
		} else {
			echo "Keys do not match <br />";
			//echo $key . " < - Key <br />";
			//echo $dbkey['key'] . "< - dbkey <br />";
		}
	}
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */