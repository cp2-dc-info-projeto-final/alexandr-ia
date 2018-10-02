<?php

	session_start();

	if(array_key_exists('emailUsuarioLogado', $_SESSION) == false){

		$erro = [];
		$erro[] = 'É preciso estar logado para acessar a página';
		$_SESSION['erro'] = $erro;

		header('Location: ../index.php');

	}

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
                    text-align: left;
                    margin-left: 2%;
                    border-style: solid;
                    border-color: grey;
                    border-width: 5px;
                    padding: 1%;
                    display: inline-block;
                    margin-right: 85%;
              }
              h3{
                margin-top: -0.5%;

              }
              .maisacessados{
                padding: 8px;
                margin-right: -1px;
                background-color: grey;
                display: inline-block;
                margin-left: 3%;

              }
              #perfilAluno{
                margin-top: -13%;
                text-align: left;
                margin-left: 2%;
                border-style: solid;
                border-color: grey;
                border-width: 5px;
                padding: 1%;
                display: inline-block;
                margin-left: 85%;

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


          </style>

        <title> Página Inicial </title>
        <meta charset="utf-8">

      </head>
      <body>

        <h1>Biblioteca CPII - Caxias</h1>

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
				<a href="PI_aluno_prof.php">Página Inicial</a>
			</li>
			<li>
				<a href="../Livro/listagemDeLivros.php">Lista de Livros</a>
			</li>
			<li>
				<a href="../Perfil/perfil_alunoProf.php">Perfil</a>
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
            <a href="Lista de Livros"> Quero ver mais </a> <!-- Redirecionamento a fazer para a lista de livros -->

          </div>
            <h2><img src="../Imagens/icon_star.png"> Livros Mais Acessados </h2>
          <div class="maisacessados">

            <!-- Colocar a consulta dos livros mais acessados -->

          </div>

          <div id="perfilAluno">
              <h3> Nome do Usuário </h3>
              <br>
              <!-- Foto e Informações Do Usuário -->
              <br><br>
              <h3> Livros Comigo </h3>
              <br>
              <!-- Consulta dos Livros emprestados -->
              <br><br>
              <h3> Livros Sugeridos </h3>

              <input id="submito2018" type="submit" value="Livro Aleatório">
              <!-- Botão dos livros aleatórios -->

          </div>

      </body>

</html>
