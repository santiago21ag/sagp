<?php

include('conexion.php');

class Formulario {
		
	private $conexion;
	private $dbConnection;
	public function __construct(){			
				
		$this->dbConnection = new DBConnection();
        $this->conexion = $this->dbConnection->getConnection();
	}

	function add($nombre,$edad,$salario){

		$nombre = $this->conexion->real_escape_string($nombre);
        $edad = $this->conexion->real_escape_string($edad);
        $salario = $this->conexion->real_escape_string($salario);

        $sql = "INSERT INTO empleado (nombre, edad, salario) VALUES ('$nombre', '$edad', '$salario')";

		if ($this->conexion->query($sql) === TRUE) {
			$this->dbConnection->closeConnection();           
			$respuesta = array('status' => 'exitoso', 'mensaje' => 'La solicitud fue exitosa');
			echo json_encode($respuesta);
        } else {
			$this->dbConnection->closeConnection();
			$respuesta = array('status' => 'error', 'mensaje' => 'Error al decodificar los datos JSON');
			echo json_encode($respuesta);
        }
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data);
    
    if ($data !== null) {
        
        $nombre = $data->nombre;
        $edad = $data->edad;
        $salario = $data->salario;
		$instancia  = new Formulario();
		$instancia->add($nombre,$edad,$salario);

	}else{
		$respuesta = array('status' => 'error', 'mensaje' => 'Error al decodificar los datos JSON -');
		echo json_encode($respuesta);
	}
}else{
	$respuesta = array('status' => 'error', 'mensaje' => 'Error al decodificar los datos JSON ´');
	echo json_encode($respuesta);
}

/*

$nombre  = $_POST['nombre'];
$edad    = $_POST['edad'];
$salario = $_POST['salario'];

if($_POST['nombre'] == null){$nombre ="";}
if($_POST['edad'] == null){$edad ="";}
if($_POST['salario'] == null){$salario ="";}
//echo $nombre." ".$edad." ".$salario;
if($nombre!=""  && $edad !="" && $salario !="" ){	
	
}*/

?>