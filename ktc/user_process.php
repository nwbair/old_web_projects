<?php
include_once 'common/base.php';

if(isset($_POST['submit']))
{
	$u = $db->prepare("INSERT INTO users (email, password, fullname, user_level) VALUES (:email, :password, :fullname, :user_level)");
	$u->bindParam(':email', $_POST['email']);
	$u->bindParam(':password', md5($_POST['password']));
	$u->bindParam(':fullname', $_POST['fullname']);
	$u->bindParam(':user_level', $_POST['UserLevel']);
	$u->execute();
	header("Location: users.php");
}

/**
 * Update the User information
 */
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

/**
 * Delete the user
 */
if(isset($_GET['a']) && $_GET['a'] == "d")
{
	$u = $db->prepare("DELETE FROM users WHERE user_id=:id");
	$u->bindParam(":id", $_GET['u']);
	$u->execute();
	header("Location: users.php");
}

/**
 * Change password
 */
 if(isset($_POST['changepassword']))
 {
 	$u = $db->prepare("UPDATE users SET password=:password WHERE user_id=:id");
	$u->bindParam('id', $_POST['userId']);
	$u->bindParam(':password', md5($_POST['newPassword']));
	$u->execute();
	//echo "<pre>"; print_r("$_POST");
	header("Location: users.php");
 }
