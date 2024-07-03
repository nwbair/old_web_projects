<?php

class Main extends Controller {

	function Main()
	{
		parent::Controller();
                $this->load->model('user_model');
	}        
        
	function index()
	{
		$this->load->view('main/main_index');
	}        
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */