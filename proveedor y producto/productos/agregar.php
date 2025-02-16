<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <h1>Agregar Producto</h1>
    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"></textarea><br>

        <label for="precio">Precio:</label>
        <input type="number" step="0.01" name="precio" required><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" required><br>

        <label for="proveedor_id">ID del Proveedor:</label>
        <input type="number" name="proveedor_id" required><br>

        <button type="submit">Agregar</button>
    </form>

    <!-- Botón para volver al menú principal -->
    <br>
    <a href="../index.php">
        <button class="btn-menu">Volver al Menú Principal</button>
    </a>
</body>
</html>