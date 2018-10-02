<?php

  session_start();

  require_once('../Modelo/TabelaUsuários.php');
  $usuario = InfosUsuario($_SESSION['emailUsuarioLogado']);

?>

<html>

  <head>

      <title> Perfil </title>
      <meta charset="utf-8">
      <!-- <link rel="stylesheet" type="text/css" href="../ArquivosStyle/FolhaDeEstilo.css"> -->

      <style>

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
        color: white;

      }

      #pesquisa{

        margin-left: 10%;
        float: left;

      }

      h1{

        margin-bottom: 2%;
        text-align: center;
        font-size: 48px;

      }

      body{

        margin-top: 3%;
        background-color: rgb(174,231,240);

      }

      h2 {

        margin-left: 2%;

      }

      #foto_perfil{

        border: 2px solid;
        float: left;

      }

      #infos{

        display: flex;
        float: left;

      }

      #infos ul {

        list-style-type:none;

      }

      </style>

  </head>

  <body>

    <h1>Biblioteca CPII - Caxias</h1>

    <div class="barra">
			<ul>
				<li>
					<a href="../PaginaInicial/PI_aluno_prof.php">Página Inicial</a>
				</li>
				<li>
					<a href="../Livro/listagemDeLivros.php">Lista de Livros</a>
				</li>
				<li>
					<a href="../Perfil/perfil_alunoProf.php">Perfil</a>
				</li>
				<div style="display: inline-block; margin-top:0.6%;" id="pesquisa">
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
				<li id="sair">
					<a id = "sair" href="../Controlador/sair.php">Sair</a>
				</li>
			</ul>
		</div>

    <h2><?php echo($usuario['nome']); ?></h2>

    <img id="foto_perfil" src=<?php

    if($usuario['foto'] == NULL){

      echo('../Imagens/icon_usuarioPadrao.png');

    } else {

      // foto guardada

    }

    ?> >

  <div id="infos">

    <ul>
      <li> Nome: <?php echo($usuario['nome']);?></li>
      <br>
      <li> Matrícula: <?php echo($usuario['matricula']);?></li>
      <br>
      <li> E-mail: <?php echo($usuario['email']);?></li>
    <ul>

  </div>

  </body>

</html>
