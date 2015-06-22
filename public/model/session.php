<?php

function validateSession() {
			session_start();

			if (!isset($_SESSION['user_id'])) {
				header('Location:/.');
			}
			//|| time() - $_SESSION['login_time'] > 600 //en caso de que se caduque la sesion
}



?>
