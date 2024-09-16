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

Route::get('/student/{id}', [studentController::class, 'show']);

Route::post('/students', [studentController::class, 'store']);

Route::put('/student/{id}', [studentController::class, 'update']);

Route::patch('/student/{id}', [studentController::class, 'updatePartial']);

Route::delete('/student/{id}', [studentController::class, 'destroy']);

