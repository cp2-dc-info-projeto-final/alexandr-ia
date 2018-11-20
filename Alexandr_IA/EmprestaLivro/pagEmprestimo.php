<?php

  session_start();

  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaUsuários.php');
  require_once('../Modelo/TabelaEmprestimo.php');

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

  $infos = InfosUsuario($_SESSION['emailUsuarioLogado']);

?>
<html>

  <head>

    <link rel="stylesheet" type="text/css" href="ArquivosStyle/FolhaDeEstilo.css">

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
      margin-top: 1%;
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

      margin-bottom: 4%;
      text-align: center;
      font-size: 48px;

    }

    body{

      margin-top: 3%;
      background-color: rgb(174,231,240);

    }

    .align{

      margin-left: 5%;
      float: left;

    }

    </style>

  </head>

  <body>

    <h1>Biblioteca CPII - Caxias</h1>

    <center><b id="aviso">ATENÇÃO: ANTES DE FAZER REALIZAR QUALQUER AÇÃO, ATUALIZE A PÁGINA (PARA SINCRONIZAR O HORÁRIO)</b></center>

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

    <?php

    $erros = filter_input(INPUT_GET, 'erros', FILTER_SANITIZE_URL);

    if(empty($erros) == false || isset($_REQUEST['mensagem']) == true){

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

      }

    ?>

    <center>

  		<div id='caixaErros'>
  	  <?php

       if (empty($erros) == false ){

         echo('ERRO:');

    	   foreach($_REQUEST as $item){

    		     print($item);

    		 }

      }

      if( isset($_REQUEST['mensagem']) == true ){

        echo($_REQUEST['mensagem']);

      }

  	  ?></div>

    </center>

    <br><br>

    <div class="align">
    <h2>Realizar Empréstimo</h2>

    <form method="post" action="emprestar.php">

      <input name="id_bibliotecario" type="hidden" value="<?php echo($infos['id']); ?>">
      <label> E-mail do Aluno: <input name="email_usuario" type="email"></label>
      <br><br>
      <label> Classificação do Livro: <input name="classificacao_livro" type="text"></label>
      <br><br>
      <input type="submit" value="Fazer Empréstimo">

    </form>
  </div>

  <div class="align">
    <h2>Receber Empréstimo</h2>

    <form method="post" action="devolve.php">

      <input name="id_bibliotecario" type="hidden" value="<?php echo($infos['id']); ?>">
      <label> E-mail do Aluno: <input name="email_usuario" type="email"></label>
      <br><br>
      <label> Classificação do Livro: <input name="classificacao_livro" type="text"></label>
      <br><br>
      <input type="submit" value="Receber Empréstimo">

    </form>
  </div>

  <div class="align">
    <h2>Realizar renovação (7 dias)</h2>

    <form method="post" action="renova.php">

      <input name="id_bibliotecario" type="hidden" value="<?php echo($infos['id']); ?>">
      <label> E-mail do Aluno: <input name="email_usuario" type="email"></label>
      <br><br>
      <label> Classificação do Livro: <input name="classificacao_livro" type="text"></label>
      <br><br>
      <input type="submit" value="Renovar Empréstimo">

    </form>
  </div>

  </body>

</html>
