<?php

// Display the counties and their statuses
$sql = 'Select counties.county, status.status FROM counties, status WHERE counties.status = status.key';
$result = $db->query($sql); 
	
?>
<div id="activated">
	Activated
	<ul> 
<?php
	while ($row = $result->fetch()) {   
		if($row['status'] == 'Activated') {
			echo '<li>' . $row['county'] . '</li>';
		}
	}
?>		
	</ul>
</div>

<div id="notactivated">
	Not Activated
	<ul> 
<?php
	while ($row = $result->fetch()) {   
		if($row['status'] == 'Not Activated') {
			echo '<li>' . $row['county'] . '</li>';
		}
	}
?>		
	</ul>
</div>