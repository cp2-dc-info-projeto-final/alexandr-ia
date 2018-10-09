<?php

  $id_usuario = $_REQUEST['id_usuario'];
  $id_livro = $_REQUEST['id_livro'];

  Reserva($id_usuario, $id_livro);

  Header('Location: detalhesLivro.php?idLivro='.$id_livro);

?>
