<?php
// Start the session
session_start();

// include required classes and configs 
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/dbcon.php';

/***************************************************
*		Page Construction
****************************************************/		
require 'includes/header.php';
// Checks to see if the auth and real variable have been set for SESSION from the login page.
if (isset($_SESSION['auth']) && isset($_SESSION['real'])) {
	// Welcome the user and display the navigation links.
	$_SESSION['loggedin'] = 'yes';
	require 'includes/nav.php';
} else {
	if (!isset($_GET['register'])) {
		require 'includes/login_form.php';		
	}
}

/***************************************************
*		Deal with errors and codes
****************************************************/

if(isset($_GET['code'])) {
	switch ($_GET['code']) {
		case 1:
			echo '<div id="message">';
			echo 'Registration Successful. Please login!';
			echo '</div>';
			break;
	}
}

// Checks to see if we have an error code passed to index.php and then passes
// to the correct case.
if(isset($_GET['error'])) {
	switch ($_GET['error']) {
		case 1:
			echo 'Incorrect login information. Please check your information and try again.';
			break;
		case 2:
			echo '<div id="error">';
			echo 'Database update failed.';
			echo '</div>';
			break;
		case 3:
			echo '<div id="error">';
			echo 'Invalid registration data.';
			echo '</div>';
			break;
		case 4:
			echo '<div id="error">';
			echo 'Email address is already used.';
			echo '</div>';
			break;
		case 5:
			echo '<div id="error">';
			echo 'Invalid data.';
			echo '</div>';
			break;
	}
}

// This is the code that calls the different pages in and out of the main app.
if(isset($_GET['profile'])) {
	require 'profile.php';
} else if (isset($_GET['register'])) {
	require 'register.php';
} else if (isset($_GET['steps'])) {
	require 'steps.php';
} else {
	require 'home.php';
}

require 'includes/footer.php';


/***************************************************
*		Deal with variables
****************************************************/

if(isset($_GET['refreshed'])) {
	if($_GET['refreshed'] == '1') {
		$_SESSION['refreshed'] = '1';
	}
}

// Executes the logout action, clears the session and destroys it.
if(isset($_GET['logout_action'])) {
	session_unset();
	session_destroy();
	redirect('index.php');
}

// Executes the login.
if(isset($_GET['login'])) { 
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
			$_SESSION['level'] = '9';
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
}


?>