<a href='<?php echo base_url() ?>admin/cu/add/'>Add a County to User List Link</a>
<table border="1">
	<tr>
		<td>List Name</td>
		<td>County Name</td>
                <td>Edit</td>
                <td>Delete</td>
	</tr>
	<?php if(isset($cus) && is_array($cus) && count($cus)> 0):?>
		<?php foreach($cus as $cu):?>
			<tr>
				<td><?php echo $cu->listName ?></td>
                                <td><?php echo $cu->countyName ?></td>
                                <td><a href='<?php echo base_url() ?>admin/cu/edit/<?php echo $cu->cuId ?>'>Edit</td>
                                <td><a href='<?php echo base_url() ?>admin/cu/delete/<?php echo $cu->cuId ?>'>Delete</td>
			</tr>
		<?php endforeach?>
	<?php else:?>
		<tr>
                    <td colspan="5">There are currently no Links.</td>
		</tr>
	<?php endif?>
</table>