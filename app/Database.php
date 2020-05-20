<?php

	class Database{
		
		private $pdo;
	
		//configuração de conexão com o banco de dados
		public function __construct(){
		
			$host = "localhost";
			$dbname = "questao03";
			$user = "root";
			$password = "";
			
			try{
			
				$this->pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password);
				
			}catch(Exception $e){
				
				echo("Erro ao conectar com o banco: ".$e->getMessage());
				
			}
			
		}
		
		public function getPdo(){
			
			return $this->pdo;
		}
		
	}

?>
