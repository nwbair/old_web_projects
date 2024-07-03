<?php

class Cu extends Controller {

	function Cu()
	{
            parent::Controller();
            if(!$this->user_model->Secure(array('userType' => 'admin')))
            {
                $this->session->set_flashdata('flashError', 'You must be logged into a valid admin account to access this section.');
                redirect('admin/access');
            }
            $this->load->model('cu_model');
	}

        /**
         * Generate the main list on the userlists management page.
         */
	function index()
	{
            $data['cus'] = $this->cu_model->GetCu();

            $this->load->view('admin/admin_header_view');
            $this->load->view('admin/cu_index_view', $data);
            $this->load->view('admin/admin_footer_view');
	}

        /**
         * Edit existing userlists.
         */
        function edit($cuId)
        {
            $data['cu'] = $this->cu_model->GetCu(array('cuId' => $cuId));
            if(!$data['cu']) redirect('admin/cu');

            // Validate form
            $this->form_validation->set_rules('listId', 'List ID', 'trim|required');

            if($this->form_validation->run())
            {
                // Validation Passed
                $_POST['cuId'] = $cuId;

                if($this->cu_model->UpdateCu($_POST))
                {
                    $this->session->set_flashdata('flashConfirm', 'The county has been successfully updated.');
                    redirect('admin/cu');
                }
                else
                {
                    $this->session->set_flashdata('flashError', 'A database error has occured, please contact your administrator.');
                    redirect('admin/cu');
                }
            }
            $this->load->view('admin/admin_header_view');
            $this->load->view('admin/cu_edit_view', $data);
            $this->load->view('admin/admin_footer_view');
        }
        /**
         * Add a userlist entry.
         */
        function add()
        {
            $data['cu'] = $this->cu_model->GetCu();
            if(!$data['cu']) redirect('admin/cu');

            // Validate form
            $this->form_validation->set_rules('listId', 'List Id', 'trim|required');

            if($this->form_validation->run())
            {
                // Validation Passed
                $cuId = $this->cu_model->AddCu($_POST);

                if($cuId)
                {
                    $this->session->set_flashdata('flashConfirm', 'The county has been successfully added.');
                    redirect('admin/cu');
                }
                else
                {
                    $this->session->set_flashdata('flashError', 'A database error has occured, please contact your administrator.');
                    redirect('admin/cu');
                }
            }
            $this->load->view('admin/admin_header_view');
            $this->load->view('admin/cu_add_view', $data);
            $this->load->view('admin/admin_footer_view');
        }

        /**
         * Change the flag in the database for the county to deleted.
         */
        function delete($cuId)
        {
            $data['cu'] = $this->cu_model->GetCu(array('cuId' => $cuId));
            if( ! $data['cu']) redirect('admin/cu');

            $this->cu_model->UpdateCu(array('cuId' => $cuId, 'cuStatus' => 'deleted'));

            redirect('admin/cu');
        }

}

/* End of file cu.php */
/* Location: ./system/application/controllers/admin/cu.php */