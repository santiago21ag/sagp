<?php 
require('../../datos/conexion.php');

	class DArchivo{

		function __construct(){
			$this->conexion = new Conexion();
		}


		function setSubirArchivoD($usuario,$n_carpeta,$n_archivo,$descrip_archivo,$tipo_archivo,$imagen_archivo,$dir_total,$tamanho,$directorio,$fichero,$precio){

            if (is_dir($directorio.$n_carpeta)) {

              //if (move_uploaded_file($_FILES['fichero']['tmp_name'], $dir_total)) {
                if (move_uploaded_file($fichero, $dir_total)) {
                    
                                    
                    $query2="SELECT e.idEvento 
                             FROM  evento AS e 
                             WHERE e.idUserss='$usuario' AND e.nombre='$n_carpeta'";
                    $result2=mysqli_query($this->conexion->openConexion(),$query2);
                    $fila2=mysqli_fetch_row($result2);


                    $query_fecha="SELECT DATE_ADD(NOW(), INTERVAL -0 hour)";
                    $result_fecha=mysqli_query($this->conexion->openConexion(),$query_fecha);
                    $fila_fecha = mysqli_fetch_row($result_fecha);


                    $query3="INSERT INTO producto(nombre,descripcion,extension,tamanho,imagen,fecha,precio,idEvento)VALUES('$n_archivo','$descrip_archivo','$tipo_archivo','$tamanho','$imagen_archivo','$fila_fecha[0]',$precio,$fila2[0]);";
                    $result3=mysqli_query($this->conexion->openConexion(),$query3);              
                  

                    
                    //echo "ARCHIVO GUARDADO";
                    header("Location:../../presentacion/GArchivo/listar_archivo.php?v_carpeta=$n_carpeta");

                }else{

                    echo "NO SE PUDO GUARDAR EL ARCHIVO";
                }


            }else{
                echo "no existe el directorio";
            }
        }



        function getListaArchivosD($usuario,$v_carpeta){
			
			$fila1     =[];
            $totalFila =[];
            

            $query1="SELECT p.idProducto,p.nombre,p.descripcion,p.tamanho,p.imagen,p.extension,p.fecha,p.precio
                     FROM producto AS p ,evento AS e
                     WHERE p.idEvento=e.idEvento AND e.nombre='$v_carpeta' AND e.idUserss='$usuario'";

            $resultado = mysqli_query($this->conexion->openConexion(),$query1);
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
            

            return $totalFila;
		}


		function getListaArchivosClieD($usuario,$v_carpeta){
			
            $fila1     =[];
            $totalFila =[];
            $query="SELECT u.persona_id  FROM userss u WHERE  u.usuario='$usuario'";
            $result=mysqli_query($this->conexion->openConexion(),$query);
            $persona_id = mysqli_fetch_row($result);

            $query1="SELECT c.id  FROM cliente c WHERE  c.persona_id=$persona_id[0]";
            $result=mysqli_query($this->conexion->openConexion(),$query1);
            $cliente_id = mysqli_fetch_row($result);


            $query2="SELECT c.abogado_id  FROM cliente c WHERE c.persona_id=$persona_id[0]";
            $result1=mysqli_query($this->conexion->openConexion(),$query2);
            $abogado_id = mysqli_fetch_row($result1);


            $query3="SELECT DISTINCT a.id,a.nombre,a.descripcion,a.tamanho,a.imagen,a.extension,a.fecha
                 FROM archivo AS a ,directorio AS d,privilegio p
                 WHERE a.directorio_id=d.id AND d.carpeta='$v_carpeta' AND p.cliente_id=$cliente_id[0] AND d.abogado_id=$abogado_id[0]";

            $resultado = mysqli_query($this->conexion->openConexion(),$query3);
	        if(mysqli_num_rows($resultado) > 0){
                while($fila = mysqli_fetch_row($resultado)){
                    $fila1[0]    = $fila[0];
                    $fila1[1]    = $fila[1];
                    $fila1[2]    = $fila[2];
                    $fila1[3]    = $fila[3];
                    $fila1[4]    = $fila[4];
                    $fila1[5]    = $fila[5];
                    $fila1[6]    = $fila[6];
                    $totalFila[] = $fila1;
                }
            }
            

            return $totalFila;
        }


		function setModificarArchivoD($n_usuario,$n_carpeta,$n_archivo,$n_extension,$nuevo_nombre,$nueva_descripcion,$precio){
		
			$direccion="../../Directorios/".$n_carpeta."/";

          	if($nuevo_nombre!="" || $nueva_descripcion!="" || $precio!="" ){

        	  
	           
	        	
	            $query2="SELECT e.idEvento FROM  evento AS e WHERE  e.idUserss='$n_usuario' AND e.nombre='$n_carpeta'";
	            $result2=mysqli_query($this->conexion->openConexion(),$query2);
	            $fila2=mysqli_fetch_row($result2);

	            if($nuevo_nombre!="" && $nueva_descripcion!="" ){

	                if(rename($direccion.$n_archivo,$direccion.$nuevo_nombre.".".$n_extension)){

		                  $nuevo_archivo=$nuevo_nombre.".".$n_extension;
		                  $query3="UPDATE producto SET nombre='$nuevo_archivo',descripcion='$nueva_descripcion'  WHERE nombre='$n_archivo' AND idEvento=$fila2[0]";
		                  $result3=mysqli_query($this->conexion->openConexion(),$query3);
		                  
		                  if($precio!=""){
                            $query4="UPDATE producto SET precio=$precio WHERE nombre='$n_archivo' AND idEvento=$fila2[0]";
                            $result4=mysqli_query($this->conexion->openConexion(),$query4);
                         }
		                  
		                  echo "Cambios Realizados";

	                  }else{
	                    	echo "No se a podido cambiar el nombre";
	                  }

	                }else if($nuevo_nombre!="" && $nueva_descripcion=="" ){

	                  if(rename($direccion.$n_archivo,$direccion.$nuevo_nombre.".".$n_extension)){

		                    $nuevo_archivo=$nuevo_nombre.".".$n_extension;
		                    $query3="UPDATE producto SET nombre='$nuevo_archivo' WHERE nombre='$n_archivo' AND idEvento=$fila2[0]";
		                    $result3=mysqli_query($this->conexion->openConexion(),$query3);
		                    
		                    if($precio!=""){
                            $query4="UPDATE producto SET precio=$precio WHERE nombre='$n_archivo' AND idEvento=$fila2[0]";
                            $result4=mysqli_query($this->conexion->openConexion(),$query4);
                         }
		                   
		                    echo "Cambios Realizados";

	                    }else{
	                      	echo "No se a podido cambiar el nombre";
	                    }
	                }else if($nuevo_nombre=="" && $nueva_descripcion!="" ){

	                    $query3="UPDATE producto SET descripcion='$nueva_descripcion' WHERE nombre='$n_archivo' AND idEvento=$fila2[0]";
	                    $result3=mysqli_query($this->conexion->openConexion(),$query3);
	                    
	                    if($precio!=""){
                            $query4="UPDATE producto SET precio=$precio WHERE nombre='$n_archivo' AND idEvento=$fila2[0]";
                            $result4=mysqli_query($this->conexion->openConexion(),$query4);
                         }
	                    
	                    echo "Cambios Realizados";
	                }else if($precio!="" && $nuevo_nombre=="" && $nueva_descripcion==""){
	                     $query4="UPDATE producto SET precio=$precio WHERE nombre='$n_archivo' AND idEvento=$fila2[0]";
                            $result4=mysqli_query($this->conexion->openConexion(),$query4);
                            
                             echo "Cambios Realizados";
	                }else{
	                     echo "Cambios No Realizados";
	                }


                    

        	}else{
          			echo "No ha ingresado ningun dato :(";
        	}
		}


		function setEliminarArchivoD($n_usuario,$n_archivo,$n_carpeta,$n_extension){

	        $direccion="../../Directorios/".$n_carpeta."/";
	        if(is_file($direccion.$n_archivo)){

	          if(unlink($direccion.$n_archivo)){	      	      
	            

	           $query2="SELECT e.idEvento FROM  evento AS e WHERE e.nombre='$n_carpeta' AND e.idUserss='$n_usuario'";
	              $result2 = mysqli_query($this->conexion->openConexion(),$query2);
	              $fila2   = mysqli_fetch_row($result2);

	              $query3  = "DELETE FROM producto WHERE nombre='$n_archivo' AND idEvento=$fila2[0]";
	              $result3 = mysqli_query($this->conexion->openConexion(),$query3);              
	              

	              echo "Archivo: $n_archivo eliminado Exitosamente";
	              
	          	}else{
	          	  echo "No se ha podido eliminar el archivo";
	          	}

	        }else{
	          echo "No Existe la ruta del archivo";
	        }
     	}

     	function getDescargarArchivoD($n_usuario,$n_archivo,$n_carpeta){
		
			$direccion="../../Directorios/".$n_carpeta."/";
			$dir_total=$direccion.$n_archivo;
			$tipo = mime_content_type($dir_total);

			if(is_file($direccion.$n_archivo)){
				  header("Content-disposition: attachment; filename=$n_archivo");
				  header("Content-type: $tipo");
				  readfile($dir_total);

				  echo "descarga ejecutandose";
			}else{
			    echo "No Existe la ruta del archivo";
			}
		}



        function __destruct(){

        	$this->conexion->closeConexion();
        }
		
	}

?>