<?php

require_once('../modelo/CRUDEntradas.php');

$codigo=$_POST['codigo'];



$en=new Entradas;
echo json_encode($en->obtenerId($codigo));

?>
