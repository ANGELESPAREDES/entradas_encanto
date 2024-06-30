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
    <div class="col-md-4 mb-3" >
        <div class="card d-flex flex-row">
        <img src="./imagenes/' . $codigo.'.jpg' . '" class="card-img-left" style="width: 150px; object-fit: cover;">
        <br>
                <br>
            <div class="card-body" >
                <h6 class="card-subtitle mb-2 text-muted">Cod. ' . $codigo . '</h6>
                <h5 class="card-title">' . $producto . '</h5>
                <h6 class="card-subtitle mb-2 text-muted">S/. ' . $precio . ' </h6>

               <div class="d-flex ">
                    <button class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#actualizar" onclick="obtenerId('. "'$codigo'".')">Editar</button>
                    <button class="btn btn-danger" onclick="eliminar('. "'$codigo'".')">Eliminar</button>
                </div>
            </div>
        </div>
    </div>';
}

echo $cards;
?>
