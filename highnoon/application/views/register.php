<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">

    <?php
    if (validation_errors() != false) {
        echo '<div class="alert alert-danger alert-dismissable">';
        echo validation_errors();
        echo '</div>';
    }

    $attributes = array('class'=>'form-signin');

    echo form_open('main/register_validation', $attributes);
    echo '<h2 class="form-signin-heading">Please sign up!</h2>';

    $data = array(  'name'=>'email',
        'class'=>'form-control',
        'placeholder'=>'Email address',
        'required'=>'required',
        'value'=>$this->input->post('email')
    );
    echo form_input($data);

    $data = array(  'name'=>'nickname',
        'class'=>'form-control',
        'placeholder'=>'First Name',
        'required'=>'required',
        'value'=>$this->input->post('nickname')
    );
    echo form_input($data);

    $data = array(  'name'=>'password',
        'class'=>'form-control',
        'placeholder'=>'Password',
        'required'=>'required'
    );
    echo form_password($data);

    $data = array(  'name'=>'cpassword',
        'class'=>'form-control',
        'placeholder'=>'Confirm Password',
        'required'=>'required'
    );
    echo form_password($data);

    $data = array(  'name'=>'submit',
        'class'=>'btn btn-lg btn-primary btn-block',
        'type'=>'submit',
        'value'=>'Sign up'
    );
    echo form_submit($data);

    echo form_close();
    ?>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>

<!-- OLD CODE

    <form class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" class="form-control" placeholder="Password" required>
        <label class="checkbox">
            <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

 -->