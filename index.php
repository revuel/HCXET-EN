<!DOCTYPE html>
<html lang = "en">
	<head>
		<!-- ---------------------------------------------------------------------------
		
		Project: Human Centeredness experimental evaluation tool
		Author: Olga Peñalba, Miguel Revuelta
		Date: 2015-09-1
		Version: 2.1 (english)

		---------------------------------------------------------------------------- -->
		
		<title> HCXET | Home </title>
		 
		<!-- METADATOS -->
		<meta charset="utf-8">
		<meta name="author" content="Olga Peñalba Rodríguez, Miguel Revuelta Espinosa">
		<meta name="description" content="Human Centered Systems Experimental Evaluation Tool">
		<meta name="keywords" content="HCS, HCC, HCD, Human Centered Systems, Sistemas Centrados en la Persona">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- ICON -->
		<link href="/favicon.ico" rel="icon"></link>
		
		<!-- CSS -->
		<link rel="stylesheet" href="CSS/reset.css" type="text/css" media="screen">
		<link rel="stylesheet" href="CSS/bootstrap.css" type="text/css" media="screen">
		<link rel="stylesheet" href="CSS/bootstrap-theme.css" type="text/css" media="screen">
		<link rel="stylesheet" href="CSS/hcxet.css" type="text/css" media="screen">
		
		<style>
			.sha { text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;}
		</style>
		
		<!-- JAVASCRIPT -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="JavaScript/bootstrap.js"></script>
	</head>
	
	<body>
		<!-- Cabecera -->
		<header class="pushdown">
			<?php include 'Include/cabecera1.php'; ?>
		</header>
		
		<!-- Contenido principal -->
		<main>
			<h3 class="text-center">Human Centeredness eXperimental Evaluation Tool</h3>
			<hr>
			<div class="container well">
				<!-- Primera fila -->
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
						<h2 class="text-center">Introduction</h2>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
						<p class="text-center lead">Experimental prototype for testing how <a href="#prin" title="Ver principios">a set of principles</a>
						of the Human-Centered Computing is being satisfied by an application (target of the survey), through a processing using statistics and fuzzy logic
						of the results from an on-line survey</p>
					</div>
				</div>
				<br>
				<!-- Segunda fila -->
				<div class="row">
					<div class="col-xs-6 col-md-4 col-sm-4">
						<h4 class="text-center">HCS/HCC/HCD</h4>
						<p class="text-center">Human-Centered Systems, 
						Human-Centered Computing and Human-Centered Design 
						are fields studying the human cognitive activity in socio-technical environments, trying to understand
						motivations, needs and other issues in order to contribute to their realization by creating systems that actually help 
						them achieving their goals in a natural way<p>
					</div>
				  <div class="col-xs-6 col-md-4 col-sm-4">
						<h4 class="text-center">OK i get it</h4>
						<p class="text-center">To start studies sending surveys you must first<p>
						<a href="Register/alta.php"><p class="text-center">Sign up</p></a>
						<p class="text-center">Already registered?<p>
						<a href="Login/formconectar.php"><p class="text-center">Log in</p></a>
					</div>
				  <div class="col-xs-6 col-md-4 col-sm-4">
						<h4 class="text-center">Origins</h4>
						<p class="text-center">
						It's often considered that one of the first events that boosted the fields of Human-Centered Computing/Systems was a workshop organised
						by the National Science Foundation (NSF), where among others Rob Kling and Susan Leigh Star settled some research ways and insights that 
						are usually refered to by the researchers on this field<p>
					</div>
				</div>
			</div>
		</main>
		<!-- Slider de los principios -->
		<div class = "container" id="prin">
			<hr>
			<div class="row">
				<div class="col-xs-12 col-md-12 col-sm-12 text-center well">
					<h2 class="text-center">Principles</h2>
					<?php include 'Include/slider1.php'; ?>
				</div>
			</div>
		</div>
		<!-- Referencias y PFG -->
		<div class = "container" id="prin">
			<hr>
			<div class="row">
				<div class="col-xs-12 col-md-6 col-sm-6 text-center well">
					<h2 class="text-center">Reference list</h2>
					<a href="articulos.php" title="Article/Papers list of HCC/HCS/HCD and others">
						<img class ="img-responsive center-block" src="Pics/references.jpg" alt="References" ismap>
					</a>
				</div>
				<div class="col-xs-12 col-md-6 col-sm-6 text-center well">
					<h2 class="text-center">DFP</h2>
					<a title="PDF Unavailable yet">
						<img class ="img-responsive center-block" src="Pics/pfg.jpg" alt="Degree´s Final Project" ismap>
					</a>
				</div>
			</div>
		</div>
		
		<!-- Pie de página-->
		<footer>
			<?php include 'Include/pie.php'; ?>
		</footer>
	</body>
</html>