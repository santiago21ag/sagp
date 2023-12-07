<?php
require('../../datos/conexion.php');
	class DPerfil{

		function __construct(){
			
			$this->conexion   = new Conexion();
		}

		function getPerfilItemD($usuario){

			
			$totalFila =[];
			$fila1     =[];

			$query1="SELECT u.rol FROM usuario AS u WHERE  u.userss='$usuario'";
            $resultado1 = mysqli_query($this->conexion->openConexion(),$query1);
            $filaresult		= mysqli_fetch_row($resultado1);


           if($filaresult[0]=="Estudio"){

            $query="SELECT DISTINCT ef.idEstudioF,u.userss,ef.nit,ef.nombre,ef.direccion,u.correo,ef.telefono,u.passwords
		            	FROM estudiofotografico AS ef, usuario AS u 
		            	WHERE  ef.idUserss=u.userss AND u.userss='$usuario'";
            $resultado = mysqli_query($this->conexion->openConexion(),$query);
            
            if(mysqli_num_rows($resultado) > 0){

            	while($fila = mysqli_fetch_row($resultado)){
						$fila1[0]    = $fila[0];
						$fila1[1]    = $fila[1];
						$fila1[2]    = $fila[2];
						$fila1[3]    = $fila[3];
						$fila1[4]    = $fila[4];
						$fila1[5]    = $fila[5];
						$fila1[6]    = $fila[6];
						$fila1[7]    = $fila[7];
						$totalFila[] = $fila1;
            	}
            }	
            
            		
			


            }else if($filaresult[0]=="Fotografo"){

            	$query="SELECT p.idPersona,u.userss,p.nit,p.nombre,p.ap_paterno,p.ap_materno,u.correo,p.telefono,u.passwords
		            FROM persona AS p,usuario AS u 
		            WHERE  p.idUserss=u.userss AND u.userss='$usuario'";
            $resultado = mysqli_query($this->conexion->openConexion(),$query);
            
            if(mysqli_num_rows($resultado) > 0){
            	while($fila = mysqli_fetch_row($resultado)){
						$fila1[0]    = $fila[0];
						$fila1[1]    = $fila[1];
						$fila1[2]    = $fila[2];
						$fila1[3]    = $fila[3];
						$fila1[4]    = $fila[4];
						$fila1[5]    = $fila[5];
						$fila1[6]    = $fila[6];
						$fila1[7]    = $fila[7];
						$fila1[8]    = $fila[8];
						$totalFila[] = $fila1;
            	}
            }	
            
            		
			

            }

            return $totalFila;

		}



		function setPerfilRegistrarEstudioD($idEstudioF,$nit,$nombre,$direccion,$correo,$telefono,$passwords,$userss){
			
			$query1="UPDATE estudiofotografico SET nit=$nit,nombre='$nombre',direccion='$direccion',telefono=$telefono  WHERE  idEstudioF=$idEstudioF";
            mysqli_query($this->conexion->openConexion(),$query1);

            $query2="UPDATE usuario SET passwords='$passwords',correo='$correo' WHERE userss='$userss' AND rol='Estudio'";
            mysqli_query($this->conexion->openConexion(),$query2);
           	
           	header('Location:../../presentacion/GPerfil/paso_m_perfil.php');

		}

		function setPerfilRegistrarFotografoD($idPersona,$nit,$nombre,$ap_paterno,$ap_materno,$correo,$telefono,$passwords,$userss){
			
			$query1="UPDATE persona SET nit=$nit,nombre='$nombre',ap_paterno='$ap_paterno',ap_materno='$ap_materno',telefono=$telefono  WHERE  idPersona=$idPersona";
            mysqli_query($this->conexion->openConexion(),$query1);

            $query2="UPDATE usuario SET passwords='$passwords',correo='$correo' WHERE userss='$userss' AND rol='Fotografo'";
            mysqli_query($this->conexion->openConexion(),$query2);

            header('Location:../../presentacion/GPerfil/paso_m_perfil.php');

		}




		function __destruct(){
			$this->conexion->closeConexion(); 
		}


	}

?>