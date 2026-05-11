<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;

// Ruta de inicio
Route::get('/', function () {
    return view('home');
})->name('home');

// Rutas de Categorías
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

// Rutas de Productos
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');