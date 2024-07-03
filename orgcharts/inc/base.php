<?php

session_start();

$db = new mysqli('localhost','','','orgcharts');

if($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
}

?>