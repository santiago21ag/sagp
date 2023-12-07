<?php
session_start();
/*if(!isset($_SESSION['user'])){header('Location:../../index.php');}*/
require('../../datos/GDirectorio/DDirectorio.php');

	class NDirectorio{
          
          
        function __construct(){

            	$this->dDirectorio = new DDirectorio();
        }

        function setCrearDirectorio($usuario,$nombre_evento,$descrip_evento,$directorio){
            
          $this->dDirectorio->setCrearDirectorioD($usuario,$nombre_evento,$descrip_evento,$directorio);

        }
        

        function getListaDirectorios($usuario){
			
			return $this->dDirectorio->getListaDirectoriosD($usuario);
		}


		function getListaDirectoriosClie($usuario){
			return $this->dDirectorio->getListaDirectoriosClieD($usuario);
		}


		function setModificarDirectorio($n_usuario,$n_evento,$n_descripcion,$nuevo_nombre,$nueva_descripcion,$direccion){
		
			$this->dDirectorio->setModificarDirectorioD($n_usuario,$n_evento,$n_descripcion,$nuevo_nombre,$nueva_descripcion,$direccion);
		}

		function setModificarEstadoDir($n_carpeta, $n_descripcion,$n_estado ,$n_usuario, $direccion){
		
			$this->dDirectorio->setModificarEstadoDirD($n_carpeta, $n_descripcion,$n_estado ,$n_usuario, $direccion);
		}

		function setEliminarDirectorio($n_usuario,$n_carpeta,$n_descripcion,$direccion){
		
			$this->dDirectorio->setEliminarDirectorioD($n_usuario,$n_carpeta,$n_descripcion,$direccion);
		}


        function __destruct(){}
    }


    	

    if(isset($_POST['crear'])){

          $nombre_evento =  $_POST['nombre'];
          $descrip_evento =  $_POST['descripcion'];
          $directorio      =  '../../Directorios/';
          $usuario         =  $_SESSION['user'];

          $crear = new NDirectorio();
          $crear->setCrearDirectorio($usuario,$nombre_evento,$descrip_evento,$directorio);
    }



	if (isset($_POST['nueva_descripcion']) || isset($_POST['nuevo_nombre'])){
	    $n_usuario=$_POST['n_usuario'];
		$n_carpeta=$_POST['n_carpeta'];
		$n_descripcion=$_POST['n_descripcion'];
		$nuevo_nombre=$_POST['nuevo_nombre'];
		$nueva_descripcion=$_POST['nueva_descripcion'];
		$direccion="../../Directorios/";


		if($nuevo_nombre!="" || $nueva_descripcion!=""){
				$modificar = new NDirectorio();
				$modificar->setModificarDirectorio($n_usuario,$n_carpeta,$n_descripcion,$nuevo_nombre,$nueva_descripcion,$direccion);
		}else{
		    echo "No ha ingresado ningun dato";
		}
	}


	if (isset($_POST['n_estado'])){

		$n_carpeta     = $_POST['n_carpeta'];
		$n_descripcion = $_POST['n_descripcion'];
		$n_estado      = $_POST['n_estado'];
		$n_usuario     = $_POST['n_usuario'];
		$direccion     = "Directorios/";   


		$modificar = new NDirectorio();
		$modificar->setModificarEstadoDir($n_carpeta, $n_descripcion,$n_estado ,$n_usuario, $direccion);
	}	


	if (isset($_POST['true'])){

		$n_usuario     = $_POST['n_usuario'];
		$n_carpeta     = $_POST['n_carpeta'];
		$n_descripcion = $_POST['n_descripcion'];
		$direccion     = "../../Directorios/";

		$eliminar = new NDirectorio();
		$eliminar->setEliminarDirectorio($n_usuario,$n_carpeta,$n_descripcion,$direccion);
	}


?>