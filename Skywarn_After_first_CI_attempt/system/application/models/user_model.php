<?php
/**
 * User_Model
 *
 * @package Users
 */

class User_Model extends Model
{

    /** Utility Methods **/
    function _required($required, $data)
    {
        foreach ($required as $field)
            if (!isset($data[$field])) return false;

        return true;
    }

    function _default($defaults, $options)
    {
        return array_merge($defaults, $options);
    }

    /** User Methods **/
    
    /**
     * AddUser method creates a record in the users table
     *
     * Options: Values
     * --------------
     * userid
     * email
     * password
     * userType
     * userStatus
     *
     * @param array $options
     * @result int insert_id()
     */
    function AddUser($options = array())
    {
        // required values
        if(!$this->_required(array('email','password'),$options))
                return false;

        $options = $this->_default(array('userStatus' => 'active'), $options);

        $this->db->insert('users', $options);

        return $this->db->insert_id();
    }

    /**
     * UpdateUser method updates a record in the users table
     *
     * Options: Values
     * --------------
     * userid       required
     * email
     * password
     * userType
     * userStatus
     *
     * @param array $options
     * @return int affected_rows()
     */
    function UpdateUser ($options = array())
    {
        // required values
        if(!$this->_required(array('userid'),$options))
                return false;

        if (isset($options['email']))
            $this->db->set('email', $options['email']);

        if (isset($options['password']))
            $this->db->set('password', md5($options['password']));

        if (isset($options['userType']))
            $this->db->set('userType', $options['userType']);

        if (isset($options['userStatus']))
            $this->db->set('userStatus', $options['userStatus']);

        $this->db->where('userid', $options['userid']);

        $this->db->update('users');

        return $this->db->affected_rows();
    }

    /**
     * GetUsers method returns a qualified list of users from the users table
     *
     * Options: Values
     * ---------------
     * userid
     * email
     * password
     * userType
     * userStatus
     * limit            limit the returned records
     * offset           bypass this many records
     * sortBy           sort by this column
     * sortDirection    (asc, desc)
     *
     * Returned Object (array of)
     * --------------------------
     * userid
     * email
     * password
     * userType
     * userStatus
     *
     * @param array $options
     * @return array of objects
     *
     */
    function GetUsers($options = array())
    {
        // Qualifications
        if(isset($options['userid']))
            $this->db->where('userid', $options['userid']);
        if(isset($options['email']))
            $this->db->where('email', $options['email']);
        if(isset($options['password']))
            $this->db->where('password', $options['password']);
        if(isset($options['userStatus']))
            $this->db->where('userStatus', $options['userStatus']);
        if(isset($options['userType']))
            $this->db->where('userType', $options['userType']);

        // limit / offset
        if (isset($options['limit']) && isset($options['offset']))
            $this->db->limit($options['limit'], $options['offset']);
        else if(isset($options['limit']))
            $this->db->limit($options['limit']);

        // sort
        if (isset($options['sortBy']) && isset($options['sortDirection']))
            $this->db->order_by($options['sortBy'], $options['sortDirection']);

        if(!isset($options['userStatus']))
            $this->db->where('userStatus !=', 'deleted');
        
        $query = $this->db->get("users");

        if(isset($options['count'])) return $query->num_rows();

        if(isset($options['userid']) || isset($options['email']))
            return $query->row(0);

        return $query->result();
    }

    /** authentication methods **/

    /**
     * The login method adds user information from the database to session data.
     *
     * Options: Values
     * ---------------
     * email
     * password
     *
     * @param array $options
     * @return object result()
     */

    function Login($options = array())
    {
        // required values
        if(!$this->_required(array('email', 'password'),$options))
                return false;
        
        $user = $this->GetUsers(array('email' => $options['email'], 'password' => md5($options['password'])));
        if(!$user) return false;

        $this->session->set_userdata('email', $user->email);
        $this->session->set_userdata('userid', $user->userid);
        $this->session->set_userdata('userType', $user->userType);

        return true;
    }

    /**
     * The secure method checks a user's session against the passed parameters to determine if the user has
     * access to a sepcific area.
     *
     * Options: Values
     * ---------------
     * userType
     *
     * @param array @options
     * #return bool
     *
     */
    function Secure($options = array())
    {
        // required values
        if(!$this->_required(array('userType'),$options))
                return false;
        
        $userType = $this->session->userdata('userType');

        if(is_array($options['userType']))
        {
            foreach($options['userType'] as $optionUserType)
            {
                if($optionUserType == $userType) return true;
            }
        }
        else
        {
            if($userType == $options['userType']) return true;
        }

        return false;
    }


}
?>