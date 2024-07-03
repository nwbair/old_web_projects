<?php

class County extends Controller {

	function County()
	{
            parent::Controller();
            if(!$this->user_model->Secure(array('userType' => 'admin')))
            {
                $this->session->set_flashdata('flashError', 'You must be logged into a valid admin account to access this section.');
                redirect('admin/access');
            }
	}

        /**
         * Generate the main list on the county management page.
         */
	function index()
	{
            $data['counties'] = $this->counties_model->GetCounties();

            $this->load->view('admin/admin_header_view');
            $this->load->view('admin/county_index_view', $data);
            $this->load->view('admin/admin_footer_view');
	}

        /**
         * Edit existing county.
         */
        function edit($countyId)
        {
            $data['county'] = $this->counties_model->GetCounties(array('countyId' => $countyId));
            if(!$data['county']) redirect('admin/county');

            // Validate form
            $this->form_validation->set_rules('countyName', 'County Name', 'trim|required');

            if($this->form_validation->run())
            {
                // Validation Passed
                $_POST['countyId'] = $countyId;

                if($this->counties_model->UpdateCounty($_POST))
                {
                    $this->session->set_flashdata('flashConfirm', 'The county has been successfully updated.');
                    redirect('admin/county');
                }
                else
                {
                    $this->session->set_flashdata('flashError', 'A database error has occured, please contact your administrator.');
                    redirect('admin/county');
                }
            }
            $this->load->view('admin/admin_header_view');
            $this->load->view('admin/county_edit_view', $data);
            $this->load->view('admin/admin_footer_view');
        }
        /**
         * Add a county.
         */
        function add()
        {
            // Validate form
            $this->form_validation->set_rules('countyName', 'County Name', 'trim|required');

            if($this->form_validation->run())
            {
                // Validation Passed
                $countyid = $this->counties_model->AddCounty($_POST);

                if($countyid)
                {
                    $this->session->set_flashdata('flashConfirm', 'The county has been successfully added.');
                    redirect('admin/county');
                }
                else
                {
                    $this->session->set_flashdata('flashError', 'A database error has occured, please contact your administrator.');
                    redirect('admin/county');
                }
            }
            $this->load->view('admin/admin_header_view');
            $this->load->view('admin/county_add_view');
            $this->load->view('admin/admin_footer_view');
        }

        /**
         * Change the flag in the database for the county to deleted.
         */
        function delete($countyid)
        {
            $data['county'] = $this->counties_model->GetCounties(array('countyId' => $countyid));
            if( ! $data['county']) redirect('admin/county');

            $this->counties_model->UpdateCounty(array('countyId' => $countyid, 'countyStatus' => 'deleted'));

            redirect('admin/county');
        }

        /**
         * Activate a county.
         */
        function activate($countyid)
        {
            $data['county'] = $this->counties_model->GetCounties(array('countyId' => $countyid));
            if( ! $data['county']) redirect('admin/county');

            $this->counties_model->UpdateCounty(array('countyId' => $countyid, 'statusId' => '2'));

            redirect('admin/county');
        }

        /**
         * Deactive a county.
         */
        function deactivate($countyid)
        {
            $data['county'] = $this->counties_model->GetCounties(array('countyId' => $countyid));
            if( ! $data['county']) redirect('admin/county');

            $this->counties_model->UpdateCounty(array('countyId' => $countyid, 'statusId' => '1'));

            redirect('admin/county');
        }
}

/* End of file county.php */
/* Location: ./system/application/controllers/admin/county.php */