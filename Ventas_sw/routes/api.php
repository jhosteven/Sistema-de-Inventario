<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí puedes registrar las rutas de la API de tu aplicación.
| Estas rutas son cargadas por el RouteServiceProvider y están dentro
| del grupo de middleware "api".
|
*/

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});
