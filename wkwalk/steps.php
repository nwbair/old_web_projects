<?php
// include required classes and configs 
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/dbcon.php';

// Clean post variables before using in SQL query.
$email = cleanInput($_SESSION['email']);
$cleanID = cleanInput($_SESSION['userid']);
$teamid = cleanInput($_SESSION['teamid']);


// Define the SQL query to get the user ID. Use cleaned variables.
$sql = 'Select * from steps where userid = "' . $cleanID . '" ORDER BY timestamp DESC' ;
$result = mysql_query($sql);
$calcTotal = array();

?>

<div id="addsteps">
	<h1>Track Your Steps!</h1>
	<form name="addsteps" action="index.php?steps" method="POST">
		<p>
			<label for="steps">Step Count: </label> 
			<input type="text" id="stepcount" name="stepcount" class="input" />
		</p>		
		<p>
			<input type="hidden" name="addsteps" value="1" />
			<input type="submit" value="Add Steps!" class="button" />
		</p>
	</form> 
</div>

<table id="datatable">
    <thead>
    	<tr>
        	<th scope="col">Date of last Entry</th>
            <th scope="col">Steps Taken</th>
			<th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
<?php

while($row = mysql_fetch_array($result)) {
	// date_default_timezone_set('America/Chicago');
	$timestamp = date("M j, Y, g:i a", $row['timestamp']);
	
	echo '<tr><td>' . $timestamp . '</td>';
	echo '<td>' . $row['stepcount'] . '</td>';
	echo '<td> <a href="index.php?steps&action=d&v=' . $row['stepid'] . '">X Delete</a> </td></tr>';
	
	$calcTotal[] = $row['stepcount'];
}

?>
	<tr>
	<td>Total Steps:</td>
	<td><?php echo array_sum($calcTotal); ?></td>
	</tr>
    </tbody>
</table>

<?php


/**
 * Checks to see if we are registering the team and then executes the team registration.
*/
if (isset($_POST['addsteps'])) {

	$cleanSteps = cleanInput($_POST['stepcount']);

	if (!eregi("[0-9]+", $cleanSteps)) {
		redirect('index.php?steps&error=5');
	} else {
	
		unset ($_POST['addsteps']);
	
		$timestamp = time();
		$stepcount = cleanInput($_POST['stepcount']);

		$sql = "INSERT INTO steps (stepcount, userid, teamid, timestamp) VALUES('$stepcount', '$cleanID', '$teamid', '$timestamp')";	
		
		$result = mysql_query($sql);
		
		if ($result) {
			redirect('index.php?steps');
		} else {
			redirect('index.php?error=2');
		}
	}		
}

if(isset($_GET['action'])) {
	switch ($_GET['action']) {
		case d:
			$sql = 'DELETE from steps where stepid = "' . $_GET['v'] . '"';
			$result = mysql_query($sql);
				if ($result) {
				redirect('index.php?steps');
			} else {
				redirect('index.php?error=2');
			}
			break;
	}
			
}

?>