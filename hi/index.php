<?php
session_start();

include('include/config.php');
include('include/adodb/adodb.inc.php');
include('include/functions.php');
include('templates/navigation.html');

$db = NewADOConnection('mysql');
$db->Connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
 
echo createRandomString();
if(isset($_SESSION['email'])) {
    
}