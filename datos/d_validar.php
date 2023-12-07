<?php
require('../datos/conexion.php');
	class Validacion{

		function __construct($usuario,$codigo){
			$this->usuario=$usuario;
			$this->codigo=$codigo;
			$this->datos = new Conexion();
		}

		function d_validar(){
				
			$query="SELECT EXISTS (SELECT codigo FROM userss  WHERE  usuario='$this->usuario' AND codigo='$this->codigo');";
			$resultado = mysqli_query($this->datos->openConexion(),$query);
			$result=mysqli_fetch_row($resultado);
			
			if ($result[0] == "1") {
				
				$query_rol="SELECT u.rol FROM userss u WHERE  u.usuario='$this->usuario' AND u.codigo='$this->codigo'";
				$resultado_rol = mysqli_query($this->datos->openConexion(),$query_rol);
				$fila_rol = mysqli_fetch_row($resultado_rol);

				
						
						if($fila_rol[0]=="Administrador"){
							mysqli_query($this->datos->openConexion(),"UPDATE prueba SET bandera='t'");
							
							session_start();
							$_SESSION['adm']=$this->usuario;
							header('Location:../presentacion/inicio_adm.php');

						}else if($fila_rol[0]=="Abogado"){
							mysqli_query($this->datos->openConexion(),"UPDATE prueba SET bandera='f'");
							
							session_start();
							$_SESSION['user']=$this->usuario;
							header('Location:../presentacion/inicio_a.php');

						}else if($fila_rol[0]=="Cliente"){
							mysqli_query($this->datos->openConexion(),"UPDATE prueba SET bandera='f'");
							
							session_start();
							$_SESSION['user']=$this->usuario;
							header('Location:../presentacion/inicio_c.php');
						}else{
							header('Location:../index.php');
						}	
				
			}else{
				
				header('Location:../index.php');
			}
		}

		function getVerificarD(){

			$query= mysqli_query($this->datos->openConexion(),"SELECT bandera FROM prueba");
			
            return mysqli_fetch_row($query);
		}


		function __destruct(){
			$this->datos->closeConexion();
		}

	}
?>
