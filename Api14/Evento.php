<?php
include('Conexion.php');

class Evento {		
	
	public $idEvento;
	public $nombre;
	public $descripcion;
	public $fecha;	
	public $usuario_id;

		
	public function __construct($v_idEvento,$v_nombre,$v_descripcion,$v_fecha,$v_usuario_id){					
		$this->idEvento    = $v_idEvento;
		$this->nombre      = $v_nombre;
		$this->descripcion = $v_descripcion;
		$this->fecha       = $v_fecha;
		$this->usuario_id  = $v_usuario_id;			
		$this->conexion    = new Conexion();
	}

	
	function listar(){

		$fila2 = array();
		$total = array();

		$resultado = $this->conexion->openConexion()->query(
			"SELECT e.idEvento,e.nombre,e.descripcion,e.descripcion,e.fecha
			 FROM evento e");
		
		while ($fila = $resultado->fetch_assoc()) {

		    $fila2['idEvento']	   = $fila['idEvento'];
		    $fila2['nombre']	   = $fila['nombre'];
		    $fila2['descripcion']  = $fila['descripcion'];
		    $fila2['fecha']        = $fila['fecha'];		   
		    $total[]               = $fila2;
		   
		}

		$this->conexion->closeConexion();

		return json_encode($total);

		
	}


}

$idEvento   = $_POST['idEvento'];
$nombre      = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$fecha         = $_POST['fecha'];
$usuario_id  = $_POST['usuario_id'];


if($_POST['idEvento'] ==null){$idEvento ="";}
if($_POST['nombre'] ==null){$nombre ="";}
if($_POST['descripcion'] ==null){$descripcion ="";}
if($_POST['fecha'] ==null){$fecha ="";}
if($_POST['usuario_id'] ==null){$usuario_id ="";}


if($idEvento=="" && $nombre =="" && $descripcion =="" && $fecha =="" && $usuario_id!=""){
	$evento  = new Evento("","","","",$usuario_id);
	echo $evento->listar();

}


?>