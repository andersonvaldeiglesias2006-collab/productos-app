@extends('layouts.app')
@section('titulo', 'Productos')
@section('contenido')

<div class="page-header">
    <div>
        <h1 class="page-title">Lista de Productos</h1>
        <div class="gold-line"></div>
        <p class="page-subtitle">{{ $productos->count() }} productos registrados</p>
    </div>
    <a href="{{ route('productos.galeria') }}" class="btn btn-gold btn-sm">🖼 Ver galería</a>
</div>

@if($productos->isEmpty())
    <div class="alert alert-info">No hay productos registrados aún.</div>
@else
<div class="card" style="padding:0; overflow:hidden">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                @if(Auth::user()->rol === 'admin')
                    <th>Acciones</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td style="color:var(--ink-light); font-size:.88rem">{{ $producto->id_producto }}</td>
                <td>
                    <a href="{{ route('productos.show', $producto->id_producto) }}" style="font-weight:600">
                        {{ $producto->nombre }}
                    </a>
                </td>
                <td style="color:var(--ink-light)">{{ $producto->marca }}</td>
                <td style="font-family:'Playfair Display',serif; color:var(--red)">
                    S/. {{ number_format($producto->precio, 2) }}
                </td>
                <td>
                    @if($producto->stock == 0)
                        <span class="stock-badge stock-low">Agotado</span>
                    @elseif($producto->stock <= 10)
                        <span class="stock-badge stock-warn">{{ $producto->stock }}</span>
                    @else
                        <span class="stock-badge stock-ok">{{ $producto->stock }}</span>
                    @endif
                </td>
                <td>
                    <span style="font-size:.85rem; color:var(--ink-light)">
                        {{ $producto->categoria->descripcion ?? '—' }}
                    </span>
                </td>
                @if(Auth::user()->rol === 'admin')
                    <td>
                        <a href="{{ route('productos.edit', $producto->id_producto) }}"
                           class="btn btn-gold btn-sm">✏ Editar</a>
                    </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection