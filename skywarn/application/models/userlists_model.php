<?php
/**
 * Description of userlists_model
 *
 * @author Nick
 */
class Userlists_Model extends Model
{

    // table name
    private $tbl_userlist = 'mc_userlists';

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
     * AddUserList method creates a record in the mc_userlists table
     *
     * Option: Values
     * --------------
     * listId
     * listName
     * mcListid
     * description
     *
     * @param array $options
     * @result int insert_id()
     */
    function AddUserList($options = array())
    {
            // required values
            if(!$this->_required(array('listName'),$options)) return false;

            $this->db->insert($this->tbl_userlist, $options);

            return $this->db->insert_id();
    }

    /**
     * GetUserLists method returns a qualified list of userlists from the mc_userlists table
     *
     * Options: Values
     * ---------------
     * listId
     * listName
     * mcListid
     * description
     *
     * limit			limit the returned records
     * offset			bypass this many records
     * sortBy			sort by this column
     * sortDirection	(asc, desc)
     *
     * Returned Object (array of)
     * --------------------------
     * listId
     * listName
     * mcListid
     * description
     *
     * @param array $options
     * @return array of objects
     *
     */
    function GetUserLists($options = array())
    {
        // Qualification
        if(isset($options['listId']))
                $this->db->where('listId', $options['listId']);
        if(isset($options['listName']))
                $this->db->where('listName', $options['listName']);
        if(isset($options['mcListid']))
                $this->db->where('mcListid', $options['mcListid']);
        if(isset($options['description']))
                $this->db->where('description', $options['description']);

        if(!isset($options['userlistStatus'])) $this->db->where('userlistStatus !=','deleted');

        // limit / offset
        if(isset($options['limit']) && isset($options['offset']))
                $this->db->limit($options['limit'], $options['offset']);
        else if(isset($options['limit']))
                $this->db->limit($options['limit']);

        // sort
        if(isset($options['sortBy']) && isset($options['sortDirection']))
                $this->db->order_by($options['sortBy'], $options['sortDirection']);

        $query = $this->db->get($this->tbl_userlist);

        if(isset($options['count'])) return $query->num_rows();

        if(isset($options['listId']) || isset($options['listName']))
                return $query->row(0);

        return $query->result();
    }

    /**
     * UpdateUserList method updates a record in the mc_userlists table
     *
     * Option: Values
     * --------------
     * listId			required
     * listName
     * mcListid
     * description
     *
     * @param array $options
     * @return int affected_rows()
     */
    function UpdateUserList($options = array())
    {
        // required values
        if(!$this->_required(array('listId'),$options)) return false;

        if(isset($options['listName']))
                $this->db->set('listName', $options['listName']);

        if(isset($options['mcListid']))
                $this->db->set('mcListid', $options['mcListid']);

        if(isset($options['userlistStatus']))
                $this->db->set('userlistStatus', $options['userlistStatus']);

        $this->db->where('listId', $options['listId']);

        $this->db->update($this->tbl_userlist);

        return $this->db->affected_rows();
    }

}
?>