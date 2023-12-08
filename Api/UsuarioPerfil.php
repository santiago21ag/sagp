<?php
include('Conexion.php');

class DUsuarioPerfil {		
	
	public $nroimagen;
	public $imagen;
	public $imagenAnterior;
	public $nombre;
	public $carpeta;		
	public $usuario_id;

		
	public function __construct($nroimagen,$imagen,$imagenAnterior,$nombre,$carpeta,$usuario_id){
		$this->nroimagen      = $nroimagen;				
		$this->imagen         = $imagen;
		$this->imagenAnterior = $imagenAnterior;
		$this->nombre         = $nombre;
		$this->carpeta        = $carpeta;	
		$this->usuario_id     = $usuario_id;
		$this->conexion       = new Conexion();
	}

	


	
	function actualizarImagenPerfilP(){
		if (is_dir($this->carpeta)) {

			//if($this->imagenAnterior!="usuario_default.png"){

				 if(file_put_contents($this->carpeta.$this->nombre,$this->imagen)){


				 	$resultado = $this->conexion->openConexion()->query("SELECT fp.idCliente  
					FROM cliente c,fotoperfil fp,usuario u,persona p 
					WHERE u.userss='$this->usuario_id' 
					AND u.userss=p.idUserss 
					AND p.idPersona=c.idPersona 
					AND c.idCliente=fp.idCliente 
					AND fp.nombre='$this->nroimagen'"); 

					$IdCliente = $resultado->fetch_array(MYSQLI_NUM);

				 	
				 	$this->conexion->openConexion()->query("UPDATE fotoperfil SET nombre='$this->nroimagen',imagen='$this->nombre',extension='JPG' WHERE nombre='$this->nroimagen' AND idCliente=$IdCliente[0]");	
											

				 	

				 	$this->conexion->closeConexion();
					return  json_encode("Actualizacion exitosa");
				 	
				 }
				
			/*}else{

				if(file_put_contents($this->carpeta.$this->nombre,$this->usuario_id)){
					$this->conexion->openConexion()->query("UPDATE usuario SET imagen='$this->nombre' WHERE userss='$this->usuario_id'");		
						$this->conexion->closeConexion();
						return  json_encode("Actualizacion exitosa");
				}

			}*/
			
		}else{
			return  json_encode("no existe el directorio: ".$this->carpeta);
		}
	}


	


}






$nroimagen          = $_POST['nroimagen'];
$imagen             = $_POST['imagen'];
$imagenAnterior     = $_POST['imagenAnterior'];
$nombre             = $_POST['nombre'];
$carpeta            = $_POST['carpeta'];
$usuario_id         = $_POST['usuario_id'];

$realImage = base64_decode($imagen);


if( $_POST['nroimagen']          == null){ $nroimagen ="";}
if( $_POST['imagen']             == null){ $imagen ="";}
if( $_POST['imagenAnterior']     == null){ $imagenAnterior ="";}
if( $_POST['nombre']             == null){ $nombre ="";}
if( $_POST['carpeta']            == null){ $carpeta ="";}
if( $_POST['usuario_id']         == null){ $usuario_id ="";}


if($nroimagen !="" && $imagen !="" && $imagenAnterior !="" && $nombre !="" && $carpeta !="" && $usuario_id !=""  ){
	$perfilImagen  = new DUsuarioPerfil($nroimagen,$realImage,$imagenAnterior,$nombre,$carpeta,$usuario_id);
	echo $perfilImagen->actualizarImagenPerfilP();

}


?>