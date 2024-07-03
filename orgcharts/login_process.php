<?php

include ('inc/base.php');

if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = $db->escape_string($_POST['email']);
	$password = md5($db->escape_string($_POST['password']));
	$sql = "SELECT * FROM users WHERE email = '$email' and password='$password'";
	if(!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

	if($result->num_rows == 1) {
		while($row = $result->fetch_assoc()) {
			$_SESSION['loggedin'] = 'sye';
			$_SESSION['user'] = $row['email'];
		}
	}
	
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
	
	header('Location: index.php');
}