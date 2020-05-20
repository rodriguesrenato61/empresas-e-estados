<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Mapa</title>
	</head>
	<body>
		
		<!-- criando elementos <a> associados a um input com o valor do código do estado -->
		<?php
		
			require_once("app/Database.php");
			
			$db = new Database();
			
			$conexao = $db->getPdo();
			
			$sql = $conexao->prepare("SELECT * FROM estados");
			$sql->execute();
			
			//imprimindo os estados
			while($estado = $sql->fetch()){
			
				echo("<a class='estado' href='#'>".$estado['nome']."</a>");
				echo("<input type='hidden' class='uf' value='".$estado['codigo']."'>");
				echo("<br>");
				
			}
			
			$sql = $conexao->prepare("SELECT * FROM segmentos");
			$sql->execute();
			
			//imprimindo os segmentos
			echo("<select id='segmento'>");
			echo("<option value='0'>--Escolha o segmento--</option>");
			
			while($segmento = $sql->fetch()){
			
				echo("<option value='".$segmento['id']."'>".$segmento['nome']."</option>");
				
			}
			
			echo("</select>");
		
		
		?>
		
		<!-- butão que faz a busca dos registros -->
		<button id="btn-buscar">Buscar</button>
		
		<!-- local onde o resultado será impresso -->
		<div id="resultado">
		</div>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="scripts.js"></script>
	</body>
</html>


