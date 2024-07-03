<?php include ('inc/base.php'); ?>
<?php include ('inc/header.php'); ?>

<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'sye') {
	include ('inc/nav.php');

} else {
	include ('login.php');
}

include ('inc/footer.php');
?>