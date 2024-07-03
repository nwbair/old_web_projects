<?php

class Dashboard extends Controller {

	function Dashboard()
	{
            parent::Controller();
            if(!$this->user_model->Secure(array('userType' => 'admin')))
            {
                $this->session->set_flashdata('flashError', 'You must be logged into a valid admin account to access this section.');
                redirect('admin/access');
            }
	}
	
	function index()
	{
            $this->load->view('admin/admin_header_view');
            $this->load->view('admin/dashboard_view');
            $this->load->view('admin/admin_footer_view');
	}
        
}

/* End of file dashboard.php */
/* Location: ./system/application/controllers/admin/dashboard.php */