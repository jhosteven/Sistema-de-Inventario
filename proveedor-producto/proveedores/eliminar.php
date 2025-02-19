<?php
include '../includes/db.php';

// Obtener el ID del proveedor a eliminar
$id = $_GET['id'];

// Eliminar el proveedor
$stmt = $conn->prepare("DELETE FROM proveedores WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

header("Location: listar.php"); // Redirigir a la lista de proveedores
exit();
?>