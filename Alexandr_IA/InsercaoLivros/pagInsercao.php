<html>

	<head>
	
		<title>Página de Inserção de Livros</title>
		<link rel="stylesheet" type="text/css" href="../ArquivosStyle/FolhaDeEstilo.css">
		<meta charset='utf-8'>
		
		<style>
		
			body{
				
				margin-top: 5%;
				
			}
		
		</style>
	
	</head>
	
	<body>
	
		<a href="">Voltar para a página de Perfil</a>
		<h1>Biblioteca CPII - Caxias</h1>
		<br>
		<p id="subtitulo">Inserção de Livro</p>
	
		<center>
		<form method="POST" action="insereLivro.php">		
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
							<label>Edição: <input type='text' class="caixa" name="edicao"></label>
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
						
						<center><input id="submito2018" type="submit" value="Inserir Livro"></center>
			
					</td>
				</tr>
			</table>
		
		</form>
		</center>
	
	</body>

</html>