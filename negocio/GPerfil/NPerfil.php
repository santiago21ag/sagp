<?php  /*
session_start();
if(!isset($_SESSION['adm'])){header('Location:../../index.php');}$admin=$_SESSION['adm'];*/

require('../../datos/GPerfil/DPerfil.php');

	class NPerfil{		

		function __construct(){				
			$this->dPerfil   = new DPerfil();

		}

		function getPerfilItemN($usuario){			
			return $this->dPerfil->getPerfilItemD($usuario);
		}

		function setPerfilRegistrarEstudioN($idEstudioF,$nit,$nombre,$direccion,$correo,$telefono,$passwords,$userss){
			$this->dPerfil->setPerfilRegistrarEstudioD($idEstudioF,$nit,$nombre,$direccion,$correo,$telefono,$passwords,$userss);
		}

		function setPerfilRegistrarFotografoN($idPersona,$nit,$nombre,$ap_paterno,$ap_materno,$correo,$telefono,$passwords,$userss){
			$this->dPerfil->setPerfilRegistrarFotografoD($idPersona,$nit,$nombre,$ap_paterno,$ap_materno,$correo,$telefono,$passwords,$userss);
		}
		
			
	}

	if (isset($_POST['ap_paterno'])){
		if($_POST['ap_paterno'] !=""){
			$idPersona  = $_POST['idPersona'];
			$nit        = $_POST['nit'];
			$nombre     = $_POST['nombre'];
			$ap_paterno = $_POST['ap_paterno'];
			$ap_materno = $_POST['ap_materno'];
			$correo     = $_POST['email'];
			$telefono   = $_POST['telefono'];
			$passwords  = $_POST['codigo'];
			$userss     = $_POST['usuario'];

			$registrar = new NPerfil();
			$registrar->setPerfilRegistrarFotografoN($idPersona,$nit,$nombre,$ap_paterno,$ap_materno,$correo,$telefono,$passwords,$userss);
		}
	}
	
	
	if (isset($_POST['direccion'])){
		if($_POST['direccion'] !=""){
			$idEstudioF = $_POST['idEstudioF'];
			$nit        = $_POST['nit'];
			$nombre     = $_POST['nombre'];
			$direccion  = $_POST['direccion'];	
			$correo     = $_POST['email'];
			$telefono   = $_POST['telefono'];
			$passwords  = $_POST['codigo'];
			$userss     = $_POST['usuario'];

			$registrar = new NPerfil();
			$registrar->setPerfilRegistrarEstudioN($idEstudioF,$nit,$nombre,$direccion,$correo,$telefono,$passwords,$userss);
		}
	}

?>