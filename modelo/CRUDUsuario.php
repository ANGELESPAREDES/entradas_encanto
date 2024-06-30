<?php
// llamamos a la conexión 
require_once "conexion.php";

// crear las operaciones CRUD
class Usuarios extends Conexion { 

    public function login($datos){
        try {
            // Iniciar sesión
            session_start();
            
            // llamar al procedimiento almacenado con la cantidad de parámetros
            $sql = "CALL login(?, ?)";
            $query = Conexion::getConexion()->prepare($sql); // llamamos a la conexión
            $query->bindParam(1, $datos['usuario'], PDO::PARAM_STR);
            $query->bindParam(2, $datos['clave'], PDO::PARAM_STR);
            $query->execute();
            $datos = $query->fetch(PDO::FETCH_OBJ);

            // Verificar si se obtuvo un resultado
            if ($datos === FALSE) {
                echo "Login fallido: usuario o clave incorrectos.";
                return header('Location: ../index.php');
            } elseif ($query->rowCount() == 1) {
                $_SESSION['usuario'] = $datos->usuario;
                $_SESSION['rol'] = $datos->rol;

                // Debug: Mostrar el rol obtenido
                echo "Rol obtenido: " . $datos->rol . "<br>";

                // Redirigir según el rol del usuario
if ($datos->rol === 'administrador') {
    echo "Login exitoso: redireccionando a administrador.php.";
    return header('Location: ../administrador.php');
} elseif ($datos->rol === 'ventas') {
    echo "Login exitoso: redireccionando a ventas.php.";
    return header('Location: ../ventas.php');
} else {
    // Si no se encontró un rol específico, redirigir a una página por defecto
    echo "Usuario sin rol definido: redireccionando a pagina_por_defecto.php.";
    return header('Location: ../login.php');
}
}

            // Retornar todos los datos obtenidos
            return $query->fetchAll();
        } catch (PDOException $ex) {
            echo "Error al listar los datos: " . $ex->getMessage();
        } finally {
            $query = null; // cerramos la conexión
        }
    }
}
?>
