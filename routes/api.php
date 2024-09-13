<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\studentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/*Comentado porque se llamará desde el controller
Route::get/*('/students', function () {
    return 'Obteniendo Lista de Estudiantes';
});
*/

Route::get('/students', [studentController::class, 'index']);

Route::get('/students/{id}', function () {
    return 'Obteniendo un Estudiante';
});

Route::post('/students', function () {
    return 'Creando Estudiante';
});

Route::put('/students/{id}', function () {
    return 'Actualizando Estudiante';
});

Route::delete('/students/{id}', function () {
    return 'Eliminando Estudiante';
});

