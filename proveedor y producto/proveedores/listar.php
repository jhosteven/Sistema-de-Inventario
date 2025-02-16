<?php
include '../includes/db.php';

$stmt = $conn->query("SELECT * FROM proveedores");
$proveedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listar Proveedores</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Lista de Proveedores</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Dirección</th>
        </tr>
        <?php foreach ($proveedores as $proveedor): ?>
        <tr>
            <td><?php echo $proveedor['id']; ?></td>
            <td><?php echo $proveedor['nombre']; ?></td>
            <td><?php echo $proveedor['apellido_paterno']; ?></td>
            <td><?php echo $proveedor['apellido_materno']; ?></td>
            <td><?php echo $proveedor['correo']; ?></td>
            <td><?php echo $proveedor['telefono']; ?></td>
            <td><?php echo $proveedor['direccion']; ?></td>
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