<?php
session_start();
// debug code
// echo"<pre>";print_r($_POST);exit;

// include required classes and configs 
require_once 'config.php';
require_once 'includes/functions.php';
require_once 'core/class.mysql.php';

// Connect to MySql
$db = &new MySql($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

/**
 * Checks to see if we are updating the profile and then executes the profile update.
*/
 if (isset($_POST['update_profile'])) {
	unset($_POST['update_profile']);
	unset ($_POST['email']);
	
	// cleans the email variable.
	$clean_email = cleanInput($_SESSION['email']);
	
		// loops through the _POST values and associates the post key and value to update the database.
		foreach($_POST as $key => $value) {
		
			$clean_key = htmlspecialchars($key);
			$clean_value = htmlspecialchars($value);

			$update[] = $clean_key . "=" . '"' .$clean_value . '"';
		}
	
		
	$sql = "UPDATE users SET ". implode(',',$update) . " WHERE email='".$clean_email."'";			
	$db->query($sql);
	
	if (!$db->isError()) {
		redirect('index.php?profile');
	} else {
		redirect('index.php?error=2');
	}
}

/**
 * Checks to see if we are registering the profile and then executes the profile registration.
*/
if (isset($_POST['register'])) {
	unset($_POST['register']);

	foreach ($_POST as $key => $value) {
		$clean_key = htmlspecialchars($key);
		$clean_value = htmlspecialchars($value);
		$keys[] = $clean_key;
		$values[] = '"'.$clean_value.'"';
	}
	
	$sql = "INSERT INTO pending_users (".implode(',',$keys).") VALUES(".implode(',',$values).")";
	$db->query($sql);
	
	if (!$db->isError()) {
		redirect('index.php?register');
	} else {
		redirect('index.php?error=3');
	}
			
}

?>