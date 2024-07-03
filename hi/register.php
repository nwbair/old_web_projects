<?php

include('include/config.php');
include('include/adodb/adodb.inc.php');
include('include/functions.php');
include('templates/navigation.html');
include('templates/RegisterForm.html');

// Create a new DB Connection using ADODB.
$db = NewADOConnection('mysql');
$db->Connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

// Check to see if the form has been submitted for registration.
// If it has, then submit the registration. If Not, then display
// registration page.
if ($_POST['register_action'] == 1) {
	$_POST['password'] = md5($_POST['password1']);
	$_POST['password1'] = md5($_POST['password1']);
	$_POST['password2'] = md5($_POST['password2']);
        $_POST['user_registered'] = createTimeStamp();

	unset($_POST['password1']);
	unset($_POST['password2']);
	unset($_POST['register_action']);

        /**
         * Assign the values that will be inserted into the user table in the
         * database. Use one value per line. 
         */
        $timestamp = createTimeStamp();
        $userValues = "'" . $_POST['email'] . "',";
        $userValues .= "'" . $_POST['password'] . "',";
        $userValues .= "'" . $timestamp . "',";
        $userValues .= "'" . md5($_POST['email'] . $timestamp) . "',";
        $userValues .= "'0',";
        $userValues .= "'" . $_POST['firstname'] . " " . $_POST['lastname'] . "'";
        
        $newUser = "insert into user(email, password, user_registered,
            user_activation_key, user_status, display_name) values($userValues)";

	if ($db->Execute($newUser) === false) {
		print 'error inserting: ' . $db->ErrorMsg() . ' <br />';
	} else {
            $id = $db->Insert_ID();

            // default blank values for a new user before
            // the profile is updated.
            $meta = array(  "First Name"    => "",
                            "Last Name"     => "",
                            "Address 1"     => "",
                            "Address 2"     => "",
                            "City"          => "",
                            "State"         => "",
                            "Zip Code"      => "",
                            "Phone Number"  => "");


            // Insert the array information
            foreach ($meta as $key=>$value)
            {
                $userMeta = $db->Execute("insert into usermeta(user_id, meta_key, meta_value)
                    values($id, '" . $key . "', '" . $value . "')");
            }

            // Set the First Login value to No until the account
            // has been activated.
            $firstTime = $db->Execute("insert into usermeta(user_id, meta_key, meta_value)
            values($id, 'First Login', 'No')");
            
            // @todo temporary email process. Clean this up.
            $message = "Click the link to activate your password: http://dev.almostlabs.com/hi/activate.php?code=";
            $message .= md5($_POST['email'] . $timestamp);

            mail($_POST['email'], 'Activate account', $message);
        }


} else {
	echo 'No information has been entered.';
}