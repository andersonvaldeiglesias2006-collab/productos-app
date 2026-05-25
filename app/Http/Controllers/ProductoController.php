<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Vista tabla
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }

    // Galería con filtro por categoría
    public function galeria(Request $request)
    {
        $categorias = Categoria::all();
        $query      = Producto::with('categoria');

        if ($request->filled('categoria')) {
            $query->where('id_categoria', $request->categoria);
        }

        $productos         = $query->get();
        $categoriaSelected = $request->categoria;

        return view('productos.galeria', compact('productos', 'categorias', 'categoriaSelected'));
    }

    // Detalle de un producto
    public function show($id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    // Formulario de edición (solo admin)
    public function edit($id)
    {
        $producto   = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    // Guardar cambios (solo admin)
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre'       => 'required|string|max:255',
            'marca'        => 'required|string|max:100',
            'precio'       => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'id_categoria' => 'required|exists:categorias,id_categoria',
        ], [
            'nombre.required'       => 'El nombre es obligatorio.',
            'marca.required'        => 'La marca es obligatoria.',
            'precio.required'       => 'El precio es obligatorio.',
            'precio.numeric'        => 'El precio debe ser un número.',
            'stock.required'        => 'El stock es obligatorio.',
            'stock.integer'         => 'El stock debe ser un número entero.',
            'id_categoria.required' => 'Seleccione una categoría.',
        ]);

        $producto->update($request->only('nombre', 'marca', 'precio', 'stock', 'id_categoria'));

        return redirect()->route('productos.show', $id)
                         ->with('success', 'Producto actualizado correctamente.');
    }
}