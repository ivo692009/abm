<?php

	require 'Form.php';
	
	class ClienteForm extends Form {
		
		//categorias del tag <select>
		public $categorias;
		
		public function __construct() {
			$this->categorias = [1 => "Argentina", 2 => "Chile", 3 => "Brazil"];
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

    }

