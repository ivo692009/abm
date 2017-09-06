<?php
	
	abstract class FormStub {
		protected $errores = [];
		protected $valores = [];
		
		/**
		 * Devuelve si se ha ingresado un valor en $campo.
		 */
		abstract public function tieneValor($campo);
		
		/**
		 * Obtiene el valor del $campo, o null si no tiene.
		 */
		 abstract public function getValor($campo);
		
		/**
		 * Devuelve si las validaciones han generado algún error.
		 */
		abstract public function tieneErrores();

		/**
		 * Devuelve si se ha generado un error de validación para el $campo.
		 */
		abstract public function tieneError($campo);
		
		/**
		 * Obtiene el error del $campo, o null si no tiene.
		 */
		abstract public function getError($campo);
		
		/**
		 * Asocia un $mensaje de error a un $campo.
		 */
		abstract public function setError($campo, $mensaje);
		
		/**
		 * Si el $campo tiene un valor booleano true, devuelve el string "checked".
		 * Útil para rellenar checkboxes.
		 */
		abstract public function getChecked($campo);
		
		/**
		 * Si el valor del $campo coincide con $valor_ref, devuelve el string "selected".
		 * Útil para rellenar selects.
		 */
        abstract public function getSelected($campo, $valor_ref);
        
        /**
		 * Rellena el form con $arreglo_datos.
         * Se puede usar con $_GET, $_POST o un arreglo propio.
         * Devuelve $this para una API fluida.   
		 */
         abstract protected function rellenarCon($arreglo_datos);
		
		/**
		 * Dispara las validaciones del form.
		 * Devuelve el resultado del proceso.
		 */
		abstract protected function validar();
	}