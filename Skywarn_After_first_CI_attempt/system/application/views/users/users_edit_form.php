<h2>Edit User "<?php echo $user->email ?>"</h2>
<?php echo form_open('users/edit/' . $user->userid) ?>
<fieldset>
    <legend><span>*</span>Required Field</legend>
    <ul>
        <li>
            <label>Email<span>*</span></label>
            <?php echo form_input('email', set_value('email', $user->email)) ?>
            <?php echo form_error('email') ?>
        </li>
        <li>
            <label>Set New Password</label>
            <?php echo form_input('password') ?>
            <?php echo form_error('password') ?>
        </li>
        <li>
            <label>Type<span>*</span></label>
            <?php echo form_dropdown('userType', array('user' => 'Standard User', 'admin' => 'Admin User'), set_value('userType', $user->userType)) ?>
            <?php echo form_error('userType') ?>
        </li>
        <li>
            <label>Status<span>*</span></label>
            <?php echo form_dropdown('userStatus', array('active' => 'Active', 'inactive' => 'Inactive'), set_value('userStatus', $user->userStatus)) ?>
            <?php echo form_error('userStatus') ?>
        </li>
        <li>
            <?php echo form_submit('', 'Save Changes') ?>
        </li>
    </ul>
</fieldset>