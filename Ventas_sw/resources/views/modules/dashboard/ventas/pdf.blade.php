<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Pago</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; padding: 0; }
        .container { max-width: 800px; margin: auto; padding: 20px; border: 2px solid #333; border-radius: 10px; }
        h2, h3 { text-align: center; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header img { max-width: 150px; }
        .details { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .footer { margin-top: 30px; text-align: center; font-size: 14px; color: #555; }
        .signature { margin-top: 40px; text-align: right; }
        .signature p { border-top: 1px solid #000; display: inline-block; padding-top: 5px; }
        .total { margin-top: 20px; text-align: right; font-size: 18px; font-weight: bold; }
    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
    <div class="header">
        <h2 class="mb-3">Crisol <i class="fa-solid fa-sun" style="color: #ffc107; font-size: 1.2em;"></i></h2>
        <h2>Comprobante de Pago</h2>
        <p><strong>Fecha de Emisión:</strong> {{ date('d/m/Y') }}</p>
    </div>

    <div class="details">
        <p><strong>ID de Venta:</strong> {{ $venta->id }}</p>
        <p><strong>Cliente:</strong> {{ $venta->cliente }}</p>
    </div>

    <h3>Productos Comprados</h3>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venta->productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->pivot->cantidad }}</td>
                <td>${{ number_format($producto->precio, 2) }}</td>
                <td>${{ number_format($producto->pivot->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p>Total: ${{ number_format($venta->total, 2) }}</p>
    </div>

    <div class="signature">
        <p>Firma y Autorización</p>
    </div>

    <div class="footer">
        <p><em>Gracias por su compra. Esperamos verlo nuevamente.</em></p>
    </div>
</div>

</body>
</html>
