<?php
	
	/* -----------------------------------------------------------------------------
		
		Proyecto: Human Centeredness experimental evaluation tool
		Autores: Olga Peñalba, Miguel Revuelta
		Fecha: 2015-09-1
		Versión: 2.0 (español)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Este script elimina cualquier sesión que esté activa.
	*/
	
	// Destruir todas las variables de sesión.
	$_SESSION = array();

	// Si se desea destruir la sesión completamente, borre también la cookie de sesión.
	// Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}

	// Finalmente, destruir la sesión.
	session_destroy();

	// Traslado a la página home
	header("Location: /HCXET-EN/");
	die();
?>