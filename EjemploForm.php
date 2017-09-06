<?php

	require 'Form.php';
	
	class EjemploForm extends Form {
		
		//categorias del tag <select>
		public $categorias;
		
		public function __construct() {
			$this->categorias = [1 => "Bebidas", 2 => "Almacén", 3 => "Limpieza"];
		}
		
		protected function procesarCampos() {
			$this->procesarNombreProducto('nombre_producto');
			$this->procesarCategoria('categoria');
		}
		
		protected function procesarNombreProducto($campo) {
			$nombre = $this->getValor($campo);
			
			//valido parametro
			if(empty($nombre)) {
				$this->setError($campo, "Faltó ingresar el nombre del producto");
				return;	//si hay error, no seguir validando
			}
			
			//otra validacion
			if(strlen($nombre) < 3) {
				$this->setError($campo, "El nombre del producto es muy corto");
			}
			
			//...
		}
		
		protected function procesarCategoria($campo) {
			$categoria = $this->getValor($campo);
			
			//valido parametro
			if(empty($categoria)) {
				$this->setError($campo, "Falta seleccionar categoría");
			}
		}
	}
