<?php

	require_once('../Modelo/TabelaLivros.php');
	
	if( array_key_exists('stringPesquisada', $_REQUEST) == false){
		
		$listaLivros = PesquisaLivro('', 'pp_titulo');
		
	} else {
		
		$listaLivros = PesquisaLivro($_REQUEST['stringPesquisada'], 'pp_titulo');
		
	}

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
				  
				  display: inline-block;
				  float: left;
				  margin-left: 4%;
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
			  
			  .conteudo ul{
				  
				  padding-left: 5%;
				  
			  }
			  
			li {
				float: left;
				padding-right: 4%;
				padding-left: 4%;
			}
			li a {
				display: block;
				color: white;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
			}
			li:hover {
				background-color: #32909a;
			}
			
			ul {
				
				list-style-type: none;
				margin-top: 5%;
				padding: 0;
				overflow: hidden;
				background-color: #000000;
				display: block;
			}
			
		</style>
	
	</head>
	
	<body>
	
		<h1>Biblioteca CPII - Caxias</h1>
		
		<!-- <div id="barra">

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
        <br><br> -->
		
		<ul>
			<li>
				<a href="../PaginaInicial/PI_aluno_prof.php">Página Inicial</a>
			</li>	
			<li>
				<a href="../Livro/listagemDeLivros.php">Lista de Livros</a>
			</li>		
			<li>
				<a href="">Perfil</a>
			</li> 
			<div style="display: inline-block; margin-top:0.6%;">
				<input style="margin-top: 0.8%;" type="text" placeholder="Pesquisar...">
				<input type="submit" value="Pesquisar">
			</div>
			<li style="float: right;">
				<a id = "sair" href="../Controlador/sair.php">Sair</a>
			</li>
		</ul>

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
					
				} else if( HQ($livro['titulo']) == true ){
					
					$img = 'hq';
					$tipo = 'HQ/Mangá/Graphic Novel';
					
				} else {
					
					$img = 'livro';
					$tipo = 'Livro';
					
				}
		
		?>
		
		<div class="exibicaoLivro">
		
			<a href="">
				<img src="../Imagens/Reduzidas/icon_<?php echo($img); ?>.png">
			</a>
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