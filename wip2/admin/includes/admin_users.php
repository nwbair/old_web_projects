        <div id="wrapper">
            <div id="content">
                <div id="box">
                	<h3>Current Users</h3>
                	<table width="100%">
						<thead>
							<tr>
                            	<th><a href="#">Last Active</a></th>
                            	<th><a href="#">Full Name</a></th>
                                <th><a href="#">Email</a></th>
                                <th width="70px"><a href="#">Group</a></th>
                                <th><a href="#">Registered</a></th>
                                <th width="60px"><a href="#">Action</a></th>
                            </tr>
						</thead>
						<tbody>
							<?php
							$sql = "SELECT userid, firstname, lastname, email, userlevel, timestamp, registertime FROM users";
							$result = $db->query($sql);					
														
							while ($row = $result->fetch()) {

								date_default_timezone_set('America/Chicago');
								$timestamp = date("m.d.y @ H:m:s", $row['timestamp']);
								$registeredon = date("m.d.y @ H:m:s", $row['registertime']);
								
							?>
							<tr>
                            	<td class="a-center"><?php echo $timestamp; ?></td>
                            	<td><a href="#"><?php echo $row['firstname'] . " " . $row['lastname']; ?></a></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['userlevel']; ?></td>
                                <td><?php echo $registeredon; ?></td>
                                <td>
									<a href="#"><img src="img/icons/user.png" title="Show profile" width="16" height="16" /></a>
									<a href="#"><img src="img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a>
									<a href="admin.php?users&action=d&id=<?php echo $row['userid']; ?>"><img src="img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a>
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
                
				<div id="box">
                	<h3>Pending Approvals</h3>
                	<table width="100%">
						<thead>
							<tr>
                            	<th><a href="#">Registered</a></th>
                            	<th><a href="#">Full Name</a></th>
                                <th><a href="#">Email</a></th>
                                <th width="70px"><a href="#">Callsign</a></th>
                                <th width="90px"><a href="#">Registered</a></th>
                                <th width="60px"><a href="#">Action</a></th>
                            </tr>
						</thead>
						<tbody>
							<?php
							$sql = "SELECT userid, firstname, lastname, email, userlevel, registertime FROM pending_users";
							$result = $db->query($sql);					
														
							while ($row = $result->fetch()) {

								date_default_timezone_set('America/Chicago');
								$timestamp = date("m.d.y @ H:m:s", $row['registertime']);
								
							?>
							<tr>
                            	<td class="a-center"><?php echo $timestamp; ?></td>
                            	<td><a href="#"><?php echo $row['firstname'] . " " . $row['lastname']; ?></a></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['userlevel']; ?></td>
                                <td></td>
                                <td>
									<a href="admin.php?users&action=a&id=<?php echo $row['userid']; ?>"><img src="img/icons/user_add.png" title="Approve user" width="16" height="16" /></a>
									<a href="#"><img src="img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a>
									<a href="admin.php?users&action=d&pending=1&id=<?php echo $row['userid']; ?>"><img src="img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a>
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
if(isset($_GET['action'])) {
	switch ($_GET['action']) {
		case d:														// Deleting Users
			if (isset($_GET['id'])) {
				if($_GET['pending'] == '1') {
					$target = 'pending_users';
				} else {
					$target = 'users';
				}
					$sql = 'DELETE FROM ' . $target . ' WHERE userid = "' . $_GET['id'] . '"';					
					$result = $db->query($sql);
					
					if ($result) {
						redirect('admin.php?users');
					} else {
						redirect('admin.php?error=2');
					}
			}
			break;
		case a:
			if (isset($_GET['id'])) {
				$sql = 'SELECT * FROM pending_users where userid ="' . $_GET['id'] . '"';
				$result = $db->query($sql);				
				$row = $result->fetch();
				unset ($row['userid']);
				
			foreach ($row as $key => $value) {
				$keys[] = $key;
				$values[] = '"'.$value.'"';
			}
	
			$sql = "INSERT INTO users (".implode(',',$keys).") VALUES(".implode(',',$values).")";
			$db->query($sql);		
			
			
			if (!$db->isError()) {
				$sql = 'DELETE FROM pending_users where userid ="' . $_GET['id'] . '"';
				$db->query($sql);	
				redirect('admin.php?users');
			} else {
				redirect('index.php?register&error=3');
			}
	
				
			}
	}
}
?>