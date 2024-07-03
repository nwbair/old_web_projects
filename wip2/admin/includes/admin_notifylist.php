 <div id="wrapper">
	<div id="content">

<?php

If (isset($_GET['action']) && $_GET['action'] == 'e') {

		// Updating Groups
?>
		<div id="box">
			<h3 id="addnotifygroup">Notification Group Settings</h3>
				<form id="form" action="admin.php?notifylist" method="post">
                      <fieldset id="groupinfo">
                        <legend>Notification Group Settings</legend>
                        <label for="groupname">Group name : </label> 
                        <input name="groupname" id="groupname" type="text" tabindex="1" value="<?php 
						
						 	$sql = "SELECT groupname FROM notify_groups WHERE groupid = '" . $_GET['id'] . "'";
							$result = $db->query($sql);
						
							$row = $result->fetch();
							
							echo $row['groupname'];
							
						?>" />
                        <br />
                      </fieldset>
                      <div align="center">
						<input type="hidden" name="update" value="<?php echo $_GET['id']; ?>">
						<input id="button1" type="submit" value="Update Group" />
						<input id="button2" type="reset" />
                      </div>
                </form>
        </div>
		
<?php		
} else {

		// Creating groups.
?>
		<div id="box">
			<h3 id="addnotifygroup">Add Notification Group</h3>
				<form id="form" action="admin.php?notifylist" method="post">
                      <fieldset id="groupinfo">
                        <legend>Notification Group Settings</legend>
                        <label for="groupname">Group name : </label> 
                        <input name="groupname" id="groupname" type="text" tabindex="1"  />
                        <br />
                      </fieldset>
                      <div align="center">
						<input id="button1" type="submit" value="Create Group" />
						<input id="button2" type="reset" />
                      </div>
                </form>
        </div>
<?php

}

?>

				
				<div id="box">
                	<h3>Current Groups</h3>
                	<table width="100%">
						<thead>
							<tr>
                            	<th><a href="#">Group ID</a></th>
                            	<th><a href="#">Group Name</a></th>
                                <th><a href="#">Date Modified</a></th>
                                <th width="60px"><a href="#">Action</a></th>
                            </tr>
						</thead>
						<tbody>
							<?php
							$sql = "SELECT groupid, groupname, timestamp FROM notify_groups";
							$result = $db->query($sql);					
														
							while ($row = $result->fetch()) {								
							?>
							<tr>
                            	<td class="a-center"><?php echo $row['groupid']; ?></td>
                            	<td><a href="admin.php?notifylist&action=e&id=<?php echo $row['groupid']; ?>"><?php echo $row['groupname']; ?></a></td>
                                <td><?php 	set_Time($row['timestamp']); ?></td>
                                <td>
									<a href="#"><img src="img/icons/user.png" title="Show profile" width="16" height="16" /></a>
									<a href="admin.php?notifylist&action=e&id=<?php echo $row['groupid']; ?>"><img src="img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a>
									<a href="admin.php?users&action=d&id=<?php echo $row['userid']; ?>">
									<img src="img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a>
								</td>
                            </tr>
							<?php
							}
							?>
						</tbody>
					</table>
                    <div id="pager">
                    	Page <a href="#"><img src="img/icons/arrow_left.gif" width="16" height="16" /></a> 
                    	<input size="1" value="1" type="text" name="page" id="page" /> 
                    	<a href="#"><img src="img/icons/arrow_right.gif" width="16" height="16" /></a>of 42
                    pages | View <select name="view">
                    				<option>10</option>
                                    <option>20</option>
                                    <option>50</option>
                                    <option>100</option>
                    			</select> 
                    per page | Total <strong>420</strong> records found
                    </div>
                </div>
                <br />
				
            </div>
</div>

<?php

if (!isset($_POST['update'])) {
	if(isset($_POST['groupname'])) {
		$groupname = cleanInput($_POST['groupname']);
		$timestamp = time();
	
		$sql = "INSERT INTO notify_groups (groupname, timestamp) VALUES ('$groupname', '$timestamp')";
		$result = $db->query($sql);
		
		if (!$db->isError()) {
			redirect('admin.php?notifylist');
		}		
	}
} else if (isset($_POST['update'])) {
		$groupid = cleanInput($_POST['update']);
		$groupname = cleanInput($_POST['groupname']);
		$timestamp = time();
		
		$sql = "UPDATE notify_groups SET groupname='$groupname', timestamp='$timestamp' WHERE groupid='$groupid'";
		$result = $db->query($sql);
		
		if (!$db->isError()) {
			redirect('admin.php?notifylist');
		}
}



?>