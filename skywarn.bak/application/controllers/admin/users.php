<?php

class Users extends Controller
{

    function Users()
    {
        parent::Controller();
        if(!$this->user_model->Secure(array('userType' => 'admin')))
        {
            $this->session->set_flashdata('flashError', 'You must be logged into a valid admin account to access this section.');
            redirect('admin/access');
        }

    }

	// Create
	function add()
	{
	    // Validate form
	    $this->form_validation->set_rules('userEmail', 'email', 'trim|required|valid_email');
	    $this->form_validation->set_rules('userPassword', 'password', 'trim|required|min_length[6]');
	    $this->form_validation->set_rules('userType', 'type', 'trim|required');
	    $this->form_validation->set_rules('userStatus', 'status', 'trim|required');

	    if($this->form_validation->run())
	    {
	        // Validation passes
	        $userId = $this->user_model->AddUser($_POST);

	        if($userId)
	        {
	            $this->session->set_flashdata('flashConfirm', 'The user has been successfully added.');
	            redirect('admin/users');
	        }
	        else
	        {
                $this->session->set_flashdata('flashError', 'A database error has occured, please contact your administrator.');
	            redirect('admin/users');
	        }
	    }
            $this->load->view('admin/admin_header_view');
	    $this->load->view('admin/users_add_view');
            $this->load->view('admin/admin_footer_view');
	}

    // Retrieve
	function index($offset = 0)
	{
	    $this->load->library('pagination');

	    $perpage = 20;

	    $config['base_url'] = base_url() . 'admin/users/index/';
	    $config['total_rows'] = $this->user_model->GetUsers(array('count' => true));
	    $config['per_page'] = $perpage;
	    $config['uri_segment'] = 3;

	    $this->pagination->initialize($config);

	    $data['pagination'] = $this->pagination->create_links();

		$data['users'] = $this->user_model->GetUsers(array('limit' => $perpage, 'offset' => $offset));

                $this->load->view('admin/admin_header_view');
		$this->load->view('admin/users_index_view', $data);
                $this->load->view('admin/admin_footer_view');
	}

	// Update
	function edit($userId)
	{
	    $data['user'] = $this->user_model->GetUsers(array('userId' => $userId));
	    if(!$data['user']) redirect('admin/users');

	    // Validate form
	    $this->form_validation->set_rules('userEmail', 'email', 'trim|required|valid_email');
	    $this->form_validation->set_rules('userPassword', 'password', 'trim|min_length[6]');
	    $this->form_validation->set_rules('userType', 'type', 'trim|required');
	    $this->form_validation->set_rules('userStatus', 'status', 'trim|required');

	    if($this->form_validation->run())
	    {
	        // Validation passes
	        $_POST['userId'] = $userId;
	        if(empty($_POST['userPassword'])) unset($_POST['userPassword']);

	        if($this->user_model->UpdateUser($_POST))
	        {
	            $this->session->set_flashdata('flashConfirm', 'The user has been successfully updated.');
	            redirect('admin/users');
	        }
	        else
	        {
                $this->session->set_flashdata('flashError', 'A database error has occured, please contact your administrator.');
	            redirect('admin/users');
	        }
	    }

            $this->load->view('admin/admin_header_view');
	    $this->load->view('admin/users_edit_view', $data);
            $this->load->view('admin/admin_footer_view');
	}

	// Delete
	function delete($userId)
	{
	    $data['user'] = $this->user_model->GetUsers(array('userId' => $userId));
	    if(!$data['user']) redirect('admin/users');

	    $this->user_model->UpdateUser(array(
	        'userId' => $userId,
	        'userStatus' => 'deleted'
	    ));

	    $this->session->set_flashdata('flashConfirm', 'The user has been successfully deleted.');
	    redirect('admin/users');
	}
}