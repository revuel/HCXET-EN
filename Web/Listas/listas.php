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
	include '../Session/checksession.php'; // Comprobando autorización
	
	// Importando e instanciando clase consultas
	require_once '../Classes/DB_functions.php';
	$db = new DB_Functions();
	
	$u = $_COOKIE['usuario'];
	
	// Consultas
	$nombreslista = $db->listaParcipantesIdusuario($u); // Nombres de las listas
	$nomuser = $db->getNombreusuario($u); // Nombre del usuario
	
	if (strlen ($nomuser)== 0){
		$nomuser = 'unknown';
	}
	
	// Determinar lista seleccionada
	if (isset($_GET['id_lista'])) {
		$id_lista = $_GET['id_lista']; // asignación estándar
	} else {
		$id_lista = $db->minIdlista($u); // Casos en los que se acceda a la página con la variable sin establecer
	}
	
	if(isset($id_lista)){
		$nombresparticipantes = $db->listaNombresparticipantelista($id_lista); // Participantes de la lista seleccionada
	}
?>

<!DOCTYPE html>
<html lang = "es">
	<head>
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
		<link rel="stylesheet" href="CSS/hcxet.css" type="text/css" media="screen">
		
		<!-- JAVASCRIPT -->
		<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
		<script src="JavaScript/hcxet.js"></script>
		<script type="text/javascript">
			// Cambiar lista seleccionada en el select
			$(function()
			{
			  $("#sel").change(function()
			  {
				window.location='Web/Listas/listas.php?id_lista=' + this.value
			  });
			});
		</script>
	</head>
	
	<body>
		<!-- Cabecera -->
		<header>
			<?php include '../Include2/cabecera2.php'; ?>
		</header>
		
		<!-- Contenido principal -->
		<main>
			<h3 class="text-center">View list</h3>
			<hr>
			<div class = "container">
				<div class="container row">
					<div class="col-xs-12 col-md-4 well">
						<?php include '../Include2/opcioneslista.php'; ?>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-8 well" style="height:338.8px; overflow-y: scroll;">
						<h4 class = "text-center">Viewing list</h4><br>
					
						<div class="form-group form-group-sm">
							<label class="col-sm-4 control-label" for="formGroupInputSmall">Choose a list:</label>
							<div class = "col-sm-6">
								<select class="form-control" id="sel">
								<!-- Cargar  el select con los nombres de las listas -->
								<?php foreach($nombreslista as $i):?>
									<option <?php if($i['id_lista'] == $id_lista):?> selected <?php endif?> value = '<?=$i['id_lista']?>'>
										<?=($i['nombre_lista'])?>
									</option>
								<?php endforeach ?>
								</select>
							</div>
						</div>
						<hr>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th>Email address</th>
								</tr>
							</thead>
							<tbody>
								<!-- Cargar tabla con los nombres de los participantes de la lista actual -->
								<?php if(isset($nombresparticipantes)){foreach ($nombresparticipantes as $j):?>
									<tr>
										<td><?=($j['id_destinatario'])?></td>
										<td><?=($j['email_destinatario'])?></td>
									</tr>
								<?php endforeach; } ?>
							</tbody>
						</table>
						<br>
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