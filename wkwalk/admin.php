<?php
// Start the session
session_start();

// include required classes and configs 
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/dbcon.php';

// Checks to see if the auth and real variable have been set for SESSION from the login page.
if (isset($_SESSION['auth']) && isset($_SESSION['real']) && $_SESSION['level'] == '9') {

	require 'includes/header.php';
?>
<div id="nav">
<ul>
	<li><a href="index.php">Home</a></li>
	<li><a href="admin.php?regteam">Register Team</a></li>
	<li class="last"><a href="index.php?logout_action">Logout</a></li>
</ul>
</div>
<?php
// Checks to see if we have an error code passed to index.php and then passes
// to the correct case.
if(isset($_GET['error'])) {
	switch ($_GET['error']) {
		case 1:
			echo '<div id="error">';
			echo 'Incorrect login information. Please check your information and try again.';
			echo '</div>';
			break;
		case 2:
			echo '<div id="error">';
			echo 'Database update failed.';
			echo '</div>';
			break;
		case 3:
			echo '<div id="error">';
			echo 'Invalid data.';
			echo '</div>';
			break;
	}

}

if(isset($_GET['code'])) {
	switch ($_GET['code']) {
		case 1:
			echo 'Registration Successful.';
			break;
	}
}


	if (isset($_GET['regteam'])) {
	
	// Define the SQL query to get the user ID. Use cleaned variables.
	$sql = 'Select * from team ORDER BY timestamp DESC' ;
	$result = mysql_query($sql);
?>
<div id="regteam">
	<h1>Register a Team</h1>
	<form name="regteam" action="admin.php?regteam" method="POST">
		<p>
			<label for="teamname">Team Name</label> 
			<input type="text" id="teamname" name="teamname" class="input" />
		</p>
		<p>
			<input type="hidden" name="regteam" value="1" />
			<input type="submit" value="Add Team" class="button" />
		</p>
	</form> 
</div>

<table id="datatable">
    <thead>
    	<tr>
        	<th scope="col">Registered Date</th>
            <th scope="col">Team Name</th>
			<th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
<?php

while($row = mysql_fetch_array($result)) {
	// date_default_timezone_set('America/Chicago');
	$timestamp = date("M j, Y, g:i a", $row['timestamp']);
	
	echo '<tr><td>' . $timestamp . '</td>';
	echo '<td>' . $row['teamname'] . '</td>';
	echo '<td> <a href="admin.php?action=d&v=' . $row['teamid'] . '">X Delete</a> </td></tr>';

}

?>
    </tbody>
</table>

<?php

	}
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
	header("Location: index.php");		
}

/**
 * Checks to see if we are registering the team and then executes the team registration.
*/
if (isset($_POST['regteam'])) {
	
		unset ($_POST['regteam']);
		
		$timestamp = time();
		$teamname= cleanInput($_POST['teamname']);

		$sql = "INSERT INTO team (teamname, timestamp) VALUES('$teamname', '$timestamp')";	
		
		$result = mysql_query($sql);
		
		if ($result) {
			redirect('admin.php?regteam');
		} else {
			redirect('index.php?error=2');
		}		
}

if(isset($_GET['action'])) {
	switch ($_GET['action']) {
		case d:
			$sql = 'DELETE from team where teamid = "' . $_GET['v'] . '"';
			$result = mysql_query($sql);
				if ($result) {
				redirect('admin.php?regteam');
			} else {
				redirect('index.php?error=2');
			}
			break;
	}
			
}

?>