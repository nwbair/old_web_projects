<h2>Edit County "<?php echo $county->countyName ?>"</h2>
<?php echo form_open('admin/county/edit/' . $county->countyId) ?>
<fieldset>
	<legend><span>*</span>Required Field</legend>
	<ul>
		<li>
			<label>County Name<span>*</span></label>
			<?php echo form_input('countyName', set_value('countyName', $county->countyName))?>
			<?php echo form_error('countyName')?>
		</li>
		<li>
			<?php echo form_submit('', 'Save Change')?>
		</li>
	</ul>
</fieldset>
<?=form_close()?>