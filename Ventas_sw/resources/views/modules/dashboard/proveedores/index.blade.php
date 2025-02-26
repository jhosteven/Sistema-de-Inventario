@extends('modules.dashboard.home')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-dark">📋 Lista de Proveedores</h2>
        <a href="{{ route('proveedores.create') }}" class="btn btn-primary shadow">
            <i class="fas fa-plus"></i> Nuevo Proveedor
        </a>
    </div>

    <div class="card shadow rounded">
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proveedores as $proveedor)
                        <tr>
                            <td>{{ $proveedor->nombre }}</td>
                            <td>{{ $proveedor->telefono }}</td>
                            <td>{{ $proveedor->email }}</td>
                            <td class="text-center">
                                <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $proveedor->id }})">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>

                                <form id="delete-form-{{ $proveedor->id }}" action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" style="display: none;">
                                    @csrf @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm("¿Estás seguro de que deseas eliminar este proveedor? Esta acción no se puede deshacer.")) {
            document.getElementById(`delete-form-${id}`).submit();
        }
    }
</script>

@endsection
