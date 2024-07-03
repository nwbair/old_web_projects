<?php

class Reports extends Controller {

	function Reports()
	{
		parent::Controller();
		$this->load->model('UserModel', 'users');                    
		$data['users'] = $this->users->getActiveUsers();	
	}
	
	function index()
	{
            $this->load->view('report_all');
    }
	
	function reportUnassigned()
	{
		$this->load->plugin('to_excel');		
		$this->db->select('custID, FirmName');
		$this->db->where('AssignedTo', '');
        $this->db->where('Called', 'F');		
		$query = $this->db->get('tax');
		to_excel($query, "UnassignedCustomers"); // filename is optional, without it, the plugin will default to 'exceloutput' 		
	}
	
	function reportAllClosed()
	{
		$this->load->plugin('to_excel');		
		$this->db->select('DateAdded, custID, FirmName, DateAssigned, DateCalled, WhoCalled, ticketnum');
        $this->db->where('DateCalled <>', '0000-00-00');        
        $this->db->order_by('DateCalled', 'DESC');
        $query = $this->db->get('tax');
		to_excel($query, "AllClosed");        
    
	}
	
	function reportClosedWithTicket()
	{
		$this->load->plugin('to_excel');		
		$this->db->select('DateAdded, custID, FirmName, DateAssigned, DateCalled, WhoCalled, ticketnum');
		$this->db->where('ticketnum <>', '');
		$this->db->where('ticketnum <>', 'Existing Customer');
        $this->db->where('DateCalled <>', '0000-00-00');        
        $this->db->order_by('DateCalled', 'DESC');
        $query = $this->db->get('tax');
		to_excel($query, "ClosedWithTicket");        
    
	}
	
	function reportClosedWithLast24Hours()
	{
		$this->load->plugin('to_excel');		
		$this->db->select('DateAdded, custID, FirmName, DateAssigned, DateCalled, WhoCalled, ticketnum');
		$dateDay = date('d') - 1;
        $this->db->where('DateCalled >', date('Y-m-').$dateDay);        
        $this->db->order_by('DateCalled', 'DESC');
        $query = $this->db->get('tax');
		to_excel($query, "Closed Last 24 Hours");        
    
	}
	
	function reportClosedWithLast7Days()
	{
		$this->load->plugin('to_excel');		
		$this->db->select('DateAdded, custID, FirmName, DateAssigned, DateCalled, WhoCalled, ticketnum');
        $this->db->where('DateCalled <', date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")-7, date("Y"))));        
        $this->db->order_by('DateCalled', 'DESC');
        $query = $this->db->get('tax');
		to_excel($query, "Closed Last 7 Days");        
    
	}
	
	function reportClosedsinceFirstofMonth()
	{
		$this->load->plugin('to_excel');		
		$this->db->select('DateAdded, custID, FirmName, DateAssigned, DateCalled, WhoCalled, ticketnum');
        $this->db->where('DateCalled >', date("Y-m-d", mktime(0, 0, 0, date("m")  , "1", date("Y"))));        
        $this->db->order_by('DateCalled', 'DESC');
        $query = $this->db->get('tax');
		$monthName = date("F");		
		to_excel($query, "Closed Since 1st of $monthName");        
    
	}
	
	function reportClosedsinceMonthNum()
	{
		$this->load->plugin('to_excel');		
		$this->db->select('DateAdded, custID, FirmName, DateAssigned, DateCalled, WhoCalled, ticketnum');
        $this->db->where('DateCalled >', date("Y-m-d", mktime(0, 0, 0, date("m")-3  , "1", date("Y"))));        
        $this->db->order_by('DateCalled', 'DESC');
        $query = $this->db->get('tax');
		$monthName = date("F");		
		to_excel($query, "Closed Since 11/1/2011");        
    
	}
	
	function reportAllOpen()
	{
		$this->load->plugin('to_excel');
		$this->db->select('DateAdded, custID, FirmName, AssignedTo');		
		$this->db->where('DateAssigned <>', '0000-00-00');
        $this->db->where('Called', 'F');        
        $query = $this->db->get('tax');
		//to_excel($query, "AllOpen");
	}
	
	function sendEmailReport()
	{
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
		$list = array('nick.bair@wolterskluwer.com', 'donny.gore@wolterskluwer.com', 'amy.lyon@wolterskluwer.com', 'cornelia.connolly@wolterskluwer.com', 'sarah.wise@wolterskluwer.com', 'steve.janzing@wolterskluwer.com');
		$this->email->to($list);
		//$this->email->to('jason.lewis@gmail.com');
		$this->email->subject('New Customer Weekly Report for '. date('m-d-Y', mktime(0,0,0,date('m'), date('d')-7, date('Y'))). ' through ' . date('m-d-Y'));
		$this->load->model('UserModel', 'users');                    
		$data['users'] = $this->users->getActiveUsers();
		$this->load->model('CustomerModel', 'customer');            
        $data['data'] = $this->customer->getClosedCustomersTickets7Days();
		$email = $this->load->view('7dayreportemail', $data, TRUE);	
		
		$this->email->message($email);  

		$this->email->send();

		
	}
}
?>