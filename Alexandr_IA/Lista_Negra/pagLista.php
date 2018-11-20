<?php

  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaUsuários.php');
  session_start();

  if(array_key_exists('emailUsuarioLogado', $_SESSION) == false){

		$erro = [];
		$erro[] = 'É preciso estar logado para acessar a página';
		$_SESSION['erro'] = $erro;

		header('Location: ../index.php');
		exit();

	} else {

    $email = $_SESSION['emailUsuarioLogado'];
    $id_usuario = InfosUsuario($email);
    $id_usuario = $id_usuario['id'];

    if(TipoUsuario($id_usuario) == 0){

      $erro = [];
  		$erro[] = 'É preciso ser um bibliotecário para acessar a página';
  		$_SESSION['erro'] = $erro;

  		header('Location: ../index.php');
  		exit();

    }
  }

  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaUsuários.php');
  $usuario = InfosUsuario($_SESSION['emailUsuarioLogado']);

?>
<html>

  <head>

    <title>Página da Lista Negra</title>
    <meta charset="utf-8">

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

    #conteudo{

      border: solid 2px;
      text-align: center;
      margin-left: 35%;
      margin-right: 35%;
      margin-bottom: 1%;

    }

    #conteudo ul{

      list-style-type: none;

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



    </style>

  </head>

  <body>

    <h1>Biblioteca CPII - Caxias</h1>

    <div class="barra">
			<ul>
				<li>
					<a href="../PaginaInicial/PaginaInicial.php">Página Inicial</a>
				</li>
				<li>
					<a href="../Livro/listagemDeLivros.php">Lista de Livros</a>
				</li>
				<li>
					<a href="../Perfil/perfil.php">Perfil</a>
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

    <center><h2>Lista Negra: </h2></center>

    <?php

      $usuarios = Usuarios();
      $bans = 0;

      foreach ($usuarios as $usuario) {

        if ($usuario['banido'] == 1){

          $bans = $bans + 1;

          if(empty($usuario['foto']) == true){

            $caminho = ('../Imagens/icon_usuarioPadrao.png');

          } else {

            $caminho = $usuario['foto'];

          }

          $id = $usuario['id'];

          echo('

          <div id="conteudo">

            <h2>'.$usuario['nome'].'</h2>

            <img height="200px" width="148px" id="foto_perfil" src='.$caminho.'>

            <div id="infos">

              <ul>

                  <li> Nome: '.$usuario['nome'].'</li>
                  <br>
                  <li> Matrícula: '.$usuario['matricula'].'</li>
                  <br>
                  <li> E-mail: '.$usuario['email'].'</li>
                  <br>

                  <form method="post" action="desbanir.php">
                    <input type="hidden" value="'.$id.'" name="id">
                    <input type="submit" value="Desbanir Aluno/Professor do Sistema">
                  </form>

              </ul>

              </div>

          </div>

          ');

        }

      }

      if($bans == 0){

        echo('<center><h4>Não há nenhum usuário na Lista Negra</h4></center>');

      }

    ?>

  </body>

</html>
