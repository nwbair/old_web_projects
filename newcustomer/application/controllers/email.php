<?php

class Email extends Controller {

		function Email()
		{
			parent::Controller();
				
		}
	
		function sendUserEmail($fullName)
		{
			$this->load->model('UserModel', 'users');                    
			$email = $this->users->getUserEmailByName($fullName);			
			$config['protocol']    = 'smtp';
			$config['smtp_host']    = '10.204.86.12'; //Lotus Notes Server (Open Relay)
			$config['smtp_port']    = '25';
			$config['smtp_timeout'] = '7';
			$config['smtp_user']    = '';
			$config['smtp_pass']    = '';
			$config['charset']    = 'utf-8';
			$config['newline']    = "\r\n";
			$config['mailtype'] = 'html'; // or html
			$config['validation'] = TRUE; // bool whether to validate email or not      
			$this->email->initialize($config);
			$this->email->from('cchtechsource+no-reply@gmail.com', 'Techsource Admin');		
			//$list = array('jason.lewis@wolterskluwer.com', 'donny.gore@wolterskluwer.com', 'amy.lyon@wolterskluwer.com', 'cornelia.connolly@wolterskluwer.com');
			//$this->email->to('jason.lewis@wolterskluwer.com');
			$this->email->to($email[0]->email);
			$this->email->subject("Open New Customer Calls for $fullName");
		   	$this->load->model('CustomerModel', 'customer');
			$data['data'] = $this->customer->getOpenCustomersUser($fullName);						
			
			$data['title'] = 'userEmailTemplate';
			//$data['content'] = 'userEmailTemplate';
			//$this->load->view('include/template.php', $data);
			$email = $this->load->view('userEmailTemplate', $data, TRUE);	
		
			$this->email->message($email);  
	
			$this->email->send();
        }
		
		function sendAllUserEmail()
		{
			$this->load->model('UserModel', 'users');                    
			$userData = $this->users->getActiveUsers();
			
			foreach($userData as $key)
			{
				$this->sendUserEmail($key->fullname);							
			}
		}
        
        
              
        
}
?>