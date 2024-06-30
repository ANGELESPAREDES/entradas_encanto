<?php
// eliminar.php

require_once('../modelo/CRUDEntradas.php');

// Verificar si se recibió el parámetro 'codigo' por POST
if (isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
    $cli = new Entradas;

    // Llamar al método para eliminar el producto
    $resultado = $cli->eliminarProductos($codigo);

    // Devolver resultado como JSON
    echo json_encode($resultado);
} else {
    // Si no se recibió el código, devolver un error
    echo json_encode(["error" => "No se recibió el código de producto"]);
}
?>
