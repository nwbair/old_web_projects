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

?>