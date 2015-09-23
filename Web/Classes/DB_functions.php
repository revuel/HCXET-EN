<?php    // db_functions.php

	/* -----------------------------------------------------------------------------
		
		Proyecto: Human Centeredness experimental evaluation tool
		Autores: Olga Peñalba, Miguel Revuelta
		Fecha: 2015-09-1
		Versión: 2.0 (español)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Clase de consultas.
	*/
	class DB_Functions {
		// ATRIBUTOS
		private $con;
		
		// MÉTODOS
		// constructor
		function __construct() {
			require_once __DIR__.'/DB_connect.php'; // Importando clase de conexión
			//require_once 'DB_connect.php'; // Importando clase de conexión
			
			// conectando...
			$db = new DB_Connect();
			$this->con = $db->getDbConnection(); // Conectando con base de datos
		}
		
		// Participar en un estudio
		public function setResultados($participante, $encuesta, $r1, $r2, $r3, $r4, $r5, $r6, $r7, $r8, $r9, $r10, $r11, $r12, $r13, $r14, $r15) {
			// # Entrada: Puntuaciones atribuidas por un participante a un estudio
			// # Salida: Actualización BD
			try {
				$consulta = $this->con->prepare('UPDATE valoracion SET respuesta_1 = :r1, respuesta_2 = :r2, respuesta_3 = :r3, respuesta_4 = :r4, respuesta_5 = :r5, respuesta_6 = :r6, respuesta_7 = :r7, respuesta_8 = :r8, respuesta_9 = :r9, respuesta_10 = :r10, respuesta_11 = :r11, respuesta_12 = :r12, respuesta_13 = :r13, respuesta_14 = :r14, respuesta_15 = :r15 WHERE id_destinatario = :participante AND id_target = :encuesta'); 
				$params = array(':participante' => $participante, ':encuesta' => $encuesta, ':r1' => $r1, ':r2' => $r2, ':r3' => $r3, ':r4' => $r4, ':r5' => $r5,':r6' => $r6, ':r7' => $r7, ':r8' => $r8, ':r9' => $r9, ':r10' => $r10, ':r11' => $r11, ':r12' => $r12, ':r13' => $r13, ':r14' => $r14,':r15' => $r15);
				$consulta->execute($params); // Ejecución
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Seleccionar: Id destinatario según un email destinatario
		public function getIddestinatario($email) {
			// # Entrada: email destinatario
			// # Salida: id destinatario
			try {
				$consulta = $this->con->prepare('SELECT id_destinatario FROM destinatario 
				WHERE email_destinatario = :email');
				$params = array(':email' => $email);
				$consulta->execute($params);
				
				$resultado = $consulta->fetchAll(PDO::FETCH_COLUMN, 0);
				$id = $resultado[0];
				return $id;
			} 
			catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Insertar un nuevo usuario 
		public function setUsuario($email, $clave, $nom, $ape) {
			// # Entrada: Datos de usuario de un formulario
			// # Salida: Alta en BD
			try {
				$consulta = $this->con->prepare('INSERT INTO usuario (email_usuario, clave, nombre_usuario, apellidos_usuario) 
				VALUES (:email, :clave, :nom, :ape)');
				$params = array(':email' => $email, ':clave' => $clave, 
				':nom' => $nom, ':ape' => $ape, );
				$consulta->execute($params); // Ejecución
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage(); // Posible error
			}
		}
		
		// Seleccionar: Id usuario según un email de usuario
		public function getIdusuario($email) { 
			// # Entrada: email de usuario
			// # Salida: id usuario
			try {
				$consulta = $this->con->prepare('SELECT id_usuario FROM usuario 
				WHERE email_usuario = :email');
				$params = array(':email' => $email);
				$consulta->execute($params);
				
				$resultado = $consulta->fetchAll(PDO::FETCH_COLUMN, 0);
				$id = $resultado[0];
				return $id;
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Seleccionar: Id usuario según un id target
		public function getIdusuarioportarget($tar) {
			// # Entrada: id target
			// # Salida: id usuario
			try {
				$consulta = $this->con->prepare('SELECT id_usuario FROM target 
				WHERE id_target = :tar');
				$params = array(':tar' => $tar);
				$consulta->execute($params);
				
				$resultado = $consulta->fetchAll(PDO::FETCH_COLUMN, 0);
				$id = $resultado[0];
				return $id;
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Seleccionar: Id usuario según un id lista
		public function getIdusuarioporlista($lis) {
			// # Entrada: id lista
			// # Salida: id usuario
			try {
				$consulta = $this->con->prepare('SELECT id_usuario FROM lista 
				WHERE id_lista = :lis');
				$params = array(':lis' => $lis);
				$consulta->execute($params);
				
				$resultado = $consulta->fetchAll(PDO::FETCH_COLUMN, 0);
				$id = $resultado[0];
				return $id;
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Seleccionar el menor id target de un usuario
		public function getMintarget($idus) {
			// # Entrada: id usuario
			// # Salida: id target
			try {
				$consulta = $this->con->prepare('SELECT MIN(id_target) FROM target 
				WHERE id_usuario = :idus');
				$params = array(':idus' => $idus);
				$consulta->execute($params);
				
				$resultado = $consulta->fetchAll(PDO::FETCH_COLUMN, 0); // MUY IMPORTANTE PARA DEVOLVER VALORES ÚNICOS
				$idtar = $resultado[0];
				return $idtar;
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Seleccionar Id target por nombre del target
		public function getIdtarget($nom) {
			// # Entrada: nombre de un target
			// # Salida: id target
			try {
				$consulta = $this->con->prepare('SELECT id_target FROM target 
				WHERE nombre_target = :nom');
				$params = array(':nom' => $nom);
				$consulta->execute($params);
				
				$resultado = $consulta->fetchAll(PDO::FETCH_COLUMN, 0); // MUY IMPORTANTE PARA DEVOLVER VALORES ÚNICOS
				$id = $resultado[0];
				return $id;
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Conectar a un estudio: necesario IdTarget, IdParticipante y token
		public function controlAccesoEstudio($participante, $encuesta, $token) {
			// # Entrada: email participante, nombre de estudio, token
			// # Salida: boolean
			try {
				$sql = 'SELECT token FROM valoracion WHERE id_destinatario = :dest AND id_target = :targ'; // Consulta
				$consulta = $this->con->prepare($sql); // Preparación
				$params = array(':dest' => $participante, ':targ' => $encuesta ); // Array de condición
				$consulta->execute($params); // Ejecución
				$resultado = $consulta->fetchAll(PDO::FETCH_COLUMN, 0); // Captura del dato
				$id = $resultado[0];
				
				// determinar respuesta
				if ($token == $id) {
					return true;
				} else {
					return false;
				}
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Aceso como usuario
		public function acceso($email, $clave) {
			// # Entrada: email usuario, clave usuario
			// # Salida: boolean
			try {
				$sql = 'SELECT clave FROM usuario WHERE email_usuario = :email'; // Consulta
				$consulta = $this->con->prepare($sql); // Preparación
				$params = array(':email' => $email); // Array de condición
				$consulta->execute($params); // Ejecución
				$resultado = $consulta->fetchAll(PDO::FETCH_COLUMN, 0); // Captura del dato

				// Comparación del resultado con el parametro
				if ($clave == $resultado[0]) {
					return true;
				} else {
					return false;
				}
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Crear un nuevo target
		public function nuevoTarget($nombre, $app, $id_usuario) {
			// # Entrada: datos target e id usuario
			// # Salida: Alta BD
			try {
				$consulta = $this->con->prepare('INSERT INTO target (nombre_target, link_target, id_usuario) 
				VALUES (:nombre, :app, :id_usuario)');
				$params = array(':nombre' => $nombre, ':app' => $app, ':id_usuario' => $id_usuario);
				$consulta->execute($params); // Ejecución
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Seleccionar: el mayor id target
		public function maxTargetid() {
			// # Entrada: 
			// # Salida: id target
			try {
				$consulta = $this->con->prepare('SELECT MAX(id_target) FROM target');
				$consulta->execute();
				$resultado = $consulta->fetchAll(PDO::FETCH_COLUMN, 0);
				$id = $resultado[0];
				return $id;
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Seleccionar la lista cuyo id es el menor, de un usuario por id
		public function minIdlista($idus) {
			// # Entrada: id usuario
			// # Salida: id lista
			try {
				$consulta = $this->con->prepare('SELECT MIN(id_lista) FROM lista WHERE id_usuario = :idus');
				$params = array(':idus' => $idus);
				$consulta->execute($params); // Ejecución

				$resultado = $consulta->fetchAll(PDO::FETCH_COLUMN, 0);
				$id = $resultado[0];
				return $id;
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Seleccionar nombres de listas (de participantes) por id_usuario
		public function listaParcipantesIdusuario($idusuario) {
			// # Entrada: id usuario
			// # Salida: array lista[nombre, id]
			try {
				$consulta = $this->con->prepare('SELECT nombre_lista, id_lista FROM lista WHERE id_usuario = :idusuario');
				$params = array(':idusuario' => $idusuario);
				
				$consulta->execute($params); // Ejecución
				$resultado = $consulta->fetchAll();
				return $resultado; // Devolver array
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Seleccionar los destinatarios que aparecen en una lista, según id lista
		public function listaNombresparticipantelista($idlista) {
			// # Entrada: id lista
			// # Salida: datos destinatario
			try {
				$consulta = $this->con->prepare('SELECT * FROM destinatario 
				WHERE id_destinatario = ANY (SELECT id_destinatario FROM contiene WHERE id_lista = :idlista)');
				$params = array(':idlista' => $idlista);
				
				$consulta->execute($params); // Ejecución
				$resultado = $consulta->fetchAll();
				return $resultado; // Devolver array
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Seleccionar destinatarios de un usuario
		public function listaParcipantestodosIdusuario($idus) {
			// # Entrada: id usuario
			// # Salida: array destinatario [id, email]
			try {
				$consulta = $this->con->prepare('SELECT id_destinatario, email_destinatario FROM destinatario 
				WHERE id_destinatario = ANY (SELECT id_destinatario FROM contiene WHERE id_lista = ANY
				(SELECT id_lista FROM lista WHERE id_usuario = :idus))');
				$params = array(':idus' => $idus);
			
				$consulta->execute($params); // Ejecución
				$resultado = $consulta->fetchAll();
				return $resultado; // Devolver array
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Crear una nueva lista
		public function nuevaLista($nombre_lista, $id_usuario) {
			// # Entrada: nombre lista e id usuario
			// # Salida: Alta BD
			try {
				$consulta = $this->con->prepare('INSERT INTO lista (nombre_lista, id_usuario)
				VALUES (:nombre_lista, :id_usuario)');
				$params = array(':nombre_lista' => $nombre_lista, ':id_usuario' => $id_usuario);
				$consulta->execute($params); // Ejecución
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Borrar una lista
		public function borrarlista($id) {
			// # Entrada: id lista
			// # Salida: Baja BD
			try {
				$sql = 'DELETE FROM lista WHERE id_lista = :id'; // Consulta
				$consulta = $this->con->prepare($sql); // Preparación
				$params = array(':id' => $id); // Array de parámetros de la consulta
				$consulta->execute($params); // Ejecución
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// agregar un unico participante a una lista
		public function agregarParticipantealista($idlista, $idparticipante) {
			// # Entrada: id lista e id participante
			// # Salida: Alta BD
			try {
				$consulta = $this->con->prepare('INSERT INTO contiene (id_lista, id_destinatario) VALUES (:idlista, :idparticipante) '); 
				$params = array(':idlista' => $idlista, ':idparticipante' => $idparticipante); // Array de parámetros de la consulta
				$consulta->execute($params); // Ejecución
			} catch(PDOException $e) {
				echo 'ERROR...: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Obtener todos los targets de un usuario
		public function getAllTargetfromuser($id) {
			// # Entrada: id usuario
			// # Salida: datos target
			try {
				$sql = 'SELECT * FROM target WHERE id_usuario = :id'; // Consulta
				$consulta = $this->con->prepare($sql); // Preparación
				$params = array(':id' => $id); // Array de parámetros de la consulta
				
				$consulta->execute($params); // Ejecución
				$resultado = $consulta->fetchAll();
				return $resultado; // Devolver array
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Comprobar que un destinatario existe por correo electronico
		public function existeDestinatario($mail) {
			// # Entrada: email usuario
			// # Salida: id usuario
			try {
				print("<br>" . $mail);
				$consulta = $this->con->prepare('SELECT id_destinatario FROM destinatario WHERE email_destinatario = :mail');
				$params = array(':mail' => $mail);
				$consulta->execute($params);
				
				$resultado = $consulta->fetchAll(PDO::FETCH_COLUMN, 0); // MUY IMPORTANTE PARA DEVOLVER VALORES ÚNICOS
				
				if(isset($resultado[0])){
					$id = $resultado[0];
					return $id;
				} else {
					return -1;
				}
				
			} catch(PDOException $e) {
				echo 'ERROR *: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Añadir miembro a estudio (inicializar)
		public function setValoracionesIni($participante, $encuesta, $token) {
			// # Entrada: id destinatario, id target y token
			// # Salida: ALTA BD
			try {
				$consulta = $this->con->prepare('INSERT INTO valoracion (id_destinatario, id_target, token) VALUES (:participante, :encuesta, :token) '); 
				$params = array(':participante' => $participante, ':encuesta' => $encuesta, ':token' => $token);
				$consulta->execute($params); // Ejecución
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Crear un nuevo destinatario (version simple)
		public function nuevoDestinatario($mail) {
			// # Entrada: email destinatario
			// # Salida: Alta BD
			try {
				$consulta = $this->con->prepare('INSERT INTO destinatario (email_destinatario) 
				VALUES (:email)');
				$params = array(':email' => $mail);
				$consulta->execute($params); // Ejecución
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Seleccionar: el mayor id lista
		public function maxListaid() {
			// # Entrada: 
			// # Salida: id lista
			try {
				$consulta = $this->con->prepare('SELECT MAX(id_lista) FROM lista');
				$consulta->execute();
				
				$resultado = $consulta->fetchAll(PDO::FETCH_COLUMN, 0);
				$id = $resultado[0];
				return $id;
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Borrar nexos de participantes a lista
		public function desvincularParticipantes($idlista) {
			// # Entrada: id lista
			// # Salida: Baja BD
			try {
				$sql = 'DELETE FROM contiene WHERE id_lista = :id'; // Consulta
				$consulta = $this->con->prepare($sql); // Preparación
				$params = array(':id' => $idlista); // Array de parámetros de la consulta
				$consulta->execute($params); // Ejecución
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Obtener las medias de cada respuesta de una valoracion
		public function mediasRespuesta($targetid) {
			// # Entrada: id target
			// # Salida: Array [coleccion AVG de cada respuesta]
			try {
				$sql = 'SELECT AVG(respuesta_1), AVG(respuesta_2), AVG(respuesta_3), AVG(respuesta_4), AVG(respuesta_5),
						AVG(respuesta_6), AVG(respuesta_7), AVG(respuesta_8), AVG(respuesta_9), AVG(respuesta_10),
						AVG(respuesta_11), AVG(respuesta_12), AVG(respuesta_13), AVG(respuesta_14), AVG(respuesta_15) 
						FROM valoracion WHERE id_target = :targetid; ' ; // Consulta
				
				$consulta = $this->con->prepare($sql); // Preparación
				$params = array(':targetid' => $targetid,); // Array de parámetros de la consulta
				$consulta->execute($params); // Ejecución
				
				$resultado = $consulta->fetchAll();
				return $resultado;
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Obtener las medias de los principios
		public function getAvgprincipios($targetid) {
			// # Entrada: id target
			// # Salida: Array [coleccion AVG de cada 3 respuestas (principio)]
			try {
				$sql = 'SELECT (AVG(respuesta_1) + AVG(respuesta_2) + AVG(respuesta_3))/3, (AVG(respuesta_4) + AVG(respuesta_5) +
						AVG(respuesta_6))/3, (AVG(respuesta_7)+ AVG(respuesta_8)+ AVG(respuesta_9))/3, (AVG(respuesta_10)+
						AVG(respuesta_11)+ AVG(respuesta_12))/3, (AVG(respuesta_13)+ AVG(respuesta_14)+ AVG(respuesta_15))/3 
						FROM valoracion WHERE id_target = :targetid; ' ; // Consulta
				
				$consulta = $this->con->prepare($sql); // Preparación
				$params = array(':targetid' => $targetid,); // Array de parámetros de la consulta
				$consulta->execute($params); // Ejecución
				
				$resultado = $consulta->fetchAll();
				return $resultado;
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Seleccionar las listas de un usuario
		public function getAllListfromuser($id) {
			// # Entrada: id usuario
			// # Salida: Array [listas]
			try {
				$sql = 'SELECT * FROM lista WHERE id_usuario = :id'; // Consulta
				$consulta = $this->con->prepare($sql); // Preparación
				$params = array(':id' => $id); // Array de parámetros de la consulta
				
				$consulta->execute($params); // Ejecución
				$resultado = $consulta->fetchAll();
				return $resultado; // Devolver array
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Obtner el nombre de un estudio según el id del mismo
		public function getNombreestudio($id) {
			// # Entrada: id usuario
			// # Salida: nombre
			try {
				$consulta = $this->con->prepare('SELECT nombre_target FROM target WHERE id_target = :id');
				$params = array(':id' => $id);
				$consulta->execute($params);
				
				$resultado = $consulta->fetchAll(PDO::FETCH_COLUMN, 0); // MUY IMPORTANTE PARA DEVOLVER VALORES ÚNICOS
				$nom = $resultado[0];
				return $nom;
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Obtner el nombre del sistema en evaluación según el id target
		public function getNombresistema($id) {
			// # Entrada: id usuario
			// # Salida: nombre
			try {
				$consulta = $this->con->prepare('SELECT link_target FROM target WHERE id_target = :id');
				$params = array(':id' => $id);
				$consulta->execute($params);
				
				$resultado = $consulta->fetchAll(PDO::FETCH_COLUMN, 0); // MUY IMPORTANTE PARA DEVOLVER VALORES ÚNICOS
				$nom = $resultado[0];
				return $nom;
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Obtner el nombre de un usuario según el id del mismo
		public function getNombreusuario($id) {
			// # Entrada: id usuario
			// # Salida: nombre usuario
			try {
				$consulta = $this->con->prepare('SELECT nombre_usuario FROM usuario WHERE id_usuario = :id');
				$params = array(':id' => $id);
				$consulta->execute($params);
				
				$resultado = $consulta->fetchAll(PDO::FETCH_COLUMN, 0); // MUY IMPORTANTE PARA DEVOLVER VALORES ÚNICOS
				$nom = $resultado[0];
				return $nom;
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
		
		// Obtener resultados de un estudio en concreto
		public function getResultados($idtar) {
			// # Entrada: id target
			// # Salida: Array [valoraciones]
			try {
				$sql = 'SELECT * FROM valoracion WHERE id_target = :idtar'; // Consulta
				$consulta = $this->con->prepare($sql); // Preparación
				$params = array(':idtar' => $idtar); // Array de parámetros de la consulta
				
				$consulta->execute($params); // Ejecución
				$resultado = $consulta->fetchAll();
				return $resultado; // Devolver array
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage() .'<br>'; // Posible error
			}
		}
	}
?>