<?php

  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaUsuários.php');

  $id = $_REQUEST['id'];
  UnBan($id);

  header('Location: pagLista.php?passou=true');

?>
