<?php
	
	/* -----------------------------------------------------------------------------
		
		Proyecto: Human Centeredness experimental evaluation tool
		Autores: Olga Peñalba, Miguel Revuelta
		Fecha: 2015-09-1
		Versión: 2.0 (español)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Este script borra listas de destinatarios (participantes a estudios).
		
	*/
	
	// Comprobando autorización de sesión
	include '../Session/checksession.php'; // Comprobando autorización
	
	// Importando clase consultas
	require_once '../Classes/DB_functions.php';
	
	// Captura de datos
	$lista = $_POST['lista'];
	
	try {
		// Instanciación de clase consultas
		$db = new DB_Functions();
		
		// Llamada a método: destruir lista
		$db->borrarlista($lista);
	} catch(PDOException $e) {
		echo("Error: " + $e);
	}
	
	// Volver a la página de invocación
	header("Location: /HCXET-EN/Web/Listas/borrarlista.php"); 
	die();
?>