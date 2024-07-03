<?php

?><?php

class Users extends Controller {

	function Users()
	{
		parent::Controller();
           
               
	}
	
	function index()
	{
		
    }
	
	function viewUsers()
	{
		$this->load->model('UserModel', 'users');    
		$data['users'] = $this->users->getAllUsers();
		$data['title'] = "Edit Users";
		$data['content'] = 'viewAllUsers';
		$this->load->view('include/template.php', $data);
	}
	
	function addUser()
	{
		$this->load->model('UserModel', 'users');    		
		$data['title'] = "Create New User";
		$data['content'] = 'createUser';
		$this->load->view('include/template.php', $data);			
	}
	function insertNewUser()
	{
		$this->load->model('UserModel', 'users');    
		$userInfo = array('loginid' => $_POST['loginid'], 'password' => $_POST['password'], 'fullname' => $_POST['fullname'], 'email' => $_POST['email'], 'url' => '', 'active' => 'T', 'userLevel' => '0');
		$data['users'] = $this->users->addUser($userInfo);		
		
		redirect($_SERVER['HTTP_REFERER'], 'redirect');
	}
	function updateUser()
	{
		
	}
	function changeUserStatus($uid, $newStatus)
	{
		$this->load->model('UserModel', 'users');
		$this->users->changeUserStatus($uid, $newStatus);
		
		redirect($_SERVER['HTTP_REFERER'], 'redirect');
	}
	function deleteUser($id)
	{
		$this->load->model('UserModel', 'users');
		$this->users->deleteUser($id);
		
		redirect($_SERVER['HTTP_REFERER'], 'redirect');
	}
                
        
}
?>