<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $this->main_page();
	}

    public function main_page()
    {
        $this->load->model('model_products');

        $popular = $this->model_products->get_random_products();
        $recommended = $this->model_products->get_random_products();

//        echo '<pre>';
//        print_r($popular);
//        echo '</pre>';


        $data = array(
            'content' => 'main_products',
            'title' => 'High Noon Holsters',
            'popular' => $popular,
            'recommended' => $recommended
        );
        $this->load->vars($data);
        $this->load->view('template', $data);
    }

    public function login()
    {
        $data['title'] = "High Noon Holsters | Login";
        $this->load->vars($data);
        $this->load->view('login', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('main/main_page');
    }

    public function register()
    {
        $data['title'] = "High Noon Holsters | Register";
        $this->load->vars($data);
        $this->load->view('register', $data);
    }

    public function login_validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback_validate_credentials');
        $this->form_validation->set_rules('password', 'Password', 'required|md5|trim');

        if ($this->form_validation->run()) {
            $data = array(
                'email' => $this->input->post('email'),
                'is_logged_in' => 1
            );

            $this->session->set_userdata($data);
            redirect('main/main_page');
        } else {
            $data['title'] = "High Noon Holsters | Login";
            $this->load->vars($data);
            $this->load->view('login', $data);
        }
    }

    public function register_validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email',
                'required|trim|valid_email|is_unique[users.email]|xss_clean');
        $this->form_validation->set_rules('nickname', 'First Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');

        if ($this->form_validation->run()) {
            // generate random key
            $key = md5(uniqid());

            $this->load->library('email',array('mailtype'=>'html'));
            $this->load->model('model_users');

            $this->email->from('highnoon@nickbair.com', 'Account Support');
            $this->email->to($this->input->post('email'));
            $this->email->subject("Confirm your account.");

            $message = "<p>Thank you for signing up.</p>";
            $message .= "<p><a href='".base_url()."main/register_user/$key'>Click here</a> to confirm your account.</p>";

            $this->email->message($message);

            // send email to user
            if ($this->model_users->add_temp_user($key)) {
                if ($this->email->send()){
                    $this->load->view('email_sent');
                } else {
                    $this->load->view('email_failed');
                }
            }


        } else {
            $data['title'] = "High Noon Holsters | Register";
            $this->load->vars($data);
            $this->load->view('register', $data);
        }

    }

    public function validate_credentials()
    {
        $this->load->model('model_users');

        if($this->model_users->can_log_in()){
            return true;
        } else {
            $this->form_validation->set_message('validate_credentials', 'Incorrect username/password');
            return false;
        }
    }

    public function register_user($key)
    {
        $this->load->model('model_users');

        if($this->model_users->is_key_valid($key)) {
            if ($user_data = $this->model_users->add_user($key)) {

                $data = array(
                    'nickname' => $user_data['nickname'],
                    'email' => $user_data['email'],
                    'is_logged_in' => 1
                );

                $this->session->set_userdata($data);
                redirect('main/main_page');
            } else {
                echo "failed to add user";
            }
        } else {
            echo "invalid key";
        }
    }
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */