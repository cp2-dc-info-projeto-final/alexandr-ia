<?php

  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaUsuários.php');

  $request = array_map("trim", $_REQUEST);
  $request = filter_var_array($request, [

    'matricula' => FILTER_DEFAULT,
    'nome' => FILTER_DEFAULT,
    'id' => FILTER_DEFAULT

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

  if( empty($erros) == false){

    foreach ($erros as $erro){

  		$text = $text.' | '.$erro;
  		header('Location: perfil.php?erros='.urlencode($text));
  	}

  } else {

    $nome = $request['nome'];
    $matricula = $request['matricula'];
    $id = $request['id'];

    AlteraUsuario($nome, $matricula, $id);

    header('Location: perfil.php');

  }

?>
