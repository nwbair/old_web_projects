<?php
include_once 'common/base.php';
$pageTitle = "KTC Search";
include_once 'common/header.php';


$u = $db->prepare('SELECT * FROM users');
$u->execute();
$u->setFetchMode(PDO::FETCH_ASSOC);

?>


<p>
	<a href="#addUserModal" role="button" class="btn btn-primary" data-toggle="modal">Add User</a>
</p>

<div id="addUserModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="addUserModalLabel">Add New User</h3>
	</div>	
	<div class="modal-body">
		<p>
			<form class="form-horizontal" method="post" action="user_process.php">
				<div class="control-group">
					<label class="control-label" for="inputEmail">Email</label>
					<div class="controls">
						<input type="text" id="inputEmail" placeholder="Email" name="email">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">Password</label>
					<div class="controls">
						<input type="password" id="inputPassword" placeholder="Password" name="password">
					</div>
				</div>	
				<div class="control-group">
					<label class="control-label" for="inputFullname">Full Name</label>
					<div class="controls">
						<input type="text" id="inputFullname" placeholder="Full Name" name="fullname">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputUserLevel">User Level</label>
					<div class="controls">
						<select name="UserLevel">
							<option value="777">Admin</option>
							<option value="000">User</option>
						</select>
					</div>
				</div>			
		</p>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<button class="btn btn-primary">Save changes</button>
		<input type="hidden" name="submit" />
		</form>
	</div>
</div>

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>email</th>
			<th>Full Name</th>
			<th>status</th>
			<th>User Level</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php while ($results = $u->fetch()): ?>
		<tr>
			<td><?php echo $results['email']; ?></td>
			<td><?php echo $results['fullname']; ?></td>
			<td><?php echo $results['status']; ?></td>
			<td>
				<?php 
					if ($results['user_level'] == "777") 
					{
						 echo "Admin"; 
					} 
					elseif ($results['user_level'] == "000") 
					{
						 echo "User"; 
					}; 
				?>
			</td>
			<td>
				<a href="#updateUserModal" class="open-updateUserModal" data-toggle="modal" 
					data-id="<?php echo $results['user_id']; ?>"
					data-email="<?php echo $results['email']; ?>"
					data-name="<?php echo $results['fullname']; ?>"
					data-level="<?php echo $results['user_level']; ?>">Edit</a> | 
				<a href="user_process.php?a=d&u=<?php echo $results['user_id']; ?>">Delete</a> | 
				<a href="#changePasswordModal" class="open-changePasswordModal" data-toggle="modal"
					data-id="<?php echo $results['user_id']; ?>">Change Password</a>
			</td>
		</tr>
		<?php endwhile; ?>
	</tbody>
</table>



<div id="updateUserModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="updateUserModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="updateUserModalLabel">Update User</h3>
	</div>	
	<div class="modal-body">
		<p>
			<form class="form-horizontal" method="post" action="user_process.php">
				<div class="control-group">
					<label class="control-label" for="inputEmail">Email</label>
					<div class="controls">
						<input type="text" id="inputEmail" placeholder="Email" name="email" value="">
					</div>
				</div>	
				<div class="control-group">
					<label class="control-label" for="inputFullname">Full Name</label>
					<div class="controls">
						<input type="text" id="inputFullname" placeholder="Full Name" name="fullname">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputUserLevel">User Level</label>
					<div class="controls">
						<select name="UserLevel" id="inputUserLevel">
							<option value="777">Admin</option>
							<option value="000">User</option>
						</select>
					</div>
				</div>	
				<input type="hidden" name="userId" id="userId" value="" />		
		</p>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<button class="btn btn-primary">Save changes</button>
		<input type="hidden" name="update" />
		
		</form>
	</div>
</div>

<div id="changePasswordModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="changePasswordModalLabel">Change Password</h3>
	</div>	
	<div class="modal-body">
		<p>
			<form class="form-horizontal" method="post" action="user_process.php">
				<div class="control-group">
					<label class="control-label" for="inputNewPassword">New Password</label>
					<div class="controls">
						<input type="password" id="inputNewPassword" placeholder="New Password" name="newPassword" value="">
					</div>
				</div>	
				<input type="hidden" name="userId" id="userId" value="" />		
		</p>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<button class="btn btn-primary">Save changes</button>
		<input type="hidden" name="changepassword" />
		
		</form>
	</div>
</div>

<?php

  include_once 'common/close.php';
  include_once 'common/footer.php';
?>