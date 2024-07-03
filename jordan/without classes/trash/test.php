<?
include("include/session.php");
?>

<html>
<head>
<title>Protected Page</title>
<link rel="stylesheet" type="text/css" href="css/main.css" />
</head>

<?
/* User is not logged in */
if(!$session->logged_in){
?>

<body>
You are not logged in.
</body>

<?
}
/* User is logged in */
else{

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

<body>
You are logged in!
</body>

<?
}
?>

</html>
