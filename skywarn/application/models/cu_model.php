<?php
/**
 * Description of cu_model
 *
 * @author Nick
 */
class cu_Model extends Model
{

    // table name
    private $tbl_cu = 'county_userlists';

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

    /** User Lists Methods **/

    /**
     * AddUserList method creates a record in the mc_cu table
     *
     * Option: Values
     * --------------
     * cuId
     * listId
     * countyId
     * cuStatus
     *
     * @param array $options
     * @result int insert_id()
     */
    function AddCu($options = array())
    {
            // required values
            if(!$this->_required(array('listId'),$options)) return false;

            $this->db->insert($this->tbl_cu, $options);

            return $this->db->insert_id();
    }

    /**
     * GetCu method returns a qualified list of cu from the county_userlists table
     *
     * Options: Values
     * ---------------
     * cuId
     * listId
     * countyId
     * cuStatus
     *
     * limit			limit the returned records
     * offset			bypass this many records
     * sortBy			sort by this column
     * sortDirection	(asc, desc)
     *
     * Returned Object (array of)
     * --------------------------
     * cuId
     * listId
     * countyId
     * cuStatus
     *
     * @param array $options
     * @return array of objects
     *
     */
    function GetCu($options = array())
    {
        // Qualification
        if(isset($options['cuId']))
                $this->db->where('cuId', $options['cuId']);
        if(isset($options['listId']))
                $this->db->where('listId', $options['listId']);
        if(isset($options['countyId']))
                $this->db->where('countyId', $options['countyId']);

        if(!isset($options['cuStatus'])) $this->db->where('cuStatus !=','deleted');

        // limit / offset
        if(isset($options['limit']) && isset($options['offset']))
                $this->db->limit($options['limit'], $options['offset']);
        else if(isset($options['limit']))
                $this->db->limit($options['limit']);

        // sort
        if(isset($options['sortBy']) && isset($options['sortDirection']))
                $this->db->order_by($options['sortBy'], $options['sortDirection']);

        $this->db->join('counties', 'counties.countyId = county_userlists.countyId');
        $this->db->join('mc_userlists', 'mc_userlists.listId = mc_userlists.listId');

        $query = $this->db->get($this->tbl_cu);

        if(isset($options['count'])) return $query->num_rows();

        if(isset($options['cuId']) || isset($options['listId']))
                return $query->row(0);

        return $query->result();
    }

    /**
     * UpdateCu method updates a record in the county_userlists table
     *
     * Option: Values
     * --------------
     * cuId			required
     * listId
     * countyId
     * cuStatus
     *
     * @param array $options
     * @return int affected_rows()
     */
    function UpdateCu($options = array())
    {
        // required values
        if(!$this->_required(array('cuId'),$options)) return false;

        if(isset($options['listId']))
                $this->db->set('listId', $options['listId']);

        if(isset($options['countyId']))
                $this->db->set('countyId', $options['countyId']);

        if(isset($options['cuStatus']))
                $this->db->set('cuStatus', $options['cuStatus']);

        $this->db->where('cuId', $options['cuId']);

        $this->db->update($this->tbl_cu);

        return $this->db->affected_rows();
    }

}
?>