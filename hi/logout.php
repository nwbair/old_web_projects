<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include('include/functions.php');

session_start();


if(isset($_SESSION['email'])) {
    session_unset();
    session_destroy();    
}

redirect('index.php');