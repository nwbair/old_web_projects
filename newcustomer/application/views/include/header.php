<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?=$title;?></title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->	
    <!-- Le styles -->
    <link href="<?=base_url();?>bootstrap/bootstrap.css" rel="stylesheet">	
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 40px; /* 40px to make the container go all the way to the bottom of the topbar */
      }
      .container > footer p {
        text-align: center; /* center align it with the container */
      }
      .container {
        width: 90%; /* downsize our container to make the content feel a bit tighter and more cohesive. NOTE: this removes two full columns from the grid, meaning you only go to 14 columns and not 16. */
      }

      /* The white background content wrapper */
      .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; /* negative indent the amount of the padding to maintain the grid system */
        -webkit-border-radius: 0 0 6px 6px;
           -moz-border-radius: 0 0 6px 6px;
                border-radius: 0 0 6px 6px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

      /* Page header tweaks */
      .page-header {
        background-color: #f5f5f5;
        padding: 20px 20px 10px;
        margin: -20px -20px 20px;
      }

      /* Styles you shouldn't keep as they are for displaying this base example only */
      .content .span10,
      .content .span4 {
        min-height: 500px;
      }
      /* Give a quick and non-cross-browser friendly divider */
      .content .span4 {
        margin-left: 0;
        padding-left: 19px;
        border-left: 1px solid #eee;
      }

      .topbar .btn {
        border: 0;
      }
	  
	  .modal-from-dom {
    ...
    width: 560px;
    top: 50%;
    margin: -250px 0 0 -250px;
}

    </style>
	
	<script src="<?=base_url();?>bootstrap/js/jquery-1.5.2.min.js"></script>	
    <script src="<?=base_url();?>bootstrap/js/jquery.tablesorter.min.js"></script>
	<script src="<?=base_url();?>bootstrap/js/bootstrap-dropdown.js"></script>
	<script src="<?=base_url();?>bootstrap/js/bootstrap-popover.js"></script>
	<script src="<?=base_url();?>bootstrap/js/bootstrap-twipsy.js"></script>
	<script src="<?=base_url();?>bootstrap/js/bootstrap-modal.js"></script>
	

  </head>

  <body>
 
  <div class="topbar" data-dropdown="dropdown">
      <div class="fill">
        <div class="container">
          <a class="brand" href="#"><?=$title;?></a>
		   <?php
  			if($this->session->userdata('fullname') && $this->session->userdata('userLevel') > 0)
			{								
  			?>
	          <ul class="nav">
					<li><a href="<?=base_url();?>">Home</a></li>												            
					<li class="dropdown" data-dropdown="dropdown" >
					<a href="#" class="dropdown-toggle">Reports</a>
						<ul class="dropdown-menu">
							<li align="center">Web Reports</li>
							<li><a href="<?=base_url();?>index.php/admin/viewUnassignedCustomers">All Unassigned</a></li>
							<li><a href="<?=base_url();?>index.php/admin/viewOpenCustomers">All Open</a></li>
							<li><a href="<?=base_url();?>index.php/admin/viewClosedCustomers"">All Closed *slow*</a></li>
							<li><a href="<?=base_url();?>index.php/admin/viewClosedCustomersTickets">Closed with Ticket</a></li>
							<li class="divider"></li>
							<li align="center">Excel Reports</li>
							<li><a href="<?=base_url();?>index.php/reports/reportUnassigned">All Unassigned</a></li>
							<li><a href="<?=base_url();?>index.php/reports/reportAllOpen">All Open</a></li>
							<li><a href="<?=base_url();?>index.php/reports/reportAllClosed">All Closed</a></li>
							<li><a href="<?=base_url();?>index.php/reports/reportClosedWithTicket">Closed with Ticket</a></li>
							<li><a href="<?=base_url();?>index.php/reports/reportClosedWithLast24Hours">Closed Last 24 Hours</a></li>
							<li><a href="<?=base_url();?>index.php/reports/reportClosedWithLast7Days">Closed Last 7 Days</a></li>
							<li><a href="<?=base_url();?>index.php/reports/reportClosedsinceFirstofMonth">Closed Since the First</a></li>
						</ul>					
					</li>	
					
					
					<li class="dropdown" data-dropdown="dropdown" >
					<a href="#" class="dropdown-toggle">Assigned To</a>
						<ul class="dropdown-menu">
							<li align="center">Active Users</li>							
							<li class="divider"></li>
						<?php foreach ($users as $datas): ?>
						<?php if($datas->active == "T" && $datas->userLevel < 1) {?>
							
						<li><a href="<?=base_url();?>index.php/customers/viewUserCustomers/<?=$datas->fullname;?>"><?=$datas->fullname;?></a></li>
						
						<?php }?>
					<?php endforeach; ?>				
						</ul>
					</li>				
					<li><a href="<?=base_url();?>index.php/users/viewUsers">View Users</a></li>
	          	</ul>
				<FORM METHOD="LINK" ACTION="<?=base_url();?>index.php/welcome/signout" class="pull-right">
					<button class="btn" type="submit">Sign Out</button>
				</FORM>
		  
		   <?php
  			}
			else if($this->session->userdata('fullname') && $this->session->userdata('userLevel') < 1)
			{
			?>
				<ul class="nav">
					<li><a href="<?=base_url();?>">Home</a></li>
		            <li><a href="<?=base_url();?>index.php/customers/viewUserCustomers/<?=$this->session->userdata('fullname');?>">My Open Customers</a></li>
		            <li><a href="<?=base_url();?>index.php/customers/viewCompletedCustomers/<?=$this->session->userdata('fullname');?>">My Closed Customers</a></li>
	          	</ul>
				   <FORM METHOD="LINK" ACTION="<?=base_url();?>index.php/welcome/signout" class="pull-right">
					<button class="btn" type="submit">Sign Out</button>
				</FORM>
			<?php
			} 			
			
			if(!$this->session->userdata('fullname'))
			{
			$attributes = array('class' => 'pull-right', 'id' => 'login');
  			echo form_open('login/authUser', $attributes);
			$username = array(
              'name'        => 'Username',
              'placeholder' => 'Username',
              'class'       => 'input-small');

			echo form_input($username);
			$password = array(
              'name'        => 'Password',
              'placeholder' => 'Password',
              'class'       => 'input-small');

			echo form_password($password);
			
			?>
            <button class="btn" type="submit">Sign in</button>
          </form>
		  <?php
  			}
			?>
        </div>
      </div>
    </div>

    <div class="container">
			