<?php  // db_connnect.php
	/* -----------------------------------------------------------------------------
		
		Proyecto: Human Centeredness experimental evaluation tool
		Autores: Olga Peñalba, Miguel Revuelta
		Fecha: 2015-09-1
		Versión: 2.0 (español)
		
	----------------------------------------------------------------------------- */
	
	/* 
		Clase de conexión a la base de datos.
	*/
	
	class DB_Connect {
		
		// ATRIBUTOS
		private $con; // Variable de almacenamiento de la conexión
		
		// MÉTODOS
		// constructor
		function __construct() {
			// connecting to database
				$this->con = $this->connect();
		}
	 
		// Conectar con base de datos (SET)
		private function connect() {	
			// Importar variables de conexión
			require_once(__DIR__.'/../config/config.php'); 

			try {
				$conn = new PDO('mysql:host='.DB_SERVER .';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage(); // Informar sobre errores
			}
			return $conn; // Si todo ha ido bien establecer conexión
		}
		
		// Devolver conexión con base de datos (GET)
		public function getDbConnection() {
			return $this->con;
		}
	}
?>