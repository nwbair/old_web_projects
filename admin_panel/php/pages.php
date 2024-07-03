<?php

$title = $_POST['title'];
$page = $_POST['page'];
$created = $_POST['created'];


mysql_connect ("localhost", "root", "") or die ('Error: ' .mysql_error());
mysql_select_db("almostlabs");

$query="INSERT INTO pages (ID, title, page, created) VALUES ('', '$title', '$pages', '$created')";

mysql_query($query) or die ('Error adding new page');

echo "Pages added!";

header("Location:../confirm.html");
exit();




?>