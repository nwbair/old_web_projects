<?php

class County extends Controller {

	function County()
	{
		parent::Controller();

                $this->load->model('counties_model');
	}
	
	function index()
	{
            $data['counties'] = $this->counties_model->GetCounties();

            $this->load->view('admin/admin_header_view');
            $this->load->view('admin/county_index_view', $data);
            $this->load->view('admin/admin_footer_view');
	}

        function edit()
        {
           $this->load->view('admin/county_edit_view');
        }

        function add()
        {
            $this->load->view('admin/county_add_view');
        }

        function delete($countyid)
        {
            $data['county'] = $this->counties_model->GetCounties(array('countyId' => $countyid));
            if( ! $data['county']) redirect('admin/county/');

            $this->counties_model->UpdateCounty(array('countyId' => $countyid, 'countyStatus' => 'deleted'));
        }
}

/* End of file dashboard.php */
/* Location: ./system/application/controllers/admin/dashboard.php */