@extends('modules.dashboard.home')

@section('content')
<div class="container mt-4">
    <h2 class="text-dark">📋 Lista de Ventas</h2>
    
    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus-circle"></i> Nueva Venta
    </a>

    <div class="card shadow rounded">
        <div class="card-body">
            <table class="table table-striped table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->cliente }}</td>
                        <td>${{ number_format($venta->total, 2) }}</td>
                        <td>
                            <a href="{{ route('ventas.show', $venta) }}" class="btn btn-info btn-sm me-2">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                            <a href="{{ route('ventas.edit', $venta) }}" class="btn btn-warning btn-sm me-2">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('ventas.destroy', $venta) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm me-2 eliminar-venta">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                            <a href="{{ route('ventas.pdf', $venta) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-file-pdf"></i> PDF
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.eliminar-venta').forEach(button => {
    button.addEventListener('click', function (event) {
        event.preventDefault();
        if (confirm('¿Estás seguro de que deseas eliminar esta venta? Esta acción no se puede deshacer.')) {
            this.closest('form').submit();
        }
    });
});
</script>

@endsection
