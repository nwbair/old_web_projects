<?php

session_start();

include('include/config.php');
include('include/functions.php');
include('include/adodb/adodb.inc.php');
include('templates/navigation.html');


// Establish the db connection.
$db = NewADOConnection('mysql');
$db->Connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
        or die("Unable to connect to the database.");

if(isset($_SESSION['email'])) {
    $msg = 'You are already logged in. If you are not ' . $_SESSION['email'];
    $msg .= ', click <a href="logout.php">here</a>.';
    echo $msg;

} else {
    // Checks to see if the form has been submitted and creates a session.
    if (isset($_POST['login_email']) && isset($_POST['login_password'])) {
        // Clean post variables before using in the SQL query.
        $email = cleanInput($_POST['login_email']);
        $password = cleanInput($_POST['login_password']);

        $login = $db->Execute('Select * from user where email = "' . $email . '" and password = "'
                               . md5($password) . '" and user_status != 0') or die("Login error: $login. " . $db->ErrorMsg());

        if ($login->RecordCount() == '1')
        {
           while ($arr = $login->FetchRow())
           {
                // sets the session variables.
               $_SESSION['email'] = $email;
               redirect('index.php');
           }
        }

    } else {
            echo 'Please login.';
    }
    include('templates/LoginForm.html');
}