<?php
require('../../datos/GUbicacion/DUbicacion.php');

class NUbicacion{
	
	function __construct(){
		
		$this->dUbicacion  =  new DUbicacion();
	}
    
    function getRolN($usuario){

		return $this->dUbicacion->getRolD($usuario);
	}    
    
	function getUbicacionN($usuario){

		return $this->dUbicacion->getUbicacionD($usuario);
	}


	function setUbicacionN($latitud,$longitud,$usuario){

		return $this->dUbicacion->setUbicacionD($latitud,$longitud,$usuario);
	}

}


 	if( isset($_POST['latitud']) AND isset($_POST['longitud']) ){

          $latitud   =  $_POST['latitud'];
          $longitud  =  $_POST['longitud'];
          $usuario   =  $_POST['usuario'];

          $ubicacion = new NUbicacion();
          $ubicacion->setUbicacionN($latitud,$longitud,$usuario);
    }



?>