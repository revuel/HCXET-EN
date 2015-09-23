<?php
	/* -----------------------------------------------------------------------------
		
		Proyecto: Human Centeredness experimental evaluation tool
		Autores: Olga Peñalba, Miguel Revuelta
		Fecha: 2015-09-1
		Versión: 2.0 (español)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Este script actualiza una lista en la base de datos. Para ello primero se
		desvinculan todos los participantes de una lista y se vuelve a generar la 
		misma con los nuevos valores POST.
	*/
	
	// Comprobando autorización de sesión
	include '../Session/checksession.php'; // Comprobando autorización
	
	// Importando clase consultas
	require_once '../Classes/DB_functions.php';
	
	// Captura de datos
	$lista = $_POST['lista'];
	$email = $_POST['email'];
	$myArray = explode(',', $email);
	print_r("lista emails " . $email . '<br>');
	print_r("conversion array  <br>");
	print_r($myArray);
	print_r("<br>");
	
	try {
		// Instanciando clase consultas
		$db = new DB_Functions();
		
		// Borrar la lista de contiene
		$db->desvincularParticipantes($lista);
		
		// Vaciar la lista
		if (strlen(trim($myArray[0])) == 0) {
			echo("solo había blancos");
		}
		else {
			foreach($myArray as $i) {
				
				$trim = trim($i);
				
				print_r('<br>' . $trim .'<br>');
				
				// Comprobar que el participante existe:
				$id_dest_actual = $db->existeDestinatario($trim);
				print_r(" id_dest_actual:  "  . $id_dest_actual);
				
				if ($id_dest_actual > 0) {
					// # participante existe 
					$db->agregarParticipantealista($lista, $id_dest_actual); // Alta tabla lista
				} else {
					// # participante NO existe
					$db->nuevoDestinatario($trim); // Alta tabla destinatario
					$id_dest_actual = $db->existeDestinatario($trim); // Capturar id destinatario recién creado
					$db->agregarParticipantealista($lista, $id_dest_actual); // Alta tabla lista
				}
			}
		}
	} catch(PDOException $e) {
		echo("Error: " + $e);
	}
	
	// Reubicación a la página de invocación
	header("Location: /HCXET-EN/Web/Listas/listas.php"); // Tal vez llevar a una pantalla de agradecimiento
	die();
?>