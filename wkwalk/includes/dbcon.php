<?php

// Connect to MySql
@ $conn = mysql_pconnect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD);

if (!$conn) {
	echo "Error: Could not connect to the database. Please try again later.";
}			
mysql_select_db($DB_DATABASE);

?>