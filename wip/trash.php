<?php

if (!isset($_SESSION['email']) && !isset($_POST['login_email'])) {
    // if no data, print the form
?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
		Email: <input type="text" name="login_email" />
		Password: <input type="password" name="login_password" />
		<input type="hidden" name="letmein" value="yup" />
		<input type="submit" value="Login" />
	</form>
<?php
}
else if (!isset($_SESSION['email']) && isset($_POST['login_email'])) {
    // if a session does not exist but the form has been submitted
    // check to see if the form has all required values
    // create a new session
    if (!empty($_POST['login_email'])) {
        $_SESSION['email'] = $_POST['login_email'];
        $_SESSION['start'] = time();
        echo "Welcome, " . $_POST['login_email'] . ". A new session has been activated for you. Click <a href=" . $_SERVER['PHP_SELF'] . ">here</a> to refresh the page.";
    }
    else {
        echo "ERROR: Please enter your name!";
    }
}
else if (isset($_SESSION['email'])) {
    // if a previous session exists
    // calculate elapsed time since session start and now
    echo "Welcome back, " . $_SESSION['email'] . ". This session was activated " . round((time() - $_SESSION['start']) / 60) . " minute(s) ago. Click <a href=" . $_SERVER['PHP_SELF'] . ">here</a> to refresh the page.";
} 



/*

if (!isset($_SESSION['email']) && !isset($_POST['login_email'])) {
    // if no data, print the form
?>
	<form method="post" action="login.php">
		Email: <input type="text" name="login_email" />
		Password: <input type="password" name="login_password" />
		<input type="hidden" name="letmein" value="yup" />
		<input type="submit" value="Login" />
	</form>
<?php
}
else if (!isset($_SESSION['email']) && isset($_POST['login_email'])) {
    // if a session does not exist but the form has been submitted
    // check to see if the form has all required values
    // create a new session
    if (!empty($_POST['login_email'])) {
        $_SESSION['email'] = $_POST['login_email'];
        $_SESSION['start'] = time();
        echo "Welcome, " . $_POST['login_email'] . ". A new session has been activated for you. Click <a href=" . $_SERVER['PHP_SELF'] . ">here</a> to refresh the page.";
    }
    else {
        echo "ERROR: Please enter your name!";
    }
}
else if (isset($_SESSION['email'])) {
    // if a previous session exists
    // calculate elapsed time since session start and now
    echo "Welcome back, " . $_SESSION['email'] . ". This session was activated " . round((time() - $_SESSION['start']) / 60) . " minute(s) ago. Click <a href=" . $_SERVER['PHP_SELF'] . ">here</a> to refresh the page. <br />";
	echo "Session ID: " . session_id() . "<br />";
	echo "<a href='" . $_SERVER['PHP_SELF'] . "?logout'>Logout</a>";
} 

/**
 * Check to see if the logout variable has been passed.
 *
*/

/*
# Checks for Form submission.
if (isset($_POST['letmein'])) {	
	
	# Define the SQL query to get the user ID.
	$sql = 'Select * from users where email = "' . $_POST['login_email'] . '" and password = "' . md5($_POST['login_password']) . '"';
	$result = $ConnectToDb->query($sql);

	# Debug Feature
	If (DEBUG_MODE == 'on') {
		echo ' || DEBUG:: Form submission is successful. :: letmein=' . $_POST['letmein'] . ' :: Users found=' . $result->size() . ' :: ';
		while ($row = $result->fetch()) {
			echo $row['email'];
		}	
	}
	
} else {

	# Debug Feature
	If (DEBUG_MODE == 'on') {
		echo 'For has not been submitted. :: letmein: ' . $_POST['letmein'];
	}
	
}
*/




?>