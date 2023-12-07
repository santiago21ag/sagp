
<?php
include('Conexion.php');

class Notificacion {		
	
		
	public $usuario_id;

		
	public function __construct($v_usuario_id){					
		
		$this->usuario_id = $v_usuario_id;			
		$this->conexion = new Conexion();
	}



	function listar(){
		$fila2 = array();
		$total = array();
		$resultado = $this->conexion->openConexion()->query("SELECT n.id,n.titulo,n.descripcion,n.fecha 
																FROM notificacion n,usuario u 
																WHERE u.userss=n.usuario_id AND u.userss='$this->usuario_id'");
		
		while($fila = $resultado->fetch_assoc()) {
		    $fila2['id']	      = $fila['id'];
		    $fila2['titulo']	  = $fila['titulo'];
		    $fila2['descripcion'] = $fila['descripcion'];
		    $fila2['fecha']       = $fila['fecha'];		   
		    $total[]              = $fila2;
		   
		}
		$this->conexion->closeConexion();

		return  json_encode($total);
		

		
	}


}


$usuario_id = $_POST['usuario_id'];
$notificacion  = new Notificacion($usuario_id);
echo $notificacion->listar();


?>