@extends('layouts.app')
@section('titulo', 'Editar — ' . $producto->nombre)
@section('contenido')

{{-- Verificación de seguridad: si no es admin, muestra error --}}
@if(Auth::user()->rol !== 'admin')
    <div class="alert alert-danger">
        ⛔ No tienes permisos para editar productos. Esta acción está reservada para administradores.
    </div>
    <a href="{{ route('productos.galeria') }}" class="btn btn-outline">← Volver a la galería</a>
@else

<a href="{{ route('productos.show', $producto->id_producto) }}"
   class="btn btn-outline btn-sm" style="margin-bottom:1.8rem; display:inline-flex">
   ← Volver al producto
</a>

<div class="page-header">
    <div>
        <h1 class="page-title">Editar Producto</h1>
        <div class="gold-line"></div>
        <p class="page-subtitle">Modificando: <strong>{{ $producto->nombre }}</strong></p>
    </div>
    <div class="alert alert-gold" style="margin:0; padding:.6rem 1rem; font-size:.85rem">
        🔐 Modo Administrador
    </div>
</div>

<div class="card" style="max-width:680px">
    <form action="{{ route('productos.update', $producto->id_producto) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre del producto</label>
            <input type="text" id="nombre" name="nombre"
                   value="{{ old('nombre', $producto->nombre) }}"
                   placeholder="Ej. Laptop HP 15">
            @error('nombre')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" id="marca" name="marca"
                   value="{{ old('marca', $producto->marca) }}"
                   placeholder="Ej. HP, Sony, Nike...">
            @error('marca')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.2rem">
            <div class="form-group">
                <label for="precio">Precio (S/.)</label>
                <input type="number" id="precio" name="precio" step="0.01" min="0"
                       value="{{ old('precio', $producto->precio) }}"
                       placeholder="0.00">
                @error('precio')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock">Stock (unidades)</label>
                <input type="number" id="stock" name="stock" min="0"
                       value="{{ old('stock', $producto->stock) }}"
                       placeholder="0">
                @error('stock')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="id_categoria">Categoría</label>
            <select id="id_categoria" name="id_categoria">
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id_categoria }}"
                        {{ old('id_categoria', $producto->id_categoria) == $cat->id_categoria ? 'selected' : '' }}>
                        {{ $cat->descripcion }}
                    </option>
                @endforeach
            </select>
            @error('id_categoria')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div style="display:flex; gap:1rem; margin-top:.5rem">
            <button type="submit" class="btn btn-gold btn-lg">💾 Guardar cambios</button>
            <a href="{{ route('productos.show', $producto->id_producto) }}"
               class="btn btn-outline btn-lg">Cancelar</a>
        </div>
    </form>
</div>

@endif
@endsection