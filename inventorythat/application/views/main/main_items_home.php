<h1><?php echo $title; ?></h1>
<p><?php echo anchor("items/create", "Add an item"); ?></p>
<?php
if ($this->session->flashdata('message')) {
	echo "<div class='message'>" . $this->session->flashdata('message') . "</div>";
}

if (count($items)) {
	echo "<table border='1' cellspacing='0' cellpadding='3' width='600'>\n";
	echo "<tr valign='top'>\n";
	echo "<th>Thumbnail</th><th>ID</th>\n<th>Item Name</th><th>Location</th><th>Category</th><th>Status</th><th>Actions</th>\n";
	echo "<tr>\n";
	foreach ($items as $key => $list) {
		echo"<tr valign='top'>\n";
		echo "<td>" . "</td>\n";
		echo "<td>" . $list['id'] . "</td>\n";
		echo "<td>" . $list['name'] . "</td>\n";
		echo "<td>" . $list['location'] . "</td>\n";
		echo "<td>" . $list['category'] . "</td>\n";
		echo "<td align='center'>" . $list['status'] . "</td>\n";
		echo "<td align='center'>";
		echo anchor('items/edit/' . $list['id'], 'edit');
		echo " | ";
		echo anchor('items/delete/' . $list['id'], 'delete');
		echo "</td>\n";
		echo "</tr>\n";
	}
	echo "</table>";
}