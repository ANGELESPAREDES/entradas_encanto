<?php
session_start();
    require_once "../modelo/CRUDUsuario.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['txtusuario'];
    $clave = $_POST['txtclave'];

    $datos = [
        'usuario' => $usuario,
        'clave' => $clave
    ];

    $usuarioModel = new Usuarios();
    $usuarioModel->login($datos);
}
?>