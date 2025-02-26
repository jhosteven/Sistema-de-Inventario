<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crisol</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .navbar-brand i {
            margin-left: 8px;
            color: #ffc107;
        }
        .welcome-section {
            text-align: center;
            padding: 50px 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        .logout-icon {
            color: #dc3545; /* Rojo oscuro */
            font-size: 1.5rem;
            margin-left: 20px; /* Separación del resto */
        }
        .logout-icon:hover {
            color: #bd2130; /* Rojo más oscuro al pasar el cursor */
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container d-flex justify-content-center">
            <a class="navbar-brand" href="{{ route('home') }}">
                Crisol <i class="fas fa-sun"></i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
                <!-- Opciones del menú -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('proveedores.index') }}">Proveedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('productos.index') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ventas.index') }}">Ventas</a>
                    </li>
                </ul>

                <!-- Icono de Cerrar Sesión separado -->
                <a class="nav-link logout-icon" href="{{ route('logout') }}" title="Cerrar sesión">
                    <i class="fas fa-power-off"></i>
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- La sección de bienvenida solo aparece si no hay contenido en @yield('content') -->
        @if (!View::hasSection('content'))
        <div class="welcome-section">
            <h2>Bienvenido, {{ Auth::user()->name }}!</h2>
            <p class="lead">Aquí puedes gestionar proveedores, productos y ventas de forma eficiente.</p>
        </div>
        @endif

        <div class="mt-4">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
