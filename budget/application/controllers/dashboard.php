<?php

class Dashboard extends Controller {
	function Dashboard() {
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
	
	/**
	* Displays the main default index page for the dashboard
	* dashboard
	*/
	function index() {
		$data['title'] = "Dashboard Home";
		$data['main'] = "main_home";
		$data['bills'] = $this->MBills->getActiveBills('active',$_SESSION['userid']);
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	/**
	* Displays the profile page for the user
	* dashboard/profile
	*/
	function profile() {
		$data['title'] = 'My Profile';
		$data['main'] = 'profile';
		$data['profile'] = $this->MUsers->getUser($_SESSION['userid']);
		$this->load-vars($data);
		$this->load->view('template');
	}
	
	/** 
	* Logout function to destroy the dashboard session
	* dashboard/logout
	*/	
	function logout() {
		unset($_SESSION['userid']);
		unset($_SESSION['username']);
		unset($_SESSION['userlevel']);
		unset($_SESSION['loginkey']);
		session_destroy();
		$this->session->set_flashdata('error',"You've been logged out!");
		redirect('main','refresh');
	}
}