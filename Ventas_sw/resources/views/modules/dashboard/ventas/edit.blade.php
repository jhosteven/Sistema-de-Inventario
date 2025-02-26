@extends('modules.dashboard.home')

@section('content')
<div class="container mt-4">
    <h2 class="text-dark">📝 Editar Venta</h2>

    <div class="card shadow rounded">
        <div class="card-body">
            <form action="{{ route('ventas.update', $venta) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="cliente" class="form-label fw-bold">Cliente:</label>
                    <input type="text" class="form-control" id="cliente" name="cliente" value="{{ old('cliente', $venta->cliente) }}" required pattern="^[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$" title="Solo se permiten letras y espacios">
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h4 class="text-primary mt-3">📦 Productos</h4>
                <div id="productos-container">
                    @foreach ($venta->productos as $producto)
                    <div class="row mb-3 align-items-center producto-item">
                        <div class="col-md-6">
                            <select name="productos[{{ $loop->index }}][id]" class="form-select producto-select">
                                @foreach ($productos as $prod)
                                <option value="{{ $prod->id }}" data-stock="{{ $prod->stock }}" {{ $prod->id == $producto->id ? 'selected' : '' }}>
                                    {{ $prod->nombre }} - ${{ $prod->precio }} (Stock: {{ $prod->stock }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="productos[{{ $loop->index }}][cantidad]" class="form-control cantidad-input" value="{{ $producto->pivot->cantidad }}" min="1" required>
                        </div>
                        <div class="col-md-2 text-center">
                            <button type="button" class="btn btn-danger btn-sm remove-producto">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <button type="button" class="btn btn-secondary mt-3" id="agregar-producto">
                    <i class="fas fa-plus-circle"></i> Agregar Producto
                </button>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success">Actualizar Venta</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('agregar-producto').addEventListener('click', function () {
        let container = document.getElementById('productos-container');
        let index = container.children.length;
        let newProduct = document.createElement('div');
        newProduct.classList.add('row', 'mb-3', 'align-items-center', 'producto-item');
        newProduct.innerHTML = `
            <div class="col-md-6">
                <select name="productos[${index}][id]" class="form-select producto-select">
                    @foreach ($productos as $prod)
                    <option value="{{ $prod->id }}" data-stock="{{ $prod->stock }}">{{ $prod->nombre }} - ${{ $prod->precio }} (Stock: {{ $prod->stock }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" name="productos[${index}][cantidad]" class="form-control cantidad-input" min="1" required>
            </div>
            <div class="col-md-2 text-center">
                <button type="button" class="btn btn-danger btn-sm remove-producto">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(newProduct);

        addEventListeners();
    });

    function addEventListeners() {
        document.querySelectorAll('.cantidad-input').forEach(input => {
            input.addEventListener('input', function() {
                let select = this.closest('.producto-item').querySelector('.producto-select');
                let stock = parseInt(select.options[select.selectedIndex].dataset.stock);
                if (parseInt(this.value) > stock) {
                    alert('La cantidad ingresada supera el stock disponible.');
                    this.value = stock;
                }
            });
        });

        document.querySelectorAll('.remove-producto').forEach(button => {
            button.addEventListener('click', function () {
                if (confirm('¿Seguro que deseas eliminar este producto?')) {
                    this.closest('.producto-item').remove();
                }
            });
        });
    }

    addEventListeners();
</script>
@endsection
