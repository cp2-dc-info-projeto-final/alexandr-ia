<?php

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

  // ======
  // ===== Validação da Senha

  if ($request['senha'] == false){

    $erros[] = "Campo da senha inexistente ou inválido";

  } else if (strlen($request['senha']) > 15 || strlen($request['senha'] < 6)) {



  }

  // ======
  // ===== Validação da Confirmação da Senha

  if ($request['confirmarSenha'] != $request['senha']){

    $erros[] = "As senhas informadas devem ser iguais";

  }

  if (count($erros) == 0){

    //insere usuário

  } else {

    header(' Location: pagCadastro.php');

  }

?>
