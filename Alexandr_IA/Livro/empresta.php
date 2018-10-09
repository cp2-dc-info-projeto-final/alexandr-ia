<?php

  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaEmprestimo.php');

  $id_usuario = $_REQUEST['id_usuario'];
  $id_livro = $_REQUEST['id_livro'];

  $possivelErro = Empresta($id_usuario, NULL, $id_livro);

  if( empty($possivelErro) == false){

    Header('Location: detalhesLivro.php?idLivro='.$id_livro.'&erro='.$possivelErro);
    exit();

  }

  Header('Location: detalhesLivro.php?idLivro='.$id_livro);

?>
