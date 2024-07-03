<?php
/**
 * Functions
 * @author Nick Bair
 * Common functions I use
 */

/**
 * Cleans the string
 * @param <type> $input
 * @return <type>
 */
function cleanInput($input)
{
    return mysql_real_escape_string($input);
}

/**
 * Redirects to a specified page.
 * @param <type> $url
 * @param string $seconds
 */
function redirect($url, $seconds = FALSE) {
    if (!headers_sent() && $seconds == FALSE) {
        header("Location:" . $url);
    } else {
        if ($seconds == FALSE) {
            $seconds = "0";
        }
        echo "<meta http-equiv=\"refresh\" content=\"$seconds;url=$url\">";
    }
}

/**
 * Create a Random string. 
 * @return string
 */
function createRandomString() {
    $length = 32; 
    $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $characters .= "abcdefghijklmnopqrstuvwxyz";
    $characters .= "1234567890";

    for ($i = 0; $i < $length; $i++)
    {
        $random .= $characters[mt_rand(0, strlen($characters))];
    }
    return $random;
}

/**
 * Create a timestamp
 * @return date $timestamp
 */
function createTimeStamp() {
    $timestamp = date('Y-m-d H:i:s');
    return $timestamp;
}

/**
 * Function to display in <pre> formatted
 * @param <type> $val
 */
function print_d($val) {
    echo'<pre>';print_r($val);exit;
}