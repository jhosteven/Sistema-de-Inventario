<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('proveedor')->get();
        return view('modules.dashboard.productos.index', compact('productos'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        return view('modules.dashboard.productos.create', compact('proveedores'));
    }

    public function store(Request $request)
    {
        // Validaciones mejoradas
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'precio' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'proveedor_id' => ['required', 'exists:proveedors,id'],
        ], [
            'nombre.required' => '⚠ El nombre del producto es obligatorio.',
            'nombre.string' => '⚠ El nombre debe ser una cadena de texto.',
            'nombre.max' => '⚠ El nombre no puede tener más de 255 caracteres.',
            'nombre.regex' => '⚠ El nombre solo puede contener letras y espacios.',

            'precio.required' => '⚠ El precio es obligatorio.',
            'precio.numeric' => '⚠ El precio debe ser un número.',
            'precio.min' => '⚠ El precio no puede ser negativo.',

            'stock.required' => '⚠ El stock es obligatorio.',
            'stock.integer' => '⚠ El stock debe ser un número entero.',
            'stock.min' => '⚠ El stock no puede ser negativo.',

            'proveedor_id.required' => '⚠ Debe seleccionar un proveedor.',
            'proveedor_id.exists' => '⚠ El proveedor seleccionado no es válido.',
        ]);

        // Crear producto
        Producto::create($validated);

        return redirect()->route('productos.index')->with('success', '✅ Producto registrado correctamente.');
    }

    public function edit(Producto $producto)
    {
        $proveedores = Proveedor::all();
        return view('modules.dashboard.productos.edit', compact('producto', 'proveedores'));
    }

    public function update(Request $request, Producto $producto)
    {
        // Validaciones mejoradas
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'precio' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'proveedor_id' => ['required', 'exists:proveedors,id'],
        ], [
            'nombre.required' => '⚠ El nombre del producto es obligatorio.',
            'nombre.string' => '⚠ El nombre debe ser una cadena de texto.',
            'nombre.max' => '⚠ El nombre no puede tener más de 255 caracteres.',
            'nombre.regex' => '⚠ El nombre solo puede contener letras y espacios.',

            'precio.required' => '⚠ El precio es obligatorio.',
            'precio.numeric' => '⚠ El precio debe ser un número.',
            'precio.min' => '⚠ El precio no puede ser negativo.',

            'stock.required' => '⚠ El stock es obligatorio.',
            'stock.integer' => '⚠ El stock debe ser un número entero.',
            'stock.min' => '⚠ El stock no puede ser negativo.',

            'proveedor_id.required' => '⚠ Debe seleccionar un proveedor.',
            'proveedor_id.exists' => '⚠ El proveedor seleccionado no es válido.',
        ]);

        // Actualizar producto
        $producto->update($validated);

        return redirect()->route('productos.index')->with('success', '✅ Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', '✅ Producto eliminado correctamente.');
    }
}
