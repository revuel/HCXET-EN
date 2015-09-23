<?php
	
	/* -----------------------------------------------------------------------------
		
		Project: Human Centeredness experimental evaluation tool
		Author: Olga Peñalba, Miguel Revuelta
		Date: 2015-09-1
		Version: 2.1 (english)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Este script realiza una llamada al script de R encargado de gestionar los 
		resultados de una encuesta mediante lógica borrosa para posteriormente 
		cargar las imágenes generadas por el procesamiento de R.
	*/
	
	// Comprobando autorización de sesión
	include '../Session/checksession.php'; // Comprobando autorización
	
	// Importando e instanciando clase consultas
	require_once '../Classes/DB_functions.php';
	$db = new DB_Functions();
	
	// Adquisición de cookies
	$u = $_COOKIE['usuario'];
	$t = $_POST['target'];
	
	// Consultas
	$nomuser = $db->getNombreusuario($u);
	
	$estudio = $db->getNombreestudio($t);
	$resultado = $db->mediasRespuesta($t);
	
	// Determinar nombre del directorio del que es propietario el usuario en el sistema
	if (!(isset($nomuser))){
		$folder = $u;
	} else {
		$folder = $u . $nomuser;
	}
	
	// Evitar llamar a R si es nulo el primer índice del array de medias de respuestas
	if((!isset($t)) || (!isset($resultado[0][0]))){
		header("Location: /HCXET-EN/Web/misresultados.php"); 
		die();
	}
	
	// Captura de datos y preparación de los datos que envíar a R (incluye folder)
	$test = $resultado[0][0] . ' ' .  $resultado[0][1] . ' ' . $resultado[0][2] . ' ' . $resultado[0][3] . ' ' . $resultado[0][4] . ' ' . $resultado[0][5]. ' ' . $resultado[0][6] . ' ' . $resultado[0][7] . ' ' . $resultado[0][8] . ' ' . $resultado[0][9] . ' ' . $resultado[0][10] . ' ' . $resultado[0][11] . ' ' . $resultado[0][12] . ' ' . $resultado[0][13] . ' ' . $resultado[0][14] . ' ' . $folder; 
	
	// Ejecutar script de R 
	try {
		exec("Rscript HCC-Fuzzy.R $test");
	}
	catch (Exception $e) {
		echo 'Exception captured: ',  $e->getMessage(), "\n";
	}
?>

<!DOCTYPE html>
<html lang = "en">
	<head>
		<!-- ---------------------------------------------------------------------------
		
		Project: Human Centeredness experimental evaluation tool
		Author: Olga Peñalba, Miguel Revuelta
		Date: 2015-09-1
		Version: 2.1 (english)

		---------------------------------------------------------------------------- -->
		<title> HCXET | <?=$nomuser?> </title>
		
		<base href="../">
		 
		<!-- METADATOS -->
		<meta charset="utf-8">
		<meta name="author" content="Olga Peñalba Rodríguez, Miguel Revuelta Espinosa">
		<meta name="description" content="Human Centered Systems Experimental Evaluation Tool">
		<meta name="keywords" content="HCS, HCC, HCD, Human Centered Systems, Sistemas Centrados en la Persona">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- CSS -->
		<link rel="stylesheet" href="../CSS/reset.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../CSS/bootstrap.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../CSS/bootstrap-theme.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../CSS/bootstrap-table.css">
		<link rel="stylesheet" href="../CSS/hcxet.css" type="text/css" media="screen">
		
		<!-- JAVASCRIPT -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="../JavaScript/hcxet.js"></script>
		
	</head>
		<body>
		<!-- Cabecera -->
		<header>
			<?php include '../Include2/cabecera2.php'; ?>
		</header>
		
		<!-- Contenido principal -->
		<main>
			<h3 class="text-center">Study results <?=$estudio?></h3>
			<div class="container  text-center">
				<h4>Statistical processing</h4>
				<div class="row">
					<div class="col-xs-6 col-md-6 col-sm-4 well">
						<p>Mean value per answer</p>
						<img class = "img-responsive center-block" src='Users/<?=$folder?>/mf.png' alt="Means"></img>
					</div>
					<div class="col-xs-6 col-md-6 col-sm-4 well">
						<p>Answer frequency by interval</p>
						<img class = "img-responsive center-block" src='Users/<?=$folder?>/hg.png' alt="Histogram"></img>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-12 col-sm-12 well">
						<p>Radar chart</p>
						<img class = "img-responsive center-block" src='Users/<?=$folder?>/ra.png' alt="Radar"></img>
					</div>
				</div>
				<h4>Fuzzy processing</h4>
				<div class="row">
					<div class="col-xs-6 col-md-6 col-sm-4 well">
						<p>Harmony principle</p>
						<img class = "img-responsive center-block" src='Users/<?=$folder?>/input1.png' alt="Input variable 1"></img>
					</div>
					<div class="col-xs-6 col-md-6 col-sm-4 well">
						<p>Active Context Appreciation principle</p>
						<img class = "img-responsive center-block" src='Users/<?=$folder?>/input2.png' alt="Input variable 2"></img>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-md-6 col-sm-4 well">
						<p>Information Display principle</p>
						<img class = "img-responsive center-block" src='Users/<?=$folder?>/input3.png' alt="Input variable 3"></img>
					</div>
					<div class="col-xs-6 col-md-6 col-sm-4 well">
						<p>Intercession for Knowledge principle</p>
						<img class = "img-responsive center-block" src='Users/<?=$folder?>/input4.png' alt="Input variable 4"></img>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-md-6 col-sm-4 well">
						<p>Custody of Values principle</p>
						<img class = "img-responsive center-block" src='Users/<?=$folder?>/input5.png' alt="Input variable 5"></img>
					</div>
					<div class="col-xs-6 col-md-6 col-sm-4 well">
						<p>Defuzzyfication variable</p>
						<img class = "img-responsive center-block" src='Users/<?=$folder?>/output.png' alt="Output variable"></img>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-12 col-sm-12 well">
						<p>Classification</p>
						<img class = "img-responsive center-block" src='Users/<?=$folder?>/res.png' alt="Score"></img>
					</div>
				</div>
			</div>
		</main>
		<!-- Pie de página-->
		<footer>
			<?php include '../Include2/pie2.php'; ?>
		</footer>
	</body>
</html>