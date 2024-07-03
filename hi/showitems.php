<?php
include('include/config.php');
include('include/adodb/adodb.inc.php');
include('include/class.Items.php');

$db = NewADOConnection('mysql');
$db->Connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$item = new Items();

$item->showAllItems(1);

?>
