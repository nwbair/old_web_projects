<?php
// Start the session.
session_start();

// include required classes and configs 
require_once 'config.php';
require_once 'includes/functions.php';
require_once 'core/class.mysql.php';

// Connect to MySql
$db = &new MySql($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

// Checks if email and password have a value. If not, then pass error code 1 back to index.php.
if (isset($_POST['login_email']) && isset($_POST['login_password'])) {
	// Clean post variables before using in SQL query.
	$email = cleanInput($_POST['login_email']);
	$password = cleanInput($_POST['login_password']);
	
		// Define the SQL query to get the user ID. Use cleaned variables.
	$sql = 'Select * from users where email = "' . $email . '" and password = "' . md5($password) . '"';
	$result = $db->query($sql);
	$row = $result->fetch();
	
	// Checks that we get just a single result back and sets Session variables.
	if ($result->size() == '1') {
		$_SESSION['auth'] = 'yes';
		$_SESSION['level'] = '9';
		$_SESSION['real'] = '12345';
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