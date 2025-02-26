@extends('modules.dashboard.home')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-dark">📌 Crear Nuevo Producto</h2>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary shadow">
            <i class="fas fa-arrow-left"></i> Volver a la lista
        </a>
    </div>

    <div class="card shadow rounded">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Formulario de Registro</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('productos.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control shadow-sm @error('nombre') is-invalid @enderror" placeholder="Ingrese el nombre del producto" value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label fw-bold">Precio ($)</label>
                    <input type="number" id="precio" name="precio" class="form-control shadow-sm @error('precio') is-invalid @enderror" placeholder="Ingrese el precio" step="0.01" value="{{ old('precio') }}" required>
                    @error('precio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label fw-bold">Stock</label>
                    <input type="number" id="stock" name="stock" class="form-control shadow-sm @error('stock') is-invalid @enderror" placeholder="Cantidad disponible" value="{{ old('stock') }}" required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="proveedor_id" class="form-label fw-bold">Proveedor</label>
                    <select id="proveedor_id" name="proveedor_id" class="form-select shadow-sm @error('proveedor_id') is-invalid @enderror" required>
                        <option value="" disabled {{ old('proveedor_id') ? '' : 'selected' }}>Seleccione un proveedor</option>
                        @foreach($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}" {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                                {{ $proveedor->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('proveedor_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success shadow">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
