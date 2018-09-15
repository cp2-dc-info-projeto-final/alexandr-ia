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
      <style> #caixaErros{visibility:visible} </style>
      
      ');
    
    }
  
  ?>
	<div id='caixaErros'>ERRO: 
  <?php
  
   foreach($_REQUEST as $item){

     print($item);
     
     }
  
  ?></div>
    <p id="subtitulo">Aluno e Professor</p>
      <center>
      <form method="post" action="cadastraUsuario.php">
        <table>
          <tr>
            <td>
              <div class="linha"><label>Matrícula:</label> <input class="caixa" type="text"name='matricula'><br></div>
              <div class="linha"><label>Nome:</label> <input class="caixa" type="text"name='nome'><br></div>
              <div class="linha"><label>Email:</label> <input class="caixa" type="email"name='email'><br></div>
              <div class="linha"><label>Senha:</label> <input class="caixa" type="password"name='senha'><br></div>
              <div class="linha"><label>Confirmar senha:</label> <input class="caixa" type="password" name='confirmarSenha'><br></div>
            </td>
          </tr>
        </table>
        <input id="submito2018" type="submit" value = "Cadastrar"><br>
      </form>
	  <a href="../LoginAluno/paginaLogin.html">Fazer Login</a>
    </center>
  </body>
</html>
