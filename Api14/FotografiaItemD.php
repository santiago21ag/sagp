
<?php
require('Conexion.php');

class FotografiaItemD {		
    
	public $idProducto;
		
	public function __construct($idProducto){					
		$this->idProducto   = $idProducto;
		$this->conexion     = new Conexion();
	}


	function getFotografiaItem(){
		
		$fila2 = array();
		$total = array();
		$resultado = $this->conexion->openConexion()->query(
			"SELECT DISTINCT p.idProducto,p.nombre,p.descripcion,p.extension,p.tamanho,p.imagen,p.fecha,p.precio
            FROM producto p
            WHERE p.idProducto=	$this->idProducto");
		
		while($fila = $resultado->fetch_assoc()) {
		    $fila2['idProducto']   = $fila['idProducto'];
		    $fila2['nombre']	   = $fila['nombre'];
		    $fila2['descripcion']  = $fila['descripcion'];
		    $fila2['extension']	   = $fila['extension'];
		    $fila2['tamanho']	   = $fila['tamanho'];
		    $fila2['imagen']	   = $fila['imagen'];
		    $fila2['fecha']	       = $fila['fecha'];
		    $fila2['precio']       = $fila['precio'];
		    $total[]               = $fila2;
		   
		}
		$this->conexion->closeConexion();

		return  json_encode($total);		
	}

}

$idProducto = $_POST['idProducto'];
	
if($_POST['idProducto'] ==null){$idProducto ="";}


if($idProducto!=""){
	$fotografiaItemD = new FotografiaItemD($idProducto);
	echo $fotografiaItemD->getFotografiaItem();

}


?>