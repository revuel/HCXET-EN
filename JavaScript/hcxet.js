/* -----------------------------------------------------------------------------
	
	Project: Human Centeredness experimental evaluation tool
	Author: Olga Peñalba, Miguel Revuelta
	Date: 2015-09-1
	Version: 2.1 (english)
	
----------------------------------------------------------------------------- */

$(document).ready(function(){
    
	// Ir a la página inical 
	$('#ini').click(function(){
		window.location.href = "/HCXET-EN/Web/start.php";
	});
	
	// Ir a nuevo estudio
	$('#nue').click(function(){
		window.location.href = "/HCXET-EN/Web/nuevotarget.php";
	});
	
	// Ir a estado de estudios
	$('#est').click(function(){
		window.location.href = "/HCXET-EN/Web/cursotarget.php";
	});
	
	// Ir a gestión de listas
	$('#lis').click(function(){
		window.location.href = "/HCXET-EN/Web/Listas/listas.php";
	});
	
	// Ir a resultados 
	$('#res').click(function(){
		window.location.href = "/HCXET-EN/Web/misresultados.php";
	});
	
	// Cerrar sesión
	$('#clo').click(function(){
		window.location.href = "/HCXET-EN/Login/logout.php";
	});
});