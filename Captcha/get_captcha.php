<?php
	/* -----------------------------------------------------------------------------
		
		Proyecto: Human Centeredness experimental evaluation tool
		Autores: Olga Peñalba, Miguel Revuelta
		Fecha: 2015-09-1
		Versión: 2.0 (español)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Este script genera una cadena de caracteres aleatoria y la plasma en una 
		imagen utilizando las librerías de fuentes de la carpeta fonts.
		
	*/
	
	// Inicio sesión para almacenar en una cookie el string del captcha que generaremos
	session_start();

	// Generación de una cadena aleatoria de caracteres
	$string = '';

	for ($i = 0; $i < 5; $i++) {
		$string .= chr(rand(97, 122));
	}

	$_SESSION['random_number'] = $string;
	
	// Directorio de las fuentes
	$dir = 'fonts/';

	// Creación de la imagen
	$image = imagecreatetruecolor(165, 50);

	// Número pseudoaleatorio para seleccionar fuente
	$num = rand(1,5);
	switch ($num) {
		case 1:
			$font = "Capture it 2.ttf";
			break;
		case 2:
			$font = "Molot.otf";
			break;
		case 3:
			$font = "PlAGuEdEaTH.ttf";
			break;
		case 4:
			$font = "Walkway Black RevOblique.ttf";
			break;
		case 5:
			$font = "Walkway rounded.ttf";
			break;
		default:
			$font = "Capture it 2.ttf";
	}

	// Número pseudoaleatorio para determinar el color
	$num2 = rand(1,2);
	if($num2==1) {
		$color = imagecolorallocate($image, 113, 193, 217);
	} else {
		$color = imagecolorallocate($image, 163, 197, 82);
	}

	// Determinar el color de fondo
	$white = imagecolorallocate($image, 255, 255, 255); 
	imagefilledrectangle($image,0,0,399,99,$white);

	// Plasmar nuestro captcha
	imagettftext ($image, 30, 0, 10, 40, $color, $dir.$font, $_SESSION['random_number']);

	// Devolver imagen
	header("Content-type: image/png");
	imagepng($image);
?>