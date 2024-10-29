<?php

use App\Http\Controllers\CarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/car', [CarController::class, 'listar']);
Route::get('/car/{id}', [CarController::class, 'mostrarId']);
Route::post('/car', [CarController::class, 'salvar']);
Route::put('/car/{id}', [CarController::class, 'editar']);
Route::delete('/car/{id}', [CarController::class, 'excluir']);

