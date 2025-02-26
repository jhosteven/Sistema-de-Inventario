<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('modules.dashboard.proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('modules.dashboard.proveedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'telefono' => ['required', 'string', 'max:20', 'regex:/^\+?[0-9\s-]+$/'],
            'email' => ['required', 'email', 'unique:proveedors,email'],
        ], [
            'nombre.required' => '⚠ El nombre del proveedor es obligatorio.',
            'nombre.string' => '⚠ El nombre debe ser una cadena de texto.',
            'nombre.max' => '⚠ El nombre no puede tener más de 255 caracteres.',
            'nombre.regex' => '⚠ El nombre solo puede contener letras y espacios.',

            'telefono.required' => '⚠ El teléfono es obligatorio.',
            'telefono.string' => '⚠ El teléfono debe ser una cadena de texto.',
            'telefono.max' => '⚠ El teléfono no puede tener más de 20 caracteres.',
            'telefono.regex' => '⚠ El teléfono solo puede contener números, espacios y guiones.',

            'email.required' => '⚠ El correo electrónico es obligatorio.',
            'email.email' => '⚠ Debe ingresar un correo electrónico válido.',
            'email.unique' => '⚠ Este correo ya está registrado.',
        ]);

        Proveedor::create($request->all());
        return redirect()->route('proveedores.index');
    }

    public function edit(Proveedor $proveedore)
    {
        return view('modules.dashboard.proveedores.edit', compact('proveedore'));
    }

    public function update(Request $request, Proveedor $proveedore)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'telefono' => ['required', 'string', 'max:20', 'regex:/^\+?[0-9\s-]+$/'],
            'email' => ['required', 'email', 'unique:proveedors,email,'.$proveedore->id],
        ], [
            'nombre.required' => '⚠ El nombre del proveedor es obligatorio.',
            'nombre.string' => '⚠ El nombre debe ser una cadena de texto.',
            'nombre.max' => '⚠ El nombre no puede tener más de 255 caracteres.',
            'nombre.regex' => '⚠ El nombre solo puede contener letras y espacios.',

            'telefono.required' => '⚠ El teléfono es obligatorio.',
            'telefono.string' => '⚠ El teléfono debe ser una cadena de texto.',
            'telefono.max' => '⚠ El teléfono no puede tener más de 20 caracteres.',
            'telefono.regex' => '⚠ El teléfono solo puede contener números, espacios y guiones.',

            'email.required' => '⚠ El correo electrónico es obligatorio.',
            'email.email' => '⚠ Debe ingresar un correo electrónico válido.',
            'email.unique' => '⚠ Este correo ya está registrado.',
        ]);

        $proveedore->update($request->all());
        return redirect()->route('proveedores.index');
    }

    public function destroy(Proveedor $proveedore)
    {
        $proveedore->delete();
        return redirect()->route('proveedores.index');
    }
}
