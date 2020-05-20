
//pega o link de cada estado
const estados_links = document.querySelectorAll('.estado');

//pega o input ligado ao link de cada estado
const estados_inputs = document.querySelectorAll('.uf');

//pega o id do local onde o resultado será impresso
const resultado = document.querySelector('#resultado');

//pega o select com o segmento selecionado
const segmento = document.querySelector('#segmento');

//pega o id do butão que fará a busca dos registros quando for clicado
const btnBuscar = document.querySelector('#btn-buscar');

//variável que armazena o estado selecionado
var uf_selecionado = "";

//função que atribui o valor do uf selecionado a cada link quando clicado
function pegarEstados(){
	
	for(let i = 0; i < estados_links.length; i++){
		
		//atribuindo a mudança do estado selecionado para cada link clicado
		estados_links[i].addEventListener('click', function(event){
			
			event.preventDefault();
			
			uf_selecionado = estados_inputs[i].value;

			console.log("Estado selecionado: "+uf_selecionado);
	
		});
	
	}
	
}

pegarEstados();

//coloca para fazer a busca quando clicar no butão
btnBuscar.addEventListener('click', function(){

	if(uf_selecionado != "" && segmento.value != "0"){
		
		busca_empresas(uf_selecionado, segmento.value);
		
	}else{
		
		resultado.innerHTML = "<h3>Selecione o estado e o segmento!</h3>";
		
	}
	
});


//busca as empresas de determinado segmento em determinado estado
function busca_empresas(uf, segmento_id){

	//esse ajax faz a busca por método get e pega o retorno em json
	$.ajax({
	    url: 'busca_empresa.php?uf='+uf+'&segmento='+segmento_id,
	    type: 'GET',
	    dataType: 'JSON', 
	    success: imprimeEmpresas 
	});
    
}

//função que pega os dados do json retornado e imprime em uma tabela	
function imprimeEmpresas(data){
 
    let html;
    
    if(data.sucess){
		
		html = "<table border='1'>";
		html += "<thead>";
		html += "<td>NOME DA EMPRESA</td>";
		html += "<td>ESTADO</td>";
		html += "<td>LINK RH</td>";
		html += "</thead>";
		
		$.each(data.dados, function(i, empresa){
				
			html += "<div id='centro-direita-select'>";
			html += "<tbody width='100%'>";
			html += "<tr>";
			html += "<td width='67%'>"+empresa.nome+"</td>";
			html += "<td width='10%'>"+empresa.sigla+"</td>";
			html += "<td><a href ='"+empresa.url+"'>Clique para acessar</a></td>";
			html += "</tr>";
			html += "</tbody>";
			html += "</div>";
				
		});
		
		html += "</table>";
		
	}else{
		
		html = "<h3>Nenhuma empresa encontrada!</h3>";
		
	}
    
    //aqui vc coloca a tabela no elemento do seu html
    resultado.innerHTML = html;
    
}

