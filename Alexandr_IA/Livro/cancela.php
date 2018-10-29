<?php

  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaEmprestimo.php');

  $id_reserva = $_REQUEST['id_reserva'];
  $id_livro = $_REQUEST['id_livro'];

  CancelaReserva($id_reserva);
  $texto = urlencode('Reserva de Livro Cancelada');

  Header('Location: detalhesLivro.php?idLivro='.$id_livro.'&erro='.$texto);

?>
