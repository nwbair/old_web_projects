<?php
// Start the session.
session_start();

// include required classes and configs 
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/dbcon.php';

// Checks if email and password have a value. If not, then pass error code 1 back to index.php.
if (isset($_POST['login_email']) && isset($_POST['login_password'])) {
	// Clean post variables before using in SQL query.
	$email = cleanInput($_POST['login_email']);
	$password = cleanInput($_POST['login_password']);
	
		// Define the SQL query to get the user ID. Use cleaned variables.
	$sql = 'Select * from users where email = "' . $email . '" and password = "' . md5($password) . '"';
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	
	// Checks that we get just a single result back and sets Session variables.
	if (mysql_num_rows($result) == '1') {
		$_SESSION['auth'] = 'yes';
		$_SESSION['level'] = $row['userlevel'];
		$_SESSION['real'] = '12345';
		$_SESSION['userid'] = $row['userid'];
		$_SESSION['teamid'] = $row['team'];
		$_SESSION['email'] = $email;
		$_SESSION['firstname'] = $row['firstname'] ;
		redirect('index.php');
	} else {
		// Passes error code 1 back to index.php
		redirect('index.php?error=1');
	}
	
} else {
	// Passes error code 1 back to index.php
	redirect('index.php?error=1');
}
?>