<?php

class Admin extends Controller {

	function Admin()
	{
		parent::Controller();
		$this->load->model('UserModel', 'users');                    
		$data['users'] = $this->users->getActiveUsers();		
	}
	
	function index()
	{
		$this->load->model('CustomerModel', 'customer');
		$this->load->model('UserModel', 'users');            
        $data['data'] = $this->customer->getUnassignedCustomers();
		$data['users'] = $this->users->getActiveUsers();		
		if($this->session->userdata('fullname') && $this->session->userdata('fullname') == 'Admin')
		{           
			$data['title'] = "Unassigned Customers";
	        $data['content'] = 'new_customers';
	        $this->load->view('include/template.php', $data);              
		} else {				
           	redirect('http://localhost/NewCustomer');					
		}
	}	
	function viewUnassignedCustomers()
	{
    	$this->load->model('CustomerModel', 'customer');
		$this->load->model('UserModel', 'users');            
        $data['data'] = $this->customer->getUnassignedCustomers();
		$data['users'] = $this->users->getActiveUsers();		
		if($this->session->userdata('fullname') && $this->session->userdata('fullname') == 'Admin')
		{           
			$data['title'] = "Unassigned Customers";
	        $data['content'] = 'new_customers';
	        $this->load->view('include/template.php', $data);              
		} else {				
           	redirect('http://localhost/NewCustomer');					
		}
     }
	 
	 function viewOpenCustomers()
		{
            $this->load->model('CustomerModel', 'customer');            
            $this->load->model('UserModel', 'users');
            $data['data'] = $this->customer->getAllOpenCustomers();            
			$data['users'] = $this->users->getActiveUsers();            
			If($this->session->userdata('fullname') && $this->session->userdata('fullname') == 'Admin')
			{
	            $data['title'] = "All Open Customers";
				$data['content'] = 'open_customers';
	            $this->load->view('include/template.php', $data);
			} else {				
            	redirect('http://localhost/NewCustomer');					
			}
        }
		
		
		function viewClosedCustomers()
		{
            $this->load->model('UserModel', 'users');                    
			$data['users'] = $this->users->getActiveUsers();
			$this->load->model('CustomerModel', 'customer');            
            $data['data'] = $this->customer->getCustomers('', 'T');            
			If($this->session->userdata('fullname') && $this->session->userdata('fullname') == 'Admin')
			{
	            $data['title'] = "All Closed Customers";
				$data['content'] = 'closed_customers';
	            $this->load->view('include/template.php', $data);
			} else {				
            	redirect('http://localhost/NewCustomer');					
			}			
        }
		
		function viewClosedCustomersTickets()
		{
            $this->load->model('UserModel', 'users');                    
			$data['users'] = $this->users->getActiveUsers();
			$this->load->model('CustomerModel', 'customer');            
            $data['data'] = $this->customer->getClosedCustomersTickets();            
			If($this->session->userdata('fullname') && $this->session->userdata('fullname') == 'Admin')
			{
	            $data['title'] = "Closed Customers with Logged Tickets";
				$data['content'] = 'closed_customers';
	            $this->load->view('include/template.php', $data);
			} else {				
            	redirect('http://localhost/NewCustomer');					
			}			
        }
			
	function viewAllUsers()
		{
            $this->load->model('UserModel', 'users');
            $data['users'] = $this->users->getAllUsers();
			If($this->session->userdata('fullname') && $this->session->userdata('fullname') == 'Admin')
			{
	            $data['title'] = "All Users";
				$data['content'] = 'admin_users';
	            $this->load->view('include/template.php', $data);
			} else {				
            	redirect('http://localhost/NewCustomer');					
			}
        }
		
		function editUser($id)
		{
            $this->load->model('UserModel', 'users');
            $data['users'] = $this->users->getUserByID($id);
			If($this->session->userdata('fullname') && $this->session->userdata('fullname') == 'Admin')
			{
	            $data['title'] = "Edit User";
				$data['content'] = 'admin_edituser';
	            $this->load->view('include/template.php', $data);
			} else {				
            	redirect('http://localhost/NewCustomer');					
			}
        }
		
		function addUsers()
		{
            $this->load->model('UserModel', 'users');
            //$data['users'] = $this->users->getUserByID($id);
			If($this->session->userdata('fullname') && $this->session->userdata('fullname') == 'Admin')
			{
	            $data['title'] = "Add New User";
				$data['content'] = 'admin_newuser';
	            $this->load->view('include/template.php', $data);
			} else {				
            	redirect('http://localhost/NewCustomer');					
			}
        }
		
		function AssignNewCustomers($custid, $user)
		{
				
            $this->load->model('CustomerModel', 'customer');
			$this->load->model('UserModel', 'users');
			$data['data'] = $this->customer->getUnassignedCustomers();
			$data['users'] = $this->users->getActiveUsers();	            
            $this->customer->assignCustomers($custid, $user);
			
			If($this->session->userdata('fullname'))
			{                         
	           	redirect('/admin/viewUnassignedCustomers', 'refresh');
			} else {				
            	redirect('http://localhost/NewCustomer');					
			}
        }
		
		function closeExistingCustomer($ticket,$id,$who)
		{
			$this->load->model('CustomerModel', 'customer');
			$this->customer->updateCustomers($ticket,$id,$who);			
			redirect('/admin/viewUnassignedCustomers', 'refresh');
			
		}
}            


?>