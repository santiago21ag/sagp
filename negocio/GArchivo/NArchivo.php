<?php 
session_start();
/*if(!isset($_SESSION['user'])){header('Location:../../index.php');}
$n_carpeta=$_SESSION['n_carpeta'];*/

require('../../datos/GArchivo/DArchivo.php');

	
	class NArchivo{

		function __construct(){

			$this->dArchivo = new DArchivo();
		}

		function setSubirArchivo($usuario,$n_carpeta,$n_archivo,$descrip_archivo,$tipo_archivo,$imagen_archivo,$dir_total,$tamanho,$directorio,$fichero,$precio){
      
      		$this->dArchivo->setSubirArchivoD($usuario,$n_carpeta,$n_archivo,$descrip_archivo,$tipo_archivo,$imagen_archivo,$dir_total,$tamanho,$directorio,$fichero,$precio);
  		}

  		function getListaArchivos($usuario,$v_carpeta){
			
			return $this->dArchivo->getListaArchivosD($usuario,$v_carpeta);
		}


		function getListaArchivosClie($usuario,$v_carpeta){
			
			return $this->dArchivo->getListaArchivosClieD($usuario,$v_carpeta);
		}

		function setModificarArchivo($n_usuario,$n_carpeta,$n_archivo,$n_extension,$nuevo_nombre,$nueva_descripcion,$precio){
		
			$this->dArchivo->setModificarArchivoD($n_usuario,$n_carpeta,$n_archivo,$n_extension,$nuevo_nombre,$nueva_descripcion,$precio);
		}

		function setEliminarArchivo($n_usuario,$n_archivo,$n_carpeta,$n_extension){
		
			$this->dArchivo->setEliminarArchivoD($n_usuario,$n_archivo,$n_carpeta,$n_extension);
		}

		function getDescargarArchivo($n_usuario,$n_archivo,$n_carpeta){
		
			$this->dArchivo->getDescargarArchivoD($n_usuario,$n_archivo,$n_carpeta);
		}



	}






if(isset($_POST['subir'])){

	$usuario=$_SESSION['user'];
	$n_carpeta=$_SESSION['n_carpeta'];
	//$n_archivo=$_POST['n_archivo'];
	$descrip_archivo=$_POST['descripcion'];
	$directorio = '../../Directorios/';
	$imagen_archivo="";
	$tipo_archivo="";
	$precio=$_POST['precio'];

	$n_archivo=$_FILES['fichero']['name'];
	$dir_total = $directorio.$n_carpeta."/".basename($_FILES['fichero']['name']);
	$tamanho=$_FILES['fichero']['size'];
	$tamanho=round($tamanho/1024);
	$tamanho=$tamanho." Kb";
	$tipo=$_FILES['fichero']['type'];
	$fichero=$_FILES['fichero']['tmp_name'];

	//echo $dir_total."       ".$tamanho." ".$tipo;

	if($tipo=="image/png"){
	  $tipo_archivo="png";
	  $imagen_archivo="../../estilo/iconos/imagenicono.png";
	}else if($tipo=="image/jpeg"){
	  $tipo_archivo="jpeg";
	  $imagen_archivo="../../estilo/iconos/imagenicono.png";
	}else if($tipo=="image/gif"){
	  $tipo_archivo="gif";
	  $imagen_archivo="../../estilo/iconos/imagenicono.png";
	}else if($tipo=="application/pdf"){
	  $tipo_archivo="pdf";
	  $imagen_archivo="../../estilo/iconos/iconopdf.png";
	}else if($tipo=="application/x-msdownload"){
	  $tipo_archivo="exe";
	  $imagen_archivo="../../estilo/iconos/iconoexe.png";
	}else if($tipo=="application/x-zip-compressed"){
	  $tipo_archivo="zip";
	  $imagen_archivo="../../estilo/iconos/fileicono.png";
	}else if($tipo=="application/octet-stream"){
	  $tipo_archivo="rar";
	  $imagen_archivo="../../estilo/iconos/fileicono.png";
	}else if($tipo=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
	  $tipo_archivo="xlsx";
	  $imagen_archivo="../../estilo/iconos/excelicono.jpg";
	}else if($tipo=="application/vnd.ms-excel"){
	  $tipo_archivo="xls";
	  $imagen_archivo="../../estilo/iconos/excelicono.jpg";
	}else if($tipo=="application/vnd.openxmlformats-officedocument.wordprocessingml.document"){
	  $tipo_archivo="docx";
	  $imagen_archivo="../../estilo/iconos/wordicono.png";
	}else if($tipo=="application/msword"){
	  $tipo_archivo="doc";
	  $imagen_archivo="../../estilo/iconos/wordicono.png";
	}else if($tipo=="text/plain"){
	  $tipo_archivo="txt";
	  $imagen_archivo="../../estilo/iconos/txticono.png";
	}else{
	  $tipo_archivo="no_especifico";
	  $imagen_archivo="../../estilo/iconos/fileicono.png";
	}



	$subir=new NArchivo();
	$subir->setSubirArchivo($usuario,$n_carpeta,$n_archivo,$descrip_archivo,$tipo_archivo,$imagen_archivo,$dir_total,$tamanho,$directorio,$fichero,$precio);

}


else if(isset($_POST['nuevo_nombre']) || isset($_POST['nueva_descripcion']) || isset($_POST['nuevo_precio'])){

	$n_usuario         =$_POST['n_usuario'];
	$n_carpeta         =$_POST['n_carpeta'];
	$n_archivo         =$_POST['n_archivo'];
	$n_extension       =$_POST['n_extension'];
	$nuevo_nombre      =$_POST['nuevo_nombre'];
	$nueva_descripcion =$_POST['nueva_descripcion'];
	$nuevo_precio      =$_POST['nuevo_precio'];


	if($nuevo_nombre!="" || $nueva_descripcion!="" || $nuevo_precio!=""){

			if($n_extension == "jpeg"){$n_extension="jpg";}

			$modificar = new NArchivo();
			$modificar->setModificarArchivo($n_usuario,$n_carpeta,$n_archivo,$n_extension,$nuevo_nombre,$nueva_descripcion,$nuevo_precio);
	}else{
	    echo "No ha ingresado ningun dato";
	}
}

else if(isset($_POST['n_archivo']) && isset($_POST['n_carpeta'])  && (!isset($_POST['nuevo_nombre']))   ){

	$n_archivo   = $_POST['n_archivo'];
	$n_carpeta   = $_POST['n_carpeta'];
	$n_usuario   = $_POST['n_usuario'];
	$n_extension = $_POST['n_extension'];

	$eliminar = new NArchivo();
	$eliminar->setEliminarArchivo($n_usuario,$n_archivo,$n_carpeta,$n_extension);
}


if(isset($_GET['descargar'])){
	if($_GET['descargar']!=null){

		$n_archivo =$_GET['n_archivo'];
		$n_carpeta =$_GET['n_carpeta'];
		$n_usuario =$_GET['n_usuario'];

		$descargar = new NArchivo();
		$descargar->getDescargarArchivo($n_usuario,$n_archivo,$n_carpeta);
	}
}		

?>