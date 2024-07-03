<h2>Add a User List</h2>
<?php echo form_open('admin/userlist/add') ?>
<fieldset>
	<legend><span>*</span>Required Field</legend>
	<ul>
		<li>
			<label>List Name<span>*</span></label>
			<?php echo form_input('listName', set_value('listName')) ?>
			<?php echo form_error('listName')?>
		</li>
                <li>
			<label>MailChimp List Id<span>*</span></label>
			<?php echo form_input('mcListid', set_value('mcListid')) ?>
			<?php echo form_error('mcListid')?>
		</li>
                <li>
			<label>Description<span>*</span></label>
			<?php echo form_input('description', set_value('description')) ?>
			<?php echo form_error('description')?>
		</li>

		<li>
			<?php echo form_submit('', 'Add User List')?>
		</li>
	</ul>
</fieldset>
<?php echo form_close()?>