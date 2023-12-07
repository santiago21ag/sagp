<?php
require('../datos/d_validar.php');
		
	class Usuario{
		public $user;
		public $code;
		
		public function __construct($user,$code){
			$this->user  = $user;
			$this->code  = $code;
			$this->datos = new Validacion($this->user,$this->code);
			
		}
			
	
		function validarDatos(){
				
			$this->datos->d_validar();
		
		}

		function getVerificar(){
			return $this->datos->getVerificarD();
		}
	}
	
	if (isset($_POST['entrar'])){
		$usuario = $_POST['usuario'];
		$codigo = $_POST['codigo'];
		if(!empty($usuario) && !empty($codigo)){			
			$sesion= new Usuario($usuario,$codigo);
			$sesion->validarDatos();
			
		}
	}
?>
