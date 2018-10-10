<?php
  session_start();
  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaLivros.php');
  $idLivro = $_SESSION['idLivro'];

  //Validação
  $request = array_map("trim", $_REQUEST);
  $request = filter_var_array($request, [

    'autor' => FILTER_DEFAULT,
    'aquisicao' => FILTER_DEFAULT,
    'classificacao' => FILTER_DEFAULT,
    'edicao' => FILTER_DEFAULT,
    'editora' => FILTER_DEFAULT,
    'qtd_exemplares' => FILTER_VALIDATE_INT,
    'observacao' => FILTER_DEFAULT,
    'titulo' => FILTER_DEFAULT,
    'volume' => FILTER_DEFAULT
  ]);

  $erros = [];

  if($request['aquisicao'] == false){
    $erros[] = "Aquisição não informado";
  }

  if($request['classificacao'] == false){
    $erros[] = "Classificação não informado";
  }

  if($request['edicao'] == false){
    $erros[] = "Edição não informado";
  }


  if($request['qtd_exemplares'] == false){
    $erros[] = "Quantidade de Exemplares não informado";
  }


  if($request['titulo'] == false){
    $erros[] = "Título não informado";
  }

  if(MesmaClassificacao($request['classificacao']) == 1){
    $erros[] = "Não pode haver livros com a mesma classificação";
  }

  //Validação dos erros
  if(empty($erros) == false){
      session_start();
  	  $_SESSION['errosInsercao'] = $erros;
  		header('Location: editar.php');
  	} else {

    $autor = $request['autor'];
    $aquisicao = $request['aquisicao'];
    $classificacao = $request['classificacao'];
    $edicao = $request['edicao'];
    $editora = $request['editora'];
    $qtd_exemplares = $request['qtd_exemplares'];
    $observacao = $request['observacao'];
    $titulo = $request['titulo'];
    $volume = $request['volume'];

    AlteraLivro($autor, $aquisicao, $classificacao, $edicao, $editora, $qtd_exemplares, $observacao, $titulo, $volume, $idLivro);

    header('Location: detalhesLivro.php?idLivro='.$idLivro);

  }

?>
