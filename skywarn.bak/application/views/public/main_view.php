<table border="1">
	<tr>
		<td>County</td>
		<td>Status</td>
	</tr>
	<?php if(isset($counties) && is_array($counties) && count($counties)> 0):?>
		<?php foreach($counties as $county):?>
			<tr>
				<td><?php echo $county->countyName ?></td>
				<?php if ($county->statusId == '1'): ?>
                                    <td class="notactive">
                                    <?php elseif ($county->statusId == '2'): ?>
                                    <td class="active">
                                    <?php endif; ?>
                                <?php echo $county->statusName ?></td>
			</tr>
		<?php endforeach?>
	<?php else:?>
		<tr>
			<td colspan="3">There are currently no counties.</td>
		</tr>
	<?php endif?>
</table>