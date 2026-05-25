@extends('layouts.app')
@section('titulo', $producto->nombre)
@section('contenido')

<a href="{{ route('productos.galeria') }}" class="btn btn-outline btn-sm"
   style="margin-bottom:1.8rem; display:inline-flex">← Volver a la galería</a>

<div class="card" style="display:flex; gap:2.5rem; flex-wrap:wrap; align-items:flex-start">

    {{-- Imagen --}}
    <div style="flex:0 0 340px">
        @if($producto->foto && file_exists(public_path('img/productos/' . $producto->foto)))
            <img src="{{ asset('img/productos/' . $producto->foto) }}"
                 alt="{{ $producto->nombre }}"
                 style="width:100%; border-radius:var(--radius); box-shadow:var(--shadow-md)">
        @else
            <div class="no-foto" style="height:300px; border-radius:var(--radius)">
                <span style="font-size:3rem">📦</span>
                <span>Sin imagen</span>
            </div>
        @endif
    </div>

    {{-- Info --}}
    <div style="flex:1; min-width:260px">
        <p style="color:var(--gold); font-weight:600; font-size:.85rem; text-transform:uppercase; letter-spacing:1px; margin-bottom:.4rem">
            {{ $producto->categoria->descripcion ?? 'Sin categoría' }}
        </p>
        <h1 class="page-title" style="font-size:2.2rem">{{ $producto->nombre }}</h1>
        <div class="gold-line"></div>
        <p style="color:var(--ink-light); margin-bottom:1.5rem">Marca: <strong>{{ $producto->marca }}</strong></p>

        <table style="margin:0 0 1.5rem">
            <tbody>
                <tr>
                    <td style="font-weight:600; padding:.6rem 1rem .6rem 0; border:none; color:var(--ink-light); font-size:.88rem; text-transform:uppercase; letter-spacing:.4px; width:140px">Precio</td>
                    <td style="border:none; font-family:'Playfair Display',serif; font-size:1.8rem; color:var(--red)">
                        S/. {{ number_format($producto->precio, 2) }}
                    </td>
                </tr>
                <tr>
                    <td style="font-weight:600; padding:.6rem 1rem .6rem 0; border:none; color:var(--ink-light); font-size:.88rem; text-transform:uppercase; letter-spacing:.4px">Stock</td>
                    <td style="border:none">
                        @if($producto->stock == 0)
                            <span class="stock-badge stock-low">Sin stock</span>
                        @elseif($producto->stock <= 10)
                            <span class="stock-badge stock-warn">{{ $producto->stock }} unidades (bajo)</span>
                        @else
                            <span class="stock-badge stock-ok">{{ $producto->stock }} unidades disponibles</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <div style="display:flex; gap:.8rem; flex-wrap:wrap">
            @if($producto->stock > 0)
                <form action="{{ route('carrito.agregar', $producto->id_producto) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg">🛒 Agregar al carrito</button>
                </form>
            @else
                <button class="btn btn-success btn-lg" disabled>Sin stock</button>
            @endif

            @if(Auth::user()->rol === 'admin')
                <a href="{{ route('productos.edit', $producto->id_producto) }}"
                   class="btn btn-gold btn-lg">✏ Editar producto</a>
            @endif
        </div>
    </div>

</div>

@endsection