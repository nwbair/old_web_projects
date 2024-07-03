<?php
include_once 'common/base.php';
$pageTitle = "KTC Search";
include_once 'common/header.php';
?>

<?php

if (strlen($_POST['email']) > 5 && strlen($_POST['password']) > 5)
{
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	
	$l = $db->prepare('SELECT email, password FROM users WHERE email=:email AND password=:password');
	$l->bindValue(':email', $email);
	$l->bindValue(':password', md5($password));
	$l->execute();
	$l->setFetchMode(PDO::FETCH_ASSOC);
	$results = $l->fetch();
	
	if ($email == $results['email'] && md5($password) == $results['password'])
	{
		$_SESSION['LoggedIn'] = '1';
		$_SESSION['user'] = $email;
		header("Location: dashboard.php");
	}	
}
else 
{
?>

<center><h2>Please try to login again</h2></center>
            
<?php
}
?>

<?php
  include_once 'common/close.php';
  include_once 'common/footer.php';
?>