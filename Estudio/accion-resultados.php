<?php

	/* -----------------------------------------------------------------------------
		
		Proyecto: Human Centeredness experimental evaluation tool
		Autores: Olga Peñalba, Miguel Revuelta
		Fecha: 2015-09-1
		Versión: 2.0 (español)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Este script recoge las respuestas establecidas por el participante de una
		encuesta y carga dichos valores en la base de datos.
	*/

	// Control de acceso: comprobando que haya sido superado el acceso como participante
	if (!isset($_COOKIE['destinatario']) || !isset($_COOKIE['target'])) {
		header("Location: /HCXET-EN/Estudio/formestudio.php"); 
		die(); // Podría comprobarse la sesión en lugar de las cookies..
	}

	// Importando clase de consultas
	require_once '../Web/Classes/DB_functions.php';
	
	// Captura de datos del formulario
	$destinatario = $_POST['destinatario'];
	$target = $_POST['target'];
	//$token = $_POST['token'];
	$op1 = $_POST['optradio1'];
	$op2 = $_POST['optradio2'];
	$op3 = $_POST['optradio3'];
	$op4 = $_POST['optradio4'];
	$op5 = $_POST['optradio5'];
	$op6 = $_POST['optradio6'];
	$op7 = $_POST['optradio7'];
	$op8 = $_POST['optradio8'];
	$op9 = $_POST['optradio9'];
	$op10 = $_POST['optradio10'];
	$op11 = $_POST['optradio11'];
	$op12 = $_POST['optradio12'];
	$op13 = $_POST['optradio13'];
	$op14 = $_POST['optradio14'];
	$op15 = $_POST['optradio15'];
	
	try {
		// Instanciar objeto de consultas
		$db = new DB_Functions();
		
		// Actualizar campos (llamada a método)
		$db->setResultados($destinatario, $target, $op1, $op2, $op3, $op4, $op5, $op6, $op7, $op8, $op9, $op10, $op11, $op12, $op13, $op14, $op15);
		
		// Destruir cookies auxiliares
		if (isset($_COOKIE['destinatario'])) {
			unset($_COOKIE['destinatario']);
			unset($_COOKIE['target']);
			setcookie('destinatario', null, -1, '/');
			setcookie('target', null, -1, '/');
		} 
	} catch(PDOException $e) {
		echo("Error: " + $e);
	}
	
	// Trasladarnos a la pantalla principal
	header("Location: /HCXET-EN/"); // Tal vez llevar a una pantalla de agradecimiento
	die();
?>
