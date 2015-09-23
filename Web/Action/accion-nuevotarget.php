<?php
	
	/* -----------------------------------------------------------------------------
		
		Proyecto: Human Centeredness experimental evaluation tool
		Autores: Olga Peñalba, Miguel Revuelta
		Fecha: 2015-09-1
		Versión: 2.0 (español)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Este script recupera los datos del formulario de creación de un estudio 
		para incluir dicho estudio en la base de datos actualizando varias tablas.
		Iterativamente según van dándose de alta los participantes, les es enviado
		un correo a los mismos.
		
	*/
	
	// Autorización de sesión
	include '../Session/checksession.php'; // Comprobando autorización
	
	// Clase de consultas
	require_once '../Classes/DB_functions.php';
	
	// Captura de datos
	$nombre = $_POST['nombre'];
	$app = $_POST['app'];
	
	// Determinando si los participantes llegaron a través de lista o de tokenfields
	if (isset($_POST['participantes'])) {
		// # tokenfields
		$participantes = $_POST['participantes'];
		$myArray = explode(', ', $participantes);

	} else if (isset($_POST['lista'])) {
		// # lista
		$m = 0;
		$lista = $_POST['lista'];
		// Instancia clase consultas
		$db = new DB_Functions();
		// Obtener los datos de una lista de participantes
		$participantesaux = $db->listaNombresparticipantelista($lista);
		// Reconvertir a array de emails de participantes
		foreach ($participantesaux as $row) {
			$participantes[$m] = $row['email_destinatario'];
			$m = $m + 1;
		}
		$myArray = $participantes;
		$m = 0;
	}
	
	// Cookie de usuario
	$id_usuario = $_COOKIE['usuario'];
	
	// Comienza la creación del estudio
	try {
		// Instancia de clase consultas
		$db = new DB_Functions();
		$db->nuevoTarget($nombre, $app, $id_usuario); // Llamada a método: Alta en tabla target
		// Recuperar el id del target recientemente creado (al ser autoincrement debería ser el mayor nº)
		$id_target = $db->maxTargetid();
		
		// Para cada participante:
		foreach($myArray as $i)
		{
			$direccion = trim($i);
			// Creamos un token para el posible participante en esta encuesta
			$random_part = chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90));
			$rest = substr($app, 0, 2);
			$token = $random_part . $rest;
		
			// Comprobar que el participante existe:
			$id_dest_actual = $db->existeDestinatario($direccion);
			
			// Ver si el participante es antiguo o nuevo
			if ($id_dest_actual > 0) {
				// # Participante antiguo
				$db->setValoracionesIni($id_dest_actual, $id_target, $token); // Alta en tabla valoraciones
			} else {
				// # Participante nuevo
				$db->nuevoDestinatario($direccion); // Alta en tabla destinatario
				$id_dest_actual = $db->existeDestinatario($direccion); // Obtener id del destinatario recien creado
				$db->setValoracionesIni($id_dest_actual, $id_target, $token); // Alta en tabla valoraciones
			}
			
			// Se procede a envíar un email al participante
			/*$msg = "Su dirección de correo electrónico " . $i . " ha sido seleccionada para participar en el siguiente estudio:\n" .
			"\t" . $nombre . ",\t" . $app . "\n\nPara participar en el estudio, deberá conectarse a HCXET/Estudio/formestudio.php y emplear el
			siguiente identificador: " . $token . "\n\nGracias por su interés.";
			$msg = wordwrap($msg,70);
			mail($i, "Invitación a estudio", $msg);*/ // enviar
			
			require_once "Mail.php";
				
				$from = ""; // Mail address
				$to = $direccion;

				$host = ""; // Mail SSL SMTP host config
				$username = ''; // Mail address
				$password = ''; // Mail address password
				// Contact revuel22@hotmail.com for more info

				$subject = "New study on HCXET";
				$body = "Your email address " . $direccion . " has been selected to participate in the following study:\n" .
				"\tStudy name: " . $nombre . ",\tTarget application: " . $app . "\n\nTo participate, you must access this url http://hcxet-english.bitnamiapp.com/HCXET-EN/Estudio/formestudio.php  from your web browser.\n\n
				You must submit the form using the following token key: " . $token . "\n\nThank you for your collaboration.";

				$headers = array ('From' => $from, 'To' => $to,'Subject' => $subject);
				$smtp = Mail::factory('smtp',
				  array ('host' => $host,
					'auth' => true,
					'username' => $username,
					'password' => $password));

				$mail = $smtp->send($to, $headers, $body);

				if (PEAR::isError($mail)) {
				  echo($mail->getMessage());
				} else {
				  echo("Message successfully sent!\n");
				}
		}
	} catch(PDOException $e) {
		echo("Error: " + $e);
	}
	
	// Nos trasladamos a la página de gestión
	header("Location: /HCXET-EN/Web/start.php"); 
	die();
?>