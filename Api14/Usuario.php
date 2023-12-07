<?php
include('Conexion.php');

class Usuario {
		
	public $user;
	public $password;		
		
		
	public function __construct($v_user,$v_password,$v_imagen){
					
		$this->user     = $v_user;
		$this->password = $v_password;
		$this->imagen   = $v_imagen;
					
		$this->conexion = new Conexion();
	}

	function verificarUsuario(){
		$bandera=false;
		$resultado = $this->conexion->openConexion()->query("SELECT EXISTS (SELECT * FROM usuario WHERE userss='$this->user' AND passwords='$this->password');");
		
		$fila = $resultado->fetch_array(MYSQLI_NUM); //MYSQLI_ASSOC

		$this->conexion->closeConexion();
		
		if($fila[0]=='1'){
			$bandera=true;
		}else{
			$bandera=false;
		}
		return $bandera;
		
	}

	function registrarUsuario(){

		if(!$this->verificarUsuario()){

			$resultado = $this->conexion->openConexion()->query("INSERT INTO usuario(userss,passwords,imagen,rol) VALUES('$this->user','$this->password','$this->imagen','Cliente');");		
			$this->conexion->closeConexion();
			return $this->user;	
		}else{
			return "ya existe";	
		}		
			
	}

	function actualizarImagenUsuario(){		

			$resultado = $this->conexion->openConexion()->query("UPDATE usuario SET imagen='$this->imagen' WHERE userss='$this->user'");		
			$this->conexion->closeConexion();
				
		return "Imagen actualizada";		
	}

	

}


$user      = $_POST['userss'];
$passwords = $_POST['passwords'];
$imagen    = $_POST['imagen'];

if($user!="" && $passwords!="" && $imagen!="" ){
	$usuario   = new Usuario($user,$passwords,$imagen);
	echo $usuario->registrarUsuario();
}else{
	$usuario   = new Usuario($user,"",$imagen);
	echo $usuario->actualizarImagenUsuario();
}


?>