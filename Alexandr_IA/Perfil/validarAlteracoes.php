<?php

  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaUsuários.php');

  $request = array_map("trim", $_REQUEST);
  $request = filter_var_array($request, [

    'nome' => FILTER_DEFAULT,
    'id' => FILTER_VALIDATE_INT

  ]);

  $erros = [];

  // ===== Validação do Nome

  if ($request['nome'] == false){

    $erros[] = "Campo do nome inexistente ou inválido";

  } else if (strlen($request['nome']) > 127 || strlen($request['nome']) < 3){

    $erros[] = "O campo nome deve ter no mínimo 3 e no máximo 127 dígitos";

  }

  $nome = $request['nome'];
  $id = $request['id'];

  // ===== Validação do Arquivo
  if (array_key_exists('arq', $_FILES) == false){

		$erro = 'Arquivo não carregado';

	} else {

		$arq = $_FILES['arq'];

		$pastaDestino = "FotosDePerfil/aluno_$id";
		mkdir("../$pastaDestino");

		$nomeOrig = basename($arq['name']);
		$nomeArq = "foto_perfil-$id-$nomeOrig";

		$caminhoCompleto = "$pastaDestino/$nomeArq";

		if($arq['error'] != UPLOAD_ERR_OK){

			$erro = 'Erro ao carregar o arquivo para o servidor';

		} else if (move_uploaded_file($arq['tmp_name'], "../$caminhoCompleto")  == false){

			$erro = "Erro ao salvar o arquivo no servidor";

		}
  }

  if( empty($erros) == false){

    foreach ($erros as $erro){

  		$text = $text.' | '.$erro;
  		header('Location: perfil.php?erros='.urlencode($text));
  	}

  } else {

    AlteraUsuario($nome, NULL, $id);

    header('Location: perfil.php');

  }

?>
