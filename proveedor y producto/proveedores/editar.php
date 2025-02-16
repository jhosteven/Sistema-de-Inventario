<?php
include '../includes/db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM proveedores WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$proveedor = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellidop = $_POST['apellido_paterno'];
    $apellidom = $_POST['apellido_materno'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $stmt = $conn->prepare("UPDATE proveedores SET nombre = :nombre, apellido_paterno = :apellido_paterno, apellido_materno = :apellido_materno, correo = :correo, telefono = :telefono, direccion = :direccion WHERE id = :id");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido_paterno', $apellidop);
    $stmt->bindParam(':apellido_materno', $apellidom);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':direccion', $direccion);
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
    <title>Editar Proveedor</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Editar Proveedor</h1>
    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $proveedor['nombre']; ?>" required><br>

        <label for="apellido_paterno">Apellido Paterno:</label>
        <input type="text" name="apellido_paterno" value="<?php echo $proveedor['apellido_paterno']; ?>" required><br>

        <label for="apellido_materno">Apellido Materno:</label>
        <input type="text" name="apellido_materno" value="<?php echo $proveedor['apellido_materno']; ?>" required><br>

        <label for="correo">Correo:</label>
        <input type="email" name="correo" value="<?php echo $proveedor['correo']; ?>" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" value="<?php echo $proveedor['telefono']; ?>" required><br>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" value="<?php echo $proveedor['direccion']; ?>" required><br>

        <button type="submit">Guardar Cambios</button>
    </form>

    <!-- Botón para volver al menú principal -->
    <br>
    <a href="../index.php">
        <button class="btn-menu">Volver al Menú Principal</button>
    </a>
</body>
</html>