        
       
    
         <script >
			  $(function() {
			    $("table#sortTableExample").tablesorter({ sortList: [[1,0]] });
				$('#topbar').dropdown()
			  	});				
		   </script>
		
		<table class="zebra-striped" id="sortTableExample">
		<thead>
            <tr>              
                <th>Login ID</th><th>Full Name</th><th>Email</th><th>Password</th><th>Active</th><th>User Level</th><th>&nbsp;</th>
			</tr>
		</thead>
            <?php foreach ($users as $item): ?>
                    <tr>
                        <td><?=$item->loginid?></td>						
						<td><?=$item->fullname?></td>						
						<td><?=$item->email?></td>
						<td><?=$item->password?></td>
						<?php
						if($item->active == 'T')
						{
						?>
							<td>Yes</td>
						<?php
						}
						else
						{
						?>
							<td>No</td>
						<?php
						}
					
						if($item->userLevel < 1)
						{
						?>
							<td>User</td>
						<?php
						}
						else
						{
						?>
							<td>Admin</td>
						<?php
						}
						?>
						<td><a href="<?=base_url();?>index.php/admin/editUser/<?=$item->uid?>" class="btn small primary">Edit User</a></td>
						
                    </tr>
            <?php endforeach; ?>

            </tr>
        </table>
 