<?php
	//taken from https://www.sitepoint.com/community/t/prevent-direct-access-to-php-files/320889/3 on 10 March 2022

	//preventing direct access from url
	// This code contains code re-used from Assignmenet 3 in this course. This code is used with Prof. Raghav Sampangi's permission. 
// This code is used as a starting point for my solution for A4
	if (!defined('SECURE_PAGE'))
		{
			header("Location: ../index.php");
		}
 
	// The script
  
	/* Session destroy/unset functionality used from Example #1 in PHP.net
	   Authors: PHP.net contributors
	   URL: https://www.php.net/manual/en/function.session-destroy.php
	   Date accessed: 10 March 2022
	*/

	// Initialize the session.
	// If you are using session_name("something"), don't forget it now!

    
	session_start();

	// Unset all of the session variables.
	$_SESSION = array();

	// If it's desired to kill the session, also delete the session cookie.
	// Note: This will destroy the session, and not just the session data!
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}

	// Finally, destroy the session.
	session_destroy();

	// Redirect:
	//header("Location: ../index.php");

?>