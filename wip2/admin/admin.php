<?php
// Start the session
session_start();

// include required classes and configs 
require_once '../config.php';
require_once '../core/class.mysql.php';
require_once '../core/class.session.php';
require_once '../includes/functions.php';

// Connect to MySql
$db = &new MySql($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

// Checks to see if the auth and real variable have been set for SESSION from the login page.
if (isset($_SESSION['auth']) && isset($_SESSION['real']) && $_SESSION['level'] == '9') {

require ('includes/admin_header.php');

// This is the code that calls the different pages in and out of the main app.
if(isset($_GET['counties'])) {
	require 'includes/admin_counties.php';
} else if (isset($_GET['users'])) {
	require 'includes/admin_users.php';
} else if (isset($_GET['manage'])) {
	require 'includes/admin_manage.php';
} else if (isset($_GET['notifylist'])) {
	require 'includes/admin_notifylist.php';
} else if (isset($_GET['notifications'])) {
	require 'includes/admin_notifications.php';
} else if (isset($_GET['statistics'])) {
	require 'includes/admin_statistics.php';
} else if (isset($_GET['settings'])) {
	require 'includes/admin_settings.php';
} else {
	require 'includes/admin_dashboard.php';
}

require ('includes/admin_sidebar.php');
require ('includes/admin_footer.php');

	
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
	
			header("Location: ../index.php");		
}




?>