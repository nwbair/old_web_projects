<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title><?php echo $title; ?></title>
	<link href="<?php echo base_url() ;?>assets/css/dateinput.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ;?>assets/js/bootstrap/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ;?>assets/css/default.css" rel="stylesheet" type="text/css" />
<noscript>
Javascript is not enabled! Please turn on Javascript to use this site.
</noscript>

<script type="text/javascript">
//<![CDATA[
base_url = '<?php echo base_url();?>';
//]]>
</script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.7.1.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/1.2.6/full/jquery.tools.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap/js/bootstrap-dropdown.js"></script>

</head>
<body>
		
<div id="wrapper">
	<div id="container">
  		<div id="header">
  			<?php $this->load->view('header');?>
  		</div>

  		<div id="main">
  			<?php $this->load->view($main);?>
  		</div>
  
  		<div id="footer"> 
  			<?php $this->load->view('footer');?>
  		</div>
	</div><!-- end container -->
</div><!-- end wrapper -->
</body>
</html>
