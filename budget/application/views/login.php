<div id='login-box'>
	<h2>Please login to Access the Dashboard</h2>
	<?php
	if ($this->session->flashdata('error')) {
		echo "<div class='message'>";
		echo $this->session->flashdata('error');
		echo "</div>";
	}
	?>

	<?php
	$udata = array('name'=>'username', 'id'=>'u', 'size'=>15, 'class'=>'xlarge span3');
	$pdata = array('name'=>'password', 'id'=>'p', 'size'=>15, 'class'=>'xlarge span3');
	$sdata = array('name'=>'submit', 'value'=>'Login', 'class'=>'btn primary');
	
	echo form_open("main/verify");
?>

<div class="clearfix">
	<label for="u">Username</label>
	<div class="input">
		<?php echo form_input($udata); ?>
	</div>
</div>

<div class="clearfix">
	<label for="p">Password</label>
	<div class="input">
		<?php echo form_password($pdata); ?>
	</div>
</div>
<?php
	echo form_submit($sdata);
	echo form_close();
?>
</div>