<?php

	require_once('../Modelo/CriaConexao.php');
	require_once('../Modelo/TabelaUsuários.php');

	$erro = [];

	$request = array_map('trim', $_REQUEST);
	$request = filter_var_array(
	               $request,
	               [ 'email' => FILTER_VALIDATE_EMAIL,
	                 'senha' => FILTER_DEFAULT ]
	           );

	$email = $request['email'];
	$senha = $request['senha'];

	$bd = CriaConexãoBd();
	$sql_1 = $bd -> prepare('SELECT email FROM usuario WHERE email = :email');
	$sql_1 -> bindValue(':email', $email);
	$sql_1 -> execute();

	$sql_2 = $bd -> prepare('SELECT senha FROM usuario WHERE email = :email');
	$sql_2 -> bindValue(':email', $email);
	$sql_2 -> execute();

	$sql_2 = $sql_2 -> fetch();
	$hash = $sql_2['senha'];

	if ($email == false)
	{
		$erro[] = "E-Mail não informado";
	}
	else if ($sql_1 -> rowCount() == 0)
	{
		$erro[] = "Nenhum cliente encontrado para este E-Mail";
	}
	else if ($senha == false)
	{
		$erro[] = "Senha não informada";
	}

	require_once('../Modelo/CriaConexao.php');
	require_once('../Modelo/TabelaUsuários.php');

	$usuario = InfosUsuario($email);

	/* if ($usuario['banido'] == 1){

		$erro[] = 'Este e-mail está banido, portanto impedido de acessar o sistema. Dúvidas, contate o bibliotecário do campus.';

	} */

		if (password_verify($senha, $hash) && count($erro) == 0){

		session_start();
		$_SESSION['emailUsuarioLogado'] = $email;

		header('Location: ../PaginaInicial/PaginaInicial.php');
		exit();

	}

	else
	{
		$erro[] = "Senha inválida";
	}

	session_start();

	$_SESSION['erro'] = $erro;
	header('Location: ../index.php');

?>
