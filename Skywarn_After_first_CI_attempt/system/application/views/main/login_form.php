<?php echo form_open(base_url() . 'main/login')?>

<?php if($this->session->flashdata('flashError')):?>
<div class='flashError'>
    <?php echo $this->session->flashdata('flashError') ?>
</div>
<?php endif?>
<fieldset>
    <legend>Login Form</legend>
    <ul>
        <li>
            <label>Email</label>
            <?php echo form_input('email', set_value('email'))?>
            <?php echo form_error('email'); ?>
        </li>
        <li>
            <label>Password</label>
            <?php echo form_password('password')?>
            <?php echo form_error('password'); ?>
        </li>
        <li>
            <?php echo form_submit('', 'Login')?>
        </li>
    </ul>
</fieldset>
<?php echo form_close() ?>