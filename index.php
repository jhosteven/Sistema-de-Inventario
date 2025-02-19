<?php

include 'proveedor-producto/includes/db.php';

session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");  // Redirigir a la página de login si no está autenticado
    exit;
}else{
    header("Location: menu.php");
}

// Si llega hasta aquí, el usuario está autenticado
echo "Bienvenido a tu panel de administración, " . $_SESSION['nombre_usuario'];


?>


