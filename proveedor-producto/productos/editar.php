<?php
include '../includes/db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM productos WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $proveedor_id = $_POST['proveedor_id'];

    $stmt = $conn->prepare("UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, cantidad = :cantidad, proveedor_id = :proveedor_id WHERE id = :id");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':precio', $precio);
    $stmt->bindParam(':cantidad', $cantidad);
    $stmt->bindParam(':proveedor_id', $proveedor_id);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: listar.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Editar Producto</h1>
    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"><?php echo $producto['descripcion']; ?></textarea><br>

        <label for="precio">Precio:</label>
        <input type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>" required><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" value="<?php echo $producto['cantidad']; ?>" required><br>

        <label for="proveedor_id">ID del Proveedor:</label>
        <input type="number" name="proveedor_id" value="<?php echo $producto['proveedor_id']; ?>" required><br>

        <button type="submit">Guardar Cambios</button>
    </form>

    <!-- Botón para volver al menú principal -->
    <br>
    <a href="../index.php">
        <button class="btn-menu">Volver al Menú Principal</button>
    </a>
</body>
</html>