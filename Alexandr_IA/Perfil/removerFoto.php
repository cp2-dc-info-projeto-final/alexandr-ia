<?php

  require_once('../Modelo/TabelaUsuários.php');
  require_once('../Modelo/CriaConexao.php');

  $id = $_REQUEST['id'];
  AlteraFoto(NULL, $id);

  header('Location: perfil.php');

?>
