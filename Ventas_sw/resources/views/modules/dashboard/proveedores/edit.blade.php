@extends('modules.dashboard.home')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-dark">✏️ Editar Proveedor</h2>
        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary shadow">
            <i class="fas fa-arrow-left"></i> Volver a la lista
        </a>
    </div>

    <div class="card shadow rounded">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Actualizar Información del Proveedor</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('proveedores.update', $proveedore) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" id="nombre" name="nombre" class="form-control shadow-sm @error('nombre') is-invalid @enderror" value="{{ old('nombre', $proveedore->nombre) }}" required>
                    </div>
                    @error('nombre')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label fw-bold">Teléfono</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input type="text" id="telefono" name="telefono" class="form-control shadow-sm @error('telefono') is-invalid @enderror" value="{{ old('telefono', $proveedore->telefono) }}" required>
                    </div>
                    @error('telefono')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" id="email" name="email" class="form-control shadow-sm @error('email') is-invalid @enderror" value="{{ old('email', $proveedore->email) }}" required>
                    </div>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success shadow">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
