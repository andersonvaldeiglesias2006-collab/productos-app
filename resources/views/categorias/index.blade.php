@extends('layouts.app')
@section('titulo', 'Categorías')
@section('contenido')

<div class="page-header">
    <div>
        <h1 class="page-title">Categorías</h1>
        <div class="gold-line"></div>
        <p class="page-subtitle">{{ $categorias->count() }} categorías registradas</p>
    </div>
</div>

@if($categorias->isEmpty())
    <div class="alert alert-info">No hay categorías registradas aún.</div>
@else
<div class="card" style="padding:0; overflow:hidden">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Descripción</th>
                <th>N° Productos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
            <tr>
                <td style="color:var(--ink-light); font-size:.88rem">{{ $categoria->id_categoria }}</td>
                <td style="font-weight:600">{{ $categoria->descripcion }}</td>
                <td>
                    @php $count = $categoria->productos->count(); @endphp
                    <span class="stock-badge {{ $count > 0 ? 'stock-ok' : 'stock-low' }}">
                        {{ $count }} {{ $count == 1 ? 'producto' : 'productos' }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection