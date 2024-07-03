<h1><?php echo $title; ?></h1>
<p><?php echo anchor("income/create", "Add some income."); ?></p>

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

if (count($income)) {
	echo "<table class='bordered-table zebra-striped' id='sortme'>\n";
	echo "<thead>\n";	
	echo "<tr>\n";
	echo "<th>Income Source</th>\n<th>Description</th>\n";
	echo "<th>Amount</th>\n<th>Due Date</th>\n<th>Actions</th>\n";
	echo "</tr>\n";
	echo "</thead>\n";
	echo "<tbody>\n";
	foreach ($income as $key => $list) {
		echo"<tr>\n";
		echo "<td>" . $list['name'] . "</td>\n";
		echo "<td>" . $list['description'] . "</td>\n";
		echo "<td>" . $list['amount'] . "</td>\n";
		echo "<td>" . $list['date'] . "</td>\n";
		echo "<td align='center'>";
		echo anchor('income/edit/' . $list['income_id'], 'edit');
		echo " | ";
		echo anchor('income/delete/' . $list['income_id'], 'delete');
		echo "</td>\n";	
		echo "</tr>\n";
	}
	echo "</tbody>\n";
	echo "</table>";
}