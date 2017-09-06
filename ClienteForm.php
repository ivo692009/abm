<?php

	require 'Form.php';
	
	class ClienteForm extends Form {
		
		//categorias del tag <select>
		public $categorias;
		
		public function __construct() {
			$this->categorias = [1 => "Argentino", 2 => "Chileno", 3 => "Paraguayo", 4 => "Cubano"];
		}
		
		protected function procesarCampos() {
			$this->procesarTexto('nombre');
			$this->procesarTexto('apellido');
			$this->procesarFecha('fecha');
			$this->procesarCategoria('categoria');
		}
		
		protected function procesarTexto($campo) {
			$nombre = $this->getValor($campo);
			
			//valido parametro
			if(empty($nombre)) {
				$this->setError($campo, "Faltó ingresar el nombre del producto");
				return;	//si hay error, no seguir validando
			}
			
			//Texto Corto
			if(strlen($nombre) < 3) {
				$this->setError($campo, "El nombre del producto es muy corto");
			}

			//Texto Largo
			if(strlen($nombre) > 30) {
				$this->setError($campo, "El nombre del producto es muy Largo");
			}

			//Solo Caracteres.
			if(preg_match('/[^a-Z]/',$nombre)){	
				$this->setError($campo, "Solo se permiten caracteres");
				return;
			}

		}
		
		protected function procesarCategoria($campo) {
			$categoria = $this->getValor($campo);

			//valido parametro
			if(empty($categoria)) {
				$this->setError($campo, "Falta seleccionar categoría");
			}

			//Opcion invalida
			if ($categoria < 0 || $categoria > 3) {
				$this->setError($campo, "Opcion incorrecta, Fuera del rango permitido");
			}

		}

		protected function procesarFecha($campo) {
			$fecha = $this->getValor($campo);

			//Para validar una fecha se tiene que usar la funcion "checkdate" que devuelve un booleano si la fecha es valida
			//El orden que devuelve en HTML5 el valor de un tipo DATE es
			//AAAA-MM-DD.
			//Y para utilizar el CHECKDATE se tiene que usar la siguiente forma
			//bool checkdate ( int $month , int $day , int $year )
			
			$valores = explode('-', $fecha);

			//valido parametro
			if(empty($fecha)) {
				$this->setError($campo, "Falta seleccionar fecha");
				return;
			}

			//Fecha Valida EN ESPAÑOL
			if(count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[1])){
				
			}
			else{
				$this->setError($campo, "La Fecha Ingresada es Invalida");
				}
		}

		public function push(){

			session_start();
			require "usuario.php";

			error_reporting(E_ALL);
			ini_set("display_errors", true);

			//Valores recividos por POST
			$nombre_nuevo = $_POST['nombre'];
			$apellido_nuevo = $_POST['apellido'];
			$fechnac_nuevo = $_POST['fecha'];
			$nacionalidad_id_nuevo = $_POST['categoria'];
			$estado_nuevo = $_POST['vigente'];

			if ($_POST['vigente']) {
				$estado_nuevo = $_POST['vigente'];
			}
			else{
				$estado_nuevo = 0;
			}

			header('Content-Type: text/html; charset=UTF-8');

			try {

			    $pdo = new PDO('mysql:host=localhost;dbname=clientes_db', $usuario, $contraseña);

			    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
			    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    $pdo->exec("SET NAMES UTF8");

			    //armamos el SQL
			    $sql = "INSERT INTO `clientes` (`apellido`,`nombre`,`activo`,`fechnac`, `nacionalidad_id`) 
			            VALUES (:apellido, :nombre, :estado, :fechnac, :nacionalidad_id)";

			    //preparamos un statement con el sql anterior
			    $stmt = $pdo->prepare($sql);

			    //especificamos la salida como un array
			    $stmt->setFetchMode(PDO::FETCH_OBJ); //podria ser PDO::FETCH_OBJ
			    //sustituimos los parametros con los valores reales
			    $stmt->bindParam(':nombre', $nombre_nuevo);
			    $stmt->bindParam(':apellido', $apellido_nuevo);
			    $stmt->bindParam(':estado', $estado_nuevo);
			    $stmt->bindParam(':fechnac', $fechnac_nuevo);
			    $stmt->bindParam(':nacionalidad_id', $nacionalidad_id_nuevo);

			    //ejecutamos la consulta
			    $stmt->execute();
			} catch (PDOException $e) {
			    echo 'Error de la coneccion a la BD:' . $e->getMessage();
			}

		}

    }

