		<br />
		<a href="<?=base_url();?>index.php/users/addUser" class="btn small success" title="Click to Delete User">Create New User</a>&nbsp;
		<table>
		<thead>
            <tr>              
                <th>User</th><th>Login</th><th>Password</th><th>Email</th><th>User Level</th><th>&nbsp;</th>
			</tr>
		</thead>
            <?php foreach ($users as $item): ?>
                    <tr>
                        <td><?=$item->fullname?></td>
						<td><?=$item->loginid?></td>
						<td><?=$item->password?></td>						
						<td><a href="MAILTO:<?=$item->email?>?subject=New%20Customer%20Contact"><?=$item->email?></a></td>
						<td>
						<?php
							if($item->userLevel == "0")
							{
								echo "User";
							} elseif($item->userLevel == "1")
							{
								echo "Admin";
							}
							
						?>
						</td>
						
						<td>
						<?php 
						
				if($item->active == "T")
				{
				?>
					<a href="<?=base_url();?>index.php/users/changeUserStatus/<?=$item->uid?>/F" class="btn small success" title="Click to Make User Inactive">&nbsp;Active&nbsp;</a>&nbsp;				
				<?php					
				} else {
				?>
					<a href="<?=base_url();?>index.php/users/changeUserStatus/<?=$item->uid?>/T" class="btn small danger" title="Click to Make User Active">Inactive</a>&nbsp;
				<?php
				}				
			                    
            ?>
				<a href="<?=base_url();?>index.php/users/deleteUser/<?=$item->uid?>" class="btn small" title="Click to Delete User">Delete User</a>
                    </tr>
            <?php endforeach; ?>
			</td>
        </table>    
<hr/><hr/>