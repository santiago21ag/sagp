<?php

class Conexion {
		
		public $server;
		public $user;		
		public $password;
		public $db;
		public $connection;
		
		public function __construct(){
					
			$this->server='localhost';
			$this->user='u607872063_fotouser';
			$this->password='+^+pS0Rw';
			$this->db='u607872063_fotodb';
			$this->connection      = new mysqli($this->server,$this->user,$this->password,$this->db);			
			$this->connection->set_charset('utf8');
		}

		function openConexion(){
			return $this->connection;
		}

		function closeConexion(){
			$this->connection->close();

		}

	}

?>