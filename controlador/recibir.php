<?php

require_once "../modelo/CRUDEntradas.php";

// Verificar si se recibieron los datos esperados
if (!isset($_POST['total']) || !isset($_POST['productos']) || !isset($_POST['fecha'])) {
    die('Error: Los datos recibidos no son válidos.');
}

// Obtener el total y los productos del carrito
$total = $_POST['total'];
$productos = json_decode($_POST['productos'], true);
$fecha = $_POST['fecha'];

// Verificar si se pudo decodificar el JSON correctamente
if ($productos === null && json_last_error() !== JSON_ERROR_NONE) {
    die('Error al decodificar JSON de productos: ' . json_last_error_msg());
}

// Instanciar la clase para manejar las operaciones con la base de datos
$crudEntradas = new Entradas(); // Asegúrate de que esta clase esté definida correctamente

try {
    // Iniciar la transacción
    $conexion = Conexion::getConexion();
    $conexion->beginTransaction();

    // Obtener el último ticket
    $stmt_ticket = $conexion->query("SELECT MAX(ticket) AS ultimo_ticket FROM venta");
    $resultado_ticket = $stmt_ticket->fetch(PDO::FETCH_ASSOC);
    $ultimo_ticket = $resultado_ticket['ultimo_ticket'];

    // Generar nuevo ticket incrementando el último valor
    $nuevo_ticket = str_pad(intval($ultimo_ticket) + 1, 5, '0', STR_PAD_LEFT);

    // Insertar la venta y obtener el ID de la venta
    $stmt_venta = $conexion->prepare("INSERT INTO venta (fecha, monto, ticket) VALUES (?, ?, ?)");
    $stmt_venta->bindParam(1, $fecha, PDO::PARAM_STR);
    $stmt_venta->bindParam(2, $total, PDO::PARAM_STR);
    $stmt_venta->bindParam(3, $nuevo_ticket, PDO::PARAM_STR);
    $stmt_venta->execute();
    $ventaid = $conexion->lastInsertId();
    // Guardar el ID de la venta en la sesión
    session_start();
    $_SESSION['ventaid'] = $ventaid;
    // Iterar sobre los productos para insertarlos en la base de datos
    foreach ($productos as $producto) {
        $registros = array(
            'precio' => $producto['precio'],
            'cantidad' => $producto['cantidad'],
            'subtotal' => $producto['subtotal'],
            'ventaid' => $ventaid,
            'codigoid' => $producto['codigo']
        );

        // Insertar los detalles del producto en la tabla "detalle"
        $stmt_detalle = $conexion->prepare("INSERT INTO detalle (precio, cantidad, subtotal, codigoid, ventaid) VALUES (?, ?, ?, ?, ?)");
        $stmt_detalle->bindParam(1, $registros['precio'], PDO::PARAM_STR);
        $stmt_detalle->bindParam(2, $registros['cantidad'], PDO::PARAM_INT);
        $stmt_detalle->bindParam(3, $registros['subtotal'], PDO::PARAM_STR);
        $stmt_detalle->bindParam(4, $registros['codigoid'], PDO::PARAM_STR);
        $stmt_detalle->bindParam(5, $registros['ventaid'], PDO::PARAM_INT);
        $stmt_detalle->execute();

        // Manejar el resultado si es necesario (por ejemplo, loguearlo o procesarlo)
        if ($stmt_detalle->rowCount() > 0) {
            // Éxito al insertar el producto
            echo "Producto insertado correctamente: " . json_encode($registros) . "\n";
        } else {
            // Error al insertar el producto
            echo "Error al insertar el producto: " . json_encode($registros) . "\n";
        }
    }

    // Commit de la transacción si todo fue exitoso
    $conexion->commit();

} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conexion->rollback();

    // Respuesta de error
    echo json_encode(['status' => 'error', 'mensaje' => 'Error: ' . $e->getMessage()]);
}

$conexion = null;


?>