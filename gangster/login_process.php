<?php

include ('inc/base.php'); // Contains the database information.

/*
 * Checks to see if the email and password is POST variables are set.
 * If they are then we are going to query the database for the user.
 */
if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = $db->escape_string($_POST['email']);
	$password = md5($db->escape_string($_POST['password']));
	$sql = "SELECT * FROM users WHERE email = '$email' and password='$password'";
	if(!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

	/* 
	 * If there is a result then set the SESSION variables.
	 */
	if($result->num_rows == 1) {
		while($row = $result->fetch_assoc()) {
			$_SESSION['loggedin'] = 'sye';
			$_SESSION['user'] = $row['email'];
		}
	}
	
	/*
	 * Checks if the Remember Me checkbox was checked when the form 
	 * was submitted. If it is, then set a cookie with the user's 
	 * email. If it is not set, then disolve the cookie.
	 */
	if($_POST['remember-me']) {
		$year = time() + 31536000;
		setcookie('remember_me', $_SESSION['user'], $year);
	}
	elseif(!$_POST['remember-me']) {
		if(isset($_COOKIE['remember_me'])) {
			$past = time() - 3600;
			setcookie('remember_me', "", $past);
		}
	}
	
	header('Location: index.php'); // redirect after successful login.
}

?>