<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;

Route::middleware("guest")->group(function () {
    Route::get('/',[AuthController::class, 'index'])->name('login');
    Route::get('/registro',[AuthController::class, 'registro'])->name('registro');
    Route::post('/registrar',[AuthController::class,'registrar'])->name('registrar');
    Route::post('/logear',[AuthController::class,'logear'])->name('logear');
});

Route::middleware("auth")->group(function () {
    Route::get('/home',[AuthController::class,'home'])->name('home');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');

    Route::resource('proveedores', ProveedorController::class);
    Route::resource('productos', ProductoController::class);

    Route::resource('ventas', VentaController::class);
    Route::get('ventas/{venta}/pdf', [VentaController::class, 'descargarPDF'])->name('ventas.pdf');
    
});