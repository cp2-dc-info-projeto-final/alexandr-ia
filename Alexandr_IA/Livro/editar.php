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
  require_once('../Modelo/TabelaLivros.php');
  $idLivro = $_SESSION['idLivro'];
  $informacoes = DetalhaLivro($idLivro);
	if(array_key_exists('errosInsercao', $_SESSION) == true){
		$erros = $_SESSION['errosInsercao'];
	}
?>
<html>
	<head>
  	<title>Editar Livro</title>
    <link rel="stylesheet" type="text/css" href="../ArquivosStyle/FolhaDeEstilo.css">
  	<meta charset="utf-8">
    <style>
      body{
        margin-top: 5%;
      }
      .linha{
        padding-bottom: 3px;
      }
    </style>
	</head>
  <body>
    <a href="detalhesLivro.php?idLivro=<?php echo($idLivro);?>">Voltar para a página do Livro</a>
		<h1>Biblioteca CPII - Caxias</h1>
		<br>
		<p id="subtitulo">Editar Livro</p>
		<?php
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
         echo('ERRO: <br>');
    	   foreach($erros as $item){
    		   echo(' | '.$item);
    		 }
         unset($_SESSION['errosInsercao']);
       }
  	  ?></div><br>
		<form method="POST" action="editaLivro.php">
			<table>
				<tr>
					<td>
						<div class="linha">
							<label>Autor: <input type='text' class="caixa" name="autor" value="<?= $informacoes['autor']?>"></label>
						</div>
						<br>
						<div class="linha">
							<label>Aquisição: <input type='date' class="caixa" name="aquisicao" value="<?= $informacoes['aquisicao']?>"></label>
						</div>
						<br>
						<div class="linha">
							<label>Classificação: <input type='text' class="caixa" name="classificacao" value="<?= $informacoes['classificacao']?>"></label>
						</div>
						<br>
						<div class="linha">
							<label>Edição: <input type='number' class="caixa" name="edicao" value="<?= $informacoes['edicao']?>"></label>
						</div>
						<br>
						<div class="linha">
							<label>Editora: <input type='text' class= "caixa" name="editora" value="<?= $informacoes['editora']?>"></label>
						</div>
						<br>
						<div class="linha">
							<label>Exemplares: <input type='number' class="caixa" name="qtd_exemplares" value="<?= $informacoes['exemplar']?>"></label>
						</div>
						<br>
						<div class="linha">
							<label>Observação: <input type='text' class="caixa" name="observacao" value="<?= $informacoes['observacao']?>"></label>
						</div>
						<br>
						<div class="linha">
							<label>Título: <input type='text' class="caixa" name="titulo" value="<?= $informacoes['titulo']?>"></label>
						</div>
						<br>
						<div class="linha">
							<label>Volume: <input type='text' class="caixa" name="volume" value="<?= $informacoes['volume']?>"></label>
						</div>
						<br>
						<center><input id="amazing_button" type="submit" value="Editar Livro"></center>
					</td>
				</tr>
			</table>
		</form>
		</center>
  </body>
</html>
