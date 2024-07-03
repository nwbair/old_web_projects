<?php

class ReportModel extends Model {
    
    function ReportModel() 
    {
        parent::Model();
    }
    
    function getClosedCustomersReport($user, $dateStart, $dateEnd)
    {
        $this->db->where('Called', 'T');
        $this->db->where('AssignedTo', $user);
        $this->db->where('DateCalled >', $dateStart);
        $this->db->where('DateCalled <', $dateEnd);
        $query = $this->db->get('tax');        
        return $query->result();
    }        
    
}
?>
