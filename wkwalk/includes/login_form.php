<div id="login">
	<form method="post" action="login.php">
		<label for="email">Email</label> <input type="text" id="login_email" name="login_email" class="input" />
		<label for="password">Password</label> <input type="password" id="" name="login_password" class="input" />
		<input type="hidden" name="letmein" value="yup" />
		<input type="submit" value="Login" class="button" />
		<input type="button" value="Register" onclick="window.location.href='index.php?register'" class="button" />
	</form> 
</div>