<?php
include_once 'common/base.php';

/*
 * Changes - Updating the Category for the account or setting 
 * the account active/inactive.
 */
if(isset($_POST['s']) && isset($_POST['cat_update']))
{
	$accountNumber = $_POST['s'];
	
	if($_POST['category'] == "disabled" || $_POST['category'] == "enabled")
	{
		$d = $db->prepare('INSERT INTO pending_changes (change_table, change_column, change_value, affected_id, timestamp) VALUES (:t, :c, :v, :id, :time)');
		$d->bindValue(':t', "accounts");
		$d->bindValue(':c', "status");
		$d->bindValue(':v', $_POST['category']);
		$d->bindValue(':id', $accountNumber);
		$d->bindValue(':time', time());
		
		$d->execute();
		
		
	} else {
	
		$c = $db->prepare('INSERT INTO pending_changes (change_table, change_column, change_value, affected_id, timestamp) VALUES (:t, :c, :v, :id, :time)');
		$c->bindValue(':t', "accounts");
		$c->bindValue(':c', "category");
		$c->bindValue(':v', $_POST['category']);
		$c->bindValue(':id', $accountNumber);
		$c->bindValue(':time', time());
		
		$c->execute();
		
		//$c = $db->prepare('UPDATE accounts SET category=:category WHERE account_number=:id');
		//$c->bindValue(':category', $_GET['category']);
		//$c->bindValue(':id', $_GET['s']);
		//$c->execute();
		//header("Location: search.php?s=" . $_GET['s']);
	}
	
	header("Location: search.php?s=" . $accountNumber);
}