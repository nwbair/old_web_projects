<?php

/**
 * Session class to handle session functions.
 * USAGE: $session = new Session();
 * $session->set('data','Bye!');
 * echo ($session->get('data');
*/
class Session {

	# Constructor to start session.
	function Session() {
		session_start();
	}
	
	# Set session variables with this function.
	function set($name, $value) {
		$_SESSION[$name] = $value;
	}
	
	# Get session variables with this function.
	function get($name) {
		if ( isset ($_SESSION[$name]))
			return $_SESSION[$name];
		else
			return false;
	}
	
	# delete session variables with this function.
	function del ($name) {
		if ( isset($_SESSION[$name])) {
			unset($_SESSION[$name]);
			return true;
		} else {
			return false;
		}
	}
	
	# Destroy the session.
	function destroy() {
		$_SESSION = array();
		session_destroy();
	}
	
}
?>