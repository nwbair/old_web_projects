<?php

class Login extends Controller {

		function Login()
		{
			parent::Controller();
			$this->load->model('UserModel', 'users');                    
			$data['users'] = $this->users->getActiveUsers();	
		}
	
		function authUser()
		{
            $this->load->model('UserModel', 'user');
			if($_POST['Username'] && $_POST['Password'])
			{
				$data['data'] = $this->user->getUser($_POST['Username'], $_POST['Password']);
				$this->session->set_userdata($data['data'][0]);	
				$fullname = $data['data'][0]->fullname;				
			} else {
				redirect(base_url(), 'refresh');
			}
            
			if($fullname && $fullname == 'Admin')
			{
				redirect("/admin", 'refresh');
			} else {
				redirect("/customers/viewUserCustomers/$fullname", 'refresh');	
			}
			
            
            
        }
        
        function createUser($array)
		{
            
        }
        
        function deleteUser($uid)
		{
            
        }
        
        function updateUser($array)
		{
            
        }
              
        
}
?>