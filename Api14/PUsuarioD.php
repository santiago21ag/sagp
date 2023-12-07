<?php
include('Conexion.php');

class PUsuarioD {
		
	public $nit;
	public $nombre;
	public $apPaterno;
	public $apMaterno;
	public $correo;	
	public $telefono;
	public $codigo;
	public $usuario_id;

		
		
	public function __construct($nit,$nombre,$apPaterno,$apMaterno,$correo,$telefono,$codigo,$usuario_id){
					
		$this->nit        = $nit;
		$this->nombre     = $nombre;
		$this->apPaterno  = $apPaterno;
		$this->apMaterno  = $apMaterno;
		$this->correo     = $correo;
		$this->telefono   = $telefono;		
		$this->codigo     = $codigo;
		$this->usuario_id = $usuario_id;
					
		$this->conexion = new Conexion();
	}

	function verificarD(){
		$bandera=false;
		$resultado = $this->conexion->openConexion()->query("SELECT EXISTS (SELECT * FROM usuario WHERE userss='$this->usuario_id');");
		
		$fila = $resultado->fetch_array(MYSQLI_NUM); //MYSQLI_ASSOC

		
		
		if($fila[0]=='1'){
			$bandera=true;
		}

		return $bandera;
		
	}

	function registrarD(){
		
		$result= "";
		if ($this->verificarD()) {

			$result= "Este usuario ya existe";
					
		}else{		

			$resultado = $this->conexion->openConexion()->query(
				"INSERT INTO usuario(userss,passwords,correo,rol) VALUES('$this->usuario_id','$this->codigo','$this->correo','Cliente')");
			

			$resultado2 = $this->conexion->openConexion()->query(
				"INSERT INTO persona(nit,nombre,ap_paterno,ap_materno,telefono,tipo,idUserss) VALUES($this->nit,'$this->nombre','$this->apPaterno','$this->apMaterno',$this->telefono,'Cliente','$this->usuario_id')");
			

			$resultado3 = $this->conexion->openConexion()->query("SELECT idPersona FROM persona WHERE nit=$this->nit AND nombre='$this->nombre' AND ap_paterno='$this->apPaterno' AND ap_materno='$this->apMaterno' AND telefono=$this->telefono AND tipo='Cliente' AND idUserss='$this->usuario_id'" );
		
			$fila3 = $resultado3->fetch_array(MYSQLI_NUM); 

		
			$resultado4 = $this->conexion->openConexion()->query("INSERT INTO cliente(idPersona) VALUES($fila3[0])");


			$resultado5 = $this->conexion->openConexion()->query("SELECT idCliente FROM cliente WHERE idPersona=$fila3[0]" );
			
			$fila5 = $resultado5->fetch_array(MYSQLI_NUM);


			$resultado6 = $this->conexion->openConexion()->query(
				"INSERT INTO fotoperfil(nombre,imagen,extension,idCliente) VALUES('imagen1','usuario_default.png','PNG',$fila5[0]),('imagen2','usuario_default.png','PNG',$fila5[0]),('imagen3','usuario_default.png','PNG',$fila5[0]);");
			

			$this->conexion->closeConexion();

			$result= "".$this->usuario_id;	
		}	

		return $result;
		
				
	}	
}	
			
	



	




$nit         = $_POST['nit'];
$nombre      = $_POST['nombre'];
$apPaterno   = $_POST['apPaterno'];
$apMaterno   = $_POST['apMaterno'];
$correo      = $_POST['correo'];
$telefono    = $_POST['telefono'];
$codigo      = $_POST['codigo'];
$usuario_id  = $_POST['usuario_id'];

if($_POST['nit'] == null){        $nit ="";}
if($_POST['nombre'] == null){     $nombre ="";}
if($_POST['apPaterno'] == null){  $apPaterno ="";}
if($_POST['apMaterno'] == null){  $apMaterno ="";}
if($_POST['correo'] == null){     $correo ="";}
if($_POST['telefono'] == null){   $telefono ="";}
if($_POST['codigo'] == null){     $codigo ="";}
if($_POST['usuario_id'] == null){ $usuario_id ="";}

if($nit!="" && $nombre!="" && $apPaterno!="" && $apMaterno!="" && $correo!="" && $telefono!="" && $codigo!="" && $usuario_id!="" ){
	$usuario   = new PUsuarioD($nit,$nombre,$apPaterno,$apMaterno,$correo, $telefono, $codigo,$usuario_id);
	echo $usuario->registrarD();
}


?>