<?php
// Start the session
session_start();

// include required classes and configs 
require_once 'config.php';
require_once 'core/class.mysql.php';
require_once 'core/class.session.php';
require_once 'includes/functions.php';

// add the HTML header file
require 'includes/header.php';

// Connect to MySql
$db = &new MySql($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

// Checks to see if the auth and real variable have been set for SESSION from the login page.
if (isset($_SESSION['auth']) && isset($_SESSION['real'])) {
	// Welcome the user and display the navigation links.
	echo "Welcome " . $_SESSION['firstname'];	
	require 'includes/nav.php';
	
	/* Delete me maybe
		// Checks user level.
		if($_SESSION['level'] == '9') {
			echo "Welcome Admin <br />";
			include 'includes/nav.php';
		} else {
			include 'includes/nav.php';
		}
	*/
	} else {	
			require 'includes/login_form.php';			
}

// Checks to see if we have an error code passed to index.php and then passes
// to the correct case.
if(isset($_GET['error'])) {
	switch ($_GET['error']) {
		case 1:
			echo 'Incorrect login information. Please check your information and try again.';
			break;
		case 2:
			echo 'Database update failed.';
			break;
	}
}

// Executes the logout action, clears the session and destroys it.
if(isset($_GET['logout_action'])) {
	session_unset();
	session_destroy();
	redirect('index.php');
}

// This is the code that calls the different pages in and out of the main app.
if(isset($_GET['profile'])) {
	require 'profile.php';
} else if (isset($_GET['register'])) {
	require 'register.php';
} else {
	require 'show_counties.php';
}

// FOOTER
require 'includes/footer.php';

?>