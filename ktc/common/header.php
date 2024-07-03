<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CCH | <?php echo $pageTitle; ?>  </title>

    <meta name="description" content="">
    <meta name="author" content="">

    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet" />
    
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>

  </head>

  <body>
<div id="container">
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">

          <a class="brand" href="index.php">KTC Lookup</a>
 
            <!-- If the user is logged in Show some menu options -->
            <ul class="nav">
              <li <?php echo echoActiveClassByPage("index"); ?>><a href="index.php">Home</a></li>
              <?php if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == '1'): ?>
              	<li <?php echo echoActiveClassByPage("dashboard"); ?>><a href="dashboard.php">Dashboard</a></li>
              <?php endif; ?>
            </ul>
            <!-- End the user Logged in Menu -->
            <?php if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == '1'): ?>
				<ul class="nav pull-right">
					<li id="fat-menu" class="dropdown">
  						<a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['user']; ?><b class="caret"></b></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
							<li><a tabindex="-1" href="users.php">Manage Users</a></li>
							<li><a tabindex="-1" href="#">Another action</a></li>
							<li><a tabindex="-1" href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a tabindex="-1" href="logout.php">Log out</a></li>
  						</ul>
					</li>
  				</ul>
            	
            <?php else: ?>
            <form class="navbar-form pull-right" action="login.php" method="post">
              <input class="input-small" type="text" placeholder="email" name="email" />
              <input class="input-small" type="password" placeholder="password" name="password" />
              <button type="submit" class="btn">Sign in</button>
            </form>
        	<?php endif; ?>

        </div>
      </div>
    </div>

<?php

	function echoActiveClassByPage($requestUri)
	{
		$current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
		
		if($current_file_name == $requestUri)
			echo 'class="active"';
	}
	
?>
