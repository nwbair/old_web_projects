<?php

/**
 * Redirect Pages
*/
function redirect($url, $seconds = FALSE) {
    if (!headers_sent() && $seconds == FALSE) { 
	header("Location:".$url);
    } else {
        if ($seconds == FALSE) { 
			$seconds = "0";
        }
		echo "<meta http-equiv=\"refresh\" content=\"$seconds;url=$url\">";
    }
}

/**
 * Cleans form input up
*/
function cleanInput($input){
	return mysql_real_escape_string($input);
}

/**
 * Sets the correct selected value on Select boxes.
*/
function isSelect($value1, $value2) {
	if ($value1 == $value2) {
		echo ' selected="yes" ';
	}	
}

function print_d($val) { 
	echo'<pre>';print_r($val);exit;
}

function set_Time($value) {
	date_default_timezone_set('America/Chicago');
	$timestamp = date("m/d/y \a\\t h:i:s a ", $value);
	echo $timestamp;
}
?>