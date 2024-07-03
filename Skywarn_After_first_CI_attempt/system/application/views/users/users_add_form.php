<h2>Add a User</h2>
<?php echo form_open('users/add') ?>
<fieldset>
    <legend><span>*</span>Required Field</legend>
    <ul>
        <li>
            <label>Email<span>*</span></label>
            <?php echo form_input('email', set_value('email')) ?>
            <?php echo form_error('email') ?>
        </li>
        <li>
            <label>Password<span>*</span></label>
            <?php echo form_input('password') ?>
            <?php echo form_error('password') ?>
        </li>
        <li>
            <label>Type<span>*</span></label>
            <?php echo form_dropdown('userType', array('user' => 'Standard User', 'admin' => 'Admin User'), set_value('userType')) ?>
            <?php echo form_error('userType') ?>
        </li>
        <li>
            <label>Status<span>*</span></label>
            <?php echo form_dropdown('userStatus', array('active' => 'Active', 'inactive' => 'Inactive'), set_value('userStatus')) ?>
            <?php echo form_error('userStatus') ?>
        </li>
        <li>
            <?php echo form_submit('', 'Add User') ?>
        </li>
    </ul>
</fieldset>