<?php

	/* -----------------------------------------------------------------------------
		
		Project: Human Centeredness experimental evaluation tool
		Author: Olga Peñalba, Miguel Revuelta
		Date: 2015-09-1
		Version: 2.1 (english)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Formulario de selección de lista a borrar.
	*/
	
	// Comprobando autorización de sesión
	include '../Session/checksession.php'; // Comprobando autorización
	
	// Importando e instanciando clase consultas
	require_once '../Classes/DB_functions.php';
	$db = new DB_Functions();
	
	// Cookie
	$u = $_COOKIE['usuario'];
	
	// Consultar 
	$nombreslista = $db->listaParcipantesIdusuario($u); // listas de un usuario
	$nomuser = $db->getNombreusuario($u); // Nombre del usuario
	
	if (strlen ($nomuser)== 0){
		$nomuser = 'unknown';
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
		<title> HCXET | <?=$nomuser?> </title>
		
		<base href="../../">
		 
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
		<link rel="stylesheet" href="CSS/bootstrap-tokenfield.css" type="text/css" media="screen">
		<link rel="stylesheet" href="CSS/hcxet.css" type="text/css" media="screen">

		<!-- JAVASCRIPT -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="JavaScript/hcxet.js"></script>
	</head>
	
	<body>
		<!-- Cabecera -->
		<header>
			<?php include '../Include2/cabecera2.php'; ?>
		</header>
		
		<!-- Contenido principal -->
		<main>
			<h3 class="text-center">Delete a list</h3>
			<hr>
			<div class = "container">
				<div class="container row">
					<div class="col-xs-12 col-md-4 well">
						<?php include '../Include2/opcioneslista.php'; ?>
					</div>
					<div style="height:340px;" class="col-xs-12 col-sm-6 col-md-8 well " >
						<h4 class = "text-center">Delete a list of emails</h4><br><br><br><br>
						<form class="form-horizontal" action = "Web/Listas/accion-borrarlista.php" method= "post">
							<div class="form-group form-group-sm">
								<label class="col-sm-4 control-label" for="formGroupInputSmall">Choose a list:</label>
								<div class = "col-sm-6">
									<select class="form-control" name="lista">
									    <!-- Cargar nombres de las listas del usuario -->
										<?php foreach($nombreslista as $i):?>
											<option value="<?=($i[1])?>"><?=($i[0])?> </td>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<br>
							<div class = "row text-center">
								<button type="submit" class="btn btn-danger">Delete</button>
							</div>
						</form>
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