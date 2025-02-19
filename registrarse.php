<?php
include 'proveedor-producto/includes/db.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Datos del formulario
        $nombre_usuario = $_POST['nombre_usuario'];
        $email = $_POST['email'];
        $clave = $_POST['clave']; // La contraseña ingresada por el usuario

        // Hashear la contraseña
        $clave_hash = password_hash($clave, PASSWORD_DEFAULT);

        // Insertar el usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombre_usuario, clave, email) VALUES (:nombre_usuario, :clave, :email)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->bindParam(':clave', $clave_hash);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            echo "Usuario registrado correctamente.";
        } else {
            echo "Error al registrar el usuario.";
        }
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>

<!-- Formulario de registro -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registrarse</title>
</head>
 <body class="bg-success">
    <div class=" container ">
    <h2 class="text-center my-4 text-light">Registrarse</h2>
    <form method="POST" action="registrarse.php" class="d-grid justify-content-center">
        <div class="bg-light p-5"m style="border-radius: 3rem;">
            <label for="nombre_usuario">Nombre de usuario:</label>
            <input type="text" class="form-control" name="nombre_usuario" required><br><br>

            <label for="email">Correo electrónico:</label>
            <input type="email" class="form-control"  name="email" required><br><br>

            <label for="clave">Contraseña:</label>
            <input type="password" class="form-control"  name="clave" required><br><br>

            <button type="submit" class="btn btn-dark">Registrar</button>
        </div>
        
        <button type="button" class="btn "><a href="index.php" class="text-dark">Iniciar Sessión</a></button>
    </form>
    </div>
    

 </body>

