<?php

class CustomerModel extends Model {
    
    function CustomerModel() 
    {
        parent::Model();
    }
    
    function getCustomers($name='', $filter='')
    {
        if($name != '')
        {
            $this->db->where('AssignedTo', $name);
        }
        if($filter != '')
        {
            $this->db->where('Called', $filter);
        }        
                
        $query = $this->db->get('tax');        
        return $query->result();
    }
	
	function getUnassignedCustomers()
    {
        $this->db->where('AssignedTo', '');
        $this->db->where('Called', 'F');        
        $query = $this->db->get('tax');        
        return $query->result();
    }        
    
    function getOpenCustomersUser($name)
    {
        $this->db->where('AssignedTo', $name);
        $this->db->where('Called', 'F');        
        $query = $this->db->get('tax');        
        return $query->result();
    }
	
	function getAllOpenCustomers()
    {
        $this->db->where('DateAssigned <>', '0000-00-00');
        $this->db->where('Called', 'F');        
        $query = $this->db->get('tax');        
        return $query->result();
    }
    
    function getClosedCustomersUser($name)
    {
        $this->db->where('AssignedTo', $name);
        $this->db->where('DateCalled <>', '0000-00-00');        
        $this->db->order_by('DateCalled', 'DESC');
        $query = $this->db->get('tax');        
        return $query->result();
    }
	
	function getClosedCustomersTickets()
    {
        $this->db->where('ticketnum <>', '');
        $this->db->where('DateCalled <>', '0000-00-00');        
        $this->db->order_by('DateCalled', 'DESC');
        $query = $this->db->get('tax');        
        return $query->result();
    }
	
	function getClosedCustomersTickets7Days()
    {
        $this->db->where('ticketnum <>', '');
        $day = date('d')-7;
		$dateMinus7 = date('Y-m-'.$day);        
        $this->db->where('DateCalled >', $dateMinus7);       
        $this->db->order_by('DateCalled', 'DESC');
        $query = $this->db->get('tax');        
        return $query->result();
    }
	
	function getClosedCustomersTickets30Days()
    {
        $this->db->where('ticketnum <>', '');
		$month = date('m')-1;
		$dateMinus30 = date('Y-'.$month.'-d');
        $this->db->where('DateCalled >', $dateMinus30);        
        $this->db->order_by('DateCalled', 'DESC');
        $query = $this->db->get('tax');        
        return $query->result();
    }
	
	function getAllClosedCustomers()
    {
        $this->db->where('DateCalled <>', '0000-00-00');        
        $this->db->order_by('DateCalled', 'DESC');
        $query = $this->db->get('tax');        
        return $query->result();
    }
    
    function updateCustomers($ticket,$id,$who)
    {
        $ticketnum = array('ticketnum' => $ticket, 'WhoCalled' => $who, 'Called' => 'T', 'DateCalled' => $today = date("y.m.d"));
        $this->db->where('id', $id);
        $this->db->update('tax', $ticketnum);             
    }
	
	function logStarTicket($ticket,$id,$who)
    {
        $ticketnum = array('ticketnum' => $ticket, 'WhoCalled' => $who);
        $this->db->where('id', $id);
        $this->db->update('tax', $ticketnum);             
    }
	
	function assignCustomers($custid, $fullname)
    {		
        $ticketnum = array('AssignedTo' => $fullname, 'DateAssigned' => $today = date("y.m.d"));
        $this->db->where('CustID', $custid);
        $this->db->update('tax', $ticketnum);             
    }
    
    
}
?>
