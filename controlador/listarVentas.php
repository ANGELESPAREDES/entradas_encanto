<?php
require_once "../modelo/CRUDEntradas.php";

$listado = new Entradas;
$registros = $listado->listarProductos();

$cards = '';
foreach ($registros as $fila) {
    $codigo = $fila['codigo'];
    $producto = strtoupper($fila['producto']);
    $precio = $fila['precio'];
    $cards .= '
    <div class="col-md-4 mb-4">
        <div class="card d-flex flex-row">
         <img src="./imagenes/' . $codigo.'.jpg' . '" class="card-img-left" style="width: 150px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-subtitle mb-2 text-muted">' . $producto .' -    S/' .    $precio  .'</h5>
                <button class="btn btn-success" data-id="' . $codigo . '">Añadir al carrito</button> 
            </div>
        </div>
    </div>';
}

echo $cards;
?>
