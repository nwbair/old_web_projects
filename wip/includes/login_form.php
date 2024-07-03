	<form method="post" action="login.php">
		Email: <input type="text" name="login_email" />
		Password: <input type="password" name="login_password" />
		<input type="hidden" name="letmein" value="yup" />
		<input type="submit" value="Login" />
		<input type="button" value="Register" onclick="window.location.href='index.php?register'">
	</form>