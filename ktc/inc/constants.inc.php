<?php

	if($_ENV['environment'] == "development") {
		// Development settings
		define('DB_HOST', 'localhost');
		define('DB_USER', '');
		define('DB_PASS', '');
		define('DB_NAME', 'ktc');
	
		define('DB_HOST2', 'localhost');
		define('DB_USER2', '');
		define('DB_PASS2', '');
		define('DB_NAME2', 'ams');
	}

	if($_ENV['environment'] == "production") {	
		// Production settings
		define('DB_HOST', 'localhost');
		define('DB_USER', '');
		define('DB_PASS', '');
		define('DB_NAME', 'ktc');
	
		define('DB_HOST2', 'localhost');
		define('DB_USER2', '');
		define('DB_PASS2', '');
		define('DB_NAME2', 'ams');
	}
?>