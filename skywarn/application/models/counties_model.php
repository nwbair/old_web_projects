<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of counties_model
 *
 * @author Nick
 */
class Counties_Model extends Model
{
    
    // table name
    private $tbl_counties = 'counties';

    /** Utility Methods **/
    function _required($required, $data)
    {
        foreach($required as $field)
            if(!isset($data[$field])) return false;

        return true;
    }

    function _default($defaults, $options)
    {
        return array_merge($defaults, $options);
    }

    /** County Methods **/

    /**
     * AddCounty method creates a record in the counties table
     *
     * Option: Values
     * --------------
     * countyId
     * countyName
     * statusId
     *
     * @param array $options
     * @result int insert_id()
     */
    function AddCounty($options = array())
    {
            // required values
            if(!$this->_required(
                    array('countyName'),$options)
            ) return false;

            $options = $this->_default(array('statusId' => '1'), $options);

            $this->db->insert('counties', $options);

            return $this->db->insert_id();
    }

    /**
     * GetCounties method returns a qualified list of counties from the counties table
     * 
     * Options: Values
     * ---------------
     * countyId
     * countyName
     * statusId
     * 
     * limit			limit the returned records
     * offset			bypass this many records
     * sortBy			sort by this column
     * sortDirection	(asc, desc)
     * 
     * Returned Object (array of)
     * --------------------------
     * countyId
     * countyName
     * statusId
     * 
     * @param array $options 
     * @return array of objects
     * 
     */
    function GetCounties($options = array())
    {
        // Qualification
        if(isset($options['countyId']))
                $this->db->where('countyId', $options['countyId']);
        if(isset($options['countyName']))
                $this->db->where('countyName', $options['countyName']);
        if(isset($options['statusId']))
                $this->db->where('statusId', $options['statusId']);

        // limit / offset
        if(isset($options['limit']) && isset($options['offset']))
                $this->db->limit($options['limit'], $options['offset']);
        else if(isset($options['limit']))
                $this->db->limit($options['limit']);

        // sort
        if(isset($options['sortBy']) && isset($options['sortDirection']))
                $this->db->order_by($options['sortBy'], $options['sortDirection']);

        if(!isset($options['countyStatus'])) $this->db->where('countyStatus !=','deleted');

        $this->db->join('status', 'status.statusId = counties.statusId');
        
        $query = $this->db->get($this->tbl_counties);
        

        if(isset($options['count'])) return $query->num_rows();

        if(isset($options['countyId']) || isset($options['countyName']))
                return $query->row(0);

        return $query->result();
    }

    /**
     * UpdateCounty method updates a record in the counties table
     *
     * Option: Values
     * --------------
     * countyId			required
     * countyName
     * statusId
     *
     * @param array $options
     * @return int affected_rows()
     */
    function UpdateCounty($options = array())
    {
        // required values
        if(!$this->_required(array('countyId'),$options)) return false;

        if(isset($options['countyName']))
                $this->db->set('countyName', $options['countyName']);

        if(isset($options['statusId']))
                $this->db->set('statusId', $options['statusId']);

        if(isset($options['countyStatus']))
                $this->db->set('countyStatus', $options['countyStatus']);

        $this->db->where('countyId', $options['countyId']);

        $this->db->update('counties');

        return $this->db->affected_rows();
    }

}
?>
