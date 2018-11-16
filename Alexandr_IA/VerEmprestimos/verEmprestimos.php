<?php

  session_start();

  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaUsuários.php');
  require_once('../Modelo/TabelaEmprestimo.php');

  $emprestimos = ListaEmprestimos();
  $reservas = ListaReservas();

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

    table{

      border: solid 3px;

    }

    td{

      margin-bottom: 2px;
      border-top: solid 3px;
      border-left: solid 3px;
      padding: 10px;

    }

    th{

      border-left: solid 3px;
      padding: 10px;

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

    <br><br>

    <h2>Empréstimos: </h2>
    <br>

    <table>

      <tr>

        <th>Nome do aluno</th>
        <th>E-mail do aluno</th>
        <th>Nome do livro emprestado</th>
        <th>Classificação do livro emprestado</th>
        <th>Data do empréstimo</th>
        <th>Data de devolução</th>

      </tr>

      <?php foreach ($emprestimos as $emprestimo) {

        if($emprestimo['retirado'] == 1 AND empty($emprestimo['_data_devolucao']) == TRUE) {

      ?>

        <tr>

          <td><?php echo($emprestimo['nome']); ?></td>
          <td><?php echo($emprestimo['email']); ?></td>
          <td><?php echo($emprestimo['titulo']); ?></td>
          <td><?php echo($emprestimo['classificacao']); ?></td>
          <td><?php echo($emprestimo['_data_emprestimo']); ?></td>
          <td><?php echo($emprestimo['_data_prazo']); ?></td>

        </tr>

      <?php

        }
       }

      ?>

    </table>

    <br>

    <h2>Reservas: </h2>
    <br>

    <table>

      <tr>

        <th>Nome do aluno</th>
        <th>E-mail do aluno</th>
        <th>Nome do livro emprestado</th>
        <th>Classificação do livro emprestado</th>
        <th>Data da reserva</th>
        <th>Data limite para retirar</th>

      </tr>

      <?php foreach ($emprestimos as $emprestimo) {

        if($emprestimo['retirado'] == 0 AND empty($emprestimo['_data_devolucao']) == TRUE) {

      ?>

        <tr>

          <td><?php echo($emprestimo['nome']); ?></td>
          <td><?php echo($emprestimo['email']); ?></td>
          <td><?php echo($emprestimo['titulo']); ?></td>
          <td><?php echo($emprestimo['classificacao']); ?></td>
          <td><?php echo($emprestimo['_data_emprestimo']); ?></td>
          <td><?php echo($emprestimo['_data_prazo']); ?></td>

        </tr>

      <?php

        }
       }

      ?>

    </table>

    <br>

    <h2>Lista de interesse: </h2>
    <br>

    <table>

      <tr>

        <th>Nome do aluno</th>
        <th>E-mail do aluno</th>
        <th>Nome do livro emprestado</th>
        <th>Classificação do livro emprestado</th>

      </tr>

      <?php foreach ($reservas as $reserva) {?>

        <tr>

          <td><?php echo($reserva['nome']); ?></td>
          <td><?php echo($reserva['email']); ?></td>
          <td><?php echo($reserva['titulo']); ?></td>
          <td><?php echo($reserva['classificacao']); ?></td>

        </tr>

      <?php } ?>

    </table>
    <br><br>

  </center>

</body>

</html>
