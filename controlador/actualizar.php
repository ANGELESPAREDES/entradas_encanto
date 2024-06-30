
<?php 
require_once "../modelo/CRUDEntradas.php";

$registros = array(
    'codigo' => $_POST['codigoa'],
    'producto' => $_POST['productoa'],
    'precio' => $_POST['precioa']
);
$cli = new Entradas;
echo $cli->actualizarProductos($registros);

?>

