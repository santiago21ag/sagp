<?php
require 'conexion.php';

	if (isset($_POST['entrar'])){
		$usuarioV = $_POST['email'];
		$codigoV = $_POST['password'];
		
		if(!empty($usuarioV) && !empty($codigoV) ){
			$dbConnection = new DBConnection();
    		$conn = $dbConnection->getConnection();
			
			$sql = "SELECT * FROM users WHERE email='$usuarioV' AND password='$codigoV'";
			$result = $conn->query($sql);
			/*
			$sql = "SELECT password FROM usuarios WHERE email='$email'";
			$result = $conn->query($sql);
			*/
			if ($result->num_rows > 0) {
				$response = array("success" => true, "message" => "Inicio de sesión exitoso");
				/*
				$row = $result->fetch_assoc();
				$storedHash = $row['password'];
				if (password_verify($password, $storedHash)) {
					$response = array("success" => true, "message" => "Inicio de sesión exitoso");
				} else {
					$response = array("success" => false, "message" => "Credenciales incorrectas");
				}*/
			} else {
				$response = array("success" => false, "message" => "Usuario no encontrado");
			}		
			//header('Content-Type: application/json');
			//echo json_encode($response);
			echo $response['success'];
			if($response['success']){
				session_start();
				$_SESSION['user']=$usuarioV;
				header('Location:presentacion/inicio_a.php');
			}else{
				header('Location:index.php');
			}
			$conn->close();
		}
			
	}else{
		echo "sassa";
	}
	
?>
