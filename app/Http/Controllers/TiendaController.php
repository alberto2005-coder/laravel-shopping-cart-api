<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\Carrito;
use Illuminate\Support\Facades\Auth;

class TiendaController extends Controller
{
    public function index()
    {
        $articulos = Articulo::where('stock', '>', 0)->get();
        return view('tienda.index', compact('articulos'));
    }
}
