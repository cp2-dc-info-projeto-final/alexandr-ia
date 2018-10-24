<?php

  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaUsuários.php');

  $id = $_REQUEST['id'];
  $matricula = $_REQUEST['matricula'];

  AlteraMatricula($id, $matricula);

  header('Location: Listagem_Usuarios.php');

?>
