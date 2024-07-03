<h1><?php echo $title; ?></h1>

<?php
echo form_open('main/contact');
echo "<p><label for='name'>Your Name</label><br />";
$data = array('name'=>'name','id'=>'name','size'=>25);
echo form_input($data) . "</p>";

echo "<p><label for='email'>Email</label><br />";
$data = array('name'=>'email','id'=>'email','size'=>40);
echo form_input($data) . "</p>";

echo "<p><label for='long'>Message</label><br />";
$data = array('name'=>'message','id'=>'message','rows'=>5, 'cols'=>'40');
echo form_textarea($data) . "</p>";

echo form_submit('submit', 'send email');
echo form_close();
?>