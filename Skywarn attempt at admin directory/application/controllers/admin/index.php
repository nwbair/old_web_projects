<?php

class Dashboard extends Controller {
    function index()
    {
        $this->load->view('admin/index_view');
    }

    function login()
    {
        $this->form_validation->set_rules('userEmail', 'email', 'trim|required|valid_email|callback__check_login');
        $this->form_validation->set_rules('userPassword', 'password', 'trim|required');

        if($this->form_validation->run())
        {
            // the form has successfully validated
            if($this->user_model->Login(array('userEmail' => $this->input->post('userEmail'), 'userPassword' => $this->input->post('userPassword'))))
            {
                redirect('dashboard');
            } redirect('index_view');
        }

    $this->load->view('admin/login_form');
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    function _check_login($email)
    {
        if($this->input->post('userPassword'))
        {
            $user = $this->user_model->GetUsers(array('userEmail' => $email, 'userPssword' => md5($this->input->post('userPassword'))));
            if($user) return true;
        }

    $this->form_validation->set_message('_check_login', 'Your username / password combination is invalid.');
    return false;
    }
}