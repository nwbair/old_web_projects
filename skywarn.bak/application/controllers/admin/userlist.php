<?php

class Userlist extends Controller {

	function Userlist()
	{
            parent::Controller();
            if(!$this->user_model->Secure(array('userType' => 'admin')))
            {
                $this->session->set_flashdata('flashError', 'You must be logged into a valid admin account to access this section.');
                redirect('admin/access');
            }
            $this->load->model('userlists_model');
	}

        /**
         * Generate the main list on the userlists management page.
         */
	function index()
	{
            $data['userlists'] = $this->userlists_model->GetUserLists();

            $this->load->view('admin/admin_header_view');
            $this->load->view('admin/userlist_index_view', $data);
            $this->load->view('admin/admin_footer_view');
	}

        /**
         * Edit existing userlists.
         */
        function edit($userlistId)
        {
            $data['userlist'] = $this->userlists_model->GetUserLists(array('listId' => $userlistId));
            if(!$data['userlist']) redirect('admin/userlist');

            // Validate form
            $this->form_validation->set_rules('listName', 'List Name', 'trim|required');

            if($this->form_validation->run())
            {
                // Validation Passed
                $_POST['listId'] = $userlistId;

                if($this->userlists_model->UpdateUserList($_POST))
                {
                    $this->session->set_flashdata('flashConfirm', 'The county has been successfully updated.');
                    redirect('admin/userlist');
                }
                else
                {
                    $this->session->set_flashdata('flashError', 'A database error has occured, please contact your administrator.');
                    redirect('admin/userlist');
                }
            }
            $this->load->view('admin/admin_header_view');
            $this->load->view('admin/userlist_edit_view', $data);
            $this->load->view('admin/admin_footer_view');
        }
        /**
         * Add a userlist entry.
         */
        function add()
        {
            // Validate form
            $this->form_validation->set_rules('listName', 'List Name', 'trim|required');

            if($this->form_validation->run())
            {
                // Validation Passed
                $listId = $this->userlists_model->AddUserList($_POST);

                if($listId)
                {
                    $this->session->set_flashdata('flashConfirm', 'The county has been successfully added.');
                    redirect('admin/userlist');
                }
                else
                {
                    $this->session->set_flashdata('flashError', 'A database error has occured, please contact your administrator.');
                    redirect('admin/userlist');
                }
            }
            $this->load->view('admin/admin_header_view');
            $this->load->view('admin/userlist_add_view');
            $this->load->view('admin/admin_footer_view');
        }

        /**
         * Change the flag in the database for the county to deleted.
         */
        function delete($listId)
        {
            $data['userlist'] = $this->userlists_model->GetUserLists(array('listId' => $listId));
            if( ! $data['userlist']) redirect('admin/userlist');

            $this->userlists_model->UpdateUserList(array('listId' => $listId, 'userlistStatus' => 'deleted'));

            redirect('admin/userlist');
        }

}

/* End of file userlist.php */
/* Location: ./system/application/controllers/admin/userlist.php */