<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
	<div class="container">
	  <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="brand" href="index.php">Techsource Management Console</a>
	  <div class="nav-collapse collapse">
		<ul class="nav">
		  <li class="active"><a href="index.php">Home</a></li>
		</ul>
		<ul class="nav pull-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<?php echo $_SESSION['user']; ?>
				<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					
					<li class="divider"></li>
					<li><a href='logout.php'>Logout</a></li>
				</ul>
			</li>
		</ul>
	  </div><!--/.nav-collapse -->
	</div>
  </div>
</div>