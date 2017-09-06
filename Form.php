<?php
	
	abstract class Form {
		protected $errores = [];
		protected $valores = [];
		
		public function tieneValor($campo) {
			return !empty($this->valores[$campo]);
		}
		
		public function getValor($campo) {
			return $this->tieneValor($campo) ? $this->valores[$campo] : null;
		}
		
		public function tieneErrores() {
			return !empty($this->errores);
		}
		
		public function tieneError($campo) {
			return !empty($this->errores[$campo]);
		}
		
		public function getError($campo) {
			return $this->tieneError($campo) ? $this->errores[$campo] : null;
		}
		
		public function setError($campo, $mensaje) {
			$this->errores[$campo] = $mensaje;
		}
		
		public function procesar($arreglo_datos) {
			$this->rellenar($arreglo_datos);
			$this->procesarCampos();
			
			return empty($this->errores);
		}
		
		public function getChecked($campo) {
			return $this->getValor($campo) ? "checked" : "";
		}
		
		public function getSelected($campo, $valor_ref) {
			return $this->getValor($campo) == $valor_ref ? "selected" : "";
		}
		
		protected function rellenar($arreglo_datos) {
			foreach($arreglo_datos as $k => $v) {
				$this->valores[$k] = $v;
			}
		}
		
		abstract protected function procesarCampos();
	}
	
