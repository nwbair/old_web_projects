<?php

include 'inc/base.php';

if (isset($_GET['edit'])) {
	$column = $db->escape_string($_GET['column']);
	$id = $db->escape_string($_GET['id']);
	$newValue = $db->escape_string($_GET['newValue']);
	
	$statement = $db->prepare("UPDATE orgchart_config SET $column = ? WHERE orgchart_config_id = ?");
	$statement->bind_param('s', $newValue, $id);
	$response['success'] = $statement->execute();
	$response['value'] = $newValue;
	
	echo json_encode($response);	
	
}

?>