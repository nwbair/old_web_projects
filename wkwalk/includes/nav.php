<div id="nav">
<ul>
	<li><a href="index.php">Home</a></li>
	<li><a href="index.php?steps">Update Steps</a></li>
	<?php if ($_SESSION['level'] == '9') {
		// echo '<li><a href="index.php?admin">Administration</a></li>';
		echo '<li><a href="admin.php">Administration</a></li>';
	} ?>
	<li class="last"><a href="index.php?logout_action">Logout</a></li>
</ul>
</div>