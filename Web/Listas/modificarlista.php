<?php

	/* -----------------------------------------------------------------------------
		
		Project: Human Centeredness experimental evaluation tool
		Author: Olga Peñalba, Miguel Revuelta
		Date: 2015-09-1
		Version: 2.1 (english)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Esta prepara un formulario con los miembros de una lista seleccionada en un
		select, para modificar los datos y enviarlos al script de actualización que
		conecta con la base de datos.
		
	*/
	
	// Comprobando autorización de sesión
	include '../Session/checksession.php'; // Comprobando autorización
	
	// Importando e instanciando clase consultas
	require_once '../Classes/DB_functions.php';
	$db = new DB_Functions();
	
	// Cookie
	$u = $_COOKIE['usuario'];
	
	// Consultas
	$nombreslista = $db->listaParcipantesIdusuario($u); // Obtener nombres de las listas del usuario
	$nomuser = $db->getNombreusuario($u); // Nombre del usuario
	
	if (strlen ($nomuser)== 0){
		$nomuser = 'unknown';
	}
	
	// Determinar lista seleccionada
	if (isset($_GET['id_lista'])) {
		
		// Control antifraude en el GET
		$aux = $_GET['id_lista'];
		$control = $db->getIdusuarioporlista($aux);
		
		if ($u == $control){
			// # usuario actual propietario de lista
			$id_lista = $_GET['id_lista']; // asignación estándar cogemos GET
		} else {
			// # usuario actual NO propietario de lista
			$id_lista = $db->minIdlista($u); // no cogemos GET
		}
	} else {
		$id_lista = $db->minIdlista($u); // casos en los que se acceda a la página con la variable sin establecer
	}
	
	// Obtener los nombres de los participantes de la lista seleccionada actualmente
	$nombresparticipantes = $db->listaNombresparticipantelista($id_lista);
	
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
		<script src="JavaScript/bootstrap-tokenfield.js"></script>
		<script src="JavaScript/hcxet.js"></script>
		<script type="text/javascript">
			// Cambiando selección de lista
			$(function()
			{
			  $("#sel").change(function()
			  {
				window.location='Web/Listas/modificarlista.php?id_lista=' + this.value
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
			<h3 class="text-center">Edit list</h3>
			<hr>
			<div class = "container">
				<div class="container row">
					<div class="col-xs-12 col-md-4 well">
						<?php include '../Include2/opcioneslista.php'; ?>
					</div>
					<div style="height:340px;" class="col-xs-12 col-sm-6 col-md-8 well " >
						<h4 class = "text-center">Modify the members of a list</h4><br><br><br>
						<form class="form-horizontal" action="Web/Listas/accion-modificarlista.php" method="post">
							<div class="form-group form-group-sm">
								<label class="col-sm-4 control-label" for="formGroupInputSmall">Choose a list:</label>
								<div class = "col-sm-6">
									<!-- Cargar nombres de listas del usuario -->
									<select class="form-control" id="sel" name="lista">
										<?php foreach($nombreslista as $i):?>
											<option <?php if($i['id_lista'] == $id_lista):?> selected <?php endif?> value = '<?=$i['id_lista']?>'>
												<?=($i[0])?>
											</td>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<hr>
						
							<div class="form-group form-group-sm">
								<label class="col-sm-4 control-label" for="formGroupInputSmall">Members of the list:</label>
							</div>
							<!-- Cargar emails de los miembros de la lista actual -->
							<textarea class="form-control" rows="7" id="tokenfield" name="email" required>
								<?php foreach ($nombresparticipantes as $j):?>
									<?=($j['email_destinatario']).','?>
								<?php endforeach ?>
							</textarea>
							
							<br>
							<div class = "row text-center">
								<button type="submit" class="btn btn-primary">Edit</button>
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
		<!-- TokenFields Bootstrap (control)-->
		<script>
			<?php include '../Include2/tkf.php'; ?>
		</script>
	</body>
</html>