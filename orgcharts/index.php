<?php include ('inc/base.php'); ?>
<?php include ('inc/header.php'); ?>

<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'sye') {
	include ('inc/nav.php');
	
?>

	<form action="upload.php" class="dropzone">
	</form>

<?php

$sql = "SELECT * FROM orgchart_config";
if(!$result = $db->query($sql)) {
	die('There was an error running the query [' . $db->error . ']');
}

if($result->num_rows > 0) {
	$table = <<<TABLE
	<table class="table table-striped" id="orgchart">
		<thead>
			<tr>
				<th>Org Chart Name</th>
				<th>Org Chart Description</th>
				<th>Org Chart File</th>
				<th>Uploaded File</th>
			</tr>
		</thead>
		<tbody>
TABLE;
	
	echo $table;
	
	while($row = $result->fetch_assoc()) {
		echo '<tr id="' . $row['orgchart_config_id'] . '">';
		echo '<td class="edit_click">' . $row['orgchart_name'] . '</td>';
		echo '<td>' . $row['orgchart_description'] . '</td>';
		echo '<td>' . $row['orgchart_file'] . '</td>';
		echo '<td></td>';
		echo '</tr>';
	}
	echo '</tbody></table>';
}

/*  Testing an output of the existing files
	$dir = '../groups/main/orgcharts';
	$dh = opendir($dir);
	while (false !== ($filename = readdir($dh))) {
		$files[] = $filename;
	}
	sort($files);
	print_r($files);
*/

} else {
	include ('login.php');
}

include ('inc/footer.php');
?>