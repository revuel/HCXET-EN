<?php
	
	/* -----------------------------------------------------------------------------
		
		Project: Human Centeredness experimental evaluation tool
		Author: Olga Peñalba, Miguel Revuelta
		Date: 2015-09-1
		Version: 2.1 (english)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Esta página ofrece un formulario dinámico con jquery donde elegir respuestas 
		a preguntas sobre los principios de la Computación Centrada en la Persona y
		los envía a otro script para ser procesadas.
	*/
	
	// Comprobando que haya sido superado el acceso como participante
	if (!isset($_COOKIE['destinatario']) || !isset($_COOKIE['target'])) {
		header("Location: http://localhost/HCXET/Estudio/formestudio.php"); 
		die();
	}
	
	// Importando clase de consultas
	require_once '../Web/Classes/DB_functions.php';
	
	// Captura de datos
	$id_destinatario = $_COOKIE['destinatario'];
	$id_target = $_COOKIE['target'];
	
	// Instancia de objeto consultas
	$db = new DB_Functions();
	
	// Nombre del estudio actual
	$study = $db->getNombreestudio($id_target);
	$sistema = $db->getNombresistema($id_target);
?>

<!DOCTYPE html>
<html lang = "en">
	<head>
	
		<!-- ---------------------------------------------------------------------------
		
		Project: Human Centeredness experimental evaluation tool
		Author: Olga Peñalba, Miguel Revuelta
		Date: 2015-09-1
		Version: 2.1 (english)

		---------------------------------------------------------------------------- -->
		<title> HCXET | Estudio </title>
		
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
			.botones{font-size: 50px; /*margin-top:40px;*/}
			.botones:hover{cursor:pointer; text-shadow: 4px 4px 2px rgba(150, 150, 150, 1);}
			.fr{float: right;}
			.abs{ padding:25px;}
		</style>
		
		<!-- JAVASCRIPT -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
			
				// Inicialización de la visibilidad de los elementos
				$(b1).show();
				$(q1).show();
				$(leftarrow).hide();
				$(lcross).show();
				
				// Variable de control
				var pos = 1;
			
				// Ir hacia la izquierda (pregunta anterior)
				$(".l1").click(function(){
		
					if (pos > 1){
						pos = pos -1;

						switch(pos) {
							case 1:
								$(q2).hide();
								$(q1).show();
								$(leftarrow).hide();
								$(lcross).show();
								break;
							case 2:
								$(q3).hide();
								$(q2).show();
								break;
							case 3:
								$(b2).hide();
								$(b1).show();
								$(q4).hide();
								$(q3).show();
								break;
							case 4:
								$(q5).hide();
								$(q4).show();
								break;
							case 5:
								$(q6).hide();
								$(q5).show();
								break;
							case 6:
								$(b3).hide();
								$(b2).show();
								$(q7).hide();
								$(q6).show();
								break;
							case 7:
								$(q8).hide();
								$(q7).show();
								break;
							case 8:
								$(q9).hide();
								$(q8).show();
								break;
							case 9:
								$(b4).hide();
								$(b3).show();
								$(q10).hide();
								$(q9).show();
								break;
							case 10:
								$(q11).hide();
								$(q10).show();
								break;
							case 11:
								$(q12).hide();
								$(q11).show();
								break;
							case 12:
								$(b5).hide();
								$(b4).show();
								$(q13).hide();
								$(q12).show();
								break;
							case 13:
								$(q14).hide();
								$(q13).show();
								break;
							case 14:
								$(q15).hide();
								$(q14).show();
								break;
							case 15:
								$(b6).hide();
								$(b5).show();
								$(q15).show();
								break;
							default:
								alert("Error");
						} 
					}
				});
				
				// Ir hacia la derecha (pregunta posterior)
				$(".r1").click(function(){
					
					if (pos < 16){
						pos = pos + 1;
						
						switch(pos) {
							case 2:
								$(q1).hide();
								$(q2).show();
								$(lcross).hide();
								$(leftarrow).show();
								break;
							case 3:
								$(q2).hide();
								$(q3).show();
								break;
							case 4:
								$(b1).hide();
								$(b2).show();
								$(q3).hide();
								$(q4).show();
								break;
							case 5:
								$(q4).hide();
								$(q5).show();
								break;
							case 6:
								$(q5).hide();
								$(q6).show();
								break;
							case 7:
								$(b2).hide();
								$(b3).show();
								$(q6).hide();
								$(q7).show();
								break;
							case 8:
								$(q7).hide();
								$(q8).show();
								break;
							case 9:
								$(q8).hide();
								$(q9).show();
								break;
							case 10:
								$(b3).hide();
								$(b4).show();
								$(q9).hide();
								$(q10).show();
								break;
							case 11:
								$(q10).hide();
								$(q11).show();
								break;
							case 12:
								$(q11).hide();
								$(q12).show();
								break;
							case 13:
								$(b4).hide();
								$(b5).show();
								$(q12).hide();
								$(q13).show();
								break;
							case 14:
								$(q13).hide();
								$(q14).show();
								break;
							case 15:
								$(q14).hide();
								$(q15).show();
								break;
							case 16:
								$(b6).show();
								$(b5).hide();
								$(q15).hide();
								break;
							default:
								alert("Error");
						}
					}
				});
			}); 
		</script>
	</head>
	
	<body>
		<!-- Contenido principal -->
		<main>
			<div class = "container">
			<h2 class ="text-center">Welcome to the survey <?=$study?></h2>
			<h3 class ="text-center">Evaluating: <?=$sistema?></h2>
			<hr>
				<form action="Estudio/accion-resultados.php" method = "POST" class="abs">
				
					<input type = "hidden" name = "destinatario" value = "<?=$id_destinatario ?>"></input>
					<input type = "hidden" name = "target" value = "<?=$id_target ?>"></input>
				
					<!-- BLOQUE DE PREGUNTAS  1 --> 
					<div class ="row well encuestapanel" id = "b1" hidden="false">
						<h3 class ="text-center">Question group 1</h3><hr>
						
						<div class = "col-xs-2 col-sm-2 col-md-2">
							<span id = "leftarrow" class="glyphicon glyphicon-chevron-left botones l1" aria-hidden="true"></span>
							<span id = "lcross" class= "glyphicon glyphicon-remove botones" disabled ></span>
						</div>
						
						<div class = "col-xs-8 col-sm-8 col-md-8" id="q1" hidden="false">
							<h4 class ="text-center">#1- Do you think that the system enhances your capabilities? </h4>
							
							<div class = "row">
								<div class = "col-xs-12 col-sm-8 col-md-6 col-md-offset-3">
									<div class="radio">
									<label><input type="radio" name="optradio1" value="3" required>Yes, it does</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio1" value="2">It does not matter to me</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio1" value="1">No, it doesn't</label>
									</div>
								</div>
							</div>
							
						</div>
					
						<div class = "col-xs-8 col-sm-8 col-md-8" id="q2" hidden="true">
							<h4 class ="text-center">#2- Do you have the opportunity to choose which tasks to perform yourself and which tasks to be performed by the system? </h4>
							
							<div class = "row">
								<div class = "col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
									<div class="radio">
										<label><input type="radio" name="optradio2" value="3" required>Yes, I can configure the system deciding what tasks do manually or automatically</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio2" value="2">It's irrelevant</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio2" value="1">The system doesn't have this feature</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class = "col-xs-8 col-sm-8 col-md-8" id="q3" hidden="true">
							<h4 class ="text-center">#3- Do you think the system is suitable for the environment where it is located? </h4>
							<div class = "row">
								<div class = "col-xs-12 col-sm-8 col-md-6 col-md-offset-3">
									<div class="radio">
										<label><input type="radio" name="optradio3" value="3" required>Yes, the system fits perfectly in the environment of use</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio3" value="2">Not too much</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio3" value="1">It doesn't make sense this system in the environment</label>
									</div>
								</div>
							</div>
						</div>
					
						<div class = "col-xs-2 col-sm-2 col-md-2">
							<span class="glyphicon glyphicon-chevron-right botones fr r1" ></span>
						</div>
					</div>
					
					<!-- BLOQUE DE PREGUNTAS 2 --> 					
					<div class ="row well encuestapanel" id = "b2" hidden="true">
						<h3 class ="text-center">Question group  2</h3><hr>
						
						<div class = "col-xs-2 col-sm-2 col-md-2">
							<span class="glyphicon glyphicon-chevron-left botones l1" aria-hidden="true"></span>
						</div>
						
						<div class = "col-xs-8 col-sm-8 col-md-8" id="q4" hidden="true">
							<h4 class ="text-center">#4- Do you perceive the system as something that has been imposed?</h4>
							
							<div class = "row">
								<div class = "col-xs-12 col-sm-8 col-md-6 col-md-offset-3">
									<div class="radio">
										<label><input type="radio" name="optradio4" value="3" required>No, I am who choose to use this system every day and instead other ones</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio4" value="2">It's not imposed but there aren't any other options</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio4" value="1">Yes, i prefear to use other tools</label>
									</div>
								</div>
							</div>
						</div>
							
						<div class = "col-xs-8 col-sm-8 col-md-8" id="q5" hidden="true">
							<h4 class ="text-center">#5- Did you make an effort to being able to use the system? </h4>
							<div class = "row">
								<div class = "col-xs-12 col-sm-8 col-md-6 col-md-offset-3">
									<div class="radio">
										<label><input type="radio" name="optradio5" value="3" required>No, i could exploit its features effortlessly from the beginning</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio5" value="2">Not many effort</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio5" value="1">Yes, in fact i'm still trying to deal with it</label>
									</div>
								</div>
							</div>
						</div>
							
						<div class = "col-xs-8 col-sm-8 col-md-8" id="q6" hidden="true">
							<h4 class ="text-center">#6- Does the system help you to efficiently perform the activities within the environment? </h4>
							
							<div class = "row">
								<div class = "col-xs-12 col-sm-8 col-md-6 col-md-offset-3">									
									<div class="radio">
										<label><input type="radio" name="optradio6" value="3" required>Yes, the system provides comfort for the activities</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio6" value="2">Only sometimes</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio6" value="1">I'm compelled to use other tools to finish some activities</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class = "col-xs-2 col-sm-2 col-md-2">
							<span class="glyphicon glyphicon-chevron-right botones fr r1" ></span>
						</div>
						
					</div>

					<!-- BLOQUE DE PREGUNTAS  3 --> 
					<div class ="row well encuestapanel" id = "b3" hidden="true">
						<h3 class ="text-center">Question group  3</h3><hr>
						
						<div class = "col-xs-2 col-sm-2 col-md-2">
							<span class="glyphicon glyphicon-chevron-left botones l1" aria-hidden="true"></span>
						</div>
						
						<div class = "col-xs-8 col-sm-8 col-md-8" id="q7" hidden="true">
							<h4 class ="text-center">#7- Is the visual layout of the information appropriate? </h4>
							
							<div class = "row">
								<div class = "col-xs-12 col-sm-8 col-md-6 col-md-offset-3">		
									<div class="radio">
										<label><input type="radio" name="optradio7" value="3" required>Yes, I can use the various components smoothly and efficiently</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio7" value="2">There are still some components that cost me access</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio7" value="1">If I could , I would change most of the elements location</label>
									</div>
								</div>
							</div>
						</div>
							
						<div class = "col-xs-8 col-sm-8 col-md-8" id="q8" hidden="true">
							<h4 class ="text-center">#8- Do you think the system provides the right amount of information? </h4>
							
							<div class = "row">
								<div class = "col-xs-12 col-sm-8 col-md-6 col-md-offset-3" >		
									<div class="radio">
										<label><input type="radio" name="optradio8" value="3" required>All the time i have the information i need</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio8" value="2">Sometimes i need more/less information or the information offered in other ways</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio8" value="1">I almost never see everything I need as i would like</label>
									</div>
								</div>
							</div>
						</div>
							
						<div class = "col-xs-8 col-sm-8 col-md-8" id="q9" hidden="true">
							<h4 class ="text-center">#9- Do you have the chance to adapt the way the information is provided by the system to your needs? </h4>
							
							<div class = "row">
								<div class = "col-xs-12 col-sm-8 col-md-6 col-md-offset-3" >		
									<div class="radio">
										<label><input type="radio" name="optradio9" value="3" required>Yes, both in format and location</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio9" value="2">I can configure some elements</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio9" value="1">The information is provided allways the same way</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class = "col-xs-2 col-sm-2 col-md-2">
							<span class="glyphicon glyphicon-chevron-right botones fr r1" ></span>
						</div>
						
					</div>
										
					<!-- BLOQUE DE PREGUNTAS  4--> 
					<div class ="row well encuestapanel" id = "b4" hidden="true">
						<h3 class ="text-center">Question group  4</h3><hr>
						
						<div class = "col-xs-2 col-sm-2 col-md-2">
							<span class="glyphicon glyphicon-chevron-left botones l1" aria-hidden="true"></span>
						</div>
						
						<div class = "col-xs-8 col-sm-8 col-md-8" id="q10" hidden="true">
							<h4 class ="text-center">#10- Does the system help you to be more expert in your profession? </h4>
							
							<div class = "row">
								<div class = "col-xs-12 col-sm-8 col-md-6 col-md-offset-3" >		
									<div class="radio">
										<label><input type="radio" name="optradio10" value="3" required>Yes, I feel I have progressed in my knowledge since using the system</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio10" value="2">I have not noticed an extraordinary breakthrough in my knowledge</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio10" value="1">No, it doesn't improve my skills</label>
									</div>
								</div>
							</div>
						</div>
							
						<div class = "col-xs-8 col-sm-8 col-md-8" id="q11" hidden="true">
							<h4 class ="text-center">#11- Does the system provide means to capture the knowledge and skills you develop when using it? </h4>
							
							<div class = "row">
								<div class = "col-xs-12 col-sm-8 col-md-6 col-md-offset-3" >		
									<div class="radio">
										<label><input type="radio" name="optradio11" value="3" required>Yes, innovative solutions are captured by the system</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio11" value="2">Some solutions are collected</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio11" value="1">There is no any function like that</label>
									</div>
								</div>
							</div>
						</div>
							
						<div class = "col-xs-8 col-sm-8 col-md-8" id="q12" hidden="true">
							<h4 class ="text-center">#12- Does the system aid participants to share their knowledge of the activities carried out through it? </h4>
							
							<div class = "row">
								<div class = "col-xs-12 col-sm-8 col-md-6 col-md-offset-3">		
									<div class="radio">
										<label><input type="radio" name="optradio12" value="3" required>Yes, in fact it is the main source of sharing knowledge</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio12" value="2">it is preferable to use other sources</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio12" value="1">This functionality is outside the tool</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class = "col-xs-2 col-sm-2 col-md-2">
							<span class="glyphicon glyphicon-chevron-right botones fr r1" ></span>
						</div>
						
					</div>
										
					<!-- BLOQUE DE PREGUNTAS 5 --> 
					<div class ="row well encuestapanel" id = "b5" hidden="true">
						<h3 class ="text-center">Question group 5</h3><hr>
						
						<div class = "col-xs-2 col-sm-2 col-md-2">
							<span class="glyphicon glyphicon-chevron-left botones l1" aria-hidden="true"></span>
						</div>
						
						<div class = "col-xs-8 col-sm-8 col-md-8" id="q13" hidden="true">
							<h4 class ="text-center">#13- Is the system consistent with your values? </h4>
							
							<div class = "row">
								<div class = "col-xs-12 col-sm-8 col-md-6 col-md-offset-3" >		
									<div class="radio">
										<label><input type="radio" name="optradio13" value="3" required>The system is not against any of my values</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio13" value="2">I miss some values, but they are not important</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio13" value="1">The system does not reflect my values</label>
									</div>
								</div>
							</div>
						</div>
							
						<div class = "col-xs-8 col-sm-8 col-md-8" id="q14" hidden="true">
							<h4 class ="text-center">#14- Do you think the system achieves consensus on the conflicting values of the participants? </h4>
							
							<div class = "row">
								<div class = "col-xs-12 col-sm-8 col-md-6 col-md-offset-3" >		
									<div class="radio">
										<label><input type="radio" name="optradio14" value="3" required>Yes, everybody seem satisfied in this regard</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio14" value="2">However, there is no conflict despite there is no consensus</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio14" value="1">There is a conflict on this issue that the system worsens</label>
									</div>
								</div>
							</div>
						</div>
							
						<div class = "col-xs-8 col-sm-8 col-md-8" id="q15" hidden="true">
							<h4 class ="text-center">#15- Does the system prevent the breaching of any human rights or supposes a threat to the dignity of any person or group of people? </h4>
							
							<div class = "row">
								<div class = "col-xs-12 col-sm-8 col-md-6 col-md-offset-3">		
									<div class="radio">
										<label><input type="radio" name="optradio15" value="3" required>the system was designed with the concern of defending the Ontological Dignity </label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio15" value="2">The system doesn't provide facilities to do this</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="optradio15" value="1">There is great concern that the system can be used for this purpose with relative ease</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class = "col-xs-2 col-sm-2 col-md-2">
							<span class="glyphicon glyphicon-chevron-right botones fr r1" ></span>
						</div>
						
					</div>
					
					<!-- BOTON ENVIAR  --> 
					<div class ="row well" id = "b6" hidden="true">
						
						<h3 class ="text-center">End evaluation</h3><hr>
						
						<div class = "col-xs-2 col-sm-2 col-md-2">
							<span class="glyphicon glyphicon-chevron-left botones l1" aria-hidden="true"></span>
						</div>
					
						<div class = "col-xs-8 col-sm-8 col-md-8 text-center">
							<p>Thanks for your collaboration</p>
							<button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
						</div>
						
						<div class = "col-xs-2 col-sm-2 col-md-2">
							<span id = "rightcross" class="glyphicon glyphicon-remove botones disabled fr" disabled></span>
						</div>
					</div>
				</form>
				<br>
			</div>
		</main>
		
		<!-- Pie de página-->
		<footer>
		</footer>
	</body>
</html>