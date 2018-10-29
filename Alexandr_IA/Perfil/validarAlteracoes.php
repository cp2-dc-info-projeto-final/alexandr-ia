<?php

  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaUsuários.php');

  $request = array_map("trim", $_REQUEST);
  $request = filter_var_array($request, [

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

  if( empty($erros) == false){

    foreach ($erros as $erro){

  		$text = $text.' | '.$erro;
  		header('Location: perfil.php?erros='.urlencode($text));
  	}

  } else {

    $nome = $request['nome'];
    $id = $request['id'];

    AlteraUsuario($nome, NULL, $id);

    header('Location: perfil.php');

  }

?>
