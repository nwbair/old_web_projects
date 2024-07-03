<?php

class Dashboard extends Controller {
	function Dashboard() {
		parent::Controller();
		session_start();

		if($_SESSION['userlevel'] != 777) {
			if($_SESSION['userid'] < 1) {
				redirect('main/verify','refresh');
			} else {
				redirect('dashboard','refresh');
			}
		}
	}
	
	/**
	* Displays the main default index page for the dashboard
	* admin/dashboard
	*/
	function index() {
		$data['title'] = "Dashboard Home";
		$data['main'] = "admin/admin_home";
		$this->load->vars($data);
		$this->load->view('admin/dashboard_template');
	}

}