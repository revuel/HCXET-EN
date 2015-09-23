<?php

	/* -----------------------------------------------------------------------------
		
		Proyecto: Human Centeredness experimental evaluation tool
		Autores: Olga Peñalba, Miguel Revuelta
		Fecha: 2015-09-1
		Versión: 2.0 (español)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Este script da de alta a un nuevo usuario. Para ello deberá controlar que 
		la dirección de correo no esté en uso y que el usuario supere el captcha.
		En caso favorable lo dará de alta en la base de datos, creará una carpeta 
		para dicho usuario y le enviará una notificación por correo electrónico.
		
	*/
	
	// Inicialización de sesión
	session_start();
	
	// Clase de consultas
	require_once '../Web/Classes/DB_functions.php';
	
	// Capturar datos
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$code = $_POST['code'];
	
	// Comprobar el captcha
	if((strtolower($code)) == strtolower($_SESSION['random_number'])) {
		// # Captcha superado
		
		// Comprobar que esa dirección no esté inscrita
		$db = new DB_Functions();
		$id = $db->getIdusuario($email);
		
		if (isset($id)) {
			// # Dirección NO disponible
			include '../Dialog/warning.php'; // Advertir de que la dirección está en uso...
			die();
			
		} else {
			// # Dirección disponible
			try {
				// Insertar nuevo usuario en la base de datos
				$db->setUsuario($email, $pwd, $name, $surname);
				
				// Crear un directorio del nuevo usuario dentro del sistema (usar su id concatenado con su nombre?)
				$id = $db->getIdusuario($email);
				$folder = $id . $name;
				mkdir("../Web/Users/" . $folder);

				// Enviar un email de confirmación de que la cuenta ha sido creada
				/*$msg = "Welcome to HCXET.\n Your account has been created. \n Thank you.";
				$msg = wordwrap($msg,70);
				mail($email, "Cuenta en HCXET", $msg); // enviar*/
				require_once "Mail.php";
				
				$from = ""; // Mail address
				$to = $email;

				$host = ""; // Mail SSL SMTP host config
				$username = ''; // Mail address
				$password = ''; // Mail address password
				// Contact revuel22@hotmail.com for more info

				$subject = "Account creation: HCXET";
				$body = "Welcome to HCXET.\n Your account has been created. \n Thank you.";

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
				
				// Mensaje todo OK y para reenviar a página de login
				include '../Dialog/success.php';
				die();
			}
			catch(Exception $e) {
				// Hubo un error, no pudo crearse la cuenta
				echo 'Message: ' .$e->getMessage();
				include '../Dialog/error.php';
				die();
			}
		}
	} else {
		// # Captcha  NO superado
		include '../Dialog/nocaptcha.php';
		die();
	}
?>