<?php

	session_start();
	
	$_SESSION['idLivro'] = 2;
	
	$idLivro = $_SESSION['idLivro'];

	require_once('../Modelo/TabelaLivros.php');
	$livro = DetalhaLivro($idLivro);
	
	$titulo = $livro['titulo'];
	
?>
<html>

	<head>
	
		<title>Detalhes do Livro</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../ArquivosStyle/FolhaDeEstilo.css">
		
		<style>
			
			body{
				
				margin-top: 5%;
				text-align: left;
				
			}
			
			h1{
				
				text-align: center;				
				font-family: "Times New Roman", Times, serif;
				
			}
			
			#infos{
				
				margin-left: 15%;
				margin-top: 5%;
			}
			
			#BordaLivro{
				
				padding: 8px;
				margin-right: -1px;
				background-color: white;
				display: inline-block;
				margin-left: 3%;
				
			}
			
			h2{
				
				font-size: 32px;				
				font-family: "Times New Roman", Times, serif;
				
			}
			
			#displayed{
				
				display: inline-block;
				margin-left: 2%;
				padding-bottom: -1px;
				font-size: 19px;
				
			}
			
			.enviar{
				
				margin-left: 5%;
				
			}
		
		</style>
	
	</head>
	
	<body>
	
		<h1>Biblioteca CPII - Caxias</h1>

		<div id="infos">
		
			<h2><i><?php echo($titulo)?></i></h2>
			
			<div id='BordaLivro'>
			
				<img src="../Imagens/icon_livro.png">
			</div>	

			<div id="displayed">
			
				<p>Autor: 
				<?php echo($livro['autor']);?>
				</p> 
				<?php 				
					
					if( empty($livro['volume']) == false){
						
						echo('<p> Volume: '.$livro['volume'].'</p>');
					}
				?>
				<p>Edição: 
				<?php echo($livro['edicao']);?>
				</p> 
				<?php 
				
					if( empty($livro['editora']) == false){
						
						echo('<p> Editora: '.$livro['editora'].'</p>');
					}
				?>
			</div>

			
			<form class="enviar">
				
				<input type='submit' value='Reservar' id="submito2018">
			</form>
			
		</div>
		
	</body>

</html>