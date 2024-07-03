<?php

	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	$_ENV['environment'] = "development";

	session_start();

	include_once 'inc/constants.inc.php';

	try {
		$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
		$db = new PDO($dsn, DB_USER, DB_PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		
		$dsn2 = "mysql:host=" . DB_HOST2 . ";dbname=" . DB_NAME2;
		$db2 = new PDO($dsn2, DB_USER2, DB_PASS2);
		$db2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		exit;
	}

?>