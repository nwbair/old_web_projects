<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();
		$this->load->model('UserModel', 'users');                    
		$data['users'] = $this->users->getActiveUsers();	
	}
	
	function index()
	{
		$this->load->model('UserModel', 'users');                    
		$data['users'] = $this->users->getActiveUsers();
		$data['content'] = 'welcome_message';
		$data['title'] = 'New Customer Contact System';
        $this->load->view('include/template.php', $data);
    }
	
	function signout()
	{
		$this->session->destroy();
		$data['content'] = 'welcome_message';
		$data['title'] = 'New Customer Contact System';
        $this->load->view('include/template.php', $data);
		redirect(base_url(), 'refresh');
    }
}
