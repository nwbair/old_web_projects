<h2>Add a County</h2>
<?php echo form_open('admin/county/add') ?>
<fieldset>
	<legend><span>*</span>Required Field</legend>
	<ul>
		<li>
			<label>County Name<span>*</span></label>
			<?php echo form_input('countyName', set_value('countyName')) ?>
			<?php echo form_error('countyName')?>
		</li>
		<li>
			<?php echo form_submit('', 'Add County')?>
		</li>
	</ul>
</fieldset>
<?php echo form_close()?>