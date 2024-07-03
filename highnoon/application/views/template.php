<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/normalize.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">

    <script src="<?php echo base_url(); ?>assets/js/vendor/modernizr-2.6.2.min.js"></script>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/carousel.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
</head>
<body>
<!--[if lt IE 7]>

<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
<div id="wrap">
    <div class="header"> <!-- Start Container -->
        <div class="row">
            <div class="col-md-4">
                <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo.png" alt="High Noon Holsters"></a>
            </div>
            <div class="col-md-8">
                <div class="pull-right"><img src="<?php echo base_url(); ?>assets/img/specials.png"></div>
            </div>
        </div>
    </div> <!-- /.container -->

    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="col-md-2">
                <ul class="nav navbar-nav order-status">
                    <?php if($this->session->userdata('is_logged_in')): ?>
                    <li>
                        <h6>Order Status<br>
                            <small>Shipped</small><br>
                            <a href="http://www.ups.com/tracking/tracking.html">1Z9999999999999999</a></h6>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!--
            <form class="navbar-form navbar-left menu-search" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
            -->
            <div class="col-xs-12 col-sm-6 col-md-8 nav-search">
                <ul>
                    <li>
                        <div class="input-group">
                            <input type="text" class="form-control">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">Go!</button>
							</span>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="col-md-2 nav-btn-menu">
                <?php if($this->session->userdata('is_logged_in')): ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        <span class="badge badge-warning">3</span>
                    </button>
                </div>
                <?php endif; ?>
                <div class="btn-group">
                    <?php if($this->session->userdata('is_logged_in')): ?>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <?php echo $this->session->userdata('nickname'); ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Orders</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>main/logout">Logout</a></li>
                    </ul>
                    <?php else: ?>
                    <a href="<?php echo base_url(); ?>main/login" class="btn btn-default" role="button">Login</a>
                    <a href="<?php echo base_url(); ?>main/register" class="btn btn-primary" role="button">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div><!-- /.navbar-collapse -->
    </nav>

    <div class="main">
        <?php $this->load->view($content); ?>
    </div>

    <div class="footer">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <ul>
                    <lh>Information</lh>
                    <li>Holster Help</li>
                    <li>About Us</li>
                    <li>Subscribe</li>
                    <li>Return Policy</li>
                    <li>Repairs Policy</li>
                </ul>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <ul>
                    <lh>Customer Service</lh>
                    <li>Contact Us</li>
                    <li>Questions</li>
                    <li>Guarantee</li>
                </ul>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <ul>
                    <lh>Extras</lh>
                    <li>Order Status</li>
                    <li>Ordering Info</li>
                    <li>Turnaround Times</li>
                </ul>
            </div>
        </div>
    </div>
</div> <!-- /.wrap -->



<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

<script src="<?php echo base_url(); ?>assets/js/plugins.js"></script>
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/holder.js"</script>

<script>
var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src='//www.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
</body>
</html>