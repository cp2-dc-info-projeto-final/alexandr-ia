<?php

  session_start();

  unset($_SESSION['emailUsuarioLogado']);
  header('Location: ../LoginAluno/paginaLogin.php');

?>