<?php

  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaEmprestimo.php');

  $id_usuario = $_REQUEST['id_usuario'];
  $id_livro = $_REQUEST['id_livro'];

  $id_emprestimo = ProcuraIdEmprestimo($id_usuario, $id_livro);

  CancelaPreEmprestimo($id_emprestimo);

  $mensagem = 'Empréstimo cancelado';
  Header("Location: detalhesLivro.php?idLivro=$id_livro&erro=$mensagem");

?>
