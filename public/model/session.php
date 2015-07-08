<?php

function startSession() {
	// start the session with a persistent cookie of 2 day
	$lifetime = 60 * 60 * 24 * 2;             // 2 days in seconds
	session_set_cookie_params($lifetime, '/');
	session_start();
}

function validateSession() {

	if (!isset($_SESSION['user_id'])) {
		header('Location:/.');
	}
			//|| time() - $_SESSION['login_time'] > 600 //en caso de que se caduque la sesion
}

?>
