<?php
	/* -----------------------------------------------------------------------------
		
		Proyecto: Human Centeredness experimental evaluation tool
		Autores: Olga Peñalba, Miguel Revuelta
		Fecha: 2015-09-1
		Versión: 2.0 (español)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Gestión de permisos 
	*/

	// Creamos la sesion
	session_start();
	
	// Validación de sesión
	if(!isset($_SESSION['id'])) {
		// # usuario NO tiene sesión
		header("Location: /HCXET-EN/index.php"); // Expulsar
		exit();
	}
?>