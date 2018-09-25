<?php

	require_once('../Modelo/TabelaLivros.php');
	
	$listaLivros = PesquisaLivro('', 'pp_titulo');

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

		<div class="exibicaoLivro">
		
			<img src="../Imagens/Reduzidas/icon_livro.png">
			<div class="conteudo">
			
				<ul>
					<li>Título: </li>
					<br>
					<li>Autor: </li>
					<br>
					<li>Tipo de Conteúdo: </li>
				<ul>
			
			</div>
		
		</div>
	
	</body>

</html>