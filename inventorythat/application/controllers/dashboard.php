<?php

class Dashboard extends Controller {
	function Dashboard() {
		parent::Controller();
		session_start();

		if($_SESSION['userid'] < 1) {
			redirect('main/verify','refresh');
		}
	}
	
	/**
	* Displays the main default index page for the dashboard
	* admin/dashboard
	*/
	function index() {
		$data['title'] = "Dashboard Home";
		$data['main'] = "main/main_home";
		$data['items'] = $this->MItems->getAllItems();
		$this->load->vars($data);
		$this->load->view('main/template');
	}
	
	/** 
	* Logout function to destroy the dashboard session
	*/	
	function logout() {
		unset($_SESSION['userid']);
		unset($_SESSION['username']);
		unset($_SESSION['userlevel']);
		unset($_SESSION['loginkey']);
		$this->session->set_flashdata('error',"You've been logged out!");
		redirect('main','refresh');
	}
}