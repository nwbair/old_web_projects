<?php
/**
 *
 */
include('include/config.php');
include('include/adodb/adodb.inc.php');
include('include/functions.php');
include('templates/navigation.html');

$db = NewADOConnection('mysql');
$db->Connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
        or die("Unable to connect to the database.");

/**
 * Checks the link passed to passwordreset for a code. If the code is set
 * then pull the user ID and bring up a password reset option. 
 */
if(isset($_GET['code'])) {
    $code = $_GET['code'];
    $reset = $db->Execute('Select * from ForgotPassword where PasswordCode="' . $code . '"')
            or die("Code Lookup error: $reset. " . $db->ErrorMsg());

    if ($reset->RecordCount() == '1')
    {
        while ($arr = $reset->FetchRow())
        {
            $userid = $arr['UserId'];
            $getUser = $db->Execute('Select * from user where userid="' . $userid . '"')
                    or die("User Lookup error: $getUser. " . $db->ErrorMsg());

            if ($getUser->RecordCount() == '1')
            {
                while ($user = $getUser->FetchRow())
                {
                    include('templates/PasswordResetForm.html');
                }
            }
        }
    }
}

if (isset($_POST['reset_email']) && isset($_POST['reset_password']))
{
    $email = cleanInput($_POST['reset_email']);
    $password = cleanInput($_POST['reset_password']);
    $userid = cleanInput($_POST['reset_id']);
    
    $updatePassword = $db->Execute('Update user SET password="' . md5($password) . '"
        , user_status=1 WHERE email="' . $email . '"')
            or die("Password reset failed: $updatePassword. " . $db->ErrorMsg());

    $updateForgotPassword = $db->Execute('DELETE from ForgotPassword where UserId="' . $userid
            . '"') or die("Code removal failed: $updateForgotPassword. " . $db->ErrorMsg());

    redirect('index.php');
}