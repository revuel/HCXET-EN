<?php
	
	/* -----------------------------------------------------------------------------
		
		Project: Human Centeredness experimental evaluation tool
		Author: Olga Peñalba, Miguel Revuelta
		Date: 2015-09-1
		Version: 2.1 (english)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Este script recupera los estudios (targets) del usuario en sesión, así como
		los datos del último estudio que este haya seleccionado. También controla 
		que el usuario no tenga posibilidad de capturar datos de estudios de otros
		usuarios.
		
	*/
	
	// Control de sesión: comprobando autorización
	include 'Session/checksession.php'; 
	
	// Importando clase de consultas e instanciando objeto consultas
	require_once 'Classes/DB_functions.php';
	$db = new DB_Functions();
	
	// Almacenando id de usuario de la sesión
	$u = $_COOKIE['usuario'];
	
	// Gestión de la selección del estudio
	if (isset($_GET['id_target'])) {
		// Comprobar no consultar estudios de otros usuarios
		$aux1 = $_GET['id_target'];
		$aux = $db->getIdusuarioportarget($aux1);
		
		if( $aux == $u) {
			$idtarget = $_GET['id_target']; // asignación estándar vía GET
		}
		else {
			$idtarget = $db->getMintarget($u); 
		}
	} else {
		// asignación del target con id mínimo 
		$idtarget = $db->getMintarget($u); 
	}
	
	// Consultas para la visualización de datos
	$alltarget = $db->getAllTargetfromuser($u); // Estudios
	$valoraciones = $db->getResultados($idtarget); // Estudio actual completo
	$mediasprincipios = $db->getAvgprincipios($idtarget); // Puntuación media de cada principio
	$nomuser = $db->getNombreusuario($u); // Nombre del usuario
	
	if (strlen ($nomuser)== 0){
		$nomuser = 'unknown';
	}
?>

<!DOCTYPE html>
<html lang = "en">
	<head>
		<!-- ---------------------------------------------------------------------------
		
		Proyecto: Human Centeredness experimental evaluation tool
		Autores: Olga Peñalba, Miguel Revuelta
		Fecha: 2015-09-1
		Versión: 2.0 (español)

		---------------------------------------------------------------------------- -->
		<title> HCXET | <?=$nomuser ?> </title>
		
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
		<link rel="stylesheet" href="CSS/bootstrap-table.css">
		<link rel="stylesheet" href="CSS/hcxet.css" type="text/css" media="screen">
		
		<!-- JAVASCRIPT -->
		<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
		<script src="JavaScript/hcxet.js"></script>
		
		<script type="text/javascript">
			// Nuevo valor seleccionado en el select: recargar con valor GET
			$(function()
			{
			  $("#sel").change(function()
			  {
				window.location='Web/cursotarget.php?id_target=' + this.value
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
			<h3 class="text-center">Checking study state</h3>
			<hr>
			<div class="container">
				<div class="row well">
					<div class="col-xs-4 col-md-4 text-center">
						<p><strong>Choose a study:</strong></p>
					</div>
					<div class="col-xs-8 col-md-8">
						<!-- Carga de los nombres de los estudios del usuario, activar según valor GET-->
						<select class="form-control" id="sel">
							<?php foreach($alltarget as $i):?>
									<option <?php if($i['id_target'] == $idtarget):?> selected <?php endif?> value = '<?=$i['id_target']?>'>
										<?=($i[1])?>
									</option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			
				<div class="row well">
					<h3>Participants answers</h3>
					<div class ="table-responsive">
						<table class="table table-striped">
							<thead>
							<tr>
								<th>#</th>
								<th>1ª</th>
								<th>2ª</th>
								<th>3ª</th>
								<th>4ª</th>
								<th>5ª</th>
								<th>6ª</th>
								<th>7ª</th>
								<th>8ª</th>
								<th>9ª</th>
								<th>10ª</th>
								<th>11ª</th>
								<th>12ª</th>
								<th>13ª</th>
								<th>14ª</th>
								<th>15ª</th>
							</tr>
							</thead>
							<tbody>
								<!-- Carga de los valores de respuesta del estudio de cada participante -->
								<?php foreach($valoraciones as $v):?>
									<tr class ="text-center">
										<td style="text-align:left;"> <mark><?=$v[0]?> </mark></td>
										<td><?=($v[3])?></td>
										<td><?=($v[4])?></td>
										<td><?=($v[5])?></td>
										<td><?=($v[6])?></td>
										<td><?=($v[7])?></td>
										<td><?=($v[8])?></td>
										<td><?=($v[9])?></td>
										<td><?=($v[10])?></td>
										<td><?=($v[11])?></td>
										<td><?=($v[12])?></td>
										<td><?=($v[13])?></td>
										<td><?=($v[14])?></td>
										<td><?=($v[15])?></td>
										<td><?=($v[16])?></td>
										<td><?=($v[17])?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
					
					<div class="row well">
					<h3>Mean score for each principle</h3>
					<div class ="table-responsive">
						<table class="table table-striped">
							<thead>
							<tr>
								<th><strong>Harmony</strong></th>
								<th><strong>Active Context Appreciation</strong></th>
								<th><strong>Information Display</strong></th>
								<th><strong>Intercession for Knowledge</strong></th>
								<th><strong>Custody of Values</strong></th>
							</tr>
							</thead>
							<tbody>
								<!-- Carga de la media de cada grupo de respuestas según los principios -->
								<?php foreach($mediasprincipios as $m):?>
									<tr class ="text-center">
										<td><?=($m[0])?></td>
										<td><?=($m[1])?></td>
										<td><?=($m[2])?></td>
										<td><?=($m[3])?></td>
										<td><?=($m[4])?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
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