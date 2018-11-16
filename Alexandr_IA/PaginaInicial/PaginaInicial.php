<?php

	session_start();

	require_once('../Modelo/CriaConexao.php');
	require_once('../Modelo/TabelaUsuários.php');
	require_once('../Modelo/TabelaEmprestimo.php');
	require_once('../Modelo/TabelaLivros.php');

	if(array_key_exists('emailUsuarioLogado', $_SESSION) == false){

		$erro = [];
		$erro[] = 'É preciso estar logado para acessar a página';
		$_SESSION['erro'] = $erro;

		header('Location: ../index.php');
		exit();

	}

	$usuario = InfosUsuario($_SESSION['emailUsuarioLogado']);
	$id_usuario = $usuario['id'];

	$emprestimos = ListaEmprestimosPorId($id_usuario);

	$resultado = [];
	$avisos = [];

	foreach ($emprestimos as $emprestimo) {

		$id_emprestimo = $emprestimo['id'];
		$resultado = TempoLimite($id_emprestimo);

		$livro = $resultado['nome_livro'];

		//var_dump($resultado['tempo_restante']);
		if($emprestimo['retirado'] == 0){

			if ($resultado['tempo_restante']->invert == 1){

				CancelaPreEmprestimo($id_emprestimo);
				$avisos[] = "O tempo para retirar o livro $livro acabou";

			} else if ( $resultado['tempo_restante']->days >= 1){

				// Nesse caso não é preciso enviar um aviso

			} else if ( $resultado['tempo_restante']->h > 12){

				$avisos[] = "Você tem menos de 24H para retirar o livro $livro na biblioteca";

			} else if ($resultado['tempo_restante']->h > 6){

				$avisos[] = "Você tem menos de 12H para retirar o livro $livro na biblioteca";

			} else if($resultado['tempo_restante']->h > 0){

					$avisos[] = "Você tem menos de 6H para retirar o livro $livro na biblioteca";

			}

		} else {

			if ($resultado['tempo_restante']->invert == 1){

				$avisos[] = "A devolução do livro $livro está atrasada";

			} else if ( $resultado['tempo_restante']->days >= 2){

				// Nesse caso não é preciso enviar um aviso

			} else if ( $resultado['tempo_restante']->days = 1){

				$avisos[] = "O prazo de devolução do livro $livro expira em 1 dia";

			} else {

				$avisos[] = "O livro $livro deve ser devolvido hoje, até as 18:00H, na biblioteca";

			}

		}

	}

	$email = $_SESSION['emailUsuarioLogado'];
	$usuario = InfosUsuario($email);

?>
<html>
      <head>
        <link rel="stylesheet" type="text/css" href="../ArquivosStyle/FolhaDeEstilo.css">
          <style>

                h1{
                  margin-bottom: 2%;
                }
                ul {
                    list-style-type: none;
                    margin-top: 5%;
                    padding: 0;
                    overflow: hidden;
                    background-color: #000000;
					display: block;
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
              .cordetela {
                  background-color: #32909a;
              }

              .adicionadosrec{
                    text-align: center;
                    margin-left: 2%;
                    border-style: solid;
                    border-color: grey;
                    border-width: 5px;
                    padding: 1%;
                    display: inline-block;
                    float: left;
              }
              h3{
                margin-top: -0.5%;

              }

							h2 {

								display: flex;
								width: auto;
								margin-left: 40%;

							}

              .maisacessados{
                padding: 8px;
                margin-right: -1px;
                background-color: grey;
                display: inline-block;
                //margin-left: 3%;

              }

              #perfilAluno{
                margin-top: -4%;
                text-align: center;
                //margin-left: 2%;
                border-style: solid;
                border-color: grey;
                border-width: 5px;
                padding: 1%;
                display: inline-block;
                float: right;

              }

							#perfilAluno img {

								margin-bottom: 5%;

							}

              #icone_pesquisa{
                margin-top: 2.5%;
                margin-bottom: 2.5%;
                background-color: white;
                width: 500px;
                padding-right: -4%;
              }
			  #sair{

				  float: right;
				  margin-left: 30%;
				  color: white;

			  }

			  body{

				  margin-top: 3%;

			  }
			  #pesquisa{

				  margin-left: 3%;
				  float: right;

			  }
			  .botao_pesquisa{

				float: left;
				display: block;
				vertical-align: middle;
				margin-top: 10px;
			  }
			  #bloco{
				  float: right;
				  width: 50%;
				  vertical-align: middle;
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


				#aviso {

					color: red;

				}

				#centro{

					margin-bottom: -2%;

				}

          </style>

        <title> Página Inicial </title>
        <meta charset="utf-8">

      </head>
      <body>

        <h1>Biblioteca CPII - Caxias</h1>

				<?php

					if ($usuario['banido'] == 1){

						echo('<h3 id="aviso"> Você está banido, portanto impedido de pegar itens emprestado. Dúvidas, contate o bibliotecário do campus.</h3>');

					}

					if( empty($avisos) == FALSE){

				    echo ('

				      <br>
				      <style>

					  #caixaAviso{

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

				    }

				  ?>

					<center>

						<div id='caixaAviso'>
					  <?php

						if( empty($avisos) == FALSE){

							echo('Aviso: ');

							foreach ($avisos as $mensagem) {

 							 echo(' || '.$mensagem);

 						 }

						}

					  ?></div>

					</center>

		<!-- <div id="barra">

			<div id="itens_nav">
				<a href="PI_aluno_prof.php">Página Inicial</a>
				<a href="../Livro/listagemDeLivros.php">Lista de Livros</a>
				<a href="">Perfil</a>
			</div>
			<div id="direita">
				<div id="pesquisa">
					<form method="POST" action="../Livro/listagemDeLivros.php">
						<input type="text" placeholder="Pesquisa..." name="stringPesquisada">
						<input type="submit">
					</form>
				</div>
				<a id = "sair" href="../Controlador/sair.php">Sair</a>
			</div>

		</div> -->

		 <ul>
			<li>
				<a href="PaginaInicial.php">Página Inicial</a>
			</li>
			<li>
				<a href="../Livro/listagemDeLivros.php">Lista de Livros</a>
			</li>
			<li>
				<a href="../Perfil/perfil.php">Perfil</a>
			</li>
			<div style="display: inline-block; margin-top:0.6%;">
				<form method="post" action="../Livro/listagemDeLivros.php">
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

        <br><br>

          <div class="adicionadosrec">
            <h3>  Adicionados <br> Recentemente </h3>
            <!-- Parte php de consulta dos livros adicionados recentemente -->
						<?php

							require_once('../Modelo/CriaConexao.php');
							require_once('../Modelo/TabelaLivros.php');

							$lista = MaisRecentes();

							foreach ($lista as $livro) {

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

								echo('

									<a href="../Livro/detalhesLivro.php?idLivro='.$livro['id'].'">
										<img src="../Imagens/MaisReduzidas/icon_'.$img.'.png">
									</a>
									<br>
									<p> '.$livro['titulo'].' </p>

								');
							}

						?>
            <a href="../Livro/listagemDeLivros.php"> Quero ver mais </a> <!-- Redirecionamento a fazer para a lista de livros -->

          </div>
            <h2><img src="../Imagens/icon_star.png"> Livros Mais Acessados </h2>
          <div class="maisacessados">

            <!-- Colocar a consulta dos livros mais acessados -->

          </div>

          <div id="perfilAluno">
              <h3> <?php echo($usuario['nome']); ?> </h3>
              <!-- Foto e Informações Do Usuário -->
							<?php

							if(empty($usuario['foto']) == true){

								echo('<img height="67px" width="50px" src="../Imagens/MaisReduzidas/icon_usuarioPadrao.png">');

							} else {

								echo('<img height="67px" width="50px" src="'.$usuario['foto'].'">');

							}

							?>
              <br>
              <h3><br> <?php

								$tipo = TipoUsuario($usuario['id']);

								if ($tipo == 1){

									echo('<a id="centro" href="../VerEmprestimos/VerEmprestimos.php">Livros emprestados</a>');

								} else {

									echo('<a id="centro" href="../Perfil/itensEmprestados.php">Livros comigo</a>');

								}

							?>
							</h3>
              <br>
              <!-- Consulta dos Livros emprestados -->

              <h3> Quero uma novidade </h3>

							<?php

								require_once('../Modelo/TabelaLivros.php');

								$lista = IdsLivro();

								$chave = array_rand($lista, 1);
								$id = $lista[$chave];

							?>

							<!-- <a href="../Livro/detalhesLivro.php?idLivro=<//?php echo($id); ?>">Livro a</a> -->
							<form method="post" action="../Livro/detalhesLivro.php?idLivro=<?php echo($id); ?>">
              	<input id="amazing_button" type="submit" value="Livro Aleatório">
							</form>
              <!-- Botão dos livros aleatórios -->

          </div>

      </body>

</html>
