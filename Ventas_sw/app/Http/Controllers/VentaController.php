<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\ValidationException;

class VentaController extends Controller {
    public function index() {
        $ventas = Venta::with('productos')->get();
        return view('modules.dashboard.ventas.index', compact('ventas'));
    }

    public function create() {
        $productos = Producto::all();
        return view('modules.dashboard.ventas.create', compact('productos'));
    }

    public function store(Request $request) {
        $request->validate([
            'cliente' => 'required|string|max:255',
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1'
        ]);

        $total = 0;
        $productosSeleccionados = [];

        foreach ($request->productos as $prod) {
            $producto = Producto::find($prod['id']);

            if ($producto->stock < $prod['cantidad']) {
                throw ValidationException::withMessages([
                    'productos' => "No hay suficiente stock para el producto: {$producto->nombre}."
                ]);
            }

            $subtotal = $producto->precio * $prod['cantidad'];
            $total += $subtotal;

            $productosSeleccionados[] = [
                'id' => $producto->id,
                'cantidad' => $prod['cantidad'],
                'subtotal' => $subtotal
            ];
        }

        $venta = Venta::create([
            'cliente' => $request->cliente,
            'total' => $total
        ]);

        foreach ($productosSeleccionados as $prod) {
            $venta->productos()->attach($prod['id'], [
                'cantidad' => $prod['cantidad'],
                'subtotal' => $prod['subtotal']
            ]);

            Producto::find($prod['id'])->decrement('stock', $prod['cantidad']);
        }

        return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente.');
    }

    public function show(Venta $venta) {
        return view('modules.dashboard.ventas.show', compact('venta'));
    }

    public function edit(Venta $venta) {
        $productos = Producto::all();
        return view('modules.dashboard.ventas.edit', compact('venta', 'productos'));
    }

    public function update(Request $request, Venta $venta) {
        $request->validate([
            'cliente' => 'required|string|max:255',
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1'
        ]);

        $venta->productos()->detach();
        $total = 0;

        foreach ($request->productos as $prod) {
            $producto = Producto::find($prod['id']);

            if ($producto->stock < $prod['cantidad']) {
                throw ValidationException::withMessages([
                    'productos' => "No hay suficiente stock para el producto: {$producto->nombre}."
                ]);
            }

            $subtotal = $producto->precio * $prod['cantidad'];
            $total += $subtotal;

            $venta->productos()->attach($producto->id, [
                'cantidad' => $prod['cantidad'],
                'subtotal' => $subtotal
            ]);
        }

        $venta->update([
            'cliente' => $request->cliente,
            'total' => $total
        ]);

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente.');
    }

    public function destroy(Venta $venta) {
        $venta->productos()->detach();
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }

    public function descargarPDF(Venta $venta) {
        $pdf = Pdf::loadView('modules.dashboard.ventas.pdf', compact('venta'));
        return $pdf->download('venta_' . $venta->id . '.pdf');
    }
}

