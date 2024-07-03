<a href='<?php echo base_url() ?>admin/userlist/add/'>Add User List</a>
<table border="1">
	<tr>
		<td>List Name</td>
		<td>List ID</td>
                <td>Description</td>
                <td>Edit</td>
                <td>Delete</td>
	</tr>
	<?php if(isset($userlists) && is_array($userlists) && count($userlists)> 0):?>
		<?php foreach($userlists as $userlist):?>
			<tr>
				<td><?php echo $userlist->listName ?></td>
                                <td><?php echo $userlist->mcListid ?></td>
                                <td><?php echo $userlist->description ?></td>
                                <td><a href='<?php echo base_url() ?>admin/userlist/edit/<?php echo $userlist->listId ?>'>Edit</td>
                                <td><a href='<?php echo base_url() ?>admin/userlist/delete/<?php echo $userlist->listId ?>'>Delete</td>
			</tr>
		<?php endforeach?>
	<?php else:?>
		<tr>
                    <td colspan="5">There are currently no User Lists.</td>
		</tr>
	<?php endif?>
</table>