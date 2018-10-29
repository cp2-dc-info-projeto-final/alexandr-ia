<?php

	session_start();
	$idLivro = filter_input(INPUT_GET, 'idLivro', FILTER_SANITIZE_URL);
	$erro = filter_input(INPUT_GET, 'erro', FILTER_DEFAULT);

	$_SESSION['idLivro'] = $idLivro;

	$idLivro = $_SESSION['idLivro'];

	require_once('../Modelo/CriaConexao.php');
	require_once('../Modelo/TabelaLivros.php');
	require_once('../Modelo/TabelaUsuários.php');
	require_once('../Modelo/TabelaEmprestimo.php');

	$livro = DetalhaLivro($idLivro);

	$titulo = $livro['titulo'];
	$email = $_SESSION['emailUsuarioLogado'];

	$dadosUsuario = InfosUsuario($email);
	$id = $dadosUsuario['id'];

	$tipoUsuario = TipoUsuario($id);
	$qtd_exemplares = ExemplaresDisponiveis($idLivro);

	$reservas_usuario = ListaReservasPorId($id);

	$reservaFeita = FALSE;
	$idReservaFeita = NULL;
	foreach ($reservas_usuario as $reserva) {

		if($reserva['aluno_prof'] == $id){

			$reservaFeita = TRUE;
			$idReservaFeita = $reserva['id'];

		}

	}

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

			#displayed input{

				width: auto;
				border: none;
				background-color: rgb(174,231,240);
				font-size: 19px;
				font-family: "Times New Roman";
				color: #000000;

			}

			.enviar{

				margin-left: 5%;

			}

		</style>

	</head>

	<body>

		<center><a href="listagemDeLivros.php?stringPesquisada=<?php if(!empty($_SESSION['stringPesquisada'])){echo($_SESSION['stringPesquisada']);} ?>">Retornar à listagem de livros</a></center>

		<h1>Biblioteca CPII - Caxias</h1>

		<?php

		if ($erro != null){

				echo ('

					<br>
					<style>

					#caixaErros{

					visibility:visible;
					background-color: #ffff80;
					width: 50%;
					text-align: center;
					border: solid 1px;
					padding: 3px;
					font-size: 18px;

					}

					</style>

				');

				echo('<center><div id="caixaErros">');

					echo($erro);

				echo('</div></center>');

				unset($_SESSION['errosInsercao']);

			}

		?>

		<div id="infos">

			<h2><i><?php echo($titulo)?></i></h2>
			<p>Qunatidade de exemplares disponíveis: <?php echo($qtd_exemplares); ?></p>

			<div id='BordaLivro'>

				<?php

					$tipo = VerificaTipo($livro['id']);
					$img = null;

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

					} else if( HQ($livro['id']) == true ){

						$img = 'hq';
						$tipo = 'HQ/Mangá/Graphic Novel';

					} else {

						$img = 'livro';
						$tipo = 'Livro';

					}

					$img = strtolower($img);

					echo(' <img src="../Imagens/icon_'.$img.'.png"> ');

				?>

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
				<?php echo('<p>Tipo de Suporte: '.$tipo.'</p>') ?>
				<label>Classificação:
				<input

					type="text"
					disabled
					value="<?php echo($livro['classificacao']);?>"
				>
				 </label>
			</div>

			<?php

			$ban = '';
			if ($dadosUsuario['banido'] == 1){

				$ban = 'disabled';

			}

				if ($tipoUsuario == 0){

					if($qtd_exemplares != 0){

						echo('

					<form class="enviar" method="post" action="empresta.php">
						<input type="hidden" value="'.$dadosUsuario['id'].'" name="id_usuario">
						<input type="hidden" value="'.$livro['id'].'" name="id_livro">
						<input type="submit" value="Pegar Emprestado" id="amazing_button"'.$ban.'>
					</form>

						');

					} else if ($reservaFeita == FALSE){

						echo('

					<form class="enviar" method="post" action="reserva.php">
						<input type="hidden" value="'.$dadosUsuario['id'].'" name="id_usuario">
						<input type="hidden" value="'.$livro['id'].'" name="id_livro">
						<input type="submit" value="Reservar Livro" id="amazing_button"'.$ban.'>
					</form>

						');

					} else {

						echo('

					<form class="enviar" method="post" action="cancela.php">
						<input type="hidden" value="'.$idReservaFeita.'" name="id_reserva">
						<input type="hidden" value="'.$livro['id'].'" name="id_livro">
						<input type="submit" value="Cancelar Reserva" id="amazing_button"'.$ban.'>
					</form>

						');

					}

				} else {

					echo('

						<br>
						<form class="enviar" method="post" action="editar.php">
							<input type="hidden" value="'.$livro['id'].'" name="id_livro">
							<input type="submit" value="Editar" id="amazing_button">
						</form>

					');

				}
			?>

		</div>

	</body>

</html>
