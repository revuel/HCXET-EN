<!DOCTYPE html>
<html lang = "es">
	<head>
		<!-- ---------------------------------------------------------------------------
		
		Project: Human Centeredness experimental evaluation tool
		Author: Olga Peñalba, Miguel Revuelta
		Date: 2015-09-1
		Version: 2.1 (english)

		---------------------------------------------------------------------------- -->
		
		<title> HCXET | Participate </title>
		
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
	</head>
	
	<body>
		<!-- Cabecera -->
		<header class="pushdown">
			<?php include '../Include/cabecera1.php'; ?>
		</header>
		<br>
		<!-- Contenido principal -->
		<main>
			<div class = "container">
				<div class = "row well">
					<form class="form-signin" role="form" action = "Estudio/accesoestudio.php" method = "post">
						<h2 class="form-signin-heading text-center">Access to answer a survey</h2>
						<hr>
						<div class = "col-xs-12 col-sm-6 col-md-offset-3">
							<label class="control-label" for="email" >Email</label>
							<input type="email" class="form-control" id="email" placeholder="Email address holding an invitation"  name="id_destinatario"required>
							<br>	
							<label class="control-label" for="pwd" >Name of the study</label>       
							<input type="text" class="form-control" id="estudio" placeholder="Type the name of the study" name="id_target" required>
							<br>	
							<label class="control-label" for="pwd" >Personal access key</label>       
							<input type="password" class="form-control" id="codigo" placeholder="Access key" name="token" required>
							<br>
							<button class="btn btn-lg btn-primary btn-block" type="submit">Start</button>
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