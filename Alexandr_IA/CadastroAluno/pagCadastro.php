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
			
              <div class="linha"><label>Matrícula:</label> 
			  
			  <input 
				class="caixa" 
				type="text"
				name='matricula'
				maxlength="31"
				required
			  >
			  
			  <br>
			  </div>
			  
              <div class="linha"><label>Nome:</label> 
			  
			  <input 
				class="caixa" 
				type="text"
				name='nome'
				minlength="3"
				maxlength="127"
				required
			  >
			  
			  <br>			  
			  </div>
			  
              <div class="linha"><label>Email:</label> 
			  
			  <input 
			    class="caixa" 
			    type="email"
			    name='email'
				required
			  >
			  
			  <br>
			  </div>
			  
              <div class="linha"><label>Senha:</label> 
			  
			  <input 
			    class="caixa" 
			    type="password"
			    name='senha'
				minlength="6"
				maxlength="15"
				required
			  >
			  
			  <br>
			  </div>
			  
              <div class="linha"><label>Confirmar senha:</label> 
			  
			  <input 
			    class="caixa" 
			    type="password" 
			    name='confirmarSenha'
				minlength="6"
				maxlength="15"
				required
			  >
			  
			  <br>
			  </div>
			  
            </td>
          </tr>
        </table>
        <input id="submito2018" type="submit" value = "Cadastrar"><br>
      </form>
	  <a href="../LoginAluno/paginaLogin.php">Fazer Login</a>
    </center>
  </body>
</html>
