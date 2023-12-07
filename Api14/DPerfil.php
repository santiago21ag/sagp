<?php
include('Conexion.php');

class DPerfil {		
	
	public $idCliente;
	public $nit;
	public $nombre;
	public $apPaterno;
	public $apMaterno;
	public $telefono;	
	public $usuario_id;

		
	public function __construct($v_idCliente,$v_nit,$v_nombre,$v_apPaterno,$v_apMaterno,$v_telefono,$v_usuario_id){					
		$this->idCliente  = $v_idCliente;
		$this->nit        = $v_nit;
		$this->nombre     = $v_nombre;
		$this->apPaterno  = $v_apPaterno;
		$this->apMaterno  = $v_apMaterno;
		$this->telefono   = $v_telefono;
		$this->usuario_id = $v_usuario_id;			
		$this->conexion   = new Conexion();
	}



	function modificarD(){

		$resultado = $this->conexion->openConexion()->query("UPDATE persona SET nit=$this->nit,nombre='$this->nombre',ap_paterno='$this->apPaterno',ap_materno='$this->apMaterno',telefono=$this->telefono WHERE idUserss='$this->usuario_id'");		
		$this->conexion->closeConexion();
		
		if($resultado){
		    return  json_encode("Modificacion exitosa");
		}else{
		    return  json_encode("No se ha podido modificar");
		}
		
	}


	function listarD(){
		$fila1 = array();
		$total = array();
		$resultado = $this->conexion->openConexion()->query("SELECT distinct c.idCliente,p.nit,p.nombre,p.ap_paterno,p.ap_materno,u.correo,p.telefono
FROM cliente c,usuario u, fotoperfil fp, persona p
WHERE u.userss=p.idUserss AND p.idPersona=c.idPersona AND u.userss='$this->usuario_id'");
		
		if ($fila = $resultado->fetch_assoc()) {
		    $fila1['idCliente']	  = $fila['idCliente'];
		    $fila1['nit']	      = $fila['nit'];
		    $fila1['nombre']      = $fila['nombre'];
		    $fila1['apPaterno']   = $fila['ap_paterno'];
		    $fila1['apMaterno']   = $fila['ap_materno'];
		    $fila1['correo']      = $fila['correo'];
		    $fila1['telefono']    = $fila['telefono'];		   
		}


		$rImagen1 = $this->conexion->openConexion()->query("SELECT imagen  as imagen1 
															FROM cliente c,fotoperfil fp,usuario u,persona p 
															WHERE u.userss='$this->usuario_id' 
															AND u.userss=p.idUserss 
															AND p.idPersona=c.idPersona 
															AND c.idCliente=fp.idCliente 
															AND fp.nombre='imagen1'");

			$filaImagen1 = $rImagen1->fetch_assoc();
		    $fila1['imagen1']     = $filaImagen1['imagen1'];


		$rImagen2 = $this->conexion->openConexion()->query("SELECT imagen as imagen2 
															FROM cliente c,fotoperfil fp,usuario u,persona p 
															WHERE u.userss='$this->usuario_id' 
															AND u.userss=p.idUserss 
															AND p.idPersona=c.idPersona 
															AND c.idCliente=fp.idCliente 
															AND fp.nombre='imagen2'");

			$filaImagen2 = $rImagen2->fetch_assoc();
		    $fila1['imagen2']     = $filaImagen2['imagen2'];

		
		$rImagen3 = $this->conexion->openConexion()->query("SELECT imagen  as imagen3 
															FROM cliente c,fotoperfil fp,usuario u,persona p 
															WHERE u.userss='$this->usuario_id' 
															AND u.userss=p.idUserss 
															AND p.idPersona=c.idPersona 
															AND c.idCliente=fp.idCliente 
															AND fp.nombre='imagen3'");

			$filaImagen3 = $rImagen3->fetch_assoc();
		    $fila1['imagen3']     = $filaImagen3['imagen3'];


		    $total[] = $fila1;
		


		$this->conexion->closeConexion();

		return  json_encode($total);
		

		
	}


}

$idCliente  = $_POST['idCliente'];
$nit        = $_POST['nit'];
$nombre     = $_POST['nombre'];
$apPaterno  = $_POST['apPaterno'];
$apMaterno  = $_POST['apMaterno'];
$telefono   = $_POST['telefono'];
$usuario_id = $_POST['usuario_id'];


if($_POST['idCliente'] ==null){$idCliente ="";}
if($_POST['nit'] ==null){$nit ="";}
if($_POST['nombre'] ==null){$nombre ="";}
if($_POST['apPaterno'] ==null){$apPaterno ="";}
if($_POST['apMaterno'] ==null){$apMaterno ="";}
if($_POST['telefono'] ==null){$telefono ="";}
if($_POST['usuario_id'] ==null){$usuario_id ="";}


if($idCliente=="" && $nit =="" && $nombre =="" && $apPaterno =="" && $apMaterno ==""  && $telefono =="" && $idCliente=="" && $usuario_id!="" ){
	$perfil  = new DPerfil("","","","","","",$usuario_id);
	echo $perfil->listarD();

}else if($idCliente!="" && $usuario_id!="" ){

	$perfil  = new DPerfil($idCliente,$nit,$nombre,$apPaterno,$apMaterno,$telefono,$usuario_id);	
	echo $perfil->modificarD();
}


?>