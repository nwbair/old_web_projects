<?php

class Calendar extends Controller {
			
		var $prevmonth;
		var $nextmonth;
		
	function Calendar() {
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
	* Displays the big calendar to manage income, debt, bills
	* 
	*/
	function index($year = null, $month = null) {
		
		if (!$year) {
			$year = date('Y');
		}
		if (!$month) {
			$month = date('m');
		}
		
		$this->load->model('MCalendar');
		
		$data['title'] = "Main Calendar View";
		$data['main'] = 'calendar';
		$data['calendar'] = $this->MCalendar->generate($year, $month);
		$this->load->vars($data);
		$this->load->view('template');
	}
}