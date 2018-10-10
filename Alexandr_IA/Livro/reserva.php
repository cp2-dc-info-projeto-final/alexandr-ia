<?php

  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaEmprestimo.php');

  $id_usuario = $_REQUEST['id_usuario'];
  $id_livro = $_REQUEST['id_livro'];

  $possivelErro = Reserva($id_usuario, $id_livro);

  if( empty($possivelErro) == true){

    Header('Location: detalhesLivro.php?idLivro='.$id_livro);

  } else {

    Header('Location: detalhesLivro.php?idLivro='.$id_livro.'&erro='.$possivelErro);

  }

?>
