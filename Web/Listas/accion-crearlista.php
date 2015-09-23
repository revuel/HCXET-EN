<?php
	/* -----------------------------------------------------------------------------
		
		Proyecto: Human Centeredness experimental evaluation tool
		Autores: Olga Peñalba, Miguel Revuelta
		Fecha: 2015-09-1
		Versión: 2.0 (español)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Este script crea una nueva lista de destinatarios en la base de datos.
	*/
	
	// Comprobando autorización de sesión
	include '../Session/checksession.php'; // Comprobando autorización
	
	// Importando clase consultas
	require_once '../Classes/DB_functions.php';
	
	// Captura de datos
	$nombrelista = $_POST['nombrelista'];
	$participantes = $_POST['participantes'];
	$myArray = explode(', ', $participantes);
	
	// Cookie
	$id_usuario = $_COOKIE['usuario'];

	try {
		// Instanciando clase consultas
		$db = new DB_Functions();
		
		// Creación de lo que viene a la lista
		$db->nuevaLista($nombrelista, $id_usuario);
		
		// Recuperar el id de la lista recientemente creada 
		$id_lista = $db->maxListaid();
		
		// Insertar a los participantes en la lista
		foreach($myArray as $i) {
			
			$trim = trim($i);
			
			// Comprobar que el participante existe:
			$id_dest_actual = $db->existeDestinatario($i);
			
			if ($id_dest_actual > 0) {
				// # participante existe
				$db->agregarParticipantealista($id_lista, $id_dest_actual); // Alta tabla lista
			} else {
				// # participante NO existe
				$db->nuevoDestinatario($trim); // Alta tabla destinatario
				$id_dest_actual = $db->existeDestinatario($trim); // Capturar id destinatario recién creado
				$db->agregarParticipantealista($id_lista, $id_dest_actual); // Alta tabla lista
			}
		}
	} catch(PDOException $e) {
		echo("Error: " + $e);
	}
	
	// Reubicación a la página de invocación
	header("Location: /HCXET-EN/Web/Listas/listas.php"); // Tal vez llevar a una pantalla de agradecimiento
	die();
?>