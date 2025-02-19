<?php
    session_start();
    include '../proveedor-producto/includes/db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cliente_nombre = $_POST['cliente_nombre'];
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];
    
        // Calcular el total
        $total = $cantidad * $precio;
    
        // Insertar los datos en la base de datos
        $sql = "INSERT INTO ventas (cliente_nombre, producto, cantidad, precio, total) 
                VALUES ('$cliente_nombre', '$producto', '$cantidad', '$precio', '$total')";
    
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registrar Venta</title>
</head>
<body class="container">

    <h1 class="my-5">Registrar Venta</h1>
    
    <form class="bg-light p-5" method="POST">
        <div class="mb-3 row">        
            <label for="" class="col-sm-2 col-form-label">Nombre del Cliente</label>
            <div class="col-sm-10">
            <input class="form-control" id="cliente_nombre" name="cliente_nombre" required><br>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label">Producto</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" name="producto">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label">Cantidad</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" name="cantidad">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label">Precio Unitario</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" name="precio">
            </div>            
        </div>
        <input class="btn-menu bg-warning btn" type="submit" value="Registrar Venta">
    </form>
    
    <a href="../menu.php">
        <button class=" bg-secondary btn">Volver al Menú Principal</button>
    </a>

</body>
</html>
