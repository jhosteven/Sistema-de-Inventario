@extends('modules.dashboard.home')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-dark">📦 Lista de Productos</h2>
        <a href="{{ route('productos.create') }}" class="btn btn-success shadow">
            <i class="fas fa-plus"></i> Nuevo Producto
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover shadow rounded">
            <thead class="bg-dark text-light">
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Proveedor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>${{ number_format($producto->precio, 2) }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>{{ $producto->proveedor->nombre }}</td>
                        <td>
                            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning btn-sm shadow-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
