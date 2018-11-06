<?php

  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaUsuários.php');

  $request = array_map("trim", $_REQUEST);
  $request = filter_var_array($request, [

    'id' => FILTER_VALIDATE_INT

  ]);

  $id = $request['id'];

  $erros = [];

  // ===== Validação do Arquivo
  if (array_key_exists('arq', $_FILES) == false){

		$erros[] = 'Arquivo não carregado';

	} else {

		$arq = $_FILES['arq'];

		$pastaDestino = "FotosDePerfil/aluno_$id";
		mkdir("../Imagens/$pastaDestino");

		$nomeOrig = basename($arq['name']);
		$nomeArq = "foto_perfil-$id-$nomeOrig";

		$caminhoCompleto = "$pastaDestino/$nomeArq";
    $caminhoCompleto = str_replace(' ', '', $caminhoCompleto);

		if($arq['error'] != UPLOAD_ERR_OK){

			$erros[] = 'Erro ao carregar o arquivo para o servidor';

		} else if (move_uploaded_file($arq['tmp_name'], "../Imagens/$caminhoCompleto")  == false){

			$erros[] = "Erro ao salvar o arquivo no servidor";

		}
  }

  if( empty($erros) == false){

    foreach ($erros as $erro){

  		$text = $text.' | '.$erro;
  		header('Location: perfil.php?erros='.urlencode($text));
  	}

  } else {

    AlteraFoto("../Imagens/".$caminhoCompleto, $id);

    header('Location: perfil.php');

  }

?>
