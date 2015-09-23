<!DOCTYPE html>
<html lang = "es">
	<head>
		<!-- ---------------------------------------------------------------------------
		
		Proyecto: Human Centeredness experimental evaluation tool
		Autores: Olga Peñalba, Miguel Revuelta
		Fecha: 2015-09-1
		Versión: 2.0 (español)

		---------------------------------------------------------------------------- -->
		<title> Error </title>
		
		<!-- METADATOS -->
		<meta charset="UTF-8">
		<meta name="author" content="Olga Peñalba Rodríguez, Miguel Revuelta Espinosa">
		<meta name="description" content="Human Centered Systems Experimental Evaluation Tool">
		<meta name="keywords" content="HCS, HCC, HCD, Human Centered Systems, Sistemas Centrados en la Persona">
		
		<!-- CSS -->
		<style>
			#dialogoverlay{
				display: none;
				opacity: .8;
				position: fixed;
				top: 0px;
				left: 0px;
				background: #A6A1A1;
				width: 100%;
				z-index: 10;
			}
			#dialogbox{
				display: none;
				position: fixed;
				background: #000;
				border-radius:7px; 
				width:550px;
				z-index: 10;
			}
			#dialogbox > div{ background:#FFF; margin:8px; }
			#dialogbox > div > #dialogboxhead{ background: #BD6262; font-size:19px; padding:10px; color:#000; }
			#dialogbox > div > #dialogboxbody{ background:#631A1A; padding:20px; color:#FFF; }
			#dialogbox > div > #dialogboxfoot{ background: #BD6262; padding:10px; text-align:right; }
		</style>
		
		<!-- JAVASCRIPT -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script>
			function mover(){
				window.location.href = "alta.php";
			}
			
			$(document).ready(function(){
				function CustomAlert(){
					this.render = function(dialog){
						var winW = window.innerWidth;
						var winH = window.innerHeight;
						var dialogoverlay = document.getElementById('dialogoverlay');
						var dialogbox = document.getElementById('dialogbox');
						dialogoverlay.style.display = "block";
						dialogoverlay.style.height = winH+"px";
						dialogbox.style.left = (winW/2) - (550 * .5)+"px";
						dialogbox.style.top = "100px";
						dialogbox.style.display = "block";
						document.getElementById('dialogboxhead').innerHTML = "Error";
						document.getElementById('dialogboxbody').innerHTML = dialog;
						document.getElementById('dialogboxfoot').innerHTML = '<button onclick="mover()">OK</button>';
						}
						this.ok = function(){
							/*document.getElementById('dialogbox').style.display = "none";
							document.getElementById('dialogoverlay').style.display = "none";
							window.location.href = "alta.php";*/
						}
					}
				
				var Alert = new CustomAlert();
				
				Alert.render('Unknown error\n. Try again.');
			});
			
		</script>
	</head> 
	<body>
		<!-- Objeto simulador del alert -->
		<div id="dialogoverlay"></div>
		<div id="dialogbox">
		  <div>
			<div id="dialogboxhead"></div>
			<div id="dialogboxbody"></div>
			<div id="dialogboxfoot"></div>
		  </div>
		</div>
	</body>
</html>