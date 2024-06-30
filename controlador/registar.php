<?php
require_once '../modelo/conexion.php';

try {
    // Obtener conexión a la base de datos
    $conexion = Conexion::getConexion();

    // Comenzar transacción
    $conexion->beginTransaction();

    // Obtener el último código de producto
    $stmt_codigo = $conexion->query("SELECT MAX(codigo) AS codigo FROM productos");
    $resultado_codigo = $stmt_codigo->fetch(PDO::FETCH_ASSOC);
    $codigo = $resultado_codigo['codigo'];

    // Generar nuevo código de producto
    $codigo = str_pad(intval($codigo) + 1, 5, '0', STR_PAD_LEFT);

    // Verificar que los datos necesarios están presentes en la solicitud POST
    if (!isset($_POST['producto']) || !isset($_POST['precio']) || !isset($_FILES['imagen'])) {
        throw new Exception('Datos del producto incompletos.');
    }

    // Procesar la imagen
    $imagen = $_FILES['imagen'];
    if ($imagen['error'] != 0) {
        throw new Exception('Error en la carga de la imagen.');
    }

    $imagenTmpPath = $imagen['tmp_name'];
    $imagenNombre = $codigo . '.jpg'; // Asigna el nombre de la imagen basado en el código del producto
    $carpetaDestino = '../imagenes/'; // Carpeta donde se guardarán las imágenes

    if (!move_uploaded_file($imagenTmpPath, $carpetaDestino . $imagenNombre)) {
        throw new Exception('Error al mover la imagen a la carpeta destino.');
    }

    // Capturar datos del formulario
    $producto = mb_strtoupper($_POST['producto']);
    $precio = $_POST['precio'];
    $imagenRuta = $carpetaDestino . $imagenNombre;

    // Preparar consulta para insertar producto
    $stmt = $conexion->prepare("INSERT INTO productos (codigo, producto, precio, imagen) VALUES (?, ?, ?, ?)");
    $stmt->bindParam(1, $codigo, PDO::PARAM_STR);
    $stmt->bindParam(2, $producto, PDO::PARAM_STR);
    $stmt->bindParam(3, $precio, PDO::PARAM_STR);
    $stmt->bindParam(4, $imagenRuta, PDO::PARAM_STR);
    $stmt->execute();

    // Confirmar transacción
    $conexion->commit();

    echo "Producto agregado correctamente.";
} catch (PDOException $e) {
    // Revertir la transacción si hay un error de PDO
    $conexion->rollBack();
    echo "Error al agregar el producto (PDO): " . $e->getMessage();
} catch (Exception $e) {
    // Revertir la transacción si hay un error general
    $conexion->rollBack();
    echo "Error al agregar el producto: " . $e->getMessage();
}
?>
