<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\CarritoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    // ── Helpers privados ─────────────────────────────────────────────────

    private function uid(): int
    {
        return Auth::id();
    }

    private function items()
    {
        return CarritoItem::where('user_id', $this->uid())->with('producto')->get();
    }

    private function buildProductos($items): array
    {
        $productos = [];
        foreach ($items as $item) {
            if ($item->producto) {
                $subtotal    = $item->producto->precio * $item->cantidad;
                $productos[] = [
                    'producto' => $item->producto,
                    'cantidad' => $item->cantidad,
                    'subtotal' => $subtotal,
                ];
            }
        }
        return $productos;
    }

    private function calcTotal(array $productos): float
    {
        return array_sum(array_column($productos, 'subtotal'));
    }

    // ── Rutas ─────────────────────────────────────────────────────────────

    public function index()
    {
        $productos = $this->buildProductos($this->items());
        $total     = $this->calcTotal($productos);

        return view('carrito.index', compact('productos', 'total'));
    }

    public function agregar($id)
    {
        $producto = Producto::findOrFail($id);

        if ($producto->stock == 0) {
            return back()->with('error', 'Este producto está agotado.');
        }

        $item = CarritoItem::firstOrCreate(
            ['user_id' => $this->uid(), 'producto_id' => $id],
            ['cantidad' => 0]
        );

        if ($item->cantidad >= $producto->stock) {
            return back()->with('error', 'No hay más stock disponible de ' . $producto->nombre);
        }

        $item->increment('cantidad');

        return back()->with('success', '«' . $producto->nombre . '» agregado al carrito.');
    }

    public function quitar($id)
    {
        $item = CarritoItem::where('user_id', $this->uid())
                           ->where('producto_id', $id)
                           ->first();

        if ($item) {
            if ($item->cantidad > 1) {
                $item->decrement('cantidad');
            } else {
                $item->delete();
            }
        }

        return back()->with('info', 'Carrito actualizado.');
    }

    public function vaciar()
    {
        CarritoItem::where('user_id', $this->uid())->delete();
        return back()->with('info', 'El carrito ha sido vaciado.');
    }

    public function confirmar()
    {
        $productos = $this->buildProductos($this->items());

        if (empty($productos)) {
            return redirect()->route('carrito.index')
                             ->with('info', 'No tienes productos en el carrito.');
        }

        $total   = $this->calcTotal($productos);
        $usuario = Auth::user();
        $fecha   = now()->format('d/m/Y H:i');

        return view('carrito.confirmar', compact('productos', 'total', 'usuario', 'fecha'));
    }
}