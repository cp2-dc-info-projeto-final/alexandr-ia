<?php

  require_once('../Modelo/TabelaUsuários.php');
  $request = array_map("trim", $_REQUEST);
  $request = filter_var_array($request, [

    'matricula' => FILTER_DEFAULT,
    'nome' => FILTER_DEFAULT,
    'email' => FILTER_VALIDATE_EMAIL,
    'senha' => FILTER_DEFAULT,
    'confirmarSenha' => FILTER_DEFAULT

  ]);

  $erros = [];

  // ===== Validação do Nome

  if ($request['nome'] == false){

    $erros[] = "Campo do nome inexistente ou inválido";

  } else if (strlen($request['nome']) > 127 || strlen($request['nome']) < 3){

    $erros[] = "O campo nome deve ter no mínimo 3 e no máximo 127 dígitos";

  }

  // ======
  // ===== Validação da Matricula

  if($request['matricula'] == false){

    $erros[] = "Campo da matrícula inexistente ou inválido";

  } else if (strlen($request['matricula']) > 31 ){

    $erros[] = "O campo matricula precisa ter menos que 31 dígitos";

  }

  // ======
  // ===== Validação do E-mail

  if ($request['email'] == false){

    $erros[] = "Campo de e-mail inexistente ou inválido";

  }

  if(MesmoEmail($request['email']) == 1){

	$erros[] = "Não podem haver contas com mesmo email";

  };

  // ======
  // ===== Validação da Senha

  if ($request['senha'] == false){

    $erros[] = "Campo da senha inexistente ou inválido";
	
  } 
  
  $senha = $request['senha'];
  $senha = strval($senha);
  
  if (strlen($senha) < 6 || strlen($senha) > 15) {

	$erros[] = "O campo senha deve ter no mínimo 6 e no máximo 15 dígitos";
	

  }

  // ======
  // ===== Validação da Confirmação da Senha

  if ($request['confirmarSenha'] != $request['senha']){

    $erros[] = "As senhas informadas devem ser iguais";

  }

  //"Criptografar" a senha
  else {
	$request['senha'] = password_hash($request['senha'], PASSWORD_DEFAULT);
  }

  if (count($erros) == 0){
	echo ('<html>
			<head>
				<link rel="stylesheet" type="text/css" href="../ArquivosStyle/FolhaDeEstilo.css">
				<title> Cadastrar </title>
				<meta charset="utf-8">
			</head>
			<body>
				<h1>Biblioteca CPII - Caxias</h1>
				<p>Cadastro Realizado com Sucesso!</p>
        <br>
        <a href="../index.php">Voltar para Tela de Inicial</a>
			</body>
		</html>');

    //insere usuário
	$novoUsuario = [
		'matricula' => $request['matricula'],
		'nome' => $request['nome'],
		'email' => $request['email'],
		'senha' => $request['senha']
	];

	InsereUsuario($novoUsuario);

  } else {

	foreach ($erros as $erro){

		$text = $text.' | '.$erro;
		header('Location: pagCadastro.php?erros='.urlencode($text));
	}

  }

?>
