<?php

class Customers extends Controller {

	function Customers()
	{
		parent::Controller();
		$this->load->model('UserModel', 'users');                    
		$data['users'] = $this->users->getActiveUsers();                
               
	}
	
	function index()
	{
		$this->load->view('welcome_message');
    }
        
        function viewCompletedCustomers($name)
	{
            $this->load->model('CustomerModel', 'customer');            
            $data['data'] = $this->customer->getClosedCustomersUser($name);			
			If($this->session->userdata('fullname'))
			{
				$data['title'] = "Closed Customers for $name";
				$data['content'] = 'closed_customers';
            	$this->load->view('include/template.php', $data);
			} else {				
            	redirect('http://localhost/NewCustomer');					
			}
			
        }
		
        function viewOpenCustomers()
		{
            $this->load->model('CustomerModel', 'customer');            
            $this->load->model('UserModel', 'users');
            $data['data'] = $this->customer->getCustomers('', 'F');            
            $data['users'] = $this->users->getActiveUsers();
			If($this->session->userdata('fullname'))
			{
	            $data['title'] = "All Open Customers";
				$data['content'] = 'open_customers';
	            $this->load->view('include/template.php', $data);
			} else {				
            	redirect('http://localhost/NewCustomer');					
			}
        }
        
        function viewNewCustomers($filter="")
		{
			$this->load->model('UserModel', 'users');                    
			$data['users'] = $this->users->getActiveUsers();
            $this->load->model('CustomerModel', 'customer');            
            $data['data'] = $this->customer->getCustomers($filter);
			If($this->session->userdata('fullname'))
			{                         
            	$this->load->view('new_customers', $data);
			} else {				
            	redirect('http://localhost/NewCustomer');					
			}
        }
		
		        
		

        function viewUserCustomers($name)
	{
             $this->load->model('UserModel', 'users');                    
			 $data['users'] = $this->users->getActiveUsers();
			 $this->load->model('CustomerModel', 'customer');             
             $data['data'] = $this->customer->getOpenCustomersUser($name);
			 If($this->session->userdata('fullname'))
			{
				 $data['title'] = "Open Customers for $name";
	             $data['content'] = 'user_customers';
				 $this->load->view('include/template.php', $data);		 
				 
			} else {				
            	 redirect('http://localhost/NewCustomer');					
			}
 
        }
		        
        function updateOpenCustomers()
		{			
			 $this->load->model('CustomerModel', 'customer');             
             if($_POST['ticketNum'])
			 {
			 	$this->customer->updateCustomers($_POST['ticketNum'], $_POST['id'], $this->session->userdata('fullname'));	
			 } else {
			 	$this->session->set_flashdata('formError', '<span class="label important">Ticket Number or N/A is required when closing an Open Customer.</span>');					
			 }
			 
			 	redirect($_SERVER['HTTP_REFERER'], 'redirect'); 
        }
		
		
        
        
}
?>