<?php

class Users extends Controller {

    function Users()
    {
        parent::Controller();

        if(!$this->user_model->Secure(array('userType' => 'admin')))
        {
            $this->session->set_flashdata('flashError', 'You must be a logged into a valid admin account to access this section.');
            redirect('login');
        }
    }

    // Create
    function add()
    {
        // Load dependencies
        $this->load->library('form_validation');

        // Validate form
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('userType', 'type', 'trim|required');
        $this->form_validation->set_rules('userStatus', 'status', 'trim|required');

        if($this->form_validation->run())
        {
            // Validation passes
            $userId = $this->user_model->AddUser($_POST);

            if($userId)
            {
                $this->session->set_flashdata('flashConfirm', 'The user has been successfully added.');
                redirect('users');
            }
            else
            {
                $this->session->set_flashdata('flashError', 'A database error has occured, please contact your administrator.');
                redirect('users');
            }
        }

        $this->load->view('users/users_add_form');
    }

    // Retrieve
    function index($offset = 0)
    {
        $this->load->library('pagination');

        $perpage = 20;

        $config['base_url'] = base_url() . 'users/index/';
        $config['total_rows'] = $this->user_model->GetUsers(array('count' => true));
        $config['per_page'] = $perpage;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();

        $data['users'] = $this->user_model->GetUsers(array('limit' => $perpage, 'offset' => $offset));

        $this->load->view('users/users_index', $data);

    }

    // Update
    function edit($userid)
    {

        $data['user'] = $this->user_model->GetUsers(array('userid' => $userid));
        if(!$data['user']) redirect('users');

        // Validate form
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'trim|min_length[6]');
        $this->form_validation->set_rules('userType', 'type', 'trim|required');
        $this->form_validation->set_rules('userStatus', 'status', 'trim|required');

        if($this->form_validation->run())
        {
            // Validation passes
            $_POST['userid'] = $userid;
            if(empty($_POST['password'])) unset($_POST['password']);
           
            if($this->user_model->UpdateUser($_POST))
            {
                $this->session->set_flashdata('flashConfirm', 'The user has been successfully added.');
                redirect('users');
            }
            else
            {
                $this->session->set_flashdata('flashError', 'A database error has occured, please contact your administrator.');
                redirect('users');
            }
        }
                
        $this->load->view('users/users_edit_form', $data);

    }

    // Delete
    function delete($userid)
    {
        $data['user'] = $this->user_model->GetUsers(array('userid' => $userid));
        if(!$data['user']) redirect('users');

        $this->user_model->UpdateUser(array('userid' => $userid, 'userStatus' => 'deleted'));

        $this->session->set_flashdata('flashConfirm', 'The user has been successfully deleted.');
        redirect('users');
    }
}