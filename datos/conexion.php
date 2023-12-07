<?php
	
			
	class Conexion {

		
		public $server;
		public $user;		
		public $password;
		public $db;
		public $con;
		
		public function __construct(){
			//$this->con=mysqli_connect('localhost','id11334789_usuario','Santiago','id11334789_juridico');			
            $this->server='localhost';
            $this->user='u607872063_fotouser';
            $this->password='+^+pS0Rw';
            $this->db='u607872063_fotodb';
			$this->con=mysqli_connect($this->server,$this->user,$this->password,$this->db);			
			mysqli_set_charset($this->con, 'utf8');
		}

	

		function openConexion(){
			return $this->con;
		}

		function closeConexion(){
			mysqli_close($this->con);
		}

	}
			
			
			
?>
