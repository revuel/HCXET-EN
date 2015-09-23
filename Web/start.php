<?php 
	
	/* -----------------------------------------------------------------------------
		
		Project: Human Centeredness experimental evaluation tool
		Author: Olga Peñalba, Miguel Revuelta
		Date: 2015-09-1
		Version: 2.1 (english)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Página principal de gestión.
	*/
	
	// Comprobación de autorización
	include 'Session/checksession.php'; // Comprobando autorización
	
	// Importando e instanciando clase consultas
	require_once 'Classes/DB_functions.php';
	$db = new DB_Functions();
	
	// Consultas (con la cookie para el id)
	$u = $_COOKIE['usuario'];
	$nomuser = $db->getNombreusuario($u); // Nombre del usuario
	
	if (strlen ($nomuser)== 0){
		$nomuser = 'unknown';
	}
?>

<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> HCXET | <?=$nomuser?> </title>
		
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
		<script src="JavaScript/hcxet.js"></script>
	</head>
	
	<body>
		<!-- Cabecera -->
		<header>
			<?php include 'Include2/cabecera2.php'; ?>
		</header>
		
		<!-- Contenido principal -->
		<main>
			<h3 class="text-center">Main</h3>
			<hr>
			<div class="container well text-center">
				<div class="row">
					<h4 class = "text-center">Actions</h4>
					<div class="col-xs-6 col-md-4 col-sm-4">
						<a href="Web/nuevotarget.php">
							<img class = "img-responsive center-block" src="Pics/nuevaencuesta.png" alt="Crear nueva encuesta" title = "Click to set up a new study">
						</a>
						<a href ="Web/cursotarget.php">
							<img class = "img-responsive center-block" src="Pics/pendienteencuesta.png" alt="Comprobar estado encuesta" title = "Click to check study state">
						</a>
					</div>
					<div class="col-xs-6 col-md-4 col-sm-4">
						<a href="Web/Listas/listas.php">
						<img class = "img-responsive center-block" src="Pics/mislistas.png" alt="Lista de direcciones" title = "Click to manage participant lists"></a>
					</div>
					<div class="col-xs-6 col-md-4 col-sm-4">
						<a href="Web/misresultados.php">
						<img class = "img-responsive center-block" src="Pics/misresultados.png" alt="Resultados de mis encuestas" title = "Click to verify study results">
					</div>
				</div>
			</div>
		</main>
		
		<!-- Pie de página-->
		<footer>
			<?php include 'Include2/pie2.php'; ?>
		</footer>
	</body>
</html>