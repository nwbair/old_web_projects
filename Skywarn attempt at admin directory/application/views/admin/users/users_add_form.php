<h2>Add a User</h2>
<?=form_open('users/add')?>
<fieldset>
	<legend><span>*</span>Required Field</legend>
	<ul>
		<li>
			<label>Email<span>*</span></label>
			<?=form_input('userEmail', set_value('userEmail'))?>
			<?=form_error('userEmail')?>
		</li>
		<li>
			<label>Password<span>*</span></label>
			<?=form_input('userPassword')?>
			<?=form_error('userPassword')?>
		</li>
		<li>
			<label>Type<span>*</span></label>
			<?=form_dropdown('userType', array('user' => 'Standard User', 'admin' => 'Admin User'), set_value('userType'))?>
			<?=form_error('userType')?>
		</li>
		<li>
			<label>Status<span>*</span></label>
			<?=form_dropdown('userStatus', array('active' => 'Can log in', 'inactive' => 'Cannot log in'), set_value('userStatus'))?>
			<?=form_error('userStatus')?>
		</li>
		<li>
			<?=form_submit('', 'Add User')?>
		</li>
	</ul>
</fieldset>
<?=form_close()?>