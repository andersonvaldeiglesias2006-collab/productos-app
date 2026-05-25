@extends('layouts.app')
@section('titulo', 'Inicio — ProductosApp')
@section('contenido')

<div class="page-header">
    <div>
        <h1 class="page-title">Panel de Administración</h1>
        <div class="gold-line"></div>
        <p class="page-subtitle">Resumen del catálogo de productos.</p>
    </div>
    @auth
        <div class="alert alert-gold" style="margin:0; padding:.6rem 1rem">
            👤 Sesión activa como <strong>{{ Auth::user()->name }}</strong>
            @if(Auth::user()->rol === 'admin')
                &nbsp;·&nbsp;<span style="color:var(--red);font-weight:700">Administrador</span>
            @endif
        </div>
    @endauth
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-number">{{ $totalCategorias }}</div>
        <div class="stat-label">Categorías registradas</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $totalProductos }}</div>
        <div class="stat-label">Productos en catálogo</div>
    </div>
</div>

<div class="card">
    <p style="color:var(--ink-light); margin-bottom:1.2rem">Accede rápidamente a las secciones del sistema:</p>
    <div style="display:flex; gap:.8rem; flex-wrap:wrap">
        <a href="{{ route('productos.galeria') }}" class="btn btn-gold">🖼 Ver Galería</a>
        <a href="{{ route('categorias.index') }}"  class="btn btn-primary">📂 Categorías</a>
        <a href="{{ route('productos.index') }}"   class="btn btn-outline">📋 Lista de Productos</a>
        <a href="{{ route('carrito.index') }}"     class="btn btn-outline">🛒 Mi Carrito</a>
    </div>
</div>

@endsection