

<?php
include('Conexion.php');

class Sesion {
		
	public $user;
	public $password;		
		
		
	public function __construct($v_user,$v_password){
					
		$this->user     = $v_user;
		$this->password = $v_password;			
		$this->conexion = new Conexion();
	}

	function validarSesion(){
		$resultado="";
		$resultado = $this->conexion->openConexion()->query("SELECT EXISTS (SELECT * FROM usuario WHERE userss='$this->user' AND passwords='$this->password');");
		
		$fila = $resultado->fetch_array(MYSQLI_NUM); //MYSQLI_ASSOC

		$this->conexion->closeConexion();
		
		if($fila[0]=='1'){
			$resultado=$this->user;
		}else{
			$resultado='no existe';
		}
		return json_encode($resultado);
		
	}

	

}


$user= $_POST['userss'];
$passwords= $_POST['passwords'];
$sesion = new Sesion($user,$passwords);
echo $sesion->validarSesion();

?>