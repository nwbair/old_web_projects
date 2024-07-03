<?php


$first = $_POST['first'];
$last = $_POST['last'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$email = $_POST['email'];
$password = md5($_POST['password']);

mysql_connect ("localhost", "root", "") or die ('Error: ' .mysql_error());
mysql_select_db("almostlabs");

$query="INSERT INTO users (ID, first, last, street, city, state, zip, email, password) VALUES ('', '$first', '$last', '$street', '$city', '$state', '$zip', '$email', '$password')";

mysql_query($query) or die ('Error adding new user');

echo "User added!";

header("Location:../confirm.html");
exit();




?>