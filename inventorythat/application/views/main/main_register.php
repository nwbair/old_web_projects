<h1><?php echo $title; ?></h1>

<?php
echo form_open('main/register');
echo "<p><label for='uname'>Username</label><br />";
$data = array('name'=>'username', 'id'=>'uname', 'size'=>25);
echo form_input($data) . "</p>";

echo "<p><label for='email'>Email</label><br />";
$data = array('name'=>'email', 'id'=>'email', 'size'=>50);
echo form_input($data) . "</p>";

echo "<p><label for='pw'>Password</label><br />";
$data = array('name'=>'password', 'id'=>'pw', 'size'=>25);
echo form_password($data) . "</p>";

echo form_hidden('status', 'active');
echo form_submit('submit', 'register');
echo form_close();
?>