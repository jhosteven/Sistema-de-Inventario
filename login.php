<?php
session_start();
include 'proveedor-producto/includes/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombre_usuario = $_POST['nombre_usuario'];
    $clave = $_POST['clave'];

    // Buscar al usuario en la base de datos
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = :nombre_usuario LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre_usuario', $nombre_usuario);
    $stmt->execute();

    // Comprobar si el usuario existe
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Verificar la contraseña con password_verify
        if (password_verify($clave, $usuario['clave'])) {
            // Contraseña correcta, iniciar sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
            echo "Bienvenido, " . $usuario['nombre_usuario'];
            // Redirigir a otra página protegida si lo deseas
            header("Location: menu.php"); 
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
</head>
<body class="bg-success">
    <div class="container">
        <h2 class="text-center my-4 text-light">Iniciar sesión</h2>
        <form action="login.php" method="POST" class="d-grid justify-content-center">
            <div class="bg-light p-5 border-round" style="border-radius: 2rem;">
                <div class="form-group">
                    <label for="nombre_usuario">Nombre de usuario:</label>
                    <input type="text" class="form-control" name="nombre_usuario" required><br><br>
                </div>
                <div class="form-group">
                    <label for="clave">Contraseña:</label>
                    <input type="password" class="form-control" name="clave" required><br><br>
                </div>
            
                <button type="submit" class="btn btn-block btn-dark">Iniciar sesión</button>
            </div>
            
        </form>
        <div class="mt-3 text-center">
            <button class="btn btn text-dark"><a class="text-dark" href="registrarse.php">Registrarse</a></button>
        </div>
        
    </div>
    
</body>
</html>