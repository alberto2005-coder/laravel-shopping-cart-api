<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\Carrito;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = Auth::user()->carrito;
        $articulos = $carrito ? $carrito->articulos : [];
        $total = $articulos->sum(function ($articulo) {
            return $articulo->precio * $articulo->pivot->cantidad;
        });

        return view('carrito.index', compact('articulos', 'total'));
    }

    public function add(Request $request, $articuloId)
    {
        $user = Auth::user();
        $carrito = $user->carrito;

        if (!$carrito) {
            $carrito = Carrito::create(['user_id' => $user->id]);
        }

        $articulo = Articulo::findOrFail($articuloId);

        if ($articulo->stock < 1) {
            return back()->with('error', 'No hay stock disponible.');
        }

        // Check if item already in cart
        $existingItem = $carrito->articulos()->where('articulo_id', $articuloId)->first();

        if ($existingItem) {
            $newQuantity = $existingItem->pivot->cantidad + 1;
            if ($newQuantity > $articulo->stock) {
                return back()->with('error', 'No hay suficiente stock.');
            }
            $carrito->articulos()->updateExistingPivot($articuloId, ['cantidad' => $newQuantity]);
        } else {
            $carrito->articulos()->attach($articuloId, ['cantidad' => 1]);
        }

        return redirect()->route('carrito.index')->with('success', 'Producto añadido al carrito.');
    }

    public function remove($articuloId)
    {
        $carrito = Auth::user()->carrito;
        if ($carrito) {
            $carrito->articulos()->detach($articuloId);
        }
        return back()->with('success', 'Producto eliminado del carrito.');
    }
}
