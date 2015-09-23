<?php

	/* -----------------------------------------------------------------------------
		
		Proyecto: Human Centeredness experimental evaluation tool
		Autores: Olga Peñalba, Miguel Revuelta
		Fecha: 2015-09-1
		Versión: 2.0 (español)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Este script contrasta los datos capturados del formulario de acceso con la
		base de datos del sistema para determinar la validación de los mismos y 
		conducir al usuario a la página principal de gestión o a reintentar superar
		el login.
		
	*/
	
	// Importando clase de consultas
	require_once '../Web/Classes/DB_functions.php';
	
	// Captura de datos
	$user = $_POST['user'];
	$pass = $_POST['pass'];

	try {
		$db = new DB_Functions();
		$usuarioid = $db->getIdusuario($user); // crear metodo
		
		// Llamada al método de login
		$result = $db->acceso($user, $pass);
		
		if($result == true) {
			// Inicio de sesión con id de usuario
			session_start();
			
			$_SESSION['id'] = $user;
			
			// Establecimiento de cookies auxiliares..
			$cookie_name1 = "usuario";
			$cookie_value1 = $usuarioid;
			setcookie($cookie_name1, $cookie_value1, time() + (86400 * 30), "/");
			
			// Próxima ubicación página de gestión
			header("Location: /HCXET-EN/Web/start.php");
			die();
			
		} else {
			
			// Próxima ubicación formulario de acceso
			header("Location: /HCXET-EN/Login/formconectar.php");
			die();
		}
	} catch(PDOException $e) {
		// posible captura de mensaje
	} 
?>