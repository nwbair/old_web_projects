<?php 
//include ('inc/base.php');

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'sye') {

} else {

?>

	<div class="container">

      <form class="form-signin" method="post" action="login_process.php">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="input-block-level" placeholder="Email address" name="email"
			<?php if(isset($_COOKIE['remember_me'])) { 
				echo "value='" . $_COOKIE['remember_me'] . "'"; 
			} ?>
		>
        <input type="password" class="input-block-level" placeholder="Password" name="password">
        <label class="checkbox">
          <input type="checkbox" value="remember-me" name="remember-me"> Remember me
        </label>
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->

<?php } ?>