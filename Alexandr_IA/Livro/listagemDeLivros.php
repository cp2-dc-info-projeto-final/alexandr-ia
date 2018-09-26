<?php

	require_once('../Modelo/TabelaLivros.php');
	
	$listaLivros = PesquisaLivro('', 'pp_titulo');
	print_r($listaLivros);

?>
<html>

	<head>
	
		<title>Lista de Livros</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../ArquivosStyle/FolhaDeEstilo.css">
		
		<style>
			
			  h1{
                  margin-bottom: 2%;
                }
				
			  body{
				  
				  margin-top: 3%;
				  
			  }
			
			  #barra{
				  
				  display: flex;
				  margin-top: auto;
				  background-color: #000000;
				  
			  }
			  #barra a{
				  
				  background-color: #32909a;
				  color: #FFFFFF;
				  text-decoration: none;
				  
			  }
			  #itens_nav{
				  
				  float: left;
				  padding: 2% 0;
				  margin-left: 3%;
				  display: flex;
				  width: 66%;
				  
			  }
			  
			  #itens_nav a{
				  
				  margin-left: 10%;
				  
			  }
			  
			  #direita{
				  
				  padding: 2% 0;
				  display: flex;
				  float: right;
				  width: 33%;
				  
			  }
			  
			  #sair{
				  
				  float: right;
				  margin-left: 30%;
				  color: white;
				  
			  }
			  
			  #pesquisa{
				  
				  margin-left: 3%;
				  float: right;
				  
			  }
			  
			  .exibicaoLivro{
				  
				  display: flex;
				  margin-left: 1%;
				  margin-top: 1%;
				  
			  }
			  
			  .conteudo{
				  
				  display: flex;
				  float: right;
				  
			  }
			  
			  .conteudo li{
				  
				  list-style-type:none;
				  text-align: left;
				  
			  }
			
		</style>
	
	</head>
	
	<body>
	
		<h1>Biblioteca CPII - Caxias</h1>
		
		<div id="barra">

			<div id="itens_nav">
				<a href="../PaginaInicial/PI_aluno_prof.php">Página Inicial</a>			
				<a href="../Livro/listagemDeLivros.php">Lista de Livros</a>			
				<a href="">Perfil</a>
			</div>
			<div id="direita">
				<div id="pesquisa">
					<input type="text" placeholder="Pesquisa...">
					<input type="submit">
				</div>
				<a id = "sair" href="../Controlador/sair.php">Sair</a>
			</div>
		
		</div>
        <br><br>

		<?php
		
			foreach($listaLivros as $livro){
				
				$tipo = VerificaTipo($livro['titulo']);
				
				if($tipo == 'CD'){
					
					$img = $tipo;
					
				} else if($tipo == 'DVD') {
					
					$img = $tipo;
					
				} else if($tipo == 'Cordel'){
					
					$img = $tipo;
					
				} else if($tipo == 'Braille'){
					
					$img = $tipo;
					
				} else if($tipo == 'Audiolivro'){
					
					$img = $tipo;
					
				} else if($tipo == 'Edição com fonte ampliada'){
					
					$img = 'fonteAmpliada';
					
				} else {
					
					$img = 'livro';
					
				}
		
		?>
		
		<div class="exibicaoLivro">
		
			<img src="../Imagens/Reduzidas/icon_<?php echo($img); ?>.png">
			<div class="conteudo">
			
				<ul>
					<li><?php echo('Título: '.$livro['titulo']);?></li>
					<br>
					<?php if(empty($livro['autor']) == false){
						
						echo('<li> Autor: '.$livro['autor'].'</li> <br>');
						
					}?>
					<li><?php echo('Tipo de Conteúdo: '.$tipo);?></li>
				<ul>
			
			</div>
		
		</div>
		
		<?php 
		
			}
		
		?>
	
	</body>

</html>