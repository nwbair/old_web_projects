<?php
// include required classes and configs 
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/dbcon.php';

// Clean post variables before using in SQL query.
$email = cleanInput($_SESSION['email']);
	
// Define the SQL query to get the user ID. Use cleaned variables.
$sql = 'Select * from users where email = "' . $email . '"' ;

$result = mysql_query($sql);
$row = mysql_fetch_array($result);

?>

<div id="profile">
	<h1>Update Your Profile</h1>
	<form name="profile" action="process.php" method="POST">
		<p>
			<label for="Email">Email</label>
			<input type="text" name="email" class="input" value="<?php echo $row['email']; ?>" />
		</p>
		<p>
			<label for="firstname">First Name</label> 
			<input type="text"  name="firstname" class="input" value="<?php echo $row['firstname']; ?>" />
		</p>
		<p>
			<label for="lastname">Last Name</label> 
			<input type="text"  name="lastname" class="input" value="<?php echo $row['lastname']; ?>" />
		</p>
		<p>		
			<label for="department">Department</label> 
			<input type="text"  name="department" class="input" value="<?php echo $row['department']; ?>" />
		</p>
		<p>
			<label for="gender">Gender</label> 
			<input type="text"  name="gender" class="input" value="<?php echo $row['gender']; ?>" />
		</p>
		<p>
			<label for="ymca">YMCA Member?</label> 
			<input type="text"  name="ymca" class="input" value="<?php echo $row['ymca']; ?>" />
		</p>
		<p>
			<input type="hidden" name="update_profile" value="1" />
			<input type="submit" value="Update Information!" class="button" />
		</p>
	</form> 
</div>