<h2>Edit User List "<?php echo $userlist->listName ?>"</h2>
<?php echo form_open('admin/userlist/edit/' . $userlist->listId) ?>
<fieldset>
	<legend><span>*</span>Required Field</legend>
	<ul>
		<li>
			<label>List Name<span>*</span></label>
			<?php echo form_input('listName', set_value('listName', $userlist->listName))?>
			<?php echo form_error('listName')?>
		</li>
                <li>
			<label>MailChimp List ID<span>*</span></label>
			<?php echo form_input('mcListid', set_value('mcListid', $userlist->mcListid))?>
			<?php echo form_error('mcListid')?>
		</li>
                <li>
			<label>Description<span>*</span></label>
			<?php echo form_input('description', set_value('description', $userlist->description))?>
			<?php echo form_error('description')?>
		</li>
		<li>
			<?php echo form_submit('', 'Save Change')?>
		</li>
	</ul>
</fieldset>
<?=form_close()?>