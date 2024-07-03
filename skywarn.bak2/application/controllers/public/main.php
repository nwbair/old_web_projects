<?php

class Main extends Controller {

	function Main()
	{
		parent::Controller();

                $this->load->model('counties_model');
	}
	
	function index()
	{
            $site['title'] = 'ICT Skywarn';
            
            $data['counties'] = $this->counties_model->GetCounties();

            $this->load->view('public/header_view', $site);
            $this->load->view('public/main_view', $data);
            $this->load->view('public/footer_view');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */