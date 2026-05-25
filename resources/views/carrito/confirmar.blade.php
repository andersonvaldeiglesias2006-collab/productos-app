@extends('layouts.app')
@section('titulo', 'Confirmar Pedido')
@section('contenido')

<div class="page-header">
    <div>
        <h1 class="page-title">Confirmación de Pedido</h1>
        <div class="gold-line"></div>
    </div>
    <a href="{{ route('carrito.index') }}" class="btn btn-outline btn-sm">← Volver al carrito</a>
</div>

{{-- Datos del pedido --}}
<div class="card" style="border-top: 4px solid var(--gold); margin-bottom:1.5rem">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-bottom:1.5rem; flex-wrap:wrap">
        <div>
            <p style="font-size:.8rem; text-transform:uppercase; letter-spacing:.5px; color:var(--ink-light); font-weight:600; margin-bottom:.3rem">Cliente</p>
            <p style="font-size:1.15rem; font-weight:600">{{ $usuario->name }}</p>
            <p style="color:var(--ink-light); font-size:.9rem">{{ $usuario->email }}</p>
        </div>
        <div>
            <p style="font-size:.8rem; text-transform:uppercase; letter-spacing:.5px; color:var(--ink-light); font-weight:600; margin-bottom:.3rem">Fecha y Hora del Pedido</p>
            <p style="font-size:1.15rem; font-weight:600">{{ $fecha }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Marca</th>
                <th style="text-align:right">Precio unit.</th>
                <th style="text-align:center">Cant.</th>
                <th style="text-align:right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $item)
            <tr>
                <td><strong>{{ $item['producto']->nombre }}</strong></td>
                <td style="color:var(--ink-light)">{{ $item['producto']->marca }}</td>
                <td style="text-align:right">S/. {{ number_format($item['producto']->precio, 2) }}</td>
                <td style="text-align:center">{{ $item['cantidad'] }}</td>
                <td style="text-align:right; font-weight:600; color:var(--red)">
                    S/. {{ number_format($item['subtotal'], 2) }}
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background:var(--cream)">
                <td colspan="4" style="text-align:right; font-weight:700; padding:.9rem 1rem; font-size:1rem">
                    TOTAL A PAGAR
                </td>
                <td style="text-align:right; padding:.9rem 1rem; font-family:'Playfair Display',serif; font-size:1.5rem; color:var(--red); font-weight:700; border-bottom:none">
                    S/. {{ number_format($total, 2) }}
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<div class="card" style="text-align:center; padding:2rem">
    <p style="color:var(--ink-light); margin-bottom:1.5rem; font-size:.95rem">
        Al confirmar, acepta que su pedido será procesado por el administrador del sistema.
    </p>
    <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap">
        <a href="{{ route('carrito.index') }}" class="btn btn-outline btn-lg">← Modificar carrito</a>
        <button class="btn btn-gold btn-lg"
                onclick="alert('✅ Pedido enviado correctamente.\n\nGracias, {{ $usuario->name }}.\nNos pondremos en contacto pronto.')">
            ✅ Confirmar pedido
        </button>
    </div>
</div>

@endsection