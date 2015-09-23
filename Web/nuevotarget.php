<?php

	/* -----------------------------------------------------------------------------
		
		Project: Human Centeredness experimental evaluation tool
		Author: Olga Peñalba, Miguel Revuelta
		Date: 2015-09-1
		Version: 2.1 (english)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Esta página envía los datos de un formulario (que pueden ser tokenfields)
		para la posterior creación de un nuevo estudio.
		
	*/
	
	// Comprobación de autorización 
	include 'Session/checksession.php'; // Comprobando autorización

	// Importando e instanciando clase consultas
	require_once 'Classes/DB_functions.php';
	$db = new DB_Functions();
	
	$u = $_COOKIE['usuario'];
	
	// Consultas
	$listasUsuario = $db->getAllListfromuser($u); // Obtener las listas de un usuario
	$nomuser = $db->getNombreusuario($u); // Nombre del usuario
	
	if (strlen ($nomuser)== 0){
		$nomuser = 'unknown';
	}
	
	// Determinar qué lista seleccionar
	if (isset($_GET['id_lista'])) {
		$id_lista = $_GET['id_lista']; // asignación estándar
	}
	else {
		$id_lista = 1; // casos en los que se acceda a la página con la variable GET sin establecer
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
		<link rel="stylesheet" href="CSS/bootstrap-tokenfield.css" type="text/css" media="screen">
		<link rel="stylesheet" href="CSS/hcxet.css" type="text/css" media="screen">
		
		<!-- JAVASCRIPT -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="JavaScript/bootstrap-tokenfield.js"></script>
		<script src="JavaScript/hcxet.js"></script>
		<script>
			// Activar el uso alternativo entre lista o tokenfields
			$(document).ready(function() {
			
				$('#control').change(function() {
				
					if ($(this).is(':checked')) {
						$('#tokenfield').tokenfield('disable');
						$('#tokenfield').attr("placeholder", "Añadir participantes...");
						$('#dd').prop('disabled', false);
					} else {
						$('#tokenfield').tokenfield('enable');
						$('#tokenfield').attr("placeholder", "! Lista activada");
						$('#dd').prop('disabled', true);
					}
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
			<h3 class="text-center">New study</h3>
			<hr>
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
						<div class = "row">
							<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 well">
							<h4 class = "text-center">Target system data</h4>
								<form class="form-horizontal" action = "Web/Action/accion-nuevotarget.php" method = "post">
									<hr>
									<div class="form-group form-group-sm">
										<label class="col-sm-2 control-label" for="formGroupInputSmall">Study name</label>
										<div class="col-sm-10">
											<input class="form-control" type="text" id="formGroupInputSmall" placeholder="Name of the study" name="nombre"></input>
										</div>
									</div>
									<div class="form-group form-group-sm">
										<label class="col-sm-2 control-label" for="formGroupInputSmall">System name</label>
										<div class="col-sm-10">
											<input class="form-control" type="text" id="formGroupInputSmall" placeholder="Application or system name" name = "app"></input>
										</div>
									</div>
									<!--<div class="form-group form-group-sm" id="tk">
										<label class="col-sm-2 control-label" for="formGroupInputSmall">Añadir</label>
										<div class="col-sm-10">
											<input type = "text" class="form-control" id="tokenfield"  placeholder="Añadir participantes..." name = "participantes" required></input>
										</div>
									</div>-->
									<textarea class="form-control" rows="7" id="tokenfield" placeholder="Add participants..." name = "participantes"required></textarea>
									<br>
									<div class="checkbox">
										<label>
										  <input type="checkbox" id="control"> Use a list instead </input>
										</label>
									</div><br>
									<select id = "dd" class="form-control" name = "lista" disabled required>
										<!-- Cargar el select con las listas del usuario -->
										<?php foreach($listasUsuario as $i):?>
											<option <?php if($i['id_lista'] == $id_lista):?> selected <?php endif?> value = '<?=$i['id_lista']?>'>
												<?=($i[1])?>
											</td>
										<?php endforeach ?>
									</select>
									<hr>
									<div class = "row text-center">
										<button type="submit" class="btn btn-primary">Create</button>
									</div>
								</form>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</main>
		
		<!-- Pie de página-->
		<footer>
			<?php include 'Include2/pie2.php'; ?>
		</footer>
		
		<!-- TokenFields Bootstrap (control)-->
		<script>
			<?php include 'Include2/tkf.php'; ?>
		</script>
	</body>
</html>