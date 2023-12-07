<?php

require('../../datos/conexion.php');

	class DDirectorio{
          
          
        function __construct(){

            	$this->conexion1 = new Conexion();
        }

        function setCrearDirectorioD($usuario,$nombre_evento,$descrip_evento,$directorio){

           if (!is_dir($nombre_evento)) { 
                
                mkdir($directorio.$nombre_evento, 0777);                
                               

                $query_fecha="SELECT DATE_ADD(NOW(), INTERVAL -0 hour)";
                $result_fecha=mysqli_query($this->conexion1->openConexion(),$query_fecha);
                $fila_fecha = mysqli_fetch_row($result_fecha);

                $query2="INSERT INTO evento(nombre,descripcion,fecha,idUserss) VALUES('$nombre_evento','$descrip_evento','$fila_fecha[0]','$usuario');";
                $result2=mysqli_query($this->conexion1->openConexion(),$query2);         

                

                header('Location:../../presentacion/GDirectorio/p_listar_directorio_a.php');
               
            }else{
                header('Location:../../presentacion/GDirectorio/p_listar_directorio_a.php');
            }  
            

        }


        function getListaDirectoriosD($usuario){       
            $fila1     =[];
            $totalFila =[];
           

            $query="SELECT e.idEvento,e.nombre,e.descripcion,e.fecha 
            FROM  evento e 
            WHERE  e.idUserss='$usuario'";
             
            $resultado =  mysqli_query($this->conexion1->openConexion(),$query);
            if(mysqli_num_rows($resultado) > 0){
                while($fila = mysqli_fetch_row($resultado)){
                    $fila1[0]    = $fila[0];
                    $fila1[1]    = $fila[1];
                    $fila1[2]    = $fila[2];
                    $fila1[3]    = $fila[3];                   
                    $totalFila[] = $fila1;
                }
            }
            return $totalFila;
        }


        function getListaDirectoriosClieD($usuario){       
            $fila1     =[];
            $totalFila =[];
            

            $query="SELECT c.id  FROM userss u, persona p,cliente c WHERE c.persona_id=p.id AND p.id=u.persona_id AND u.usuario='$usuario'";
            $result=mysqli_query($this->conexion1->openConexion(),$query);
            $cliente_id = mysqli_fetch_row($result);


            $query2="SELECT d.carpeta,d.descripcion,d.estado,d.fecha 
            FROM  directorio AS d ,privilegio p 
            WHERE  d.id=p.directorio_id AND p.cliente_id=$cliente_id[0] 
            ORDER BY d.fecha";
         
            $resultado =  mysqli_query($this->conexion1->openConexion(),$query2);
            if(mysqli_num_rows($resultado) > 0){
                while($fila = mysqli_fetch_row($resultado)){
                    $fila1[0]    = $fila[0];
                    $fila1[1]    = $fila[1];
                    $fila1[2]    = $fila[2];
                    $fila1[3]    = $fila[3];
                    $totalFila[] = $fila1;
                }
            }
            

            return $totalFila;
        

        }


        function setModificarDirectorioD($n_usuario,$n_evento,$n_descripcion,$nuevo_nombre,$nueva_descripcion,$direccion){
                       

            if($nuevo_nombre!="" && $nueva_descripcion!=""){

                if(rename($direccion.$n_evento,$direccion.$nuevo_nombre)){

                    $query3="UPDATE evento SET nombre='$nuevo_nombre',descripcion='$nueva_descripcion' WHERE nombre='$n_evento' AND idUserss='$n_usuario'";
                    $result3=mysqli_query($this->conexion1->openConexion(),$query3);
                   

                    echo "Cambios Realizados";

                }else{
                    echo "Error al renombrar";
                }


            }else if($nuevo_nombre!=""){

                if(rename($direccion.$n_evento,$direccion.$nuevo_nombre)){

                    $query3="UPDATE evento SET nombre='$nuevo_nombre' WHERE nombre='$n_evento' AND idUserss='$n_usuario'";
                    mysqli_query($this->conexion1->openConexion(),$query3);
                    

                    echo "Cambios Realizados en el nombre";

                }else{
                    echo "Error al renombrar";
                }
            }else{

                    $query3="UPDATE evento SET descripcion='$nueva_descripcion' WHERE nombre='$n_evento' AND idUserss='$n_usuario'";
                    $result3=mysqli_query($this->conexion1->openConexion(),$query3);
                    
                        echo "Cambios Realizados en la descripcion";
            }

        }

        function setModificarEstadoDirD($n_carpeta, $n_descripcion,$n_estado ,$n_usuario, $direccion){

            $query="SELECT a.id  FROM userss u, persona p,abogado a WHERE a.persona_id=p.id AND p.id=u.persona_id AND u.usuario='$n_usuario'";
            $result=mysqli_query($this->conexion1->openConexion(),$query);
            $abogado_id = mysqli_fetch_row($result);      

            $query3="UPDATE directorio SET estado='$n_estado' WHERE carpeta='$n_carpeta' AND descripcion='$n_descripcion' AND abogado_id=$abogado_id[0]";
            $result3=mysqli_query($this->conexion1->openConexion(),$query3);            

        }


        function setEliminarDirectorioD($n_usuario,$n_evento,$n_descripcion,$direccion){
            

           if(is_dir($direccion.$n_evento)){

                $this->rmDir_rf($direccion.$n_evento);                

              
                $query2="SELECT e.idEvento FROM  evento AS e  WHERE e.idUserss='$n_usuario' AND e.nombre='$n_evento' AND e.descripcion='$n_descripcion'";
                $result2=mysqli_query($this->conexion1->openConexion(),$query2);
                

                
                if(!empty($result2) && mysqli_num_rows($result2)>0){
                    $fila2=mysqli_fetch_row($result2);
                    $query5="DELETE FROM evento WHERE  idEvento=$fila2[0]";
                    mysqli_query($this->conexion1->openConexion(),$query5);
                    
                }
                
                echo "Carpeta eliminada Exitosamente";                   

            }else{

                echo "No Existe la ruta del archivo: ".$this->direccion.$this->n_evento;
            }


        }

        function rmDir_rf($carpeta) {

            foreach(glob($carpeta . "/*") as $archivos_carpeta){
                if (is_dir($archivos_carpeta)){
                      rmDir_rf($archivos_carpeta);
                } else {
                    unlink($archivos_carpeta);
                }
            }
            rmdir($carpeta);
        }

        function __destruct(){

            $this->conexion1->closeConexion();
        }
    }

?>