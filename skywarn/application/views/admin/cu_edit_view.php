<h2>Edit County > User List Link "<?php echo $cu->cuId ?>"</h2>
<?php echo form_open('admin/cu/edit/' . $cu->cuId) ?>
<fieldset>
	<legend><span>*</span>Required Field</legend>
	<ul>
		<li>
			<label>List ID<span>*</span></label>
			<?php echo form_input('listId', set_value('listId', $cu->listId))?>
			<?php echo form_error('listId')?>
		</li>
                <li>
			<label>County ID<span>*</span></label>
			<?php echo form_input('countyId', set_value('countyId', $cu->countyId))?>
			<?php echo form_error('countyId')?>
		</li>
		<li>
			<?php echo form_submit('', 'Save Change')?>
		</li>
	</ul>
</fieldset>
<?=form_close()?>