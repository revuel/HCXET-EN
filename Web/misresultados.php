<?php
	
	/* -----------------------------------------------------------------------------
		
		Project: Human Centeredness experimental evaluation tool
		Author: Olga Peñalba, Miguel Revuelta
		Date: 2015-09-1
		Version: 2.1 (english)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Esta página escoge un estudio a través de un formulario y envía ese dato 
		a otro script para su procesamiento.
		
	*/
	
	// Comprobando autorización de sesión
	include 'Session/checksession.php'; // Comprobando autorización
	
	// Importando e instanciando clase consultas
	require_once 'Classes/DB_functions.php';
	$db = new DB_Functions();
	
	$u = $_COOKIE['usuario'];
	
	// Determinando el estudio actualmente seleccionado
	if (isset($_GET['id_target'])) {
		$id_target = $_GET['id_target']; // asignación estándar
	} else {
		$id_target = $db->getMintarget($u);// acceso a la página con la variable sin establecer
	}
	
	// Consultas
	$targets = $db->getAllTargetfromuser($u);
	$nomuser = $db->getNombreusuario($u); // Nombre del usuario
	
	if (strlen ($nomuser)== 0){
		$nomuser = 'unknown';
	}
?>

<!DOCTYPE html>
<html lang = "es">
	<head>
	
		<!-- ---------------------------------------------------------------------------
		
		Proyecto: Human Centeredness experimental evaluation tool
		Autores: Olga Peñalba, Miguel Revuelta
		Fecha: 2015-09-1
		Versión: 2.0 (español)

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
		<link rel="stylesheet" href="CSS/reset.css" type="text/css" media="screen">
		<link rel="stylesheet" href="CSS/bootstrap.css" type="text/css" media="screen">
		<link rel="stylesheet" href="CSS/bootstrap-theme.css" type="text/css" media="screen">
		<link rel="stylesheet" href="CSS/hcxet.css" type="text/css" media="screen">
		
		<style>
			#kludge { padding:10%;}
		</style>
		
		<!-- JAVASCRIPT -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="JavaScript/bootstrap.js"></script>
		<script src="JavaScript/hcxet.js"></script>
		
		<script type="text/javascript">
			// Cambio de valor en el select, recargar página con GET actualizado
			$(function()
			{
			  $("#sel").change(function()
			  {
				window.location='Web/misresultados.php?id_target=' + this.value
			  });
			});
		</script>
	</head>
	
	<body>
		<!-- Cabecera -->
		<header>
			<?php include 'Include2/cabecera2.php'; ?>
		</header>
		
		<!-- Contenido principal -->
		<main>
			<h3 class="text-center">Verify study results</h3>
			<hr>
			<div class="container well text-center" id="kludge">
				<div class="row">
					<form class="form-horizontal" action="Web/talkr/callr.php" method="post">
						<div class="form-group">
							<label class="control-label" for="form-group">Choose a study</label>
							<div class = "col-xs-12 col-sm-12 col-md-12">
								<!-- Carga del select con los estudios del usuario -->
								<select class="form-control" id="sel" name="target">
									<?php foreach($targets as $i):?>
										<option <?php if($i['id_target'] == $id_target):?> selected <?php endif?> value = '<?=$i['id_target']?>'>
											<?=($i['nombre_target'])?>
										</td>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Check</button>
					</form>
				</div>
			</div>
		</main>
		
		<!-- Pie de página-->
		<footer>
			<?php include 'Include2/pie2.php'; ?>
		</footer>
	</body>
</html>