<?php

require('../../datos/conexion.php');

     class DUbicacion{

          function __construct(){
               
               $this->conexion = new Conexion();
          }
          
          function getRolD($usuario){
               $total =[];
               $filaRol =[];
               $resultado = $this->conexion->openConexion()->query("SELECT DISTINCT u.rol
                                                                    FROM usuario u
                                                                    WHERE u.userss='$usuario'");               
              
                while($fila = $resultado->fetch_assoc()) {
				    $filaRol['rol']	        = $fila['rol'];
				    $total[]               = $filaRol;
				 }
               
               return $total;               
          }

          function getUbicacionD($usuario){
               $total =[];
               $fila2 =[];               
               $resultado1 = $this->conexion->openConexion()->query("SELECT DISTINCT ue.idUbicacionE,ue.coordenadaX,ue.coordenadaY,u.rol
                        FROM usuario u,ubicacionestudio ue,estudiofotografico ef
                        WHERE u.userss='$usuario'
                        AND u.userss=ef.idUserss
                        AND ef.idEstudioF=ue.idEstudioF");               
              
                while($fila1 = $resultado1->fetch_assoc()) {
                    $fila2['idUbicacionE']  = $fila1['idUbicacionE'];
				    $fila2['latitud']	    = $fila1['coordenadaX'];
				    $fila2['longitud']	    = $fila1['coordenadaY'];
				    $fila2['rol']	        = $fila1['rol'];
				    $total[]               = $fila2;
				 }
               
               return $total;               
          }


          function setUbicacionD($latitud,$longitud,$usuario){
              
               
                $resultado1=$this->conexion->openConexion()->query("SELECT DISTINCT ef.idEstudioF
                        FROM usuario u,estudiofotografico ef
                        WHERE u.userss='$usuario'
                        AND u.userss=ef.idUserss");               
              
               $fila1 = $resultado1->fetch_array(MYSQLI_NUM);
               
              $query2 = $this->conexion->openConexion()->query("UPDATE ubicacionestudio SET coordenadaX=$latitud,coordenadaY=$longitud WHERE idEstudioF=$fila1[0]");               
              
               
               
               echo json_encode("Ubicacion actualizada exitosamente");
               
          }

          function __destruct(){
               $this->conexion->closeConexion();
          } 
     }        
?>