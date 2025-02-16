<?php
$host = 'localhost';
$dbname = 'ferreteria';
$username = 'root'; // Usuario por defecto de XAMPP
$password = ''; // Contraseña por defecto de XAMPP

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>