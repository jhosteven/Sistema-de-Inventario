@extends('modules.dashboard.home')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-dark">🛒 Registrar Venta</h2>
    </div>

    <div class="card shadow rounded">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('ventas.store') }}" method="POST" id="venta-form">
                @csrf
                <div class="mb-3">
                    <label for="cliente" class="form-label fw-bold">Cliente</label>
                    <input type="text" class="form-control @error('cliente') is-invalid @enderror" name="cliente" required placeholder="Nombre del cliente">
                    @error('cliente')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h4 class="text-primary mt-3">📦 Productos</h4>
                <div id="productos-container">
                    <div class="row mb-3 align-items-center producto-row">
                        <div class="col-md-6">
                            <label class="form-label">Producto</label>
                            <select name="productos[0][id]" class="form-select producto-select">
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}" data-stock="{{ $producto->stock }}" data-precio="{{ $producto->precio }}">
                                        {{ $producto->nombre }} - ${{ $producto->precio }} (Stock: {{ $producto->stock }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Cantidad</label>
                            <input type="number" name="productos[0][cantidad]" class="form-control cantidad-input" placeholder="Cantidad" min="1" required>
                        </div>
                        <div class="col-md-2 text-center">
                            <button type="button" class="btn btn-danger btn-sm mt-4 d-none remove-producto">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="button" id="agregar-producto" class="btn btn-secondary mt-3">
                    <i class="fas fa-plus-circle"></i> Agregar otro producto
                </button>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success">Registrar Venta</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let index = 1;
    document.getElementById('agregar-producto').addEventListener('click', function() {
        let container = document.getElementById('productos-container');
        let html = `<div class="row mb-3 align-items-center producto-row">
                        <div class="col-md-6">
                            <label class="form-label">Producto</label>
                            <select name="productos[${index}][id]" class="form-select producto-select">
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}" data-stock="{{ $producto->stock }}" data-precio="{{ $producto->precio }}">
                                        {{ $producto->nombre }} - ${{ $producto->precio }} (Stock: {{ $producto->stock }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Cantidad</label>
                            <input type="number" name="productos[${index}][cantidad]" class="form-control cantidad-input" placeholder="Cantidad" min="1" required>
                        </div>
                        <div class="col-md-2 text-center">
                            <button type="button" class="btn btn-danger btn-sm mt-4 remove-producto">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>`;
        container.insertAdjacentHTML('beforeend', html);
        index++;
        addRemoveListeners();
    });

    function addRemoveListeners() {
        document.querySelectorAll('.remove-producto').forEach(button => {
            button.classList.remove('d-none'); 
            button.addEventListener('click', function() {
                this.closest('.producto-row').remove();
            });
        });
    }

    document.addEventListener('input', function(event) {
        if (event.target.classList.contains('cantidad-input')) {
            let cantidadInput = event.target;
            let productoSelect = cantidadInput.closest('.producto-row').querySelector('.producto-select');
            let stockDisponible = parseInt(productoSelect.selectedOptions[0].dataset.stock);

            if (cantidadInput.value > stockDisponible) {
                cantidadInput.setCustomValidity('Cantidad excede el stock disponible');
            } else {
                cantidadInput.setCustomValidity('');
            }
        }
    });
</script>

@endsection

