<?php

	/* -----------------------------------------------------------------------------
		
		Proyecto: Human Centeredness experimental evaluation tool
		Autores: Olga Peñalba, Miguel Revuelta
		Fecha: 2015-09-1
		Versión: 2.0 (español)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Este script agrega un email de un participante a una lista de correos de un
		usuario en la base de datos.
	*/
	
	// Comprobando autorización de sesión
	include '../Session/checksession.php'; // Comprobando autorización
	
	// Importando clase consultas
	require_once '../Classes/DB_functions.php';
	
	// Captura de datos
	$lista = $_POST['lista'];
	$email = $_POST['email'];
	
	try {
		// Instanciando clase consultas
		$db = new DB_Functions();
		
		// Comprobar si el participante existe o no
		$id_dest_actual = $db->existeDestinatario($email);
		
		if ($id_dest_actual != false) {
			// # participante existe
			$db->agregarParticipantealista($lista, $id_dest_actual); // Alta tabla listas (simplemente agregarlo a la lista)
		} else {
			// # participante NO existe
			$db->nuevoDestinatario($email); // Alta del participante en la tabla destinatario
			$id_dest_actual = $db->existeDestinatario($email); // Capturar id del participante recién creado
			$db->agregarParticipantealista($lista, $id_dest_actual); // Alta tabla listas
		}
	} catch(PDOException $e) {
		echo("Error: " + $e);
	}
	
	// Nos trasladamos a la página del action de invocación
	header("Location: /HCXET-EN/Web/Listas/nuevoparticipante.php");
	die();
?>