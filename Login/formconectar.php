<?php

	/* -----------------------------------------------------------------------------
		
		Project: Human Centeredness experimental evaluation tool
		Author: Olga Peñalba, Miguel Revuelta
		Date: 2015-09-1
		Version: 2.1 (english)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Este script comprueba el estado de la sesión para determinar si enviar al
		usuario al formulario de acceso o a la página principal de gestión.
	*/
	
	// Creamos la sesion
	session_start();

	// Evitar el formulario de acceso si ya hay sesión iniciada
	if(isset($_SESSION['id'])) {
	  header("Location: /HCXET-EN/Web/start.php");
	  exit();
	}
?>

<!DOCTYPE html>
<html lang = "es">
	<head>
	
		<!-- ---------------------------------------------------------------------------
		
		Project: Human Centeredness experimental evaluation tool
		Author: Olga Peñalba, Miguel Revuelta
		Date: 2015-09-1
		Version: 2.1 (english)

		---------------------------------------------------------------------------- -->
		
		<title> HCXET | Log In</title>
		
		<base href="../">
		 
		<!-- METADATOS -->
		<meta charset="utf-8">
		<meta name="author" content="Olga Peñalba Rodríguez, Miguel Revuelta Espinosa">
		<meta name="description" content="Human Centered Systems Experimental Evaluation Tool">
		<meta name="keywords" content="HCS, HCC, HCD, Human Centered Systems, Sistemas Centrados en la Persona">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- CSS -->
		<link rel="stylesheet" href="CSS/reset.css" type="text/css" media="screen">
		<link rel="stylesheet" href="CSS/bootstrap.css" type="text/css" media="screen">
		<link rel="stylesheet" href="CSS/bootstrap-theme.css" type="text/css" media="screen">
		<link rel="stylesheet" href="CSS/hcxet.css" type="text/css" media="screen">
		
		<style>		
			.vertical-center {
			  min-height: 100%;  
			  min-height: 100vh;
			  display: flex;
			  align-items: center;
			}
		</style>
		
		<!-- JAVASCRIPT -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="JavaScript/bootstrap.js"></script>
	</head>
	
	<body>
		<!-- Cabecera -->
		<header class="pushdown">
			<?php include '../Include/cabecera1.php'; ?>
		</header>
		
		<!-- Contenido principal -->
		<main>
			<div class = "row well">
			<h2 class = "text-center">Log in</h2>
				<p class = "text-center">Session not initialized</p>
				<hr>
				<form class="form-signin" role="form" action= "Login/accion-conectar.php" method = "post">
					<div class = "col-xs-12 col-sm-6 col-md-offset-3">
						<label class="control-label" for="email">Email address</label>
						<input type="email" class="form-control" id="email" placeholder="Type your email address" name="user" required>
						<br>	
						<label class="control-label" for="pwd">Password</label>       
						<input type="password" class="form-control" id="estudio" placeholder="Type your password on this web site" name = "pass" required>
						<br>	
						<button class="btn btn-lg btn-primary btn-block" type="submit">Log In</button>
					</div>
				</form>
			</div>
		</main>
		
		<!-- Pie de página-->
		<footer>
			<?php include '../Include/adorno.php'; ?>
		</footer>
	</body>
</html>