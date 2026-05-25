@extends('layouts.app')
@section('titulo', 'Galería de Productos')
@section('contenido')

<div class="page-header">
    <div>
        <h1 class="page-title">Galería de Productos</h1>
        <div class="gold-line"></div>
        <p class="page-subtitle">{{ $productos->count() }} productos encontrados</p>
    </div>
    <a href="{{ route('productos.index') }}" class="btn btn-outline btn-sm">Ver como tabla</a>
</div>

{{-- ── BARRA DE FILTROS ── --}}
<div class="filtros-bar">
    {{-- FILTRO POR CATEGORÍA: envía el formulario al cambiar el select --}}
    <form action="{{ route('productos.galeria') }}" method="GET" style="display:flex; align-items:center; gap:.7rem; flex:1; flex-wrap:wrap">
        <label for="categoria">Categoría:</label>
        <select name="categoria" id="categoria" onchange="this.form.submit()">
            <option value="">Todas</option>
            @foreach($categorias as $cat)
                <option value="{{ $cat->id_categoria }}"
                    {{ $categoriaSelected == $cat->id_categoria ? 'selected' : '' }}>
                    {{ $cat->descripcion }}
                </option>
            @endforeach
        </select>

        @if($categoriaSelected)
            <a href="{{ route('productos.galeria') }}" class="btn btn-outline btn-sm">✕ Limpiar</a>
        @endif
    </form>

    {{-- BUSCADOR EN TIEMPO REAL (JavaScript, no recarga la página) --}}
    <div style="display:flex; align-items:center; gap:.7rem; flex:1">
        <label for="buscador">Buscar:</label>
        <input type="text" id="buscador" placeholder="Escriba el nombre del producto..."
               oninput="filtrarProductos(this.value)">
    </div>
</div>

{{-- ── GRID DE PRODUCTOS ── --}}
@if($productos->isEmpty())
    <div class="alert alert-info">No hay productos en esta categoría.</div>
@else
<div class="galeria-grid" id="galeriaGrid">
    @foreach($productos as $producto)
    {{-- data-nombre se usa para la búsqueda en JS --}}
    <div class="producto-card {{ $producto->stock == 0 ? 'agotado' : '' }}"
         data-nombre="{{ strtolower($producto->nombre) }} {{ strtolower($producto->marca) }}">

        {{-- Imagen con overlay si está agotado --}}
        <div class="prod-img-wrap">
            @if($producto->foto && file_exists(public_path('img/productos/' . $producto->foto)))
                <img src="{{ asset('img/productos/' . $producto->foto) }}"
                     alt="{{ $producto->nombre }}">
            @else
                <div class="no-foto">
                    <span style="font-size:2rem">📦</span>
                    <span>Sin imagen</span>
                </div>
            @endif

            {{-- Badge de categoría sobre la imagen --}}
            <span class="prod-badge-cat">{{ $producto->categoria->descripcion ?? '—' }}</span>

            {{-- Overlay "AGOTADO" si stock = 0 --}}
            @if($producto->stock == 0)
                <div class="agotado-overlay">
                    <span class="agotado-label">Agotado</span>
                </div>
            @endif
        </div>

        <div class="card-body">
            <h3>{{ $producto->nombre }}</h3>
            <p class="marca">{{ $producto->marca }}</p>

            {{-- Badge de stock con color --}}
            @if($producto->stock == 0)
                <span class="stock-badge stock-low">Sin stock</span>
            @elseif($producto->stock <= 5)
                <span class="stock-badge stock-warn">Stock bajo: {{ $producto->stock }}</span>
            @elseif($producto->stock <= 20)
                <span class="stock-badge stock-warn">Stock: {{ $producto->stock }}</span>
            @else
                <span class="stock-badge stock-ok">Stock: {{ $producto->stock }}</span>
            @endif

            <p class="precio">S/. {{ number_format($producto->precio, 2) }}</p>
        </div>

        <div class="card-footer">
            <a href="{{ route('productos.show', $producto->id_producto) }}"
               class="btn btn-outline btn-sm">Ver detalle</a>

            {{-- Botón deshabilitado si está agotado --}}
            @if($producto->stock > 0)
                <form action="{{ route('carrito.agregar', $producto->id_producto) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">+ Carrito</button>
                </form>
            @else
                <button class="btn btn-success btn-sm" disabled title="Sin stock disponible">
                    Agotado
                </button>
            @endif

            {{-- Botón editar solo para admin --}}
            @if(Auth::user()->rol === 'admin')
                <a href="{{ route('productos.edit', $producto->id_producto) }}"
                   class="btn btn-gold btn-sm">✏ Editar</a>
            @endif
        </div>

    </div>
    @endforeach
</div>

{{-- Mensaje cuando la búsqueda no encuentra nada --}}
<p id="noResultados" style="display:none; color:var(--ink-light); text-align:center; padding:3rem; font-size:1rem">
    No se encontraron productos con ese nombre.
</p>
@endif

<script>
// Filtra las tarjetas en tiempo real según lo que escribe el usuario
function filtrarProductos(texto) {
    const termino = texto.toLowerCase().trim();
    const cards   = document.querySelectorAll('#galeriaGrid .producto-card');
    let   visibles = 0;

    cards.forEach(card => {
        const nombre = card.dataset.nombre || '';
        if (nombre.includes(termino)) {
            card.style.display = '';
            visibles++;
        } else {
            card.style.display = 'none';
        }
    });

    // Muestra mensaje si no hay resultados
    const noRes = document.getElementById('noResultados');
    if (noRes) noRes.style.display = visibles === 0 ? 'block' : 'none';
}
</script>

@endsection