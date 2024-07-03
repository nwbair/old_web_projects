<h1><?php echo $title; ?></h1>
<p><?php echo anchor("bills/create", "Add a bill."); ?></p>

<script>
$(document).ready(function() 
    { 
        $("#sortme").tablesorter(); 
    } 
); 
</script>

<?php
if ($this->session->flashdata('message')) {
	echo "<div class='message'>" . $this->session->flashdata('message') . "</div>";
}

if (count($bills)) {
	echo "<table class='bordered-table zebra-striped' id='sortme'>\n";
	echo "<thead>\n";	
	echo "<tr>\n";
	echo "<th>Bill Name</th>\n<th>Description</th>\n";
	echo "<th>Amount</th>\n<th>Due Date</th>\n<th>Actions</th>\n";
	echo "</tr>\n";
	echo "</thead>\n";
	echo "<tbody>\n";
	foreach ($bills as $key => $list) {
		echo"<tr>\n";
		echo "<td>" . $list['name'] . "</td>\n";
		echo "<td>" . $list['description'] . "</td>\n";
		echo "<td>" . $list['amount'] . "</td>\n";
		echo "<td>" . $list['date'] . "</td>\n";
		echo "<td align='center'>";
		echo anchor('bills/edit/' . $list['bills_id'], 'edit');
		echo " | ";
		echo anchor('bills/delete/' . $list['bills_id'], 'delete');
		echo "</td>\n";	
		echo "</tr>\n";
	}
	echo "</tbody>\n";
	echo "</table>";
}