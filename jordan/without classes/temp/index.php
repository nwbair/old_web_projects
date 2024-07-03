<?php
$host = "mysql.nickbair.com";
$user = "bair_jordan";
$pass = "password";
$db = "nickbair_jordan";

mysql_connect($host, $user, $pass) or die(mysql_error());
mysql_select_db($db) or die(mysql_error());


if(isset($_POST['act'])) {
	$activate = ucfirst($_POST['act']);
	mysql_query("UPDATE counties SET status='2' WHERE county = '$activate'");
	$_POST['act'] = "";
}

/* if(isset($_POST['act']) == "all") {
	$activate = ucfirst($_POST['act']);
	mysql_query("UPDATE counties SET status='2'");
	$_POST['act'] = "";
}
*/

if(isset($_POST['da'])) {
	$deactivate = ucfirst($_POST['da']);
	mysql_query("UPDATE counties SET status='1' WHERE county = '$deactivate'");
	$_POST['da'] = "";
}

/* if(isset($_POST['da']) == "all") {
	$deactivate = ucfirst($_POST['da']);
	mysql_query("UPDATE counties SET status='1'");
	$_POST['da'] = "";
}
*/
?>

<head>
<link rel="stylesheet" type="text/css" href="main.css" />
</head>
<?php
$result = mysql_query("SELECT counties.county, status.status FROM counties, status ".
						"Where counties.status = status.key");
	
echo "<table>";

while ($row = mysql_fetch_array($result)) {

if ($row['status'] == "Not Activated") {
	$class = "notactive";
} else {
	$class = "activate";
}

	echo "<tr><td class='" . $class . "'>"; 
	echo $row['county'];
	echo "</td>";
	echo "<td class='" . $class . "'>";
	echo $row['status'];
	echo "</td>";
	echo "</tr>"; 

}	

echo "</table>";  
?>
<form name="change" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Activate: <input type="text" name="act" /><br />
Deactivate: <input type="text" name="da" /><br />
<input type="submit" value="Submit" />
</form>