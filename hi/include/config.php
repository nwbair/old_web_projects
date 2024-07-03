<?php

set_include_path( '.' . PATH_SEPARATOR . '/home/almostadmin/pear/php' 
        . PATH_SEPARATOR . get_include_path() );
$pear_user_config = '/home/almostadmin/.pearrc';

# Turns on the debug features.
@define( 'DEBUG_MODE','on');

@define( 'TITLE', 'Home Inventory');

//$DB_HOSTNAME = 'localhost';
//$DB_USERNAME = 'root';
//$DB_PASSWORD = 'nick';
//$DB_DATABASE = 'almostlabs_hi';

$DB_HOSTNAME = 'mysql.almostlabs.com';
$DB_USERNAME = 'labs_hi';
$DB_PASSWORD = 'labs_almost';
$DB_DATABASE = 'almostlabs_hi';