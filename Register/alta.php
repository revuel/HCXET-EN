<?php

	/* -----------------------------------------------------------------------------
		
		Project: Human Centeredness experimental evaluation tool
		Author: Olga Peñalba, Miguel Revuelta
		Date: 2015-09-1
		Version: 2.1 (english)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Esta es la página de alta a un nuevo usuario. Si existe sesión iniciada, se
		desvía del formulario de registro a la página principal de gestión
	*/
	
	//creamos la sesion
	session_start();

	// Si hay sesión iniciada, nos trasladamos a la página de gestión
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
		<title> HCXET | Register </title>
		
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
		
		<!-- JAVASCRIPT -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="JavaScript/bootstrap.js"></script>
		<script>
			$(document).ready(function() { 
			
				 // refresh captcha
				 $('img#refresh').click(function() {  
						
						change_captcha();
				 });
				 
				 function change_captcha()
				 {
					document.getElementById('captcha').src="Captcha/get_captcha.php?rnd=" + Math.random();
				 }
			});
		</script>
	</head>
	
	<body>
		<!-- Cabecera -->
		<header class="pushdown">
			<?php include '../Include/cabecera1.php'; ?>
		</header>
		
		<!-- Contenido principal -->
		<main>
			<div class="container">
				<div class = "row well">
					<h2 class = "text-center">Register Form</h2>
					<p class = "text-center">
						Create an account on this web site if you are interested in check how the HCXET works and be able to send surveys and
						study their results</p>
					<hr>
					<form class="form-signin" role="form" action="Register/alta-action.php" method="post">
						<div class = "col-xs-12 col-sm-6 col-md-offset-3">
							<label class="control-label" for="email">Email</label>
							<input type="email" class="form-control" name="email" placeholder="Type your email address" required>
							<br>	
							<label class="control-label" for="pwd">Password</label>       
							<input type="password" class="form-control" name="pwd" placeholder="Key to acces your account in this web site" required>
							<br>	
							<label class="control-label" for="name">Name</label>       
							<input type="text" class="form-control" name="name" placeholder="What is your name? (optional)">
							<br>
							<label class="control-label" for="surname">Surname</label>       
							<input type="text" class="form-control" name="surname" placeholder="...and your surname? (optional)">
							<br>
							<div id="wrap" align="center">
								<img src="Captcha/get_captcha.php" alt="No load" id="captcha" title="Captcha image"/>
								<img src="Captcha/refresh.jpg" width="25" alt="" id="refresh" title="Refresh"/>
								<br>
								<input type="text" class="form-control" name="code" id="code" placeholder="Type captcha characters" required>
							</div>
							<br>
							<button class="btn btn-lg btn-primary btn-block" type="submit" id="Send">Register</button>
						</div>
						
					</form>
				</div>
			</div>
		</main>
	
		<!-- Pie de página-->
		<footer>
			<?php include '../Include/adorno.php'; ?>
		</footer>
	</body>
</html>