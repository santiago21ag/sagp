<?php
    require('datos/conexion.php');
    $conexion    = new Conexion();
    
	if (isset($_POST['registrar']) ){

		$usuario = $_POST['usuario'];
		$nombre = $_POST['nombre'];
		$ap_paterno = $_POST['ap_paterno'];
		$ap_materno = $_POST['ap_materno'];
		$email = $_POST['email'];	
		$telefono=$_POST['telefono'];
		$nit=$_POST['nit'];
		$rol = "Fotografo"; 
		$codigo = $_POST['codigo'];

		

		if((!empty($usuario))&& (!empty($nombre)) && (!empty($ap_paterno)) && (!empty($ap_materno)) && (!empty($email)) && (!empty($codigo))){

			

			//$cifrado=password_hash($pass,PASSWORD_DEFAULT);
			//$cifrado=md5($pass);
			//echo $cifrado;

			$query=$conexion->openConexion()->query("INSERT INTO usuario(userss,passwords,correo,rol)VALUES('$usuario','$codigo','$email','$rol');");
		


			$query1=$conexion->openConexion()->query("INSERT INTO persona(nit,nombre,ap_paterno,ap_materno,telefono,tipo,idUserss)VALUES($nit,'$nombre','$ap_paterno','$ap_materno',$telefono,'Fotografo','$usuario');");
			


			$query2=$conexion->openConexion()->query("SELECT idPersona FROM persona WHERE nit=$nit AND nombre='$nombre' AND ap_paterno='$ap_paterno' AND ap_materno='$ap_materno' AND telefono=$telefono  AND tipo='Fotografo'");
		    $filaIdEstudioF = $query2->fetch_array(MYSQLI_NUM); 
			


			$query3=$conexion->openConexion()->query("INSERT INTO fotografo(idPersona)VALUES($filaIdEstudioF[0]);");
		

			$conexion->closeConexion();
				session_start();
				$_SESSION['user']=$usuario;
				header('Location:presentacion/inicio_a.php');
			//echo"<br><br><h2>Registro exitoso  <a href='index.php'>Ir al inicio</a></h2>";


		}else{
			
			header('Location:registrarseFotografo.php');
		}
	}

?>
