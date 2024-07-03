<?php
session_start();
// debug code
// echo"<pre>";print_r($_POST);exit;

// include required classes and configs 
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/dbcon.php';

/**
 * Checks to see if we are updating the profile and then executes the profile update.
*/
 if (isset($_POST['update_profile'])) {
	unset ($_POST['update_profile']);
	unset ($_POST['email']);
	unset ($_POST['password']);
	unset ($_POST['password2']);
	unset ($_SESSION['firstname']);
	unset ($_SESSION['teamid']);
	
	// cleans the email variable.
	$clean_email = cleanInput($_SESSION['email']);
	
		// loops through the _POST values and associates the post key and value to update the database.
		foreach($_POST as $key => $value) {
		
			$clean_key = htmlspecialchars($key);
			$clean_value = htmlspecialchars($value);

			$update[] = $clean_key . "=" . '"' .$clean_value . '"';
		}

	$sql = "UPDATE users SET ". implode(',',$update) . " WHERE email='".$clean_email."'";	
	$result = mysql_query($sql);
	
	if ($result) {
		$_SESSION['firstname'] = $_POST['firstname'];
		$_SESSION['teamid'] = $_POST['team'];
		redirect('index.php?profile');
	} else {
		redirect('index.php?error=2');
	}
	
}

/**
 * Checks to see if we are registering the profile and then executes the profile registration.
*/
if (isset($_POST['register'])) {
	
	$cleanEmail = cleanInput($_POST['email']);
	$cleanPassword = cleanInput($_POST['password']);
	$cleanPassword2 = cleanInput($_POST['password2']);
	$cleanFirstname = cleanInput($_POST['firstname']);
	$cleanLastname = cleanInput($_POST['lastname']);
	$cleanDepartment = cleanInput($_POST['department']);
	$cleanGender = cleanInput($_POST['gender']);
	$cleanYmca = cleanInput($_POST['ymca']);
	
	// Is this a valid email pattern?
	if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $cleanEmail)){
		redirect('index.php?register&error=3');
	}else{	
		$emailchk = 'passed';
	}

	
	// Matches validation password.
	if ($cleanPassword != $cleanPassword2) {
		redirect('index.php?register&error=3');
	}else{
		$passchk = 'passed';
	}
	
	if (!eregi("[a-zA-Z .-]+", $cleanFirstname)) {
		redirect('index.php?register&error=3');
	} else {
		$firstnamechk = 'passed';
	}

	if (!eregi("[a-zA-Z .-]+", $cleanLastname)) {
		redirect('index.php?register&error=3');
	} else {
		$lastnamechk = 'passed';
	}
	
	if (!eregi("[a-zA-Z .-]+", $cleanDepartment)) {
		redirect('index.php?register&error=3');
	} else {
		$departmentchk = 'passed';
	}

	if (!eregi("[a-zA-Z]+", $cleanGender)) {
		redirect('index.php?register&error=3');
	} else {
		$genderchk = 'passed';
	}

	if (!eregi("[a-zA-Z]+", $cleanYmca)) {
		redirect('index.php?register&error=3');
	} else {
		$ymcachk = 'passed';
	}	
	
	// Once all checks are passed, execute registration
	if($emailchk == 'passed' && $passchk == 'passed' && $firstnamechk == 'passed' && $lastnamechk == 'passed'
	   && $departmentchk == 'passed' && $genderchk == 'passed' && $ymcachk == 'passed') {
	
		$sql = 'Select * from users where email = "' . $cleanEmail . '"';
		$result = mysql_query($sql);
		
		if(mysql_num_rows($result) == '1') {
			redirect('index.php?register&error=4');
		} else {
		
			unset($_POST['register']);
			unset($_POST['password2']);

			foreach ($_POST as $key => $value) {
				$clean_key = htmlspecialchars($key);
				$clean_value = htmlspecialchars($value);
				if ($clean_key == "password") {
					$clean_value = md5($clean_value);
				}
				$keys[] = $clean_key;
				$values[] = '"'.$clean_value.'"';
			}
			
			$sql = "INSERT INTO users (".implode(',',$keys).") VALUES(".implode(',',$values).")";
			$result = mysql_query($sql);
			
			if ($result) {
				redirect('index.php?code=1');
			} else {
				redirect('index.php?error=3');
			}
		}
	}
}
?>