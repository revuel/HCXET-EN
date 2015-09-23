<?php
	/* -----------------------------------------------------------------------------
		
		Proyecto: Human Centeredness experimental evaluation tool
		Autores: Olga Peñalba, Miguel Revuelta
		Fecha: 2015-09-1
		Versión: 2.0 (español)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Este script contrasta los valores del formulario de acceso a un estudio con 
		la base de datos y establece las cookies correspondientes en caso de haber
		introducido correctamente los datos de validación.
	*/
	
	// Importando clase de consultas
	require_once '../Web/Classes/DB_functions.php';
	
	// Captura de datos del formulario
	$destinatario = $_POST['id_destinatario']; // Realmente no son los id, son los nombres
	$target = $_POST['id_target'];
	$token = $_POST['token'];
	
	try {
		$db = new DB_Functions();
		
		// Seleccionar id_target e id_destinatario segun los nombres de target y de destinatario de la BD
		$destinatario = $db->getIddestinatario($destinatario);
		$target = $db->getIdtarget($target);
		
		// Comprobando resultado de la validación
		$result = $db->controlAccesoEstudio($destinatario, $target, $token);
		
		if($result == true) {
			// Inicio de sesión con id de usuario
			session_start();
			
			$_SESSION['destar'] = $destinatario + $target;
			
			// Asignación de cookies
			$cookie_name1 = "destinatario";
			$cookie_value1 = $destinatario;
			setcookie($cookie_name1, $cookie_value1, time() + (86400 * 30), "/");
			$cookie_name2 = "target";
			$cookie_value2 = $target;
			setcookie($cookie_name2, $cookie_value2, time() + (86400 * 30), "/");
			
			// Traslado a realizar la encuesta
			header("Location: /HCXET-EN/Estudio/estudio.php");
			die();
			
		} else {
			
			// Acceso no superado, reintentarlo de nuevo
			header("Location: /HCXET-EN/Estudio/formestudio.php");
			die();
		}
	} catch(PDOException $e) {
		// posible captura de mensaje de error
	}
?>