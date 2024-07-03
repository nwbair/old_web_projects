<?php

class Dashboard extends Controller {

	function Dashboard()
	{
		parent::Controller();

                $this->load->model('counties_model');
	}
	
	function index()
	{
            $this->load->view('admin/dashboard_view');
	}
}

/* End of file dashboard.php */
/* Location: ./system/application/controllers/admin/dashboard.php */