<?php

	require_once('../Modelo/TabelaLivros.php');

	if(array_key_exists('tipoConsulta', $_REQUEST) == true){

		$tipoConsulta = $_REQUEST['tipoConsulta'];

	} else {

		$tipoConsulta = 'pp_titulo';

	}

	if( array_key_exists('stringPesquisada', $_REQUEST) == false){

		$listaLivros = PesquisaLivro('', 'pp_titulo');

	} else {

		if($tipoConsulta == 'pp_titulo'){

			$listaLivros = PesquisaLivro($_REQUEST['stringPesquisada'], 'pp_titulo');
		}

		if($tipoConsulta == 'pp_autor'){

			$listaLivros = PesquisaLivro($_REQUEST['stringPesquisada'], 'pp_autor');
		}

		if($tipoConsulta == 'pp_editora'){

			$listaLivros = PesquisaLivro($_REQUEST['stringPesquisada'], 'pp_editora');
		}
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

			  .exibicaoLivro {

				  display: inline-block;
				  float: left;
				  margin-left: 4%;
				  margin-top: 1%;
				  width: 100%;
			  }

			  .exibicaoLivro a{

				  float: left;

			  }

			  .conteudo{

				  display: flex;
				  float: left;

			  }

			  .conteudo li{

				  list-style-type:none;
				  text-align: left;


			  }

			  .conteudo ul{

				  padding-left: 10px;

			  }

			.barra li {
				float: left;
				padding-right: 4%;
				padding-left: 4%;
			}
			.barra li a {
				display: block;
				color: white;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
			}
			.barra li:hover {
				background-color: #32909a;
			}

			.barra ul {

				list-style-type: none;
				margin-top: 5%;
				padding: 0;
				overflow: hidden;
				background-color: #000000;
				display: block;
			}

			#parte_esquerda{

				float: left;
				width: 45%;
				margin-left: 5%;

			}

			#parte_direita{

				float: right;
				width: 45%;

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

		<div class="barra">
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
				<form method="post" action="listagemDeLivros.php">
					<select name="tipoConsulta">
						<option value="pp_titulo">Título</option>
						<option value="pp_autor">Autor</option>
						<option value="pp_editora">Editora</option>
					</select>
					<input name="stringPesquisada" style="margin-top: 0.8%;" type="text" placeholder="Pesquisar...">
					<input type="submit" value="Pesquisar">
				</form>
			</div>
				<li style="float: right;">
					<a id = "sair" href="../Controlador/sair.php">Sair</a>
				</li>
			</ul>
		</div>

		<div id="parte_esquerda">
			<?php

				$listaEsquerda = [];
				$listaDireita = [];

				for($i = 0; $i < count($listaLivros); $i++){

					if( ($i % 2) == 0){

						$listaEsquerda[] = $listaLivros[$i];

					} else {

						$listaDireita[] = $listaLivros[$i];

					}

				}

				foreach($listaEsquerda as $livro){

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

				<a href="detalhesLivro.php?idLivro=<?php echo($livro['id']); ?>">
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

		</div>

		<div id="parte_direita">
			<?php

				foreach($listaDireita as $livro){

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

				<a href="detalhesLivro.php?idLivro=<?php echo($livro['id']); ?>">
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

		</div>

	</body>

</html>
