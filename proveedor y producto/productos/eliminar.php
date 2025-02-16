<?php
include '../includes/db.php';

// Obtener el ID del producto a eliminar
$id = $_GET['id'];

// Eliminar el producto
$stmt = $conn->prepare("DELETE FROM productos WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

header("Location: listar.php"); // Redirigir a la lista de productos
exit();
?>