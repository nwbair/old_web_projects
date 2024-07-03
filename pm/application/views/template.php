<!doctype html>
<html lang="en">
<head>
  <meta charset=utf-8">
  <title><?php echo $title; ?></title>
	<link href="<?php echo base_url() ;?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ;?>assets/css/main.css" rel="stylesheet" type="text/css" />
<noscript>
Javascript is not enabled! Please turn on Javascript to use this site.
</noscript>

<script type="text/javascript">
//<![CDATA[
base_url = '<?php echo base_url();?>';
//]]>
</script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.8.2.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

</head>
<body>
		
<div id="wrapper">
	<div id="container">
  		<div id="top">
  			<?php $this->load->view('top');?>
  		</div>

  		<div id="main">
  			<?php $this->load->view($main);?>
  		</div>
  
  		<div id="footer"> 
  			<?php $this->load->view('bottom');?>
  		</div>
	</div><!-- end container -->
</div><!-- end wrapper -->
</body>
</html>
