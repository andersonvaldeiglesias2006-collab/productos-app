<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Models\Categoria;
use App\Models\Producto;

// ── RUTAS PÚBLICAS (cualquiera puede entrar sin iniciar sesión) ──────────

// Página de inicio: pasa el conteo de categorías y productos a la vista
Route::get('/', function () {
    return view('home', [
        'totalCategorias' => Categoria::count(),
        'totalProductos'  => Producto::count(),
    ]);
})->name('home');

// Muestra el formulario de login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Procesa el formulario cuando el usuario hace clic en "Iniciar Sesión"
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Cierra la sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ── RUTAS PROTEGIDAS (solo accesibles si hay sesión activa) ─────────────
// Si alguien intenta entrar sin sesión, Laravel lo redirige automáticamente a /login

Route::middleware('auth')->group(function () {

    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

});