<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Models\Categoria;
use App\Models\Producto;

// ── PÚBLICAS ─────────────────────────────────────────────────────────────

Route::get('/', function () {
    return view('home', [
        'totalCategorias' => Categoria::count(),
        'totalProductos'  => Producto::count(),
    ]);
})->name('home');

Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

// ── PROTEGIDAS (requieren sesión) ─────────────────────────────────────────

Route::middleware('auth')->group(function () {

    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

    Route::get('/productos',          [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/galeria',            [ProductoController::class, 'galeria'])->name('productos.galeria');
    Route::get('/productos/{id}',     [ProductoController::class, 'show'])->name('productos.show');

    // Edición solo para admin
    Route::get('/productos/{id}/edit',   [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{id}',        [ProductoController::class, 'update'])->name('productos.update');

    // Carrito
    Route::get('/carrito',                [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/agregar/{id}',  [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::post('/carrito/quitar/{id}',   [CarritoController::class, 'quitar'])->name('carrito.quitar');
    Route::post('/carrito/vaciar',        [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

    // Confirmación de pedido
    Route::get('/carrito/confirmar',      [CarritoController::class, 'confirmar'])->name('carrito.confirmar');

});