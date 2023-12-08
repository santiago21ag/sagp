<?php
include('Conexion.php');

class Favoritos {	

	public $marca;
	public $modelo;
	public $version;
	public $usuario_id;
	public $producto_id;		
		
	public function __construct($marca,$modelo,$version,$v_usuario_id,$v_producto_id){					
		$this->marca        = $marca;
		$this->modelo       = $modelo;
		$this->version      = $version;
		$this->usuario_id  = $v_usuario_id;
		$this->producto_id = $v_producto_id;			
		$this->conexion = new Conexion();
	}

	function registrar(){

		$resultado = $this->conexion->openConexion()->query("INSERT INTO favoritos(agregado,marca,modelo,version,usuario_id,producto_id)VALUES('activo','$this->marca','$this->modelo','$this->version','$this->usuario_id',$this->producto_id);");	
		$this->conexion->closeConexion();

		return json_encode("Registro exitoso");
	}


	function eliminar(){
		
		$resultado = $this->conexion->openConexion()->query("DELETE FROM favoritos WHERE  usuario_id='$this->usuario_id' AND producto_id=$this->producto_id");		
		$this->conexion->closeConexion();

		return json_encode("Eliminacion exitosa");
	}



	function listar(){
		$fila2 = array();
		$total = array();

				

			    $resultado = $this->conexion->openConexion()->query(
				"SELECT p.id,p.titulo,p.descripcion,p.precio,p.unidades,p.estado,p.imagen,p.tipoproducto,f.marca,f.modelo,f.version
				 FROM producto p,favoritos f
				 WHERE f.producto_id=p.id AND f.usuario_id='$this->usuario_id'");
				
				 while($fila = $resultado->fetch_assoc()) {

				    $fila2['id']	       = $fila['id'];
				    $fila2['titulo']	   = $fila['titulo'];
				    $fila2['descripcion']  = $fila['descripcion'];
				    $fila2['precio']	   = $fila['precio'];
				    $fila2['unidades']	   = $fila['unidades'];
				    $fila2['estado']	   = $fila['estado'];
				    $fila2['imagen']	   = $fila['imagen'];
				    $fila2['tipoproducto'] = $fila['tipoproducto'];
				    $fila2['marca']	       = $fila['marca'];
				    $fila2['modelo']	   = $fila['modelo'];
				    $fila2['version']	   = $fila['version'];	    		    		   
				    $total[]               = $fila2;
				}

				$this->conexion->closeConexion();

				return  json_encode($total);		   
		}		
		
	

	

}

$marca       = $_POST['marca'];
$modelo      = $_POST['modelo'];
$version     = $_POST['version'];
$agregado    = $_POST['agregado'];
$usuario_id  = $_POST['usuario_id'];
$producto_id = $_POST['producto_id'];

if($_POST['marca'] ==null){$marca ="";}
if($_POST['modelo'] ==null){$modelo ="";}
if($_POST['version'] ==null){$version ="";}
if($_POST['agregado'] ==null){$agregado ="";}
if($_POST['usuario_id'] ==null){$usuario_id ="";}
if($_POST['producto_id'] ==null){$producto_id ="";}


if($marca=="" && $modelo==""&& $version==""&& $agregado=="" && $usuario_id!="" && $producto_id==""){

	$favoritos = new Favoritos("","","",$usuario_id,"");
	echo $favoritos->listar();

}else if($agregado!=""){

	$favoritos = new Favoritos($marca,$modelo,$version,$usuario_id,$producto_id);

	if($agregado =="activo"){
		echo $favoritos->registrar();
	}else{
		echo $favoritos->eliminar();
	}
}





?>