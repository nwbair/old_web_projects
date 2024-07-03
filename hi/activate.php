<?php
/**
 *
 */
include('include/config.php');
include('include/functions.php');
include('include/adodb/adodb.inc.php');
include('templates/navigation.html');

$db = NewADOConnection('mysql');
$db->Connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
        or die("Unable to connect to the database.");

if(isset($_GET['code'])) {
    $code = $_GET['code'];
    $activate = $db->Execute('Select * from user where user_activation_key="' . $code . '"')
            or die("Code Lookup error: $reset. " . $db->ErrorMsg());

    if ($activate->RecordCount() == '1')
    {
        while ($arr = $activate->FetchRow())
        {
            $getUser = $db->Execute('Select * from user where userid="' . $arr['userid'] . '"')
                    or die("User Lookup error: $getUser. " . $db->ErrorMsg());
            
            if ($getUser->RecordCount() == '1')
            {
                while ($user = $getUser->FetchRow())
                {
                    echo 'Your account has been activated.';
                    $update = $db->Execute('Update user
                        SET user_activation_key="", user_status="1"
                        WHERE userid="' . $user['userid'] . '"');
                    $_SESSION = $user['email'];
                    redirect('profile.php');
                }
            }
        }
    }
}