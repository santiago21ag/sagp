<?php
include('Conexion.php');

class Compras {	

	public $idCompra;
	public $cantidad;
	public $total;
	public $fecha;
	public $hora;
	public $producto_id;
	public $usuario_id;		
		
	public function __construct($idCompra,$cantidad,$total,$fecha,$hora,$producto_id,$usuario_id){
		$this->idCompra    = $idCompra;
		$this->cantidad    = $cantidad;
		$this->total       = $total;
		$this->fecha       = $fecha;
		$this->hora        = $hora;		
		$this->usuario_id  = $usuario_id;
		$this->producto_id = $producto_id;			
		$this->conexion    = new Conexion();
	}

	function registrar(){
	

		$resultado = $this->conexion->openConexion()->query(
				"SELECT DISTINCT c.idCliente
                FROM  usuario u,persona p,cliente c
                WHERE  p.idUserss=u.userss AND c.idPersona=p.idPersona AND u.userss='$this->usuario_id'");

		$fila = $resultado->fetch_array(MYSQLI_NUM); 
		

		$resultado1 = $this->conexion->openConexion()->query(
			"INSERT INTO compra(fecha,hora,idCliente)VALUES('$this->fecha','$this->hora',$fila[0]);");	


		$resultado2 = $this->conexion->openConexion()->query(
			"SELECT c.idCompra FROM compra c WHERE c.fecha='$this->fecha' AND c.hora='$this->hora' AND c.idCliente=$fila[0]");	
		$fila2 = $resultado2->fetch_array(MYSQLI_NUM); 

		$cant= json_decode($this->cantidad);
		$prod= json_decode($this->producto_id);
		for ($i=0; $i < count($cant); $i++) { 			
		
			$resultado3 = $this->conexion->openConexion()->query(
				"INSERT INTO detallecompra(cantidad,total,idCompra,idProducto)VALUES($cant[$i],$this->total,$fila2[0],$prod[$i]);");	
		}

		$this->conexion->closeConexion();

		return json_encode("Registro exitoso");
	}


	function eliminar(){
		
		$resultado = $this->conexion->openConexion()->query(
				"SELECT DISTINCT cli.idCliente
				FROM cliente cli,usuario u,persona p
				WHERE u.userss=p.idUserss 
				AND  p.idPersona=cli.idPersona
				AND  u.userss='$this->usuario_id'");

		$fila = $resultado->fetch_array(MYSQLI_NUM);

		$resultado2 = $this->conexion->openConexion()->query("DELETE FROM compra WHERE idCompra=$this->idCompra AND idCliente=$fila[0]");

		$this->conexion->closeConexion();

		return json_encode("Eliminacion exitosa");
	}



	function listar(){
		$fila2 = array();
		$total = array();

			    $resultado1 = $this->conexion->openConexion()->query(
				"SELECT DISTINCT co.idCompra,co.fecha,co.hora,p.nombre,p.ap_paterno,p.ap_materno
				FROM cliente c,usuario u,persona p ,compra co
				WHERE u.userss='$this->usuario_id'
				AND u.userss=p.idUserss
				AND p.idPersona=c.idPersona
				AND c.idCliente=co.idCliente");
								
				 while($fila1 = $resultado1->fetch_assoc()) {

				    $fila2['idCompra']	   = $fila1['idCompra'];
				    $fila2['fecha']	       = $fila1['fecha'];
				    $fila2['hora']         = $fila1['hora'];				    
				    $fila2['cliente']	   = $fila1['nombre']." ".$fila1['ap_paterno']." ".$fila1['ap_materno'];     	    
				    $total[]               = $fila2;
				 }

				 $this->conexion->closeConexion();
				 return  json_encode($total);		   
		}	

		function listarDetalle(){
		$fila2 = array();
		$total = array();

			    $resultado1 = $this->conexion->openConexion()->query(
				"SELECT DISTINCT co.idCompra,co.fecha,co.hora,p.nombre,p.ap_paterno,p.ap_materno,pro.nombre AS titulo,pro.precio,dc.cantidad,dc.total,e.nombre AS evento
FROM cliente c,usuario u,persona p ,compra co,detallecompra dc,producto pro,evento e
WHERE u.userss='$this->usuario_id'
AND u.userss=p.idUserss
AND p.idPersona=c.idPersona
AND c.idCliente=co.idCliente
AND co.idCompra=$this->idCompra
AND co.idCompra=dc.idCompra
AND pro.idProducto=dc.idProducto
AND e.idEvento=pro.idEvento;");
				
				 while($fila1 = $resultado1->fetch_assoc()) {

				    $fila2['idCompra']	   = $fila1['idCompra'];
				    $fila2['fecha']	       = $fila1['fecha'];
				    $fila2['hora']         = $fila1['hora'];				    
				    $fila2['cliente']	   = $fila1['nombre']." ".$fila1['ap_paterno']." ".$fila1['ap_materno'];			   
				    $fila2['producto']	   = $fila1['titulo']; 
				    $fila2['precio']	   = $fila1['precio'];
				    $fila2['cantidad']	   = $fila1['cantidad'];
				    $fila2['total']	       = $fila1['total'];
				    $fila2['evento']	   = $fila1['evento'];
				    $total[]               = $fila2;
				 }

				 $this->conexion->closeConexion();
				 return  json_encode($total);		   
		}	
		
	

	

}

$idCompra    = $_POST['idCompra'];
$cantidad    = $_POST['cantidad'];
$total       = $_POST['total'];
$fecha       = $_POST['fecha'];
$hora        = $_POST['hora'];
$producto_id = $_POST['producto_id'];
$usuario_id  = $_POST['usuario_id'];

if($_POST['idCompra'] ==null){$idCompra ="";}
if($_POST['cantidad'] ==null){$cantidad ="";}
if($_POST['total'] ==null){$total ="";}
if($_POST['fecha'] ==null){$fecha ="";}
if($_POST['hora'] ==null){$hora ="";}
if($_POST['producto_id'] ==null){$producto_id ="";}
if($_POST['usuario_id'] ==null){$usuario_id ="";}

if($idCompra=="" &&  $cantidad!="" && $total!=""&& $fecha!=""&& $hora!="" &&  $producto_id!="" && $usuario_id!=""){

	$compras = new Compras($idCompra,$cantidad,$total,$fecha,$hora,$producto_id,$usuario_id);
	echo $compras->registrar();

/*}else if($id!="" && $usuario_id!="" ){

	$compras = new Compras($cantidad,$total,$fecha,$hora,$tipocompra,$producto_id,$usuario_id);echo $compras->eliminar();*/
	
	
}else if($idCompra=="" && $usuario_id!="" ){
	$compras = new Compras($idCompra,$cantidad,$total,$fecha,$hora,$producto_id,$usuario_id);	
	echo $compras->listar();


}else if($idCompra!="" && $usuario_id!="" ){
	$compras = new Compras($idCompra,$cantidad,$total,$fecha,$hora,$producto_id,$usuario_id);	
	echo $compras->listarDetalle();
}





?>