<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

include('include/config.php');
include('include/adodb/adodb.inc.php');
include('include/functions.php');
include('templates/navigation.html');

$db = NewADOConnection('mysql');
$db->Connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

if(isset($_SESSION['email'])) {

    $email = $_SESSION['email'];
    
    $user = $db->Execute('Select * from user where email = "' . $email . '"')
            or die("Login error: $login. " . $db->ErrorMsg());    

    if ($user->RecordCount() == '1')
    {
        while ($arr = $user->FetchRow())
        {
            $userid = $arr['userid'];
            $userEmail = $arr['email'];
        }
        
        $userMeta = $db->Execute('Select * from usermeta where user_id="' . $userid
            . '"') or die("Meta failed: $userMeta. " . $db->ErrorMsg());

        while ($userInfo = $userMeta->FetchRow()) 
        {
            $key = $userInfo['meta_key'];
            $value = $userInfo['meta_value'];
            echo $key . " " . $value . "<br />";
                
        }
        
        include('templates/ProfileForm.html');
    }

    if (isset($_POST['update_profile'])) {

        unset($_POST['update_profile']);
        unset($_POST['email']);

        // Insert the array information
        foreach ($_POST as $key=>$value)
        {
            if ($userMeta->RecordCount() > '0')
            {
            $userMetaData = $db->Execute("Update usermeta set " . $key . "='" . $value
                . "' where user_id='" . $userid . "' and meta_key='" . $key . "'");

//            $sql = "Update usermeta set " . $key . "= '" . $value
//                . "' where user_id='" . $userid . "' and meta_key='" . $key . "'";
//            echo $sql . "<br />";

            } else {
                $userMetaData = $db->Execute("insert into usermeta(user_id, meta_key, meta_value)
                    values($userid, '" . $key . "', '" . $value . "')");

//                $sql = "insert into usermeta(user_id, meta_key, meta_value)
//                    values($userid, '" . $key . "', '" . $value . "')";
//                echo $sql . "<br />";
            }
        
        }
    }
}