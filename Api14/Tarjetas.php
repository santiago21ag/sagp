<?php
include('Conexion.php');

class Tarjeta {		
	
	public $idTarjeta;
	public $numero;
	public $vencimiento;
	public $cvc;	
	public $usuario_id;

		
	public function __construct($v_idTarjeta,$v_numero,$v_vencimiento,$v_cvc,$v_usuario_id){					
		$this->idTarjeta   = $v_idTarjeta;
		$this->numero      = $v_numero;
		$this->vencimiento = $v_vencimiento;
		$this->cvc         = $v_cvc;
		$this->usuario_id  = $v_usuario_id;			
		$this->conexion    = new Conexion();
	}

	function registrar(){

		$resultado = $this->conexion->openConexion()->query("SELECT DISTINCT c.idCliente  
															FROM cliente c,usuario u,persona p 
															WHERE u.userss='$this->usuario_id' 
															AND u.userss=p.idUserss 
															AND p.idPersona=c.idPersona"); 

		$IdCliente = $resultado->fetch_array(MYSQLI_NUM);


		$resultado2=$this->conexion->openConexion()->query("INSERT INTO tarjeta(numero,vencimiento,cvc,idCliente)VALUES('$this->numero','$this->vencimiento','$this->cvc',$IdCliente[0]);");
		$this->conexion->closeConexion();
		if($resultado2){
		    return json_encode("Registro exitoso");
		}else{
		    return json_encode("No se realizo el registro");
		}
		
	}


	function eliminar(){

		$resultado = $this->conexion->openConexion()->query("SELECT DISTINCT c.idCliente  
															FROM cliente c,usuario u,persona p 
															WHERE u.userss='$this->usuario_id' 
															AND u.userss=p.idUserss 
															AND p.idPersona=c.idPersona"); 

		$IdCliente = $resultado->fetch_array(MYSQLI_NUM);

		$resultado = $this->conexion->openConexion()->query("DELETE FROM tarjeta  WHERE idTarjeta=$this->idTarjeta AND idCliente=$IdCliente[0]");		
		$this->conexion->closeConexion();
		if($resultado){
		    return json_encode("Eliminacion exitosa");
		}else{
		    return json_encode("Error al eliminar");
		}
	
	}


	function listar(){
		$fila2 = array();
		$total = array();
		$resultado = $this->conexion->openConexion()->query(
			"SELECT t.idTarjeta,t.numero,t.vencimiento,t.cvc,p.nombre,p.ap_paterno,p.ap_materno
			FROM cliente c,usuario u,persona p ,tarjeta t
			WHERE u.userss='$this->usuario_id' 
			AND u.userss=p.idUserss 
			AND p.idPersona=c.idPersona 
			AND c.idCliente=t.idCliente");
		
		while ($fila = $resultado->fetch_assoc()) {
		    $fila2['idTarjeta']	   = $fila['idTarjeta'];
		    $fila2['numero']	   = $fila['numero'];
		    $fila2['vencimiento']  = $fila['vencimiento'];
		    $fila2['cvc']          = $fila['cvc'];
		    $fila2['cliente']      = $fila['nombre']." ".$fila['ap_paterno']." ".$fila['ap_materno'];
		    $total[]               = $fila2;
		   
		}
		$this->conexion->closeConexion();

		return json_encode($total);	

		
	}


}

$idTarjeta   = $_POST['idTarjeta'];
$numero      = $_POST['numero'];
$vencimiento = $_POST['vencimiento'];
$cvc         = $_POST['cvc'];
$usuario_id  = $_POST['usuario_id'];


if($_POST['idTarjeta'] ==null){$idTarjeta ="";}
if($_POST['numero'] ==null){$numero ="";}
if($_POST['vencimiento'] ==null){$vencimiento ="";}
if($_POST['cvc'] ==null){$cvc ="";}
if($_POST['usuario_id'] ==null){$usuario_id ="";}


if($idTarjeta=="" && $numero =="" && $vencimiento =="" && $cvc =="" && $usuario_id!=""){
	$tarjeta  = new Tarjeta("","","","",$usuario_id);
	echo $tarjeta->listar();

}else if($idTarjeta=="" && $numero !="" && $vencimiento !="" && $cvc !="" && $usuario_id!=""  ){
	$tarjeta  = new Tarjeta("",$numero,$vencimiento,$cvc,$usuario_id);	
	echo $tarjeta->registrar();

}else if($idTarjeta!=""){
	$tarjeta  = new Tarjeta($idTarjeta,"","","",$usuario_id);	
	echo $tarjeta->eliminar();
}


?>