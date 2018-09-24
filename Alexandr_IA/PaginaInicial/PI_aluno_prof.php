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
                  margin-bottom: -50px;
                }
                ul {
                    list-style-type: none;
                    margin-top: 5%;
                    padding: 0;
                    overflow: hidden;
                    background-color: #000000;
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
				  display: inline-block;
				  
			  }
			  
			  #sair:hover {
                    background-color: #32909a;
              }


          </style>

        <title> Página Inicial </title>
        <meta charset="utf-8">

      </head>
      <body>

        <h1>Biblioteca CPII - Caxias</h1>

          <ul>
              <li class="cordetela"><a href="PI_aluno_prof.php"> Página Inicial </a></li>
              <li><a href="PI_aluno_prof.php"> Lista de Livros </a></li>
              <li><a href="PI_aluno_prof.php"> Perfil </a></li>
			<form action="">
			  <input type="text" placeholder="Pesquisa.." name="pesquisa">
			  <button type="submit"><i class="botao_pesquisa"></i></button>
			</form>

              <li id="sair"><a class="cordetela" href="../Controlador/sair.php">Sair</a></li>
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
