<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include('include/config.php');
include('include/functions.php');
include('include/adodb/adodb.inc.php');
include('templates/navigation.html');
include('templates/ForgotPasswordForm.html');

// Establish the db connection.
$db = NewADOConnection('mysql');
$db->Connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
        or die("Unable to connect to the database.");

    // Checks to see if the form has been submitted and creates a session.
    if (isset($_POST['login_email'])) {
        // Clean post variables before using in the SQL query.
        $email = cleanInput($_POST['login_email']);
        
        $login = $db->Execute('Select * from user where email = "' . $email . '"')
                or die("Login error: $login. " . $db->ErrorMsg());
        
        if ($login->RecordCount() == '1')
        {
           while ($arr = $login->FetchRow())
           {
               $resetCode = createRandomString();
                // Generate Random verification code
               $code = $db->Execute('INSERT INTO ForgotPassword (UserId, PasswordCode)
                   VALUES ("' . $arr['userid'] . '", "' . $resetCode . '")')
                       or die("Code creation error: $code. " . $db->ErrorMsg());

               $userUpdate = $db->Execute('UPDATE user SET user_status=0 WHERE userid="'
                       . $arr['userid'] . '"') or die("Update User error: $userUpdate" . $db->ErrorMsg());
               
               include('messages/ForgotPasswordConfirm.html');

               $message = "Click the link to reset your password: http://dev.almostlabs.com/hi/passwordreset.php?code=";
               $message .= $resetCode;

               mail($arr['email'], 'Password Reset', $message);
               
           }
        } else {
            // if there is no record found, display this message.
            include('messages/ForgotPasswordFailed.html');
        }

    }