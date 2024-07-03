<h2>Add a County > User List Link</h2>
<?php echo form_open('admin/cu/add') ?>
<fieldset>
	<legend><span>*</span>Required Field</legend>
	<ul>
                <li>
			<label>County ID<span>*</span></label>
			<?php echo form_input('countyId', set_value('countyId')) ?>
			<?php echo form_error('countyId')?>
		</li>
                <li>
			<label>County ID<span>*</span></label>
			<?php echo form_dropdown('countyId', $cu->countyId) ?>
			<?php echo form_error('countyId')?>
		</li>
		<li>
			<label>List ID<span>*</span></label>
			<?php echo form_input('listId', set_value('listId')) ?>
			<?php echo form_error('listId')?>
		</li>                
		<li>
			<?php echo form_submit('', 'Add Link')?>
		</li>
	</ul>
</fieldset>
<?php echo form_close()?>