@extends('modules.dashboard.home')

@section('content')
<div class="container mt-4">
    <h2 class="text-dark">📝 Detalles de la Venta</h2>

    <div class="card shadow rounded p-4">
        <p><strong>🆔 ID de Venta:</strong> {{ $venta->id }}</p>
        <p><strong>👤 Cliente:</strong> {{ $venta->cliente }}</p>
        <p><strong>💰 Total:</strong> ${{ number_format($venta->total, 2) }}</p>

        <h4 class="mt-4">📦 Productos Comprados</h4>
        <div class="table-responsive">
            <table class="table table-striped mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($venta->productos as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->pivot->cantidad }}</td>
                        <td>${{ number_format($producto->pivot->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex mt-4">
            <a href="{{ route('ventas.index') }}" class="btn btn-secondary me-3">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a href="{{ route('ventas.pdf', $venta) }}" class="btn btn-success">
                <i class="fas fa-file-pdf"></i> Descargar PDF
            </a>
        </div>
    </div>
</div>
@endsection
