<?php
echo "<br />";
echo "<br />";
echo "<br />";
echo "<br />";
echo form_open('email/send');
echo form_label('User Name:', 'username');
$data = array(
              'name'        => 'username',
              'id'          => 'username',
              'value'       => $users[0]->loginid,
              'maxlength'   => '100',
              'size'        => '50',
              'style'       => 'width:20%',
            );

echo form_input($data);
echo "<br />";
echo "<br />";
echo form_label('Full Name:', 'fullname');
$data = array(
              'name'        => 'fullname',
              'id'          => 'fullname',
              'value'       => $users[0]->fullname,
              'maxlength'   => '30',
              'size'        => '30',
              'style'       => 'width:20%',
            );

echo form_input($data);
echo "<br />";
echo "<br />";
echo form_label('Email:', 'email');
$data = array(
              'name'        => 'email',
              'id'          => 'email',
              'value'       => $users[0]->email,
              'maxlength'   => '100',
              'size'        => '50',
              'style'       => 'width:20%',
            );

echo form_input($data);
echo "<br />";
echo "<br />";
echo form_label('Password:', 'password');
$data = array(
              'name'        => 'password',
              'id'          => 'password',
              'value'       => $users[0]->password,
              'maxlength'   => '100',
              'size'        => '50',
              'style'       => 'width:20%',
            );

echo form_input($data);
echo "<br />";
echo "<br />";
echo form_label('Activity:', 'username');
$options = array(
                  'T'  => 'Inactive',
                  'F'    => 'Active',
                  );

echo form_dropdown('active', $options);
echo "<br />";
echo "<br />";
echo form_label('User Level:', 'username');
$options = array(
                  '0'  => 'User',
                  '1'    => 'Admin',
                );
echo form_dropdown('userLevel', $options);

echo "<br />";
echo "<br />";
$data = array(
    'name' => 'button',
    'class' => 'btn small primary',
    'value' => 'true',
    'type' => 'reset',
    'content' => 'Submit'
);

echo form_button($data);

echo form_close();

?>