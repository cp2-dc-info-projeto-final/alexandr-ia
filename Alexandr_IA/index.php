<?php

	session_start();

	require_once('Modelo/CriaConexao.php');
	require_once('Modelo/TabelaUsuários.php');

	$listaErros = null;

	if ( empty($_SESSION['emailUsuarioLogado']) == false ){

		header('Location: PaginaInicial/PaginaInicial.php');
		exit();

	}

	if (array_key_exists('erro', $_SESSION) == true){

		$erros = $_SESSION['erro'];

		foreach($erros as $erro){

			$listaErros[] = $erro;

		}

	}

	if (isset($_SESSION['confirmacao']) == true){

		if($_REQUEST['confirmacao'] == $_SESSION['confirmacao']){

			InsereUsuario($_SESSION['dados'], 0);

			$listaErros[] = 'Cadastro confirmado';

		} else {

			$listaErros[] = 'Erro na Confirmação do Cadastro';

		}

		unset($_SESSION['dados']);
		unset($_SESSION['confirmacao']);

	}

?>
<html>
  <head>
    <title>Login</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="ArquivosStyle/FolhaDeEstilo.css">

  </head>
  <body>
    <h1>Biblioteca CPII - Caxias</h1>
    <center>

		<?php

		if ($listaErros != null){

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

			echo('<div id="caixaErros">ERRO: <br>');

			foreach($listaErros as $erro){

				echo($erro.' | ');

			}

			echo('</div>');

			unset($_SESSION['erro']);

		}


		?>

        <form method="post" action="Controlador/entrar.php">
          <table style="margin-top:35px;">
            <tr>
              <td>
                <div><label>E-mail: </label> <input  class="caixa"type = "text" name="email" required></div><br>
                <div><label>Senha: </label> <input  class="caixa" type = "password" name="senha" minlength="6" maxlength="15" required></div><br>
                <div><input type = "checkbox"> <label>Permanecer logado</label></div><br>
                <input id="amazing_button" style="margin-bottom:20px;" type = "submit" value = "Login"></div><br>
                <a href="" >Esqueci minha senha</a><br>
                <a href="CadastroAluno/pagCadastro.php">Não sou cadastrado</a>
              </td>
            </tr>
          </table>
        </form>
    </center>
  </body>
</html>
