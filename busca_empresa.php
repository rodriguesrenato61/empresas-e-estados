<?php

	require_once("app/Database.php");
	
	$db = new Database();
	
	$conexao = $db->getPdo();

	//pega o uf escolhido por get
	$uf_empresa = $_GET['uf'];
	//pega o segmento escolhido por get
	$segmento_id = $_GET['segmento'];
	
	//faz a busca passando os parâmetros de uf e de segmento
	$sql = $conexao->prepare("SELECT e.nome AS empresa_nome, e.sigla AS empresa_sigla, e.url AS empresa_url FROM empresas AS e INNER JOIN estados AS t ON (e.ufempresas = t.codigo) WHERE e.ufempresas = :ufempresa AND e.segempresas = :segmento_id");
	$sql->bindParam(":ufempresa", $uf_empresa, PDO::PARAM_INT);
	$sql->bindParam(":segmento_id", $segmento_id, PDO::PARAM_INT);
	$sql->execute(); 
	
	if($sql->rowCount()> 0){
		
		//coloca os registros em um array
		while($empresas = $sql->fetch(PDO::FETCH_ASSOC)){

			$dados[] = array(
				"nome" => $empresas['empresa_nome'],
				"sigla" => $empresas['empresa_sigla'],
				"url" => $empresas['empresa_url']
			);
		}
		
		$registros = array(
			"sucess" => true,
			"dados" => $dados
		);
		
	}else{
		
		//caso não seja encontrado nenhuma empresa essa informação é colocado no array
		$registros = array(
			"sucess" => false,
			"dados" => NULL
		);
		
	}
	
	//imprimindo um json com os dados vindos do banco
	echo json_encode($registros);
	
	

?>
