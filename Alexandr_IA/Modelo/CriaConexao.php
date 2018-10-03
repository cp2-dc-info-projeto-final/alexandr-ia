<?php

function CriaConexãoBd(){
  $bd = new PDO('mysql:host=localhost;
  dbname=alexandria;charset=utf8',
  'alexandria',
  'bibliteclinha'
);

  $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $bd;
}

?>
