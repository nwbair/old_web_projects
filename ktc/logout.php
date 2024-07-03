<?php

session_start();

unset($_SESSION['LoggedIn']);
unset($_SESSION['user']);

?>

<meta http-equiv="refresh" content="0;index.php">
