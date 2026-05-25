<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'ProductosApp')</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink:        #1a1a2e;
            --ink-light:  #3d3d5c;
            --gold:       #c9a84c;
            --gold-light: #e8c97a;
            --cream:      #faf8f3;
            --white:      #ffffff;
            --red:        #b5293a;
            --red-dk:     #8c1f2b;
            --green:      #2d6a4f;
            --border:     #e8e0d0;
            --shadow-sm:  0 2px 8px rgba(26,26,46,.08);
            --shadow-md:  0 8px 32px rgba(26,26,46,.12);
            --shadow-lg:  0 20px 60px rgba(26,26,46,.18);
            --radius:     12px;
            --radius-sm:  8px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--ink);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        a { color: var(--red); text-decoration: none; transition: color .2s; }
        a:hover { color: var(--red-dk); }

        /* ── NAVBAR ── */
        .navbar {
            background: var(--ink);
            padding: 0 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 68px;
            box-shadow: 0 4px 24px rgba(26,26,46,.25);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.55rem;
            color: var(--white);
            letter-spacing: .5px;
        }
        .brand span { color: var(--gold); }

        .nav-links { display: flex; align-items: center; gap: .3rem; }

        .nav-links a {
            color: rgba(255,255,255,.72);
            padding: .45rem .9rem;
            border-radius: 6px;
            font-size: .9rem;
            font-weight: 500;
            transition: all .2s;
        }
        .nav-links a:hover {
            color: var(--white);
            background: rgba(255,255,255,.08);
            text-decoration: none;
        }

        .nav-divider {
            width: 1px;
            height: 20px;
            background: rgba(255,255,255,.15);
            margin: 0 .5rem;
        }

        .nav-user {
            color: var(--gold-light);
            font-size: .85rem;
            font-weight: 500;
            padding: .45rem .9rem;
        }

        .btn-carrito {
            background: var(--gold);
            color: var(--ink) !important;
            padding: .45rem 1.1rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: .88rem;
            transition: all .2s;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
        }
        .btn-carrito:hover {
            background: var(--gold-light);
            text-decoration: none;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(201,168,76,.35);
        }

        .cart-count {
            background: var(--red);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: .72rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        /* ── MAIN ── */
        .main-content {
            max-width: 1240px;
            margin: 0 auto;
            padding: 2.5rem 2rem;
            flex: 1;
            width: 100%;
        }

        /* ── PAGE HEADER ── */
        .page-header {
            margin-bottom: 2rem;
            padding-bottom: 1.2rem;
            border-bottom: 2px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--ink);
            line-height: 1.2;
        }
        .page-subtitle {
            color: var(--ink-light);
            font-size: .9rem;
            margin-top: .25rem;
            font-weight: 400;
        }

        /* ── CARDS ── */
        .card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            padding: 1.8rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border);
        }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .6rem 1.4rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: .9rem;
            cursor: pointer;
            border: none;
            transition: all .22s;
            font-family: 'DM Sans', sans-serif;
            line-height: 1;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn:active { transform: translateY(0); }

        .btn-primary {
            background: var(--ink);
            color: var(--white);
            box-shadow: var(--shadow-sm);
        }
        .btn-primary:hover {
            background: var(--ink-light);
            color: var(--white);
            text-decoration: none;
            box-shadow: var(--shadow-md);
        }

        .btn-gold {
            background: var(--gold);
            color: var(--ink);
            box-shadow: var(--shadow-sm);
        }
        .btn-gold:hover {
            background: var(--gold-light);
            color: var(--ink);
            text-decoration: none;
            box-shadow: 0 4px 16px rgba(201,168,76,.4);
        }

        .btn-success {
            background: var(--green);
            color: var(--white);
        }
        .btn-success:hover {
            background: #1e4d38;
            color: var(--white);
            text-decoration: none;
        }
        .btn-success:disabled {
            background: #ccc;
            color: #888;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-danger {
            background: var(--red);
            color: var(--white);
        }
        .btn-danger:hover {
            background: var(--red-dk);
            color: var(--white);
            text-decoration: none;
        }

        .btn-outline {
            background: transparent;
            border: 1.5px solid var(--ink);
            color: var(--ink);
        }
        .btn-outline:hover {
            background: var(--ink);
            color: var(--white);
            text-decoration: none;
        }

        .btn-outline-gold {
            background: transparent;
            border: 1.5px solid var(--gold);
            color: var(--gold);
        }
        .btn-outline-gold:hover {
            background: var(--gold);
            color: var(--ink);
            text-decoration: none;
        }

        .btn-sm { padding: .38rem .85rem; font-size: .82rem; }
        .btn-lg { padding: .85rem 2rem; font-size: 1rem; }

        /* ── GALERÍA ── */
        .galeria-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.8rem;
            margin-top: 1.5rem;
        }

        .producto-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform .28s cubic-bezier(.34,1.56,.64,1), box-shadow .28s ease;
        }
        .producto-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }
        .producto-card.agotado { opacity: .65; }

        .prod-img-wrap { position: relative; overflow: hidden; height: 220px; }
        .prod-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s ease;
        }
        .producto-card:hover .prod-img-wrap img { transform: scale(1.05); }

        .no-foto {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #f0ede6, #e8e3d8);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #a89f8e;
            font-size: .9rem;
            gap: .5rem;
        }

        .agotado-overlay {
            position: absolute;
            inset: 0;
            background: rgba(26,26,46,.6);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .agotado-label {
            background: var(--red);
            color: white;
            font-weight: 700;
            font-size: 1rem;
            padding: .5rem 1.5rem;
            border-radius: 4px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .prod-badge-cat {
            position: absolute;
            top: .75rem;
            left: .75rem;
            background: rgba(26,26,46,.8);
            color: var(--gold-light);
            font-size: .72rem;
            font-weight: 600;
            padding: .25rem .65rem;
            border-radius: 20px;
            backdrop-filter: blur(4px);
        }

        .card-body {
            padding: 1.1rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .card-body h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: .2rem;
            color: var(--ink);
        }
        .card-body .marca {
            color: var(--ink-light);
            font-size: .83rem;
            margin-bottom: .6rem;
        }
        .card-body .precio {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            color: var(--red);
            margin-top: auto;
            padding-top: .6rem;
        }
        .stock-badge {
            font-size: .78rem;
            font-weight: 600;
            padding: .2rem .6rem;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: .5rem;
        }
        .stock-ok   { background: #d5f5e3; color: var(--green); }
        .stock-warn { background: #fef9e7; color: #b7770d; }
        .stock-low  { background: #fdecea; color: var(--red); }

        .card-footer {
            padding: .9rem 1.1rem;
            border-top: 1px solid var(--border);
            display: flex;
            gap: .5rem;
            align-items: center;
            justify-content: flex-end;
        }

        /* ── FILTROS ── */
        .filtros-bar {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.2rem 1.5rem;
            margin-bottom: 1.8rem;
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
            box-shadow: var(--shadow-sm);
        }
        .filtros-bar label {
            font-weight: 600;
            font-size: .88rem;
            color: var(--ink-light);
            white-space: nowrap;
        }
        .filtros-bar select,
        .filtros-bar input[type="text"] {
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            padding: .5rem .9rem;
            font-size: .9rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            background: var(--cream);
            transition: border-color .2s;
            flex: 1;
            min-width: 160px;
        }
        .filtros-bar select:focus,
        .filtros-bar input:focus {
            outline: none;
            border-color: var(--gold);
        }

        /* ── TABLA ── */
        table { width: 100%; border-collapse: collapse; }
        thead th {
            background: var(--ink);
            color: var(--gold-light);
            padding: .75rem 1rem;
            text-align: left;
            font-size: .85rem;
            font-weight: 600;
            letter-spacing: .4px;
        }
        thead th:first-child { border-radius: var(--radius-sm) 0 0 0; }
        thead th:last-child  { border-radius: 0 var(--radius-sm) 0 0; }
        tbody td { padding: .75rem 1rem; border-bottom: 1px solid var(--border); font-size: .92rem; }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: #faf7f0; }

        /* ── ALERTS ── */
        .alert {
            padding: .9rem 1.2rem;
            border-radius: var(--radius-sm);
            margin-bottom: 1.2rem;
            font-size: .92rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: .6rem;
        }
        .alert-success { background: #d5f5e3; border-left: 4px solid var(--green); color: #1e4d38; }
        .alert-danger  { background: #fdecea; border-left: 4px solid var(--red); color: var(--red-dk); }
        .alert-info    { background: #e8f4fd; border-left: 4px solid #2471a3; color: #1a5276; }
        .alert-gold    { background: #fef9e7; border-left: 4px solid var(--gold); color: #7d6608; }

        /* ── FORMULARIOS ── */
        .form-group { margin-bottom: 1.4rem; }
        .form-group label {
            display: block;
            font-weight: 600;
            font-size: .88rem;
            color: var(--ink-light);
            margin-bottom: .45rem;
            text-transform: uppercase;
            letter-spacing: .5px;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: .7rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: .95rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            background: var(--cream);
            transition: border-color .2s, box-shadow .2s;
        }
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,168,76,.15);
        }
        .form-error { color: var(--red); font-size: .82rem; margin-top: .35rem; }

        /* ── CARRITO ── */
        .carrito-row td { vertical-align: middle; }
        .qty-control { display: flex; align-items: center; gap: .5rem; }
        .qty-num { font-weight: 700; font-size: 1rem; min-width: 24px; text-align: center; }

        /* ── FOOTER ── */
        .site-footer {
            background: var(--ink);
            color: rgba(255,255,255,.4);
            text-align: center;
            padding: 1.2rem;
            font-size: .82rem;
            margin-top: auto;
        }
        .site-footer span { color: var(--gold); opacity: .8; }

        /* ── STAT CARDS ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.2rem;
            margin: 1.5rem 0;
        }
        .stat-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: transform .2s, box-shadow .2s;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }
        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            color: var(--red);
            line-height: 1;
        }
        .stat-label { color: var(--ink-light); font-size: .88rem; margin-top: .4rem; font-weight: 500; }

        /* ── DECORATIVE LINE ── */
        .gold-line {
            height: 3px;
            background: linear-gradient(90deg, var(--gold), var(--gold-light), transparent);
            border-radius: 2px;
            margin: .5rem 0 1.5rem;
        }

        /* ── LOGOUT form inline ── */
        form.inline { display: inline; margin: 0; }
    </style>
</head>
<body>

<div class="navbar">
    <a href="{{ route('home') }}" class="brand">Productos<span>App</span></a>
    <div class="nav-links">
        @auth
            <a href="{{ route('productos.galeria') }}">Galería</a>
            <a href="{{ route('productos.index') }}">Productos</a>
            <a href="{{ route('categorias.index') }}">Categorías</a>
            <div class="nav-divider"></div>

            <a href="{{ route('carrito.index') }}" class="btn-carrito">
                🛒 Carrito

                @php
                    $cartCount = Auth::check()
                        ? \App\Models\CarritoItem::where('user_id', Auth::id())->sum('cantidad')
                        : 0;
                @endphp

                @if($cartCount > 0)
                    <span class="cart-count">{{ $cartCount }}</span>
                @endif
            </a>

            <div class="nav-divider"></div>
            <span class="nav-user">{{ Auth::user()->name }}</span>

            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="btn btn-outline-gold btn-sm">Salir</button>
            </form>
        @else
            <a href="{{ route('login') }}">Iniciar sesión</a>
        @endauth
    </div>
</div>

<div class="main-content">
    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">⛔ {{ session('error') }}</div>
    @endif

    @if(session('info'))
        <div class="alert alert-info">ℹ️ {{ session('info') }}</div>
    @endif

    @yield('contenido')
</div>

<div class="site-footer">
    Desarrollo de Aplicaciones en Internet &mdash; Ciclo III &mdash; <span>{{ date('Y') }}</span>
</div>

</body>
</html>