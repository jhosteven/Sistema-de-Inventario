<?php
include '../includes/db.php';

$stmt = $conn->query("SELECT * FROM productos");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listar Productos</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Lista de Productos</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Proveedor ID</th>
        </tr>
        <?php foreach ($productos as $producto): ?>
        <tr>
            <td><?php echo $producto['id']; ?></td>
            <td><?php echo $producto['nombre']; ?></td>
            <td><?php echo $producto['descripcion']; ?></td>
            <td><?php echo $producto['precio']; ?></td>
            <td><?php echo $producto['cantidad']; ?></td>
            <td><?php echo $producto['proveedor_id']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Botón para volver al menú principal -->
    <br>
    <a href="../index.php">
        <button class="btn-menu">Volver al Menú Principal</button>
    </a>
</body>
</html>