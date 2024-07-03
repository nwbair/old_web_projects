<?php
include_once 'common/base.php';

/**
 * Accept suggested change
 */
if(isset($_GET['a']) && $_GET['a'] == "a")
{
	$s = $db->prepare("SELECT * FROM pending_changes WHERE change_id=:id");
	$s->bindParam(':id', $_GET['i']);
	$s->execute();
	$s->setFetchMode(PDO::FETCH_ASSOC);
	$results = $s->fetch();
	
	$table = $results['change_table'];
	$column = $results['change_column'];

	if ($results['change_table'] == "accounts") 
	{
		//$u->bindValue(":change_id", "account_number");
		$change_id = "account_number";
	}
	
	$u = $db->prepare("UPDATE $table SET $column=:value WHERE $change_id=:id");
	$u->bindParam(':table', $results['change_table']);
	$u->bindParam(':column', $results['change_column']);
	$u->bindParam(':value', $results['change_value']);

	$u->bindParam(":id", $results['affected_id']);
	$u->execute();
	
	//echo "\nPDOStatement::errorInfo():\n";
	//$arr = $u->errorInfo();
	//print_r($arr);
	// exit;
	
	$d = $db->prepare("DELETE FROM pending_changes WHERE change_id=:id");
	$d->bindParam(':id', $_GET['i']);
	$d->execute();
	header("Location: dashboard.php");
}

/**
 * Reject suggested change
 */
if(isset($_GET['a']) && $_GET['a'] == "d")
{
	$d = $db->prepare("DELETE FROM pending_changes WHERE change_id=:id");
	$d->bindParam(':id', $_GET['i']);
	$d->execute();
	header("Location: dashboard.php"); 	
}
 
if(isset($_POST['update']))
{
	$u = $db->prepare("UPDATE users SET email=:email, fullname=:fullname, user_level=:user_level WHERE user_id=:id");
	$u->bindParam(':id', $_POST['userId']);
	$u->bindParam(':email', $_POST['email']);
	$u->bindParam(':fullname', $_POST['fullname']);
	$u->bindParam(':user_level', $_POST['UserLevel']);
	$u->execute();
	header("Location: users.php");
}