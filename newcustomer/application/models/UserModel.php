<?php

class UserModel extends Model {
    
    function UserModel() 
    {
        parent::Model();
    }
        
    function addUser($userInfo) 
    {
        if($this->db->insert('user', $userInfo))
		{
			return True;	
		}
    }
    
    function deleteUser($id) 
    {
        if($this->db->delete('user', array('uid' => $id)))
		{
			return True;
		} 
    }
    
    function changeUserStatus($id, $newStatus) 
    {
		$data = array('active'=> $newStatus);
		$this->db->where('uid', $id);
		$this->db->update('user', $data);
    }
	function getUser($name, $pass) 
    {
	    $this->db->where('loginid', $name); 
        $this->db->where('password', $pass);
		$this->db->where('active', 'T');
		$this->db->limit(1);
        $query = $this->db->get('user');        
        return $query->result(); 
        
    }    
	
	function getUserByID($id) 
    {
	    $this->db->where('uid', $id);
		$this->db->limit(1);
        $query = $this->db->get('user');        
        return $query->result(); 
        
    }
	
	function getUserEmailByName($fullName) 
    {
	    $this->db->where('fullname', $fullName);
		$this->db->select('email');
        $query = $this->db->get('user');        
        return $query->result(); 
        
    }
    
    function getActiveUsers()
    {
        $this->db->where('active', 'T');
        $this->db->where('userLevel', '0');
        $query = $this->db->get('user');
        $data = $query->result();
        $newData = array();
        foreach($data as $row)
        {
            $row->count = $this->getTicketCount($row->fullname);
            array_push($newData, $row);
        }
        return $newData;
        
    }
	
	function getAllUsers()
    {
        $query = $this->db->get('user');
        $data = $query->result();
        $newData = array();
        foreach($data as $row)
        {
            array_push($newData, $row);
        }
        return $newData;
        
    }
    
    function getTicketCount($name)
    {
        $this->db->like('AssignedTo', $name);
        $this->db->like('Called', 'F');
        $this->db->from('tax');
        return $this->db->count_all_results();
    }
    
    
}
?>
