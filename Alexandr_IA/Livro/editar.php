<?php
  session_start();
  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaLivros.php');
  $idLivro = $_SESSION['idLivro'];
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
  	  ?></div><br>
		<form method="POST" action="editaLivro.php">
			<table>
				<tr>
					<td>
						<div class="linha">
							<label>Autor: <input type='text' class="caixa" name="autor"></label>
						</div>
						<br>
						<div class="linha">
							<label>Aquisição: <input type='date' class="caixa" name="aquisicao"></label>
						</div>
						<br>
						<div class="linha">
							<label>Classificação: <input type='text' class="caixa" name="classificacao"></label>
						</div>
						<br>
						<div class="linha">
							<label>Edição: <input type='number' class="caixa" name="edicao"></label>
						</div>
						<br>
						<div class="linha">
							<label>Editora: <input type='text' class= "caixa" name="editora"></label>
						</div>
						<br>
						<div class="linha">
							<label>Exemplares: <input type='number' class="caixa" name="qtd_exemplares"></label>
						</div>
						<br>
						<div class="linha">
							<label>Observação: <input type='text' class="caixa" name="observacao"></label>
						</div>
						<br>
						<div class="linha">
							<label>Título: <input type='text' class="caixa" name="titulo"></label>
						</div>
						<br>
						<div class="linha">
							<label>Volume: <input type='text' class="caixa" name="volume"></label>
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
