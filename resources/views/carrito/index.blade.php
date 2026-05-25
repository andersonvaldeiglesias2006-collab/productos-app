@extends('layouts.app')
@section('titulo', 'Mi Carrito')
@section('contenido')

<div class="page-header">
    <div>
        <h1 class="page-title">Mi Carrito de Compras</h1>
        <div class="gold-line"></div>
    </div>
    <a href="{{ route('productos.galeria') }}" class="btn btn-outline btn-sm">← Seguir comprando</a>
</div>

@if(empty($productos))
    <div class="card" style="text-align:center; padding:4rem 2rem">
        <p style="font-size:3rem; margin-bottom:1rem">🛒</p>
        <p style="font-size:1.1rem; color:var(--ink-light); margin-bottom:1.5rem">Tu carrito está vacío.</p>
        <a href="{{ route('productos.galeria') }}" class="btn btn-gold btn-lg">Explorar galería</a>
    </div>
@else
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th style="width:80px">Imagen</th>
                    <th>Producto</th>
                    <th>Precio unit.</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $item)
                <tr class="carrito-row">
                    <td>
                        @if($item['producto']->foto && file_exists(public_path('img/productos/' . $item['producto']->foto)))
                            <img src="{{ asset('img/productos/' . $item['producto']->foto) }}"
                                 style="width:64px; height:64px; object-fit:cover; border-radius:var(--radius-sm); box-shadow:var(--shadow-sm)">
                        @else
                            <div style="width:64px; height:64px; background:var(--border); border-radius:var(--radius-sm); display:flex; align-items:center; justify-content:center; color:#aaa; font-size:1.4rem">📦</div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $item['producto']->nombre }}</strong><br>
                        <span style="color:var(--ink-light); font-size:.84rem">{{ $item['producto']->marca }}</span>
                    </td>
                    <td style="font-weight:500">S/. {{ number_format($item['producto']->precio, 2) }}</td>
                    <td>
                        <div class="qty-control">
                            <form action="{{ route('carrito.quitar', $item['producto']->id_producto) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger btn-sm" style="width:30px; padding:.3rem; justify-content:center">−</button>
                            </form>
                            <span class="qty-num">{{ $item['cantidad'] }}</span>
                            <form action="{{ route('carrito.agregar', $item['producto']->id_producto) }}" method="POST">
                                @csrf
                                <button class="btn btn-success btn-sm" style="width:30px; padding:.3rem; justify-content:center">+</button>
                            </form>
                        </div>
                    </td>
                    <td style="font-family:'Playfair Display',serif; font-size:1.1rem; color:var(--red); font-weight:600">
                        S/. {{ number_format($item['subtotal'], 2) }}
                    </td>
                    <td>
                        <form action="{{ route('carrito.quitar', $item['producto']->id_producto) }}" method="POST">
                            @csrf
                            <button class="btn btn-outline btn-sm" style="color:var(--red); border-color:var(--red)"
                                    onclick="return confirm('¿Quitar este producto?')">✕</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="display:flex; justify-content:space-between; align-items:center; margin-top:2rem; flex-wrap:wrap; gap:1rem">
            <form action="{{ route('carrito.vaciar') }}" method="POST">
                @csrf
                <button class="btn btn-outline" onclick="return confirm('¿Vaciar el carrito?')">
                    🗑 Vaciar carrito
                </button>
            </form>
            <div style="display:flex; align-items:center; gap:1.5rem; flex-wrap:wrap">
                <div style="font-family:'Playfair Display',serif; font-size:1.8rem; color:var(--ink)">
                    Total: <span style="color:var(--red)">S/. {{ number_format($total, 2) }}</span>
                </div>
                <a href="{{ route('carrito.confirmar') }}" class="btn btn-gold btn-lg">
                    Confirmar pedido →
                </a>
            </div>
        </div>
    </div>
@endif

@endsection