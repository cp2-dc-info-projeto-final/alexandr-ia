 <html>
  <head>
  <link rel="stylesheet" type="text/css" href="../ArquivosStyle/FolhaDeEstilo.css">
    <title> Cadastrar </title>
    <meta charset="utf-8">
  </head>
  <body>
    <h1>Biblioteca CPII - Caxias</h1>
	<?php

  if(count($_REQUEST) != 0){

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

		<div id='caixaErros'>ERRO:
	  <?php

	   foreach($_REQUEST as $item){

		 print($item);

		 }

	  ?></div>

	</center>

    <p id="subtitulo">Aluno e Professor</p>
      <center>
      <form method="post" action="cadastraUsuario.php" novalidate>
        <table>
          <tr>
            <td>

              <div class="linha">

			  <label>Matrícula:

				  <input
					class="caixa"
					type="text"
					name='matricula'
					maxlength="31"
					required
				  >

			  </label>

			  <br>
			  </div>

              <div class="linha">
			  <label>Nome:

				  <input
					class="caixa"
					type="text"
					name='nome'
					minlength="3"
					maxlength="127"
					required
				  >

			  </label>

			  <br>
			  </div>

              <div class="linha">

			  <label>Email:

				  <input
					class="caixa"
					type="email"
					name='email'
					required
				  >

			  </label>

			  <br>
			  </div>

              <div class="linha">

			  <label>Senha:

				  <input
					class="caixa"
					type="password"
					name='senha'
					minlength="6"
					maxlength="15"
					required
				  >

			  </label>

			  <br>
			  </div>

              <div class="linha">

			  <label>Confirmar senha:

				  <input
					class="caixa"
					type="password"
					name='confirmarSenha'
					minlength="6"
					maxlength="15"
					required
				  >

			  </label>

			  <br>
			  </div>

            </td>
          </tr>
        </table>
        <input id="amazing_button" type="submit" value = "Cadastrar"><br>
      </form>
	  <a href="../index.php">Fazer Login</a>
    </center>
  </body>
</html>
