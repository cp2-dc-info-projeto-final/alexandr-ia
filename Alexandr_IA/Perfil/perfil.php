<?php

  session_start();

  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaUsuários.php');
  $usuario = InfosUsuario($_SESSION['emailUsuarioLogado']);

  $tipoUsuario = TipoUsuario($usuario['id']);

?>

<html>

  <head>

      <title> Perfil </title>
      <meta charset="utf-8">
      <!-- <link rel="stylesheet" type="text/css" href="../ArquivosStyle/FolhaDeEstilo.css"> -->

      <script>

        function Redirect(endereco){

          window.location.replace(endereco);

        }

      </script>

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

      #infos input {

        //height: 25%;

      }

      #conteudo{
        margin-left: 20%;
        display: inline-block;
        width: 50%;
      }

      #botoes{
        margin-left: 5%;
      }

      #funcionalidades{

        display: block;
        float: right;
        margin-left: 5%;
        border: 2px solid;
        padding: 1%;

      }

      #funcionalidades input {

          width: 100%;
          height: 5%;

      }

      #id {

        margin: 0;
        padding: 0;
        visibility: hidden;

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

    <?php

    $erros = filter_input(INPUT_GET, 'erros', FILTER_SANITIZE_URL);

    if(empty($erros) == false){

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

  	  ?></div>

  	</center>

    <div id="conteudo">
      <h2><?php echo($usuario['nome']); ?></h2>

      <img id="foto_perfil" src=<?php

      if(empty($usuario['foto']) == true){

        echo('../Imagens/icon_usuarioPadrao.png');

      } else {

        // foto guardada

      }

      ?> >

    <div id="infos">

      <ul>

          <form method="post" action="validarAlteracoes.php">

            <input type="hidden" name="id" value="<?php echo($usuario['id']); ?>">
            <li> Nome: <input type="text" name="nome" value="<?php echo($usuario['nome']);?>"></li>
            <br>
            <li> Matrícula: <input type="text" name="matricula" value="<?php echo($usuario['matricula']);?>"></li>
            <br>
            <li> E-mail: <input type="text" disabled name="email" value="<?php echo($usuario['email']);?>"></li>
            <br>
            <input type="submit" value="Salvar alterações">

          </form>

      </ul>

    </div>

    <?php

    if ($tipoUsuario == 1){

      echo('

      <div id="funcionalidades">

          <h3>Painel de Funcionalidades</h3>

          <input type="button" value="Inserir Novo Livro" onClick="Redirect(\'../InsercaoLivros/pagInsercao.php\');">
          <br>
          <input type="button" value="Cadastrar Novo Bibliotecário" onClick="Redirect(\'../CadastroBibliotecario/pagCadastro.php\');">
          <br>
          <input type="button" value="Gerenciar Lista Negra" onClick="Redirect(\'../Lista_Negra/pagLista.php\');">
          <br>
          <input type="button" value="Listar Usuarios" onclick="Redirect(\'../Listagem_Usuarios/Listagem_Usuarios.php\');">
          <br>
          <input type="button" value="Emprestar Livro" onClick="Redirect(\'../EmprestaLivro/pagEmprestimo.php\');">

      </div>

      ');

    }

    ?>

  </div>

  </body>

</html>
