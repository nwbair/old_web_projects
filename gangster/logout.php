<?php

include ('inc/base.php');

$_SESSION = array(); // Unset all of the session variables.

session_destroy(); // Destroy the session.

header('Location: index.php'); // redirect to the index page.

?>