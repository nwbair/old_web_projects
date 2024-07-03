<?php

class Main extends Controller {

	function Main()
	{
		parent::Controller();
                $this->load->model('user_model');
	}
	
        function login()
        {
            $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback__check_login');
            $this->form_validation->set_rules('password', 'password', 'trim|required');

            if($this->form_validation->run())
            {
                // the form has successfully validated
                if($this->user_model->Login(array('email' => $this->input->post('email'), 'password' => $this->input->post('password'))))
                {
                    redirect('dashboard');
                } redirect('main/login');
            }

            $this->load->view('main/login_form');
        }

        function logout()
        {
            $this->session->sess_destroy();
            redirect('login');
        }
        
	function index()
	{
		$this->load->view('main/main_index');
	}

        function _check_login($email)
        {
            if($this->input->post('password'))
            {
                $user = $this->user_model->GetUsers(array('email' => $email, 'password' => md5($this->input->post('password'))));
                if($user) return true;
            }

            $this->form_validation->set_message('_check_login', 'Your username / password combination is invalid.');
            return false;
        }
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */